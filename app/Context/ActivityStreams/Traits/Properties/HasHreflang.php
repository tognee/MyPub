<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;

/**
 * @property-read string|null $hreflang
 */
trait HasHreflang
{
    protected function hreflangSchema(): array
    {
        return [
            'hreflang' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#hreflang',
                'cast' => Cast::String,
                'range' => ['[BCP47] Language Tag']
            ]
        ];
    }

    /**
     * Hints as to the language used by the target resource. Value MUST be a BCP47 Language-Tag.
     *
     * Domain: Link
     * Range: BCP47 Language Tag
     * Functional: True
     */
    public function withHreflang(string $hreflang): self
    {
        return $this->set('https://www.w3.org/ns/activitystreams#hreflang', $hreflang);
    }
}
