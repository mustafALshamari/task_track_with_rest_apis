<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Task;
use App\TaskUser;
use App\User;
use DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request,  [ 
            "fname" => "required" ,
             "lname" => "required" 
             ]);

        $user = User::create($request->all());
        return response()->json(['Your new user added Successfully' => 'Successful'],201);
        
    }

    public function destroy($id)
    {
        $task = User::find($id);
        $task->delete();
        return response()->json(null ,204);
        
    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->save();
        return response()->json(['Your user updated Successfully' => 'Successful'],201);
        
    }

}
