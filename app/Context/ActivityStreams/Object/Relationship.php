<?php

namespace App\Context\ActivityStreams\Object;

use App\Context\ActivityStreams\BaseObject;
use App\Context\ActivityStreams\Traits\Properties\HasObject;
use App\Context\ActivityStreams\Traits\Properties\HasRelationship;
use App\Context\ActivityStreams\Traits\Properties\HasSubject;

class Relationship extends BaseObject
{
    /**
     * Describes a relationship between two individuals.
     * The `subject` and `object` properties are used to identify the connected individuals.
     *
     * See 5.2 Representing Relationships Between Entities for additional information.
     */
    use HasObject, HasRelationship, HasSubject;
}
