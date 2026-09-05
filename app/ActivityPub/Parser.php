<?php

namespace App\ActivityPub;

use App\ActivityPub\JsonLD\DocumentLoader;
use App\ActivityPub\JsonLD\Graph;
use ML\JsonLD\JsonLD;

class Parser
{
    protected DocumentLoader $loader;

    public function __construct(DocumentLoader $loader)
    {
        $this->loader = $loader;
    }

    public function parse(string $jsonString)
    {
        $jsonObject = json_decode($jsonString);

        $options = ['documentLoader' => $this->loader];

        // Step 1. Expand
        $expanded = JsonLD::expand($jsonObject, $options);

        $rootIds = [];
        foreach ($expanded as $rootNode) {
            $rootIds[] = $rootNode->{'@id'};
        }

        // Step 2. Flatten the graph and create a node map
        $flattened = JsonLD::flatten($expanded, options: $options);

        // Step 3. Create a graph
        $graph = new Graph($flattened, $rootIds);

        // Step 4. Create the root object
        $root = TypeFactory::create($graph->getRoot(), $graph);

        return $root;
    }
}
