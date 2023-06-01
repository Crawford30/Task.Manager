<?php

namespace App\Http\Controllers\Api;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function getAllProjects(){
        $projects = Project::orderByDesc("created_at")->get();
        return apiResponse($projects);
    }
}
