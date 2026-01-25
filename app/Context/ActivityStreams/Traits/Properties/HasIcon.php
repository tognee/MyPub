<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use Illuminate\Support\Collection;
use App\Context\ActivityStreams\Link;
use App\Context\ActivityStreams\Object\Image;

/**
 * @property-read Collection<Image|Link|RemoteNode> $icon
 */
trait HasIcon
{
    protected function iconSchema(): array
    {
        return [
            'icon' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#icon',
                'cast' => Cast::Collection,
                'range' => [Image::class, Link::class, RemoteNode::class]
            ]
        ];
    }

    /**
     * Indicates an entity that describes an icon for this object.
     * The image should have an aspect ratio of one (horizontal) to one (vertical)
     * and should be suitable for presentation at a small size.
     *
     * Domain: Object
     * Range: Image | Link
     */
    public function withIcon(Image|Link|RemoteNode|string|Collection $value): self
    {
        $collection = collect(is_iterable($value) ? $value : [$value]);

        $collection->each(function ($item) {
            if (is_string($item)) {
                $item = RemoteNode::make($item);
            }

            $isValid = $item instanceof Image ||
                       $item instanceof Link ||
                       $item instanceof RemoteNode;

            if (!$isValid) {
                throw new \InvalidArgumentException("Icon items must be an Image, Link, or an URI.");
            }
        });

        return $this->set('https://www.w3.org/ns/activitystreams#icon', $collection);
    }
}
