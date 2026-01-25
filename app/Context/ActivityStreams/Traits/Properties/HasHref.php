<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;

/**
 * @property-read string|null $href
 */
trait HasHref
{
    protected function hrefSchema(): array
    {
        return [
            'href' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#href',
                'cast' => Cast::String,
                'range' => ['xsd:anyURI']
            ]
        ];
    }

    /**
     * The target resource pointed to by a Link.
     *
     * Domain: Link
     * Range: xsd:anyURI
     * Functional: True
     */
    public function withHref(string $href): self
    {
        return $this->set('https://www.w3.org/ns/activitystreams#href', $href);
    }
}
