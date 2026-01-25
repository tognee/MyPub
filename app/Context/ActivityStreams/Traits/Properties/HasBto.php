<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use Illuminate\Support\Collection;
use App\Context\ActivityStreams\BaseObject;
use App\Context\ActivityStreams\Link;

/**
 * @property-read Collection<BaseObject|Link|RemoteNode> $bto
 */
trait HasBto
{
    protected function btoSchema(): array
    {
        return [
            'bto' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#bto',
                'cast' => Cast::Collection,
                'range' => [BaseObject::class, Link::class, RemoteNode::class]
            ]
        ];
    }

    /**
     * Identifies an Object that is part of the private primary audience of this Object.
     *
     * Domain: Object
     * Range: Object | Link
     */
    public function withBto(BaseObject|Link|RemoteNode|string|Collection $value): self
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
                throw new \InvalidArgumentException("Bto items must be an Object, Link, or an URI.");
            }
        });

        return $this->set('https://www.w3.org/ns/activitystreams#bto', $collection);
    }
}
