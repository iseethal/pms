<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['id','project_id','task_name','hours','date','description','status'];

    public $timestamp = false;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
