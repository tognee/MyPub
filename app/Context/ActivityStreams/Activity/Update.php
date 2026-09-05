<?php

namespace App\Context\ActivityStreams\Activity;

use App\Context\ActivityStreams\Activity;

class Update extends Activity
{
    /**
     * Indicates that the `actor` has updated the `object`.
     * Note, however, that this vocabulary does not define a
     * mechanism for describing the actual set of modifications
     * made to `object`.
     *
     * The `target` and `origin` typically have no defined meaning.
     */
}
