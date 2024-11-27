<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrganisationRequest;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrganisationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //TODO: Return organisations created by user.
        //TODO: Add policies too
        return Response::api([
            'message' => 'All organisations!',
            'data'    => Organisation::paginate()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrganisationRequest $request)
    {
        return Response::api([
            'message' => 'Organisation added!',
            'data'    => Organisation::create($request->validated())
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Organisation $organisation)
    {
        return Response::api([
            'message' => 'Organisation!',
            'data'    => $organisation
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Organisation $organisation)
    {
        $organisation->update($request->all());

        return Response::api([
            'message' => 'Organisation updated!',
            'data'    => $organisation
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organisation $organisation)
    {
        $organisation->delete();

        return Response::api('Organisation deleted!');
    }
}
