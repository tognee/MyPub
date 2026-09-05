<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;

/**
 * @property-read int|null $width
 */
trait HasWidth
{
    protected function schemaHasWidth(): array
    {
        return [
            'width' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#width',
                'cast' => Cast::Int,
            ],
        ];
    }

    /**
     * On a Link, specifies a hint as to the rendering width in device-independent pixels of the linked resource.
     *
     * Domain: Link
     * Range: xsd:nonNegativeInteger
     * Functional: True
     */
    public function withWidth(int $width): self
    {
        if ($width < 0) {
            throw new \InvalidArgumentException('Width must be a non-negative integer');
        }

        return $this->set('https://www.w3.org/ns/activitystreams#width', $width);
    }
}
