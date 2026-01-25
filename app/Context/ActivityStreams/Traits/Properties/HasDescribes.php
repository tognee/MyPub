<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use App\Context\ActivityStreams\BaseObject;

/**
 * @property-read BaseObject|RemoteNode|null $describes
 */
trait HasDescribes
{
    protected function describesSchema(): array
    {
        return [
            'describes' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#describes',
                'cast' => Cast::Node,
                'range' => [BaseObject::class, RemoteNode::class]
            ]
        ];
    }

    /**
     * On a Profile object, the describes property identifies the object described by the Profile.
     *
     * Domain: Profile
     * Range: Object
     * Functional: True
     */
    public function withDescribes(BaseObject|RemoteNode|string $describes): self
    {
        if (is_string($describes)) {
            $describes = RemoteNode::make($describes);
        }

        return $this->set('https://www.w3.org/ns/activitystreams#describes', $describes);
    }
}
