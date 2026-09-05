<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;

/**
 * @property-read string|null $mediaType
 */
trait HasMediaType
{
    protected function schemaHasMediaType(): array
    {
        return [
            'mediaType' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#mediaType',
                'cast' => Cast::String,
                'range' => ['MIME Media Type'],
            ],
        ];
    }

    /**
     * When used on a Link, identifies the MIME media type of the referenced resource.
     * When used on an Object, identifies the MIME media type of the value of the content property.
     * If not specified, the content property is assumed to contain text/html content.
     *
     * Domain: Link | Object
     * Range: MIME Media Type
     * Functional: True
     */
    public function withMediaType(string $mediaType): self
    {
        return $this->set('https://www.w3.org/ns/activitystreams#mediaType', $mediaType);
    }
}
