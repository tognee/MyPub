<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use Illuminate\Support\Collection;
use App\Context\ActivityStreams\BaseObject;
use App\Context\ActivityStreams\Link;

/**
 * @property-read Collection<BaseObject|Link|RemoteNode> $to
 */
trait HasTo
{
    protected function toSchema(): array
    {
        return [
            'to' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#to',
                'cast' => Cast::Collection,
                'range' => [BaseObject::class, Link::class, RemoteNode::class]
            ]
        ];
    }

    /**
     * Identifies an entity considered to be part of the public primary audience of an Object.
     *
     * Domain: Object
     * Range: Object | Link
     */
    public function withTo(BaseObject|Link|RemoteNode|string|Collection $value): self
    {
        $collection = collect(is_iterable($value) ? $value : [$value]);

        $collection->each(function ($item) {
            if (is_string($item)) {
                $item = RemoteNode::make($item);
            }

            $isValid = $item instanceof BaseObject ||
                       $item instanceof Link ||
                       $item instanceof RemoteNode;

            if (!$isValid) {
                throw new \InvalidArgumentException("To items must be an Object, Link, or an URI.");
            }
        });

        return $this->set('https://www.w3.org/ns/activitystreams#to', $collection);
    }
}
