<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['id','project_name','status'];

    public $timestamp = false;

    public function task()
    {
        return $this->hasMany(Task::class);
    }
}
