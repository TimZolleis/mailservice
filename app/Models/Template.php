<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasUuids;

    protected $table = 'templates';
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'name',
        'subject',
        'text',
    ];
    public $timestamps = false;
    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'subject' => 'string',
        'text' => 'string',
    ];

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Project::class);
    }


}
