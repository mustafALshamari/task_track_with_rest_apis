<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Task;
use Illuminate\Http\Request;
use App\TaskUser;
use App\User;
use DB;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks,200);
    }

    public function taskByid($id)
    {
        $findTaskByid = Task::find($id);
        return response()->json($findTaskByid,200);
        
    }

    public function store(Request $request)
    {
        $this->validate($request, [ 
            "title" => "required" ,
             "desc" => "required" 
             ]);

        $taskCreate = Task::create($request->all());
        return response()->json(['Your new task created Successfully' => 'Successful'],201);
        
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return response()->json(null, 204);
        
    }


    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $task->title = $request->title;
        $task->desc = $request->desc;
        $task->save();
        return response()->json(['Your task updated Successfully' => 'Successful'],201);
        
    }


    
    public function assigntask(Request $request)
    {
        $this->validate($request,  [ 
            "task_id" => "required" ,
             "user_id" => "required" 
             ]);

        $taskAssinge = TaskUser::create($request->all());
        return response()->json(['Your task is assigned Successfully' => 'Successful'],201);
        
    }

    public function getAssignedTasks()
    {
        $tasks = DB::table('task_users')
       ->join('tasks', 'task_users.task_id', '=', 'tasks.id')
       ->join('users', 'task_users.user_id', '=', 'users.id')
       ->orderBy('task_users.user_id', 'asc')
       ->get();
       return response()->json($tasks, 200);
    }

    public function findAssingedTask($id)
    {
        $task = TaskUser::find($id);
        return response()->json($task, 200);
        
    }

    public function updateAssingedTask(Request $request,$id)
    {
        $task = TaskUser::find($id);
        $task->task_id = $request->task_id;
        $task->user_id = $request->user_id;
        $task->status = $request->status;
        $task->save();
        return response()->json(['Your assigned task updated Successfully' => 'Successful'],201);
    }

    public function updateAssingedTaskStatus(Request $request, $id)
    {
        $task = TaskUser::find($id);
        $task->status = $request->status;
        $task->save();
        return response()->json(['Your task status updated' => 'Successful'],201);
        
    }
    
    public function destroyAssingedTask($id)
    {
        $task = TaskUser::find($id);
        $task->delete();
        return response()->json(null, 204);
        
    }



}
