<?php

namespace App\Http\Controllers;

use App\TasksList;
use Illuminate\Http\Request;

// TODO: Make auth
class TasksListController extends Controller
{
    public function store(Request $request)
    {
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
        $tasksList->update($request->all());
        return $tasksList;
    }

    public function destroy(TasksList $tasksList)
    {
        $tasksList->delete();
        return response(null, 200);
    }
}
