<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use App\Context\ActivityStreams\BaseObject;
use App\Context\ActivityStreams\Link;
use Illuminate\Support\Collection;

/**
 * @property-read Collection<BaseObject|Link|RemoteNode> $inReplyTo
 */
trait HasInReplyTo
{
    protected function schemaHasInReplyTo(): array
    {
        return [
            'inReplyTo' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#inReplyTo',
                'cast' => Cast::Collection,
                'range' => [BaseObject::class, Link::class, RemoteNode::class],
            ],
        ];
    }

    /**
     * Indicates one or more entities for which this object is considered a response.
     *
     * Domain: Object
     * Range: Object | Link
     */
    public function withInReplyTo(BaseObject|Link|RemoteNode|string|Collection $value): self
    {
        $collection = collect(is_iterable($value) ? $value : [$value]);

        $collection->each(function ($item) {
            if (is_string($item)) {
                $item = RemoteNode::make($item);
            }

            $isValid = $item instanceof BaseObject ||
                       $item instanceof Link ||
                       $item instanceof RemoteNode;

            if (! $isValid) {
                throw new \InvalidArgumentException('InReplyTo items must be an BaseObject, Link, or an URI.');
            }
        });

        return $this->set('https://www.w3.org/ns/activitystreams#inReplyTo', $collection);
    }
}
