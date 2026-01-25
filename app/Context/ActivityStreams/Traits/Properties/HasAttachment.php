<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use Illuminate\Support\Collection;
use App\Context\ActivityStreams\Link;
use App\Context\ActivityStreams\BaseObject;

/**
 * @property-read Collection<BaseObject|Link|RemoteNode> $attachment
 */
trait HasAttachment
{
    protected function attachmentSchema(): array
    {
        return [
            'attachment' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#attachment',
                'cast' => Cast::Collection,
                'range' => [BaseObject::class, Link::class, RemoteNode::class]
            ]
        ];
    }

    /**
     * Identifies a resource attached or related to an object that potentially requires special handling.
     * The intent is to provide a model that is at least semantically similar to attachments in email.
     *
     * Domain: Object
     * Range: Object | Link
     */
    public function withAttachment(BaseObject|Link|RemoteNode|string|Collection $value): self
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
                throw new \InvalidArgumentException("Attachment items must be an Object, Link, or an URI.");
            }
        });

        return $this->set('https://www.w3.org/ns/activitystreams#attachment', $collection);
    }
}
