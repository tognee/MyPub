<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;

/**
 * @property-read string|null $units
 */
trait HasUnits
{
    protected function unitsSchema(): array
    {
        return [
            'units' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#units',
                'cast' => Cast::String,
                'range' => ["cm", "feet", "inches", "km", "m", "miles", "xsd:anyURI"]
            ]
        ];
    }

    /**
     * Specifies the measurement units for the radius and altitude properties on a Place object.
     * If not specified, the default is assumed to be "m" for "meters".
     *
     * Domain: Place
     * Range: "cm" | "feet" | "inches" | "km" | "m" | "miles" | xsd:anyURI
     */
    public function withUnits(string $units): self
    {
        return $this->set('https://www.w3.org/ns/activitystreams#units', $units);
    }
}
