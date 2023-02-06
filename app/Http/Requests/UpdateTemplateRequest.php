<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateTemplateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = Auth::user()->id;
        $projectId = $this->project->id;
        return [
            'name' => ['required', Rule::unique('templates')->where(function ($query) use ($projectId) {
                return $query->where('name', $this->request->get('name'))->where('project_id', $projectId);
            })],
            'description' => 'nullable',
            'subject' => 'required',
            'body' => 'required',
        ];
    }


}
