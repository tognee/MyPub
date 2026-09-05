<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use App\Context\ActivityStreams\BaseObject;
use App\Context\ActivityStreams\Link;

/**
 * @property-read BaseObject|Link|RemoteNode|null $context
 */
trait HasContext
{
    protected function schemaHasContext(): array
    {
        return [
            'context' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#context',
                'cast' => Cast::Node,
                'range' => [BaseObject::class, Link::class, RemoteNode::class],
            ],
        ];
    }

    /**
     * Identifies the context within which the object exists or an activity was performed.
     *
     * The notion of "context" used is intentionally vague.
     * The intended function is to serve as a means of grouping objects and activities
     * that share a common originating context or purpose.
     * An example could be all activities relating to a common project or event.
     *
     * Domain: Object
     * Range: Object | Link
     */
    public function withContext(BaseObject|Link|RemoteNode|string $value): self
    {
        if (is_string($value)) {
            $value = RemoteNode::make($value);
        }

        return $this->set('https://www.w3.org/ns/activitystreams#context', $value);
    }
}
