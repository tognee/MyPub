<?php

namespace App\Context\ActivityStreams\Object;

use App\Context\ActivityStreams\BaseObject;
use App\Context\ActivityStreams\Traits\Properties\HasDescribes;

class Profile extends BaseObject
{
    /**
     * A `Profile` is a content object that describes another Object,
     * typically used to describe Actor Type objects.
     * The `describes` property is used to reference the object
     * being described by the profile.
     */
    use HasDescribes;
}
