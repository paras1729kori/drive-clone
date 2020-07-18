<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Session;

class TasksController extends Controller
{
    public function index(){
        $tasks = Task::all();
        return view('admin.task')->with('tasks',$tasks);
    }

    public function store(Request $request){
        $tasks = new Task;

        $tasks->task = $request->input('task');
        $tasks->subtask = $request->input('subtask');
        $tasks->description = $request->input('description');
        $tasks->save();

        Session::flash('statuscode','success');
        return redirect('/tasks')->with('status', 'Your Task is Added');
    }

    public function edit(Request $request, $id){
        $tasks = Task::findorfail($id);
        return view('admin.tasks.edit')->with('tasks',$tasks);
    }

    public function update(Request $request, $id){
        $tasks = Task::findorfail($id);

        $tasks->task = $request->input('task');
        $tasks->subtask = $request->input('subtask');
        $tasks->description = $request->input('description'); 
        $tasks->update();

        Session::flash('statuscode','info');
        return redirect('/tasks')->with('status', 'Your Task is updated');
    }

    public function delete(Request $request, $id){
        $tasks = Task::findorfail($id);

        $tasks->delete();

        Session::flash('statuscode','error');
        return redirect('/tasks')->with('status', 'Your Task is deleted');
    }
}
