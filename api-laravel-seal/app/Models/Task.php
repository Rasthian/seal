<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $table = 'tasks';
    protected $primaryKey = 'id_task';
    protected $fillable = [
        'name',
        'description',
        'status',
        'project_id',
        'user_id'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'id_project');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
