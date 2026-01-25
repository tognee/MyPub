<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use App\Context\ActivityStreams\BaseObject;
use App\Context\ActivityStreams\Link;

/**
 * @property-read BaseObject|Link|RemoteNode|null $origin
 */
trait HasOrigin
{
    protected function originSchema(): array
    {
        return [
            'origin' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#origin',
                'cast' => Cast::Node,
                'range' => [BaseObject::class, Link::class, RemoteNode::class]
            ]
        ];
    }

    /**
     * Describes an indirect object of the activity from which the activity is directed.
     * The precise meaning of the origin is the object of the English preposition "from".
     * For instance, in the activity "John moved an item to List B from List A", the origin of the activity is "List A".
     *
     * Domain: Activity
     * Range: Object | Link
     */
    public function withOrigin(BaseObject|Link|RemoteNode|string $value): self
    {
        if (is_string($value)) {
            $value = RemoteNode::make($value);
        }

        return $this->set('https://www.w3.org/ns/activitystreams#origin', $value);
    }
}
