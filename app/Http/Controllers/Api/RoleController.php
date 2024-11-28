<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return Response::api([
            'message' => 'All roles!',
            'data'    => Role::paginate()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $role = Role::create([
            'name' => $validated['name'],
        ]);

        $role->givePermissionTo($validated['permissions']);

        return Response::api([
            'message' => 'Role added!',
            'data'    => $role
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role): JsonResponse
    {
        return Response::api([
            'message' => 'Role!',
            'data'    => $role->load('permissions')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role): JsonResponse
    {
        return Response::api([
            'message' => 'Role updated!',
            'data'    => tap($role)
                ->update($request->only('name'))
                ->syncPermissions($request->input('permissions'), [])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role): JsonResponse
    {
        tap($role->syncPermissions([]))->delete();

        return Response::api('Role deleted!');
    }
}
