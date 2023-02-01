<?php

namespace App\Http\Controllers;

use App\ArrayHelper;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\ModifyProjectRequest;
use App\Models\Project;
use App\Models\ProjectConfiguration;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ProjectController extends BaseController
{


    public function index(): \Inertia\Response
    {

        return Inertia::render('Index', [
            'projects' => Project::all()
        ]);
    }


    public function create(): \Inertia\Response
    {
        return Inertia::render('Project/Create');

    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function handleCreate(CreateProjectRequest $request)
    {
        Auth::user()->projects()->create($request->validated());
        return redirect('/');
    }


    public function edit(string $id): \Inertia\Response
    {
        $project = Project::with('config')->find($id);
        return Inertia::render('Project/Edit', [
            'project' => $project
        ]);
    }

    public function handleEdit(ModifyProjectRequest $request, $id): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $validated = $request->validated();
        $projectValues = $request->safe()->only(['name', 'description']);
        $configurationValues = $request->safe()->only(ProjectConfiguration::getValues());
        $project = Project::find($id);
        $project->update($projectValues);
        $project->config()->update(ArrayHelper::convertKeysToSnakeCase($configurationValues));
        return redirect('/');
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        Project::destroy($id);
        return redirect('/');
    }

}
