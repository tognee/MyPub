<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;

/**
 * @property-read float|null $latitude
 */
trait HasLatitude
{
    protected function latitudeSchema(): array
    {
        return [
            'latitude' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#latitude',
                'cast' => Cast::Float,
            ]
        ];
    }

    /**
     * The latitude of a place.
     *
     * Domain: Place
     * Range: xsd:float
     * Functional: True
     */
    public function withLatitude(float|string|int $value): self
    {
        $floatValue = is_numeric($value) ? (float) $value : (float) $value;

        if ($floatValue < -90 || $floatValue > 90) {
            throw new \InvalidArgumentException("Latitude must be between -90 and 90 degrees");
        }

        return $this->set('https://www.w3.org/ns/activitystreams#latitude', $floatValue);
    }
}
