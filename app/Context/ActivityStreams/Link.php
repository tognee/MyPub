<?php

namespace App\Context\ActivityStreams;

use App\ActivityPub\BaseNode;
use App\Context\ActivityStreams\Traits\Properties\HasHeight;
use App\Context\ActivityStreams\Traits\Properties\HasHref;
use App\Context\ActivityStreams\Traits\Properties\HasHreflang;
use App\Context\ActivityStreams\Traits\Properties\HasMediaType;
use App\Context\ActivityStreams\Traits\Properties\HasName;
use App\Context\ActivityStreams\Traits\Properties\HasPreview;
use App\Context\ActivityStreams\Traits\Properties\HasRel;
use App\Context\ActivityStreams\Traits\Properties\HasWidth;

class Link extends BaseNode
{
    /**
     * A Link is an indirect, qualified reference to a resource identified by a URL.
     * The fundamental model for links is established by [RFC5988].
     *
     * Many of the properties defined by the Activity Vocabulary allow values that are
     * either instances of `Object` or `Link`. When a `Link` is used, it establishes a qualified
     * relation connecting the subject (the containing object) to the resource identified by the `href`.
     *
     * Properties of the `Link` are properties of the reference as opposed to properties of the resource.
     */
    use HasHeight, HasHref, HasHreflang, HasMediaType, HasName, HasPreview, HasRel, HasWidth;
}
