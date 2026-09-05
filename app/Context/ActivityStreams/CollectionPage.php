<?php

namespace App\Context\ActivityStreams;

use App\Context\ActivityStreams\Traits\Properties\HasNext;
use App\Context\ActivityStreams\Traits\Properties\HasPartOf;
use App\Context\ActivityStreams\Traits\Properties\HasPrev;

class CollectionPage extends Collection
{
    /**
     * Used to represent distinct subsets of items from a `Collection`.
     * Refer to the Activity Streams 2.0 Core for a complete description of the `CollectionPage` object.
     */
    use HasNext, HasPartOf, HasPrev;
}
