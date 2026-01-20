<?php

namespace App\Http\Controllers\Actor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
