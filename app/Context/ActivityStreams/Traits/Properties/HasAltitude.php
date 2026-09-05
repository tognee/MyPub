<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;

/**
 * @property-read float|null $altitude
 */
trait HasAltitude
{
    protected function schemaHasAltitude(): array
    {
        return [
            'altitude' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#altitude',
                'cast' => Cast::Float,
            ],
        ];
    }

    /**
     * Indicates the altitude of a place. The measurement units is indicated using the units property.
     * If units is not specified, the default is assumed to be "m" indicating meters.
     *
     * Domain: Place
     * Range: xsd:float
     */
    public function withAltitude(float|string|int $value): self
    {
        return $this->set('https://www.w3.org/ns/activitystreams#altitude', (float) $value);
    }
}
