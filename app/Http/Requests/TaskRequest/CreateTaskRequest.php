<?php

namespace App\Http\Requests\TaskRequest;

use App\Task;
use App\UserTask;
use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
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
            'task_name' => 'required|unique:task|max:40',
            'task_priority' => 'required',
            'project_id' => 'required',
        ];
    }




    public function saveTaskData($request)
    {

        $request = Task::updateOrCreate(
            ['id' => $this->task_id],
            [
                'task_name' => ($request->task_name),
                'user_id' => auth()->user()->id,
                'task_priority' => (int)$request->task_priority,
                'project_id' => $request->project_id,
            ]
        );

        if ($request->_task_reference_number == NULL) {
            $request->update([
                'task_reference_number' => $this->generateRefNumber($request)
            ]);
        }



        return apiResponse($request);
    }

    private function generateRefNumber($request)
    {
        $today = date('Ym');
        if (strlen($request->id) >= 4) {
            return "Task-Ref-" . $today . "-" . $request->id;
        }

        $len = strlen($request->id);
        $randomNumberLen = 4 - $len;
        $extras = ['', '0', '00', '000', '0000'];

        return  "Task-Ref-" . $today . "-" . $extras[$randomNumberLen] . $request->id;
    }
}
