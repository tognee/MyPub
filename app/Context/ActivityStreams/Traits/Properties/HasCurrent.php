<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use App\Context\ActivityStreams\Link;
use App\Context\ActivityStreams\CollectionPage;

/**
 * @property-read CollectionPage|Link|RemoteNode|null $current
 */
trait HasCurrent
{
    protected function currentSchema(): array
    {
        return [
            'current' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#current',
                'cast' => Cast::Node,
                'range' => [CollectionPage::class, Link::class, RemoteNode::class]
            ]
        ];
    }

    /**
     * In a paged Collection, indicates the page that contains the most recently updated member items.
     *
     * Domain: Collection
     * Range: CollectionPage | Link
     * Functional: true
     */
    public function withCurrent(CollectionPage|Link|RemoteNode|string $value): self
    {
        if (is_string($value)) {
            $value = RemoteNode::make($value);
        }

        return $this->set('https://www.w3.org/ns/activitystreams#current', $value);
    }
}
