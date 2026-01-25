<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use Illuminate\Support\Collection;
use App\Context\ActivityStreams\BaseObject;
use App\Context\ActivityStreams\Link;

/**
 * @property-read Collection<BaseObject|Link|RemoteNode> $instrument
 */
trait HasInstrument
{
    protected function instrumentSchema(): array
    {
        return [
            'instrument' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#instrument',
                'cast' => Cast::Collection,
                'range' => [BaseObject::class, Link::class, RemoteNode::class]
            ]
        ];
    }

    /**
     * Identifies one or more objects used (or to be used) in the completion of an Activity.
     *
     * Domain: Activity
     * Range: Object | Link
     */
    public function withInstrument(BaseObject|Link|RemoteNode|string|Collection $value): self
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
                throw new \InvalidArgumentException("Instrument items must be an Object, Link, or an URI.");
            }
        });

        return $this->set('https://www.w3.org/ns/activitystreams#instrument', $collection);
    }
}
