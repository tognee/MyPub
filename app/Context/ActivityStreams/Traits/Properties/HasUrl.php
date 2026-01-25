<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use Illuminate\Support\Collection;
use App\Context\ActivityStreams\Link;

/**
 * @property-read Collection<Link|RemoteNode> $url
 */
trait HasUrl
{
    protected function urlSchema(): array
    {
        return [
            'url' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#url',
                'cast' => Cast::Collection,
                'range' => [Link::class, RemoteNode::class]
            ]
        ];
    }

    /**
     * Identifies one or more links to representations of the object.
     *
     * Domain: Object
     * Range: xsd:anyURI | Link
     */
    public function withUrl(Link|RemoteNode|string|Collection $value): self
    {
        $collection = collect(is_iterable($value) ? $value : [$value]);

        $collection->each(function ($item) {
            if (is_string($item)) {
                $item = RemoteNode::make($item);
            }

            $isValid = $item instanceof Link || $item instanceof RemoteNode;

            if (!$isValid) {
                throw new \InvalidArgumentException("Url items must be a Link or an URI.");
            }
        });

        return $this->set('https://www.w3.org/ns/activitystreams#url', $collection);
    }
}
