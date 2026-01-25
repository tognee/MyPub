<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use Illuminate\Support\Collection;
use App\Context\ActivityStreams\Link;
use App\Context\ActivityStreams\BaseObject;

/**
 * @property-read Collection<BaseObject|Link|RemoteNode> $actor
 */
trait HasActor
{
    protected function actorSchema(): array
    {
        return [
            'actor' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#actor',
                'cast' => Cast::Collection,
                'range' => [BaseObject::class, Link::class, RemoteNode::class]
            ]
        ];
    }

    /**
     * Describes one or more entities that either performed or are expected to perform the activity.
     * Any single activity can have multiple actors. The actor MAY be specified using an indirect Link.
     *
     * Domain: Activity
     * Range: Object | Link
     * Subproperty Of: attributedTo
     */
    public function withActor(BaseObject|Link|RemoteNode|string|Collection $value): self
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
                throw new \InvalidArgumentException("Actor items must be an Object, Link, or an URI.");
            }
        });

        return $this->set('https://www.w3.org/ns/activitystreams#actor', $collection);
    }
}
