<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;

/**
 * @property-read string|null $duration
 */
trait HasDuration
{
    protected function schemaHasDuration(): array
    {
        return [
            'duration' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#duration',
                'cast' => Cast::String,
                'range' => ['xsd:duration'],
            ],
        ];
    }

    /**
     * When the object describes a time-bound resource, such as an audio or video, a meeting, etc,
     * the duration property indicates the object's approximate duration. The value MUST be expressed as an
     * xsd:duration as defined by xmlschema11-2, section 3.3.6 (e.g. a period of 5 seconds is represented as "PT5S").
     *
     * Domain: Object
     * Range: xsd:duration
     * Functional: True
     */
    public function withDuration(string $duration): self
    {
        return $this->set('https://www.w3.org/ns/activitystreams#duration', $duration);
    }
}
