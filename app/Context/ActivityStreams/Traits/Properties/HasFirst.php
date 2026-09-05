<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use App\Context\ActivityStreams\CollectionPage;
use App\Context\ActivityStreams\Link;

/**
 * @property-read CollectionPage|Link|RemoteNode|null $first
 */
trait HasFirst
{
    protected function schemaHasFirst(): array
    {
        return [
            'first' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#first',
                'cast' => Cast::Node,
                'range' => [CollectionPage::class, Link::class, RemoteNode::class],
            ],
        ];
    }

    /**
     * In a paged Collection, indicates the furthest preceeding page of items in the collection.
     *
     * Domain: Collection
     * Range: CollectionPage | Link
     * Functional: true
     */
    public function withFirst(CollectionPage|Link|RemoteNode|string $value): self
    {
        if (is_string($value)) {
            $value = RemoteNode::make($value);
        }

        return $this->set('https://www.w3.org/ns/activitystreams#first', $value);
    }
}
