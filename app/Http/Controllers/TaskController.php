<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $body = $request->all();
        $user = $request->user();
        $body['creator'] = $user->id;
        $validation = Validator::make($body, [
            'name' => 'required|string|max:64',
            'description' => 'string',
            'creator' => 'required|integer|exists:users,id',
        ]);
        if($validation->fails()){
            return response()->json($validation->errors(), 417);
        }
        return Task::create($body);
    }

    public function index(Request $request)
    {
        $user = $request->user();
        return Task::where('creator', $user->id)->get();
    }

    public function show(Task $task, Request $request)
    {
        $user = $request->user();
        if(!$this->hasPermission($task, $user))
            return response()->json(['message' => 'Permission denied'], 403);
        return $task;
    }

    public function update(Request $request, Task $task)
    {
        $user = $request->user();
        if(!$this->hasPermission($task, $user))
            return response()->json(['message' => 'Permission denied'], 403);
        $body = $request->all();
        $validation = Validator::make($body, [
            'name' => 'string|max:64',
            'description' => 'string'
        ]);
        if($validation->fails()){
            return response()->json($validation->errors(), 417);
        }
        $task->update($body);
        return $task;
    }

    public function destroy(Task $task, Request $request)
    {
        $user = $request->user();
        if(!$this->hasPermission($task, $user))
            return response()->json(['message' => 'Permission denied'], 403);
        $task->delete();
        return response(null, 200);
    }

    public function hasPermission($task, $user)
    {
        return $task->creator == $user->id;
    }
}
