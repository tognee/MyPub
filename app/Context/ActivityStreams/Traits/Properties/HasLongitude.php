<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;

/**
 * @property-read float|null $longitude
 */
trait HasLongitude
{
    protected function longitudeSchema(): array
    {
        return [
            'longitude' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#longitude',
                'cast' => Cast::Float,
            ]
        ];
    }

    /**
     * The longitude of a place.
     *
     * Domain: Place
     * Range: xsd:float
     * Functional: True
     */
    public function withLongitude(float|string|int $value): self
    {
        $floatValue = is_numeric($value) ? (float) $value : (float) $value;

        if ($floatValue < -180 || $floatValue > 180) {
            throw new \InvalidArgumentException("Longitude must be between -180 and 180 degrees");
        }

        return $this->set('https://www.w3.org/ns/activitystreams#longitude', $floatValue);
    }
}
