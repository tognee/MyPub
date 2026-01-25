<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;

/**
 * @property-read int|null $totalItems
 */
trait HasTotalItems
{
    protected function totalItemsSchema(): array
    {
        return [
            'totalItems' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#totalItems',
                'cast' => Cast::Int,
            ]
        ];
    }

    /**
     * A non-negative integer specifying the total number of objects contained by the logical view of the collection.
     * This number might not reflect the actual number of items serialized within the Collection object instance.
     *
     * Domain: Collection
     * Range: xsd:nonNegativeInteger
     * Functional: True
     */
    public function withTotalItems(int $totalItems): self
    {
        if ($totalItems < 0) {
            throw new \InvalidArgumentException("TotalItems must be a non-negative integer");
        }

        return $this->set('https://www.w3.org/ns/activitystreams#totalItems', $totalItems);
    }
}
