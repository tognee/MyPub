<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use App\Context\ActivityStreams\Link;
use App\Context\ActivityStreams\Collection;

/**
 * @property-read Collection|Link|RemoteNode|null $partOf
 */
trait HasPartOf
{
    protected function partOfSchema(): array
    {
        return [
            'partOf' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#partOf',
                'cast' => Cast::Node,
                'range' => [Collection::class, Link::class, RemoteNode::class]
            ]
        ];
    }

    /**
     * Identifies the Collection to which a CollectionPage's items belong.
     *
     * Domain: CollectionPage
     * Range: Link | Collection
     * Functional: True
     */
    public function withPartOf(Collection|Link|RemoteNode|string $partOf): self
    {
        if (is_string($partOf)) {
            $partOf = RemoteNode::make($partOf);
        }

        return $this->set('https://www.w3.org/ns/activitystreams#partOf', $partOf);
    }
}
