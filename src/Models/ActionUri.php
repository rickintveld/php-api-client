<?php

namespace Rintveld\Models;

final class ActionUri
{
    public function __construct(private readonly string $url)
    {
    }

    public function addParameters(array $parameters): self
    {
        if (!empty($parameters)) {
            $this->url . '?' . http_build_query($parameters);
        }

        return $this;
    }

    public function href(): string
    {
        return $this->url;
    }
}
