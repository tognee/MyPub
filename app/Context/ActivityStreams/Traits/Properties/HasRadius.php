<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;

/**
 * @property-read float|null $radius
 */
trait HasRadius
{
    protected function schemaHasRadius(): array
    {
        return [
            'radius' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#radius',
                'cast' => Cast::Float,
            ],
        ];
    }

    /**
     * The radius from the given latitude and longitude for a Place.
     * The units is expressed by the units property. If units is not specified, the default is assumed to be "m" indicating "meters".
     *
     * Domain: Place
     * Range: xsd:float [>= 0.0f]
     * Functional: True
     */
    public function withRadius(float|string|int $value): self
    {
        $floatValue = (float) $value;

        if ($floatValue < 0) {
            throw new \InvalidArgumentException('Radius must be greater than or equal to 0');
        }

        return $this->set('https://www.w3.org/ns/activitystreams#radius', $floatValue);
    }
}
