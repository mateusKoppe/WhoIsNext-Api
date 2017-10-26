<?php

namespace App\Http\Controllers;

use App\Helper;
use App\User;
use App\Task;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function store()
    {
        // TODO: Implement store
    }

    public function index(Task $task, Request $request)
    {
        $user = $request->user();
        if(!$task->hasPermission($user))
            return response()->json(['message' => 'Permission denied'], 403);
        return Helper::where('task', $task->id)->get();
    }

    public function show(Helper $helper, Request $request)
    {
        // TODO: Implement show
    }

    public function update()
    {
        // TODO: Implement update
    }

    public function destroy()
    {
        // TODO: Implement destroy
    }
}
