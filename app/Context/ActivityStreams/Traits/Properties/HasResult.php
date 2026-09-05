<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use App\Context\ActivityStreams\BaseObject;
use App\Context\ActivityStreams\Link;

/**
 * @property-read BaseObject|Link|RemoteNode|null $result
 */
trait HasResult
{
    protected function schemaHasResult(): array
    {
        return [
            'result' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#result',
                'cast' => Cast::Node,
                'range' => [BaseObject::class, Link::class, RemoteNode::class],
            ],
        ];
    }

    /**
     * Describes the result of the activity. For instance, if a particular action results in the creation of a new resource,
     * the result property can be used to describe that new resource.
     *
     * Domain: Activity
     * Range: Object | Link
     */
    public function withResult(BaseObject|Link|RemoteNode|string $result): self
    {
        if (is_string($result)) {
            $result = RemoteNode::make($result);
        }

        return $this->set('https://www.w3.org/ns/activitystreams#result', $result);
    }
}
