<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use Illuminate\Support\Carbon;

/**
 * @property-read Carbon|null $deleted
 */
trait HasDeleted
{
    protected function deletedSchema(): array
    {
        return [
            'deleted' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#deleted',
                'cast' => Cast::Date,
            ]
        ];
    }

    /**
     * On a Tombstone object, the deleted property is a timestamp for when the object was deleted.
     *
     * Domain: Tombstone
     * Range: xsd:dateTime
     * Functional: True
     */
    public function withDeleted(\DateTimeInterface|string $deleted): self
    {
        if (is_string($deleted)) {
            $deleted = Carbon::parse($deleted);
        }

        return $this->set('https://www.w3.org/ns/activitystreams#deleted', $deleted);
    }
}
