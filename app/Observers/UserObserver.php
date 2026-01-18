<?php

namespace App\Observers;

use App\Models\User;
use App\Services\SignatureService;

class UserObserver
{
    public function creating(User $user): void
    {
        $keyPair = app(SignatureService::class)->createKeyPair();
        $user->private_key = $keyPair['private'];
        $user->public_key = $keyPair['public'];
    }
}
