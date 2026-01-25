<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use Illuminate\Support\Carbon;

/**
 * @property-read Carbon|null $startTime
 */
trait HasStartTime
{
    protected function startTimeSchema(): array
    {
        return [
            'startTime' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#startTime',
                'cast' => Cast::Date,
            ]
        ];
    }

    /**
     * The date and time describing the actual or expected starting time of the object.
     * When used with an Activity object, for instance, the startTime property specifies the moment the activity began or is scheduled to begin.
     *
     * Domain: Object
     * Range: xsd:dateTime
     * Functional: True
     */
    public function withStartTime(\DateTimeInterface|string $startTime): self
    {
        if (is_string($startTime)) {
            $startTime = Carbon::parse($startTime);
        }

        return $this->set('https://www.w3.org/ns/activitystreams#startTime', $startTime);
    }
}
