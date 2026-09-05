<?php

namespace App\Context\ActivityStreams\Object;

use App\Context\ActivityStreams\BaseObject;
use App\Context\ActivityStreams\Traits\Properties\HasAccuracy;
use App\Context\ActivityStreams\Traits\Properties\HasAltitude;
use App\Context\ActivityStreams\Traits\Properties\HasLatitude;
use App\Context\ActivityStreams\Traits\Properties\HasLongitude;
use App\Context\ActivityStreams\Traits\Properties\HasRadius;
use App\Context\ActivityStreams\Traits\Properties\HasUnits;

class Place extends BaseObject
{
    /**
     * Represents a logical or physical location.
     * See 5.3 Representing Places for additional information.
     */
    use HasAccuracy, HasAltitude, HasLatitude, HasLongitude, HasRadius, HasUnits;
}
