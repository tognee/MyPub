<?php

namespace App\Services;

class SignatureService
{
    public function createKeyPair(): array
    {
        $keyPair = openssl_pkey_new([
            'digest_alg' => 'sha256',
            'private_key_bits' => 2048,
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
        ]);

        openssl_pkey_export($keyPair, $privateKey);

        $publicKey = openssl_pkey_get_details($keyPair)['key'];

        return [
            'private' => $privateKey,
            'public' => $publicKey,
        ];
    }
}
