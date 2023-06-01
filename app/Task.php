<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $table = 'tasks';

    use HasFactory;
    protected $fillable = [
        'task_name','user_id','task_reference_number', 'task_priority','project_id'
    ];


    public function getCreatedAtAttribute($value)
    {
        $date = $this->asDateTime($value);
        return $date->timezone(env('TIMEZONE'));
    }

    public function getUpdatedAtAttribute($value)
    {
        $date = $this->asDateTime($value);
        return $date->timezone(env('TIMEZONE'));
    }


    public function project()
    {
        return $this->belongsTo(Project::class, 'projects');
    }

}
