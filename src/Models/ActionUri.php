<?php

namespace Rintveld\Models;

final class ActionUri
{
    public function __construct(private string $uri)
    {
    }

    public function addParameters(array $parameters): self
    {
        $this->uri =
            implode('?', [$this->uri, http_build_query($parameters)]);

        return $this;
    }

    public function uri(): string
    {
        return $this->uri;
    }
}
