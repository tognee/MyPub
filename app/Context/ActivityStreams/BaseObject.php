<?php

namespace App\Context\ActivityStreams;

use App\ActivityPub\BaseNode;
use App\Context\ActivityStreams\Traits\Properties\HasAttachment;
use App\Context\ActivityStreams\Traits\Properties\HasAttributedTo;
use App\Context\ActivityStreams\Traits\Properties\HasAudience;
use App\Context\ActivityStreams\Traits\Properties\HasBcc;
use App\Context\ActivityStreams\Traits\Properties\HasBto;
use App\Context\ActivityStreams\Traits\Properties\HasCc;
use App\Context\ActivityStreams\Traits\Properties\HasContent;
use App\Context\ActivityStreams\Traits\Properties\HasContext;
use App\Context\ActivityStreams\Traits\Properties\HasDuration;
use App\Context\ActivityStreams\Traits\Properties\HasEndTime;
use App\Context\ActivityStreams\Traits\Properties\HasGenerator;
use App\Context\ActivityStreams\Traits\Properties\HasIcon;
use App\Context\ActivityStreams\Traits\Properties\HasImage;
use App\Context\ActivityStreams\Traits\Properties\HasInReplyTo;
use App\Context\ActivityStreams\Traits\Properties\HasLocation;
use App\Context\ActivityStreams\Traits\Properties\HasMediaType;
use App\Context\ActivityStreams\Traits\Properties\HasName;
use App\Context\ActivityStreams\Traits\Properties\HasPreview;
use App\Context\ActivityStreams\Traits\Properties\HasPublished;
use App\Context\ActivityStreams\Traits\Properties\HasReplies;
use App\Context\ActivityStreams\Traits\Properties\HasStartTime;
use App\Context\ActivityStreams\Traits\Properties\HasSummary;
use App\Context\ActivityStreams\Traits\Properties\HasTag;
use App\Context\ActivityStreams\Traits\Properties\HasTo;
use App\Context\ActivityStreams\Traits\Properties\HasUpdated;
use App\Context\ActivityStreams\Traits\Properties\HasUrl;

class BaseObject extends BaseNode
{
    /**
     * Describes an object of any kind.
     * The `Object` type serves as the base type for most of the other kinds
     * of objects defined in the Activity Vocabulary, including other Core types
     * such as `Activity`, `IntransitiveActivity`, `Collection` and `OrderedCollection`.
     */
    use HasAttachment, HasAttributedTo, HasAudience, HasBcc, HasBto,
        HasCc, HasContent, HasContext, HasDuration, HasEndTime, HasGenerator,
        HasIcon, HasImage, HasInReplyTo, HasLocation, HasMediaType,
        HasName, HasPreview, HasPublished, HasReplies, HasStartTime, HasSummary, HasTag, HasTo,
        HasUpdated, HasUrl;
}
