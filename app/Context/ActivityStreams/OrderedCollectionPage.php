<?php

namespace App\Context\ActivityStreams;

use App\Context\ActivityStreams\Traits\Properties\HasStartIndex;

class OrderedCollectionPage extends CollectionPage
{
    /**
     * Used to represent ordered subsets of items from an `OrderedCollection`.
     *
     * Refer to the Activity Streams 2.0 Core for a complete description of the `OrderedCollectionPage` object.
     */
    use HasStartIndex;
}
