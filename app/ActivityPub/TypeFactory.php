<?php

namespace App\ActivityPub;

use App\ActivityPub\JsonLD\Graph;

class TypeFactory
{
    public static function create(object $node, Graph $graph) {

        return new BaseNode($node, $graph);

    }
}
