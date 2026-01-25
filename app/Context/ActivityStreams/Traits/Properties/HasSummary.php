<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\TranslatableString;

/**
 * @property-read TranslatableString|null $summary
 */
trait HasSummary
{
    protected function summarySchema(): array
    {
        return [
            'summary' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#summary',
                'cast' => Cast::TranslatableString,
            ]
        ];
    }

    /**
     * A natural language summarization of the object encoded as HTML.
     * Multiple language tagged summaries MAY be provided.
     *
     * Domain: Object
     * Range: xsd:string | rdf:langString
     */
    public function withSummary(string|TranslatableString $summary): self
    {
        return $this->set('https://www.w3.org/ns/activitystreams#summary', $summary);
    }
}
