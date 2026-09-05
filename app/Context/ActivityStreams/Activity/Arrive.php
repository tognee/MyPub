<?php

namespace App\Context\ActivityStreams\Activity;

use App\Context\ActivityStreams\IntransitiveActivity;

class Arrive extends IntransitiveActivity
{
    /**
     * An `IntransitiveActivity` that indicates that the `actor` has arrived at the `location`.
     * The `origin` can be used to identify the context from which the `actor` originated.
     * The `target` typically has no defined meaning.
    */
}
