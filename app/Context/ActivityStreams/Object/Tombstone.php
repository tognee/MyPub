<?php

namespace App\Context\ActivityStreams\Object;

use App\Context\ActivityStreams\BaseObject;
use App\Context\ActivityStreams\Traits\Properties\HasDeleted;
use App\Context\ActivityStreams\Traits\Properties\HasFormerType;

class Tombstone extends BaseObject
{
    /**
     * A Tombstone represents a content object that has been deleted.
     * It can be used in Collections to signify that there used to be an
     * object at this position, but it has been deleted.
     */
    use HasDeleted, HasFormerType;
}
