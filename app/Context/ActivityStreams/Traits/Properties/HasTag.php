<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use App\Context\ActivityStreams\BaseObject;
use App\Context\ActivityStreams\Link;
use Illuminate\Support\Collection;

/**
 * @property-read Collection<BaseObject|Link|RemoteNode> $tag
 */
trait HasTag
{
    protected function schemaHasTag(): array
    {
        return [
            'tag' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#tag',
                'cast' => Cast::Collection,
                'range' => [BaseObject::class, Link::class, RemoteNode::class],
            ],
        ];
    }

    /**
     * One or more "tags" that have been associated with an objects. A tag can be any kind of Object.
     * The key difference between attachment and tag is that the former implies association by inclusion,
     * while the latter implies associated by reference.
     *
     * Domain: Object
     * Range: Object | Link
     */
    public function withTag(BaseObject|Link|RemoteNode|string|Collection $value): self
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
                throw new \InvalidArgumentException('Tag items must be an Object, Link, or an URI.');
            }
        });

        return $this->set('https://www.w3.org/ns/activitystreams#tag', $collection);
    }
}
