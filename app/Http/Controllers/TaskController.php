<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::latest()->paginate();
        return view('index',compact('tasks'));
    }
    public function store(Request $request){
        $request->validate(
            [
                'task' =>'required'
            ],
            [
                'task.require' => 'task is require'
            ]
            );
        $task = new Task();
        $task->task = $request->task;
        $task->save();
        return response()->json([
            'status' =>'success',
        ]);
    }
    public function update(Request $request){
        $request->validate(
            [
                'task' =>'required'.$request->up_id
            ],
            [
                'task.require' => 'task is require'
            ]
            );
            Task::where('id',$request->up_id)->update([
                'task' => $request->up_task,
            ]);
        return response()->json([
            'status' =>'success',
        ]);
    }
    public function delete(Request $request){
        Task::find($request->task_id)->delete();
        return response()->json([
            'status' =>'success',
        ]);
    }
}
