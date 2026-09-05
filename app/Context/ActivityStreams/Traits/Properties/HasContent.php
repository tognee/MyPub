<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use App\ActivityPub\TranslatableString;

/**
 * @property-read TranslatableString|null $content
 */
trait HasContent
{
    protected function schemaHasContent(): array
    {
        return [
            'content' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#content',
                'cast' => Cast::TranslatableString,
            ],
        ];
    }

    /**
     * The content or textual representation of the Object encoded as a string.
     * By default, the value is HTML. The mediaType property can be used to indicate a different content type.
     * The content MAY be expressed using multiple language-tagged values.
     *
     * Domain: Object
     * Range: xsd:string | rdf:langString
     */
    public function withContent(string|TranslatableString $content): self
    {
        return $this->set('https://www.w3.org/ns/activitystreams#content', $content);
    }
}
