<?php

namespace App\Http\Controllers;

use App\TasksList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TasksListController extends Controller
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
        return TasksList::create($body);
    }

    public function index(Request $request)
    {
        $user = $request->user();
        return TasksList::where('creator', $user->id)->get();
    }

    public function show(TasksList $tasksList, Request $request)
    {
        $user = $request->user();
        if(!$this->hasPermission($tasksList, $user))
            return response()->json(['message' => 'Permission denied'], 403);
        return $tasksList;
    }

    public function update(Request $request, TasksList $tasksList)
    {
        $user = $request->user();
        if(!$this->hasPermission($tasksList, $user))
            return response()->json(['message' => 'Permission denied'], 403);
        $body = $request->all();
        $validation = Validator::make($body, [
            'name' => 'string|max:64',
            'description' => 'string'
        ]);
        if($validation->fails()){
            return response()->json($validation->errors(), 417);
        }
        $tasksList->update($body);
        return $tasksList;
    }

    public function destroy(TasksList $tasksList, Request $request)
    {
        $user = $request->user();
        if(!$this->hasPermission($tasksList, $user))
            return response()->json(['message' => 'Permission denied'], 403);
        $tasksList->delete();
        return response(null, 200);
    }

    public function hasPermission($tasksList, $user)
    {
        return $tasksList->creator == $user->id;
    }
}
