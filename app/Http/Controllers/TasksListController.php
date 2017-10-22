<?php

namespace App\Http\Controllers;

use App\TasksList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// TODO: Make auth
class TasksListController extends Controller
{
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:64',
            'description' => 'string',
            'creator' => 'required|integer|exists:users,id',
        ]);
        if($validation->fails()){
            return response()->json($validation->errors(), 417);
        }
        return TasksList::create($request->all());
    }

    public function index()
    {
        return TasksList::all();
    }

    public function show(TasksList $tasksList)
    {
        return $tasksList;
    }

    public function update(Request $request, TasksList $tasksList)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'string|max:64',
            'description' => 'string',
            'creator' => 'integer|exists:users,id',
        ]);
        if($validation->fails()){
            return response()->json($validation->errors(), 417);
        }
        $tasksList->update($request->all());
        return $tasksList;
    }

    public function destroy(TasksList $tasksList)
    {
        $tasksList->delete();
        return response(null, 200);
    }
}
