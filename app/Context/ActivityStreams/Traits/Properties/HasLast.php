<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use App\Context\ActivityStreams\Link;
use App\Context\ActivityStreams\CollectionPage;

/**
 * @property-read CollectionPage|Link|RemoteNode|null $last
 */
trait HasLast
{
    protected function lastSchema(): array
    {
        return [
            'last' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#last',
                'cast' => Cast::Node,
                'range' => [CollectionPage::class, Link::class, RemoteNode::class]
            ]
        ];
    }

    /**
     * In a paged Collection, indicates the furthest proceeding page of the collection.
     *
     * Domain: Collection
     * Range: CollectionPage | Link
     * Functional: True
     */
    public function withLast(CollectionPage|Link|RemoteNode|string $last): self
    {
        if (is_string($last)) {
            $last = RemoteNode::make($last);
        }

        return $this->set('https://www.w3.org/ns/activitystreams#last', $last);
    }
}
