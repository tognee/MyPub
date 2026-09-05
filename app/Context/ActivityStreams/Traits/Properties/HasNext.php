<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use App\Context\ActivityStreams\CollectionPage;
use App\Context\ActivityStreams\Link;

/**
 * @property-read CollectionPage|Link|RemoteNode|null $next
 */
trait HasNext
{
    protected function schemaHasNext(): array
    {
        return [
            'next' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#next',
                'cast' => Cast::Node,
                'range' => [CollectionPage::class, Link::class, RemoteNode::class],
            ],
        ];
    }

    /**
     * In a paged Collection, indicates the next page of items.
     *
     * Domain: CollectionPage
     * Range: CollectionPage | Link
     * Functional: True
     */
    public function withNext(CollectionPage|Link|RemoteNode|string $next): self
    {
        if (is_string($next)) {
            $next = RemoteNode::make($next);
        }

        return $this->set('https://www.w3.org/ns/activitystreams#next', $next);
    }
}
