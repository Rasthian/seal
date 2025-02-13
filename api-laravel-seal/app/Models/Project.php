<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    protected $primaryKey = 'id_project';
    protected $fillable = [
        'name',
        'description',
    ];



    public function tasks()
    {
        return $this->hasMany(Task::class,'project_id', 'id_project');
    }
}
