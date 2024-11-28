<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(): Response
    {
        return Response::api([
            'message' => 'All permissions!',
            'data'    => Permission::paginate()
        ]);
    }

    public function store(Request $request): Response
    {
        $validated = $request->validate([
            'name' => 'string|required|max:225'
        ]);

        return Response::api([
            'message' => 'Permission added!',
            'data'    => Permission::create($validated)
        ]);
    }
}
