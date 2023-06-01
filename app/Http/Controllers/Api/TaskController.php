<?php

namespace App\Http\Controllers\Api;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest\CreateTaskRequest;
use App\Http\Requests\TaskRequest\DeleteTaskRequest;

class TaskController extends Controller
{
       /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function saveTaskData(CreateTaskRequest $request){
        return $request->save();
    }




    public function getAllTasks(){
        $tasks = Task::orderByDesc("created_at")->get();
        return apiResponse($tasks);
    }





    public function deleteTaskData(DeleteTaskRequest $request)
    {
        return $request->deleteTask();
    }
}
