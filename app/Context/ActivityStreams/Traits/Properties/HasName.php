<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\TranslatableString;

/**
 * @property-read TranslatableString|null $name
 */
trait HasName
{
    protected function nameSchema(): array
    {
        return [
            'name' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#name',
                'cast' => Cast::TranslatableString,
            ]
        ];
    }

    /**
     * A simple, human-readable, plain-text name for the object.
     * HTML markup MUST NOT be included. The name MAY be expressed using multiple language-tagged values.
     *
     * Domain: Object | Link
     * Range: xsd:string | rdf:langString
     */
    public function withName(string|TranslatableString $name): self
    {
        return $this->set('https://www.w3.org/ns/activitystreams#name', $name);
    }
}
