<?php

namespace App\Http\Controllers;

use App\Helper;
use App\User;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HelperController extends Controller
{
    public function store(Task $task, Request $request)
    {
        $body = $request->all();
        $user = $request->user();
        if(!$task->hasPermission($user))
            return response()->json(['message' => 'Permission denied'], 403);
        $validator = Validator::make($body, [
            'name' => 'required|string|min:2|max:64',
            'helped_times' => 'integer|min:0',
            'account' => 'integer|min:1|exists:users,id',
        ]);
        if($validator->fails())
            return response($validator->errors(), 417);
        return Helper::create($body);
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
        $user = $request->user();
        $task = $helper->getTask();
        if(!$task->hasPermission($user))
            return response()->json(['message' => 'Permission denied'], 403);
        return $helper;
    }

    public function update(Helper $helper, Request $request)
    {
        $body = $request->all();
        $user = $request->user();
        $task = $helper->getTask();
        if(!$task->hasPermission($user))
            return response()->json(['message' => 'Permission denied'], 403);
        $validator = Validator::make($body, [
            'name' => 'required|string|min:2|max:64',
            'helped_times' => 'integer|min:0',
            'account' => 'integer|min:1|exists:users,id',
        ]);
        if($validator->fails())
            return response($validator->errors(), 417);
        $helper->update($body);
        return $helper;
    }

    public function destroy()
    {
        // TODO: Implement destroy
    }
}
