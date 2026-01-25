<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use Illuminate\Support\Carbon;

/**
 * @property-read Carbon|null $endTime
 */
trait HasEndTime
{
    protected function endTimeSchema(): array
    {
        return [
            'endTime' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#endTime',
                'cast' => Cast::Date,
            ]
        ];
    }

    /**
     * The date and time describing the actual or expected ending time of the object.
     * When used with an Activity object, for instance, the endTime property specifies the moment the activity concluded or is expected to conclude.
     *
     * Domain: Object
     * Range: xsd:dateTime
     * Functional: True
     */
    public function withEndTime(\DateTimeInterface|string $endTime): self
    {
        if (is_string($endTime)) {
            $endTime = Carbon::parse($endTime);
        }

        return $this->set('https://www.w3.org/ns/activitystreams#endTime', $endTime);
    }
}
