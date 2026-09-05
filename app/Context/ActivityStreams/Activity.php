<?php

namespace App\Context\ActivityStreams;

use App\Context\ActivityStreams\Traits\Properties\HasActor;
use App\Context\ActivityStreams\Traits\Properties\HasInstrument;
use App\Context\ActivityStreams\Traits\Properties\HasObject;
use App\Context\ActivityStreams\Traits\Properties\HasOrigin;
use App\Context\ActivityStreams\Traits\Properties\HasResult;
use App\Context\ActivityStreams\Traits\Properties\HasTarget;

class Activity extends BaseObject
{
    /**
     * An Activity is a subtype of `Object` that describes some form of action
     * that may happen, is currently happening, or has already happened.
     *
     * The `Activity` type itself serves as an abstract base type for all types of activities.
     * It is important to note that the `Activity` type itself does not carry any specific semantics
     * about the kind of action being taken.
     */
    use HasActor, HasInstrument, HasObject, HasOrigin, HasResult, HasTarget;
}
