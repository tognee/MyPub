<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActorController extends Controller
{
    public function show($username)
    {
        return response()->json([
            'type' => 'Person',
            'id' => url("/u/{$username}"),
            'name' => $username,
        ]);
    }
}
