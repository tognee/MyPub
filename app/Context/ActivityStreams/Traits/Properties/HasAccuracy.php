<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;

/**
 * @property-read float|null $accuracy
 */
trait HasAccuracy
{
    protected function schemaHasAccuracy(): array
    {
        return [
            'accuracy' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#accuracy',
                'cast' => Cast::Float,
            ],
        ];
    }

    /**
     * Indicates the accuracy of position coordinates on a Place object.
     * Expressed in properties of percentage. e.g. "94.0" means "94.0% accurate".
     *
     * Domain: Place
     * Range: xsd:float
     */
    public function withAccuracy(float|string $value): self
    {
        $floatValue = (float) $value;

        if ($floatValue < 0 || $floatValue > 100) {
            throw new \InvalidArgumentException('Accuracy must be between 0 and 100');
        }

        return $this->set('https://www.w3.org/ns/activitystreams#accuracy', $floatValue);
    }
}
