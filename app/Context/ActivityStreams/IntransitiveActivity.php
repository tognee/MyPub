<?php

namespace App\Context\ActivityStreams;

use App\Context\ActivityStreams\Traits\Properties\HasActor;
use App\Context\ActivityStreams\Traits\Properties\HasInstrument;
use App\Context\ActivityStreams\Traits\Properties\HasOrigin;
use App\Context\ActivityStreams\Traits\Properties\HasResult;
use App\Context\ActivityStreams\Traits\Properties\HasTarget;

class IntransitiveActivity extends BaseObject
{
    /**
     * Instances of `IntransitiveActivity` are a subtype of `Activity` representing intransitive actions.
     * The `object` property is therefore inappropriate for these activities.
     */
    use HasActor, HasInstrument, HasOrigin, HasResult, HasTarget;
}
