<?php

namespace App\Context\ActivityStreams\Activity;

use App\Context\ActivityStreams\IntransitiveActivity;
use App\Context\ActivityStreams\Traits\Properties\HasAnyOf;
use App\Context\ActivityStreams\Traits\Properties\HasClosed;
use App\Context\ActivityStreams\Traits\Properties\HasOneOf;

class Question extends IntransitiveActivity
{
    /**
     * Represents a question being asked.
     * Question objects are an extension of `IntransitiveActivity`.
     *
     * That is, the `Question` object is an `Activity`, but the direct object
     * is the question itself and therefore it would not contain an `object` property.
     *
     * Either of the `anyOf` and `oneOf` properties MAY be used to express possible answers,
     * but a Question object MUST NOT have both properties.
     */
    use HasAnyOf, HasClosed, HasOneOf;
}
