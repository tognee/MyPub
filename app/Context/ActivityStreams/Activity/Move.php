<?php

namespace App\Context\ActivityStreams\Activity;

use App\Context\ActivityStreams\Activity;

class Move extends Activity
{
    /**
     * Indicates that the `actor` has moved `object` from `origin` to `target`.
     * If the `origin` or `target` are not specified, either can be determined by context.
     */
}
