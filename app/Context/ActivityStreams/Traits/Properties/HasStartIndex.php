<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;

/**
 * @property-read int|null $startIndex
 */
trait HasStartIndex
{
    protected function schemaHasStartIndex(): array
    {
        return [
            'startIndex' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#startIndex',
                'cast' => Cast::Int,
            ],
        ];
    }

    /**
     * A non-negative integer value identifying the relative position within the logical view of a strictly ordered collection.
     *
     * Domain: OrderedCollectionPage
     * Range: xsd:nonNegativeInteger
     * Functional: True
     */
    public function withStartIndex(int $startIndex): self
    {
        if ($startIndex < 0) {
            throw new \InvalidArgumentException('StartIndex must be a non-negative integer');
        }

        return $this->set('https://www.w3.org/ns/activitystreams#startIndex', $startIndex);
    }
}
