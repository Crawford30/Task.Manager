<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    use HasFactory;



    protected $fillable = [
        'project_name'
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

    public function task()
    {
        return $this->hasMany(Task::class, 'tasks');
    }
}
