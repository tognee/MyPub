<?php

namespace App\ActivityPub\JsonLD;

use ML\JsonLD\DocumentLoaderInterface;
use ML\JsonLD\RemoteDocument;

class DocumentLoader implements DocumentLoaderInterface
{
    public function loadDocument($url)
    {
        $localMap = config('jsonld.contextMap');

        if (isset($localMap[$url])) {
            $file_path = $localMap[$url];

            if (! file_exists($file_path)) {
                throw new \Exception('Local JSON-LD context file not found: '.$file_path);
            }

            return new RemoteDocument(
                $url,
                json_decode(file_get_contents($file_path)),
                'application/ld+json'
            );
        }

        throw new \RuntimeException("Remote JSON-LD context blocked: $url. Please cache this file locally.");
    }
}
