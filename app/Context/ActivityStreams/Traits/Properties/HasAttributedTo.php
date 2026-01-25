<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use Illuminate\Support\Collection;
use App\Context\ActivityStreams\BaseObject;
use App\Context\ActivityStreams\Link;

/**
 * @property-read Collection<BaseObject|Link|RemoteNode> $attributedTo
 */
trait HasAttributedTo
{
    protected function attributedToSchema(): array
    {
        return [
            'attributedTo' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#attributedTo',
                'cast' => Cast::Collection,
                'range' => [BaseObject::class, Link::class, RemoteNode::class]
            ]
        ];
    }

    /**
     * Identifies one or more entities to which this object is attributed.
     * The attributed entities might not be Actors.
     * For instance, an object might be attributed to the completion of another activity.
     *
     * Domain: Link | Object
     * Range: Link | Object
     */
    public function withAttributedTo(BaseObject|Link|RemoteNode|string|Collection $value): self
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
                throw new \InvalidArgumentException("AttributedTo items must be an Object, Link, or an URI.");
            }
        });

        return $this->set('https://www.w3.org/ns/activitystreams#attributedTo', $collection);
    }
}
