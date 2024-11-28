<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Notifications\Welcome;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Notification;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Response::api([
            'message' => 'All users!',
            'data'    => User::paginate()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());

        $user->notify(new Welcome($user->firstPassword()));

        return Response::api([
            'message' => 'User added!',
            'data'    => $user
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return Response::api([
            'message' => 'User!',
            'data'    => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUserRequest $request, User $user)
    {
        $user->update($request->validated());

        return Response::api([
            'message' => 'User updated!',
            'data'    => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return Response::api('User deleted!');
    }
}
