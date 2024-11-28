<?php

namespace App\Http\Controllers;

use App\Models\Structure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StructureController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Response::api([
            'message' => 'Structure added!',
            'data'    => Structure::create($request->validate(['name' => 'required|string|max:225']))
        ]);
    }
}
