<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use Illuminate\Support\Carbon;

/**
 * @property-read Carbon|null $updated
 */
trait HasUpdated
{
    protected function schemaHasUpdated(): array
    {
        return [
            'updated' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#updated',
                'cast' => Cast::Date,
            ],
        ];
    }

    /**
     * The date and time at which the object was updated.
     *
     * Domain: Object
     * Range: xsd:dateTime
     * Functional: True
     */
    public function withUpdated(\DateTimeInterface|string $updated): self
    {
        if (is_string($updated)) {
            $updated = Carbon::parse($updated);
        }

        return $this->set('https://www.w3.org/ns/activitystreams#updated', $updated);
    }
}
