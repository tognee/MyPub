<?php

namespace App\Context\ActivityStreams;

use App\Context\ActivityStreams\Traits\Properties\HasCurrent;
use App\Context\ActivityStreams\Traits\Properties\HasFirst;
use App\Context\ActivityStreams\Traits\Properties\HasItems;
use App\Context\ActivityStreams\Traits\Properties\HasLast;
use App\Context\ActivityStreams\Traits\Properties\HasTotalItems;

class Collection extends BaseObject
{
    /*
     * A `Collection` is a subtype of `Object` that represents ordered
     * or unordered sets of `Object` or `Link` instances.
     *
     * Refer to the Activity Streams 2.0 Core specification for a
     * complete description of the `Collection` type.
    */

    use HasCurrent, HasFirst, HasItems, HasLast, HasTotalItems;
}
