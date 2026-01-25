<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use App\Context\ActivityStreams\BaseObject;
use App\Context\ActivityStreams\Link;

/**
 * @property-read BaseObject|Link|RemoteNode|null $preview
 */
trait HasPreview
{
    protected function previewSchema(): array
    {
        return [
            'preview' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#preview',
                'cast' => Cast::Node,
                'range' => [BaseObject::class, Link::class, RemoteNode::class]
            ]
        ];
    }

    /**
     * Identifies an entity that provides a preview of this object.
     *
     * Domain: Link | Object
     * Range: Link | Object
     */
    public function withPreview(BaseObject|Link|RemoteNode|string $preview): self
    {
        if (is_string($preview)) {
            $preview = RemoteNode::make($preview);
        }

        return $this->set('https://www.w3.org/ns/activitystreams#preview', $preview);
    }
}
