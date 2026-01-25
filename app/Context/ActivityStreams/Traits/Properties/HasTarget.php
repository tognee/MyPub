<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use Illuminate\Support\Collection;
use App\Context\ActivityStreams\BaseObject;
use App\Context\ActivityStreams\Link;

/**
 * @property-read Collection<BaseObject|Link|RemoteNode> $target
 */
trait HasTarget
{
    protected function targetSchema(): array
    {
        return [
            'target' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#target',
                'cast' => Cast::Collection,
                'range' => [BaseObject::class, Link::class, RemoteNode::class]
            ]
        ];
    }

    /**
     * Describes the indirect object, or target, of the activity. The precise meaning of the target is largely
     * dependent on the type of action being described but will often be the object of the English preposition "to".
     * For instance, in the activity "John added a movie to his wishlist", the target of the activity is John's wishlist.
     * An activity can have more than one target.
     *
     * Domain: Activity
     * Range: Object | Link
     */
    public function withTarget(BaseObject|Link|RemoteNode|string|Collection $value): self
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
                throw new \InvalidArgumentException("Target items must be an Object, Link, or an URI.");
            }
        });

        return $this->set('https://www.w3.org/ns/activitystreams#target', $collection);
    }
}
