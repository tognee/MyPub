<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use App\Context\ActivityStreams\BaseObject;
use App\Context\ActivityStreams\Link;
use Illuminate\Support\Collection;

/**
 * @property-read Collection<BaseObject|Link|RemoteNode> $oneOf
 */
trait HasOneOf
{
    protected function schemaHasOneOf(): array
    {
        return [
            'oneOf' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#oneOf',
                'cast' => Cast::Collection,
                'range' => [BaseObject::class, Link::class, RemoteNode::class],
            ],
        ];
    }

    /**
     * Identifies an exclusive option for a Question. Use of oneOf implies that the Question can have only a single answer.
     * To indicate that a Question can have multiple answers, use anyOf.
     *
     * Domain: Question
     * Range: Object | Link
     */
    public function withOneOf(BaseObject|Link|RemoteNode|string|Collection $value): self
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
                throw new \InvalidArgumentException('OneOf items must be an Object, Link, or an URI.');
            }
        });

        return $this->set('https://www.w3.org/ns/activitystreams#oneOf', $collection);
    }
}
