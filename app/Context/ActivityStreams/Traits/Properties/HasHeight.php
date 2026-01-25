<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;

/**
 * @property-read int|null $height
 */
trait HasHeight
{
    protected function heightSchema(): array
    {
        return [
            'height' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#height',
                'cast' => Cast::Int,
            ]
        ];
    }

    /**
     * On a Link, specifies a hint as to the rendering height in device-independent pixels of the linked resource.
     *
     * Domain: Link
     * Range: xsd:nonNegativeInteger
     * Functional: True
     */
    public function withHeight(int $height): self
    {
        if ($height < 0) {
            throw new \InvalidArgumentException("Height must be a non-negative integer");
        }

        return $this->set('https://www.w3.org/ns/activitystreams#height', $height);
    }
}
