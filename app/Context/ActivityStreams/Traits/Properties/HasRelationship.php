<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use App\Context\ActivityStreams\BaseObject;

/**
 * @property-read BaseObject|RemoteNode|null $relationship
 */
trait HasRelationship
{
    protected function relationshipSchema(): array
    {
        return [
            'relationship' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#relationship',
                'cast' => Cast::Node,
                'range' => [BaseObject::class, RemoteNode::class]
            ]
        ];
    }

    /**
     * On a Relationship object, the relationship property identifies the kind of relationship that exists between subject and object.
     *
     * Domain: Relationship
     * Range: Object
     */
    public function withRelationship(BaseObject|RemoteNode|string $relationship): self
    {
        if (is_string($relationship)) {
            $relationship = RemoteNode::make($relationship);
        }

        return $this->set('https://www.w3.org/ns/activitystreams#relationship', $relationship);
    }
}
