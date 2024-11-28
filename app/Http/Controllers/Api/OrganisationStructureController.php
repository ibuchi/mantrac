<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organisation;
use App\Models\Structure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class OrganisationStructureController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Organisation $organisation)
    {
        $validated = $request->validate([
            'structures'                => 'required|array',
            'structures.*.file'         => 'required|file|mimes:png,jpg',
            'structures.*.structure_id' => 'required|exists:structures,id',
        ]);

        collect($validated)->each(function ($structure) use ($organisation) {
            $fileContent = $structure['file'];
            $fileExtension = $fileContent->getClientOriginalExtension();
            $fileName = $fileContent->getClientOriginalName();
            $filePath = "public/{$fileName}.{$fileExtension}";

            Storage::put($filePath, $fileContent, 'public');

            $organisation->structures()->attach(
                $structure['structure_id'],
                ['structure_path' => $filePath]
            );
        });

        return Response::api([
            'message' => 'Organisation structures added!',
            'data'    => $organisation->loadMissing('structures')
        ]);
    }

    public function show(Organisation $organisation, Structure $structure)
    {
        return Response::api([
            'message' => 'Organisation structure detail!',
            'data'    => $organisation->structures()->wherePivot('structure_id', '=', $structure->id)->first()
        ]);
    }

    public function update(Request $request, Organisation $organisation, Structure $structure)
    {
        $validated = $request->validate([
            'structure_path' => 'sometimes|file|mimes:png,jpg',
            'line_manager' => 'sometimes|exists:users,id'
        ]);

        return Response::api([
            'message' => 'Organisation structure updated!',
            'data'    => tap(
                $organisation,
                $organisation->structures()->updateExistingPivot($structure->id, $validated)
            )
        ]);
    }
}