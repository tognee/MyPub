<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use Illuminate\Support\Collection;
use App\Context\ActivityStreams\BaseObject;
use App\Context\ActivityStreams\Link;

/**
 * @property-read Collection<BaseObject|Link|RemoteNode> $anyOf
 */
trait HasAnyOf
{
    protected function anyOfSchema(): array
    {
        return [
            'anyOf' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#anyOf',
                'cast' => Cast::Collection,
                'range' => [BaseObject::class, Link::class, RemoteNode::class]
            ]
        ];
    }

    /**
     * Identifies an inclusive option for a Question. Use of anyOf implies that the Question can have multiple answers.
     * To indicate that a Question can have only one answer, use oneOf.
     *
     * Domain: Question
     * Range: Object | Link
     */
    public function withAnyOf(BaseObject|Link|RemoteNode|string|Collection $value): self
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
                throw new \InvalidArgumentException("AnyOf items must be an Object, Link, RemoteNode, or URI string.");
            }
        });

        return $this->set('https://www.w3.org/ns/activitystreams#anyOf', $collection);
    }
}
