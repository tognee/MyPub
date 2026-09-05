<?php

namespace App\ActivityPub\JsonLD;

class Graph
{
    protected array $nodes = [];

    protected array $rootIds = [];

    public function __construct(array $flattened, array $rootIds)
    {
        // Create the nodes map
        foreach ($flattened as $node) {
            $currentNodeId = $node->{'@id'};
            $this->nodes[$currentNodeId] = $node;
        }

        $this->rootIds = $rootIds;
    }

    public function getNode(string $id): ?object
    {
        return $this->nodes[$id] ?? null;
    }

    public function getRoot(?string $id = null): ?object
    {
        if ($id) {
            return $this->nodes[$id] ?? null;
        }

        if (count($this->rootIds) === 1) {
            return $this->nodes[$this->rootIds[0]] ?? null;
        }

        throw new \Exception('This graph has more than one root node, please specify one');
    }

    public function getRootIds(): array
    {
        return $this->rootIds;
    }
}
