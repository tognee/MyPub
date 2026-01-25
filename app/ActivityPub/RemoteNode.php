<?php

namespace App\ActivityPub;

class RemoteNode
{
    public string $id;

    public function __construct(string $id)
    {

        if (!filter_var($id, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException("Remote ID must be a valid URL.");
        }
        $this->id = $id;
    }

    public static function make(string $id): self
    {
        return new self($id);
    }
}
