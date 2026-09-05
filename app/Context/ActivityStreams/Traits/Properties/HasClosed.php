<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\RemoteNode;
use App\Context\ActivityStreams\BaseObject;
use App\Context\ActivityStreams\Link;
use Illuminate\Support\Carbon;

/**
 * @property-read bool|string|\DateTimeInterface|BaseObject|Link|RemoteNode|null $closed
 */
trait HasClosed
{
    protected function schemaHasClosed(): array
    {
        return [
            'closed' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#closed',
                'cast' => Cast::Node,
                'range' => [BaseObject::class, Link::class, RemoteNode::class, 'xsd:dateTime', 'xsd:boolean'],
            ],
        ];
    }

    /**
     * Indicates that a question has been closed, and answers are no longer accepted.
     * Can be:
     * - boolean: closed or not closed
     * - datetime string: saying when it has been closed
     * - an Object/Link: giving the reason why it has been closed
     *
     * Domain: Question
     * Range: Object | Link | xsd:dateTime | xsd:boolean
     */
    public function withClosed(bool|string|\DateTimeInterface|BaseObject|Link|RemoteNode $value): self
    {
        // Let's make sure it's a Carbon interface
        if ($value instanceof \DateTimeInterface) {
            $value = Carbon::parse($value);
        }

        if (is_string($value)) {
            // Can be a datetime or a RemoteNode
            if (filter_var($value, FILTER_VALIDATE_URL)) {
                $value = RemoteNode::make($value);
            } else {
                $value = Carbon::parse($value);
            }
        }

        $isValid = is_bool($value) ||
                   $value instanceof Carbon ||
                   $value instanceof BaseObject ||
                   $value instanceof Link ||
                   $value instanceof RemoteNode;

        // Validate the value type
        if (! $isValid) {
            throw new \InvalidArgumentException('Closed value must be a boolean, datetime string, or Object/Link');
        }

        return $this->set('https://www.w3.org/ns/activitystreams#closed', $value);
    }
}
