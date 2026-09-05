<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use App\Context\ActivityStreams\BaseObject;
use App\Context\ActivityStreams\Link;
use Illuminate\Support\Collection;

/**
 * @property-read Collection<BaseObject|Link|RemoteNode> $location
 */
trait HasLocation
{
    protected function schemaHasLocation(): array
    {
        return [
            'location' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#location',
                'cast' => Cast::Collection,
                'range' => [BaseObject::class, Link::class, RemoteNode::class],
            ],
        ];
    }

    /**
     * Indicates one or more physical or logical locations associated with the object.
     *
     * Domain: Object
     * Range: Object | Link
     */
    public function withLocation(BaseObject|Link|RemoteNode|string|Collection $value): self
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
                throw new \InvalidArgumentException('Location items must be an Object, Link, or an URI.');
            }
        });

        return $this->set('https://www.w3.org/ns/activitystreams#location', $collection);
    }
}
