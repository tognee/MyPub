<?php

namespace App\Context\ActivityStreams\Traits\Properties;

use App\ActivityPub\Cast;
use Illuminate\Support\Collection;

/**
 * @property-read Collection<string> $rel
 */
trait HasRel
{
    protected function schemaHasRel(): array
    {
        return [
            'rel' => [
                'uri' => 'https://www.w3.org/ns/activitystreams#rel',
                'cast' => Cast::Collection,
                'range' => ['string'],
            ],
        ];
    }

    /**
     * A link relation associated with a Link. The value MUST conform to both HTML5 and RFC5988 "link relation" definitions.
     * In HTML5, any string not containing the "space" U+0020, "tab" (U+0009), "LF" (U+000A), "FF" (U+000C), "CR" (U+000D) or "," (U+002C) characters can be used as a valid link relation.
     *
     * Domain: Link
     * Range: [RFC5988] or [HTML5] Link Relation
     */
    public function withRel(string|Collection $value): self
    {
        $collection = collect(is_iterable($value) ? $value : [$value]);

        $collection->each(function ($item) {
            if (! is_string($item)) {
                throw new \InvalidArgumentException('Rel items must be strings');
            }
        });

        return $this->set('https://www.w3.org/ns/activitystreams#rel', $collection);
    }
}
