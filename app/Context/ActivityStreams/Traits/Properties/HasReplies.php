<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use App\Context\ActivityStreams\Collection;

/**
 * @property-read Collection|RemoteNode|null $replies
 */
trait HasReplies
{
    protected function repliesSchema(): array
    {
        return [
            'replies' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#replies',
                'cast' => Cast::Node,
                'range' => [Collection::class, RemoteNode::class]
            ]
        ];
    }

    /**
     * Identifies a Collection containing objects considered to be responses to this object.
     *
     * Domain: Object
     * Range: Collection
     */
    public function withReplies(Collection|RemoteNode|string $replies): self
    {
        if (is_string($replies)) {
            $replies = RemoteNode::make($replies);
        }

        return $this->set('https://www.w3.org/ns/activitystreams#replies', $replies);
    }
}
