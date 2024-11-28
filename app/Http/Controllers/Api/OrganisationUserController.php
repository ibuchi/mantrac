<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organisation;
use App\Models\User;
use App\Notifications\OrganisationWelcome;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrganisationUserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Organisation $organisation, User $user)
    {
        $user->update(['organisation_id' => $organisation->id]);

        $user->notify(new OrganisationWelcome($organisation));

        return Response::api([
            'message' => "{$user->name} has been added to this organisation!",
            'data'    => $user->loadMissing('organisation')
        ]);
    }
}
