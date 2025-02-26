<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::get();
        // dd($tasks->first());
        return new TaskCollection($tasks);
    }
    
    public function store(Request $request)
    {
        // dd($request);
        $task = Task::create([
            'title' => $request['title'],
            'status' => $request['status'],
            'user_id' => $request['user_id']
        ]);
        new TaskResource($task);
        return response()->json([
            'msg' => 'success',
        ]);
    }

    public function update($taskId, Request $request){
        // dd($request);
        $task = Task::find($taskId);
        $updated = $task;

        if(isset($request->title)){
            $updated->title = $request->title;
        }
        if(isset($request->status)){
            $updated->status = $request->status;
        }
        if(isset($request->user_id)){
            $updated->user_id = $request->user_id;
        }
        $task->update([
            'title' => $updated['title'],
            'status' => $updated['status'],
            'user_id' => $updated['user_id']
        ]);

        new TaskResource($task);

        return response()->json([
            'msg' => 'success',
        ]);
    }

    public function destroy($taskId){
        $task = Task::find($taskId)->delete();
        
        return response()->json([
            'msg' => 'deleted'
        ]);
    }
}
