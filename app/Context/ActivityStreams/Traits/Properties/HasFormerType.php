<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;

/**
 * @property-read string|null $formerType
 */
trait HasFormerType
{
    protected function formerTypeSchema(): array
    {
        return [
            'formerType' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#formerType',
                'cast' => Cast::String,
            ]
        ];
    }

    /**
     * On a Tombstone object, the formerType property identifies the type of the object that was deleted.
     *
     * Domain: Tombstone
     * Range: Object
     * Functional: False
     */
    public function withFormerType(string $formerType): self
    {
        return $this->set('https://www.w3.org/ns/activitystreams#formerType', $formerType);
    }
}
