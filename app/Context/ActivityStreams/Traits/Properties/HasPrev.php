<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use App\Context\ActivityStreams\CollectionPage;
use App\Context\ActivityStreams\Link;

/**
 * @property-read CollectionPage|Link|RemoteNode|null $prev
 */
trait HasPrev
{
    protected function prevSchema(): array
    {
        return [
            'prev' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#prev',
                'cast' => Cast::Node,
                'range' => [CollectionPage::class, Link::class, RemoteNode::class]
            ]
        ];
    }

    /**
     * In a paged Collection, identifies the previous page of items.
     *
     * Domain: CollectionPage
     * Range: CollectionPage | Link
     * Functional: True
     */
    public function withPrev(CollectionPage|Link|RemoteNode|string $prev): self
    {
        if (is_string($prev)) {
            $prev = RemoteNode::make($prev);
        }

        return $this->set('https://www.w3.org/ns/activitystreams#prev', $prev);
    }
}
