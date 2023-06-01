<?php

namespace App\Http\Requests\TaskRequest;

use App\Task;
use Illuminate\Foundation\Http\FormRequest;

class DeleteTaskRequest extends FormRequest
{
       /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

        /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "task_id" => "required"
        ];
    }

    public function deleteTask()
    {
        $task= Task::findOrFail($this->task_id);
        $task->delete();
        return response()->json("DELETED", 200);
    }
}
