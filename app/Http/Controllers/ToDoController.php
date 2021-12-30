<?php

namespace App\Http\Controllers;

use App\Models\ToDo;
use Illuminate\Http\Request;

class ToDoController extends Controller
{
    //

    public function index()
    {


        $tasksCompleted = ToDo::orderBy('order')->select('id','title','order','status')->where('status',2)->get();
        $tasksNotCompleted = ToDo::orderBy('order')->select('id','title','order','status')->where('status',1)->get();
        $tasksList = ToDo::orderBy('order')->select('id','title','order','status')->where('status',0)->get();

        return  [$tasksCompleted,$tasksNotCompleted,$tasksList];
    }

    public function addTask(Request $request){
        $this->validate($request,[
            'taskTitle' => 'required'
        ]);

        ToDo::create([
            'title' => $request['taskTitle'],

            'status' => 0
        ]);

        return response('Task has been created successfully.', 200);
    }

    public function updateTasksStatus(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);

        $task = ToDo::find($id);
        $task->status = $request->status;
        $task->save();

        return response('Updated Successfully.', 200);

    }

    public function updateTasksOrder(Request $request)
    {
        $this->validate($request, [
            'tasks.*.order' => 'required|numeric',
        ]);

        $tasks = ToDo::all();

        foreach ($tasks as $task) {
            $id = $task->id;
            foreach ($request->tasks as $tasksNew) {
                if ($tasksNew['id'] == $id) {
                    $task->update(['order' => $tasksNew['order']]);
                }
            }
        }

        return response('Updated Successfully.', 200);
    }
}
