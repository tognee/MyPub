<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use App\Context\ActivityStreams\BaseObject;
use App\Context\ActivityStreams\Link;
use Illuminate\Support\Collection;

/**
 * @property-read Collection<BaseObject|Link|RemoteNode> $items
 */
trait HasItems
{
    protected function schemaHasItems(): array
    {
        return [
            'items' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#items',
                'cast' => Cast::Collection,
                'range' => [BaseObject::class, Link::class, RemoteNode::class],
            ],
        ];
    }

    /**
     * Identifies the items contained in a collection. The items might be ordered or unordered.
     *
     * Domain: Collection
     * Range: Object | Link | Ordered List of [Object | Link]
     */
    public function withItems(BaseObject|Link|RemoteNode|string|Collection $value): self
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
                throw new \InvalidArgumentException('Items must be an Object, Link, or an URI.');
            }
        });

        return $this->set('https://www.w3.org/ns/activitystreams#items', $collection);
    }
}
