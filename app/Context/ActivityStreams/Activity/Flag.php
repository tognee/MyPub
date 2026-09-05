<?php

namespace App\Context\ActivityStreams\Activity;

use App\Context\ActivityStreams\Activity;

class Flag extends Activity
{
    /**
     * Indicates that the `actor` is "flagging" the `object`.
     * Flagging is defined in the sense common to many social platforms as
     * reporting content as being inappropriate for any number of reasons.
     */
}
