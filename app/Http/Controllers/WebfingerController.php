<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\UriWithScheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Uri;

class WebfingerController extends Controller
{
    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'resource' => ['required', 'string', new UriWithScheme],
            'rel' => ['sometimes', 'array'],
            'rel.*' => ['string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid request',
            ], 400);
        }

        $validated = $validator->validated();

        $resource = Uri::of($validated['resource']);

        // Fix acct scheme to work with Uri
        if ($resource->scheme() === 'acct' && $resource->path()) {
            $resource = Uri::of('acct://'.$resource->path());
        }

        $serverUri = Uri::of(config('app.url'));

        if ($resource->host() != $serverUri->host()) {
            return response()->json([
                'error' => 'Invalid request',
            ], 400);
        }

        switch ($resource->scheme()) {
            case 'acct':
                [$responseData, $responseCode] = $this->handleAcct($resource);
                break;
            case 'https':
                [$responseData, $responseCode] = $this->handleHttps($resource);
                break;
            default:
                $responseData = [
                    'error' => 'Invalid request',
                ];
                $responseCode = 400;
        }

        return response()->json($responseData, $responseCode);
    }

    private function handleAcct($resource)
    {
        // Get the user with that username
        $username = $resource->user();

        $user = User::where('username', $username)->first();

        if (! $user) {
            return [[
                'error' => 'User not found',
            ], 404];
        }

        return [[
            'subject' => 'acct:'.$username.'@'.$resource->host(),
            'links' => [
                [
                    'rel' => 'self',
                    'type' => 'application/activity+json',
                    'href' => Uri::route('actor.show', [$user]),
                ],
            ],
        ], 200];
    }

    private function handleHttps($resource)
    {
        return [[
            'error' => 'Currently not supported',
        ], 400];
    }
}
