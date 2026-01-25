<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use App\Context\ActivityStreams\Link;
use App\Context\ActivityStreams\BaseObject;

/**
 * @property-read BaseObject|Link|RemoteNode $generator
 */
trait HasGenerator
{
    protected function generatorSchema(): array
    {
        return [
            'generator' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#generator',
                'cast' => Cast::Node,
                'range' => [BaseObject::class, Link::class, RemoteNode::class]
            ]
        ];
    }

    /**
     * Identifies the entity (e.g. an application) that generated the object.
     *
     * Domain: Object
     * Range: Object | Link
     */
    public function withGenerator(BaseObject|Link|RemoteNode|string $value): self
    {
        if (is_string($value)) {
            $value = RemoteNode::make($value);
        }

        return $this->set('https://www.w3.org/ns/activitystreams#generator', $value);
    }
}
