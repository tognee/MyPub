<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use Illuminate\Support\Carbon;

/**
 * @property-read Carbon|null $published
 */
trait HasPublished
{
    protected function schemaHasPublished(): array
    {
        return [
            'published' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#published',
                'cast' => Cast::Date,
            ],
        ];
    }

    /**
     * The date and time at which the object was published.
     *
     * Domain: Object
     * Range: xsd:dateTime
     * Functional: True
     */
    public function withPublished(\DateTimeInterface|string $published): self
    {
        if (is_string($published)) {
            $published = Carbon::parse($published);
        }

        return $this->set('https://www.w3.org/ns/activitystreams#published', $published);
    }
}
