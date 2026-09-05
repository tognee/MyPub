<?php

namespace App\Context\ActivityStreams\Activity;

use App\Context\ActivityStreams\Activity;

class Ignore extends Activity
{
    /**
     * Indicates that the `actor` is ignoring the `object`.
     * The `target` and `origin` typically have no defined meaning.
     */
}
