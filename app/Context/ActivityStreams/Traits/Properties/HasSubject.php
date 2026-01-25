<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use App\Context\ActivityStreams\BaseObject;
use App\Context\ActivityStreams\Link;

/**
 * @property-read BaseObject|Link|RemoteNode|null $subject
 */
trait HasSubject
{
    protected function subjectSchema(): array
    {
        return [
            'subject' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#subject',
                'cast' => Cast::Node,
                'range' => [BaseObject::class, Link::class, RemoteNode::class]
            ]
        ];
    }

    /**
     * On a Relationship object, the subject property identifies one of the connected individuals.
     * For instance, for a Relationship object describing "John is related to Sally", subject would refer to John.
     *
     * Domain: Relationship
     * Range: Link | Object
     * Functional: True
     */
    public function withSubject(BaseObject|Link|RemoteNode|string $subject): self
    {
        if (is_string($subject)) {
            $subject = RemoteNode::make($subject);
        }

        return $this->set('https://www.w3.org/ns/activitystreams#subject', $subject);
    }
}
