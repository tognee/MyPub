<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use App\Context\ActivityStreams\Link;
use App\Context\ActivityStreams\Object\Image;
use Illuminate\Support\Collection;

/**
 * @property-read Collection<Image|Link|RemoteNode> $image
 */
trait HasImage
{
    protected function schemaHasImage(): array
    {
        return [
            'image' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#image',
                'cast' => Cast::Collection,
                'range' => [Image::class, Link::class, RemoteNode::class],
            ],
        ];
    }

    /**
     * Indicates an entity that describes an image for this object.
     * Unlike the icon property, there are no aspect ratio or display size limitations assumed.
     *
     * Domain: Object
     * Range: Image | Link
     */
    public function withImage(Image|Link|RemoteNode|string|Collection $value): self
    {
        $collection = collect(is_iterable($value) ? $value : [$value]);

        $collection->each(function ($item) {
            if (is_string($item)) {
                $item = RemoteNode::make($item);
            }

            $isValid = $item instanceof Image ||
                       $item instanceof Link ||
                       $item instanceof RemoteNode;

            if (! $isValid) {
                throw new \InvalidArgumentException('Image items must be an Image, Link, or an URI.');
            }
        });

        return $this->set('https://www.w3.org/ns/activitystreams#image', $collection);
    }
}
