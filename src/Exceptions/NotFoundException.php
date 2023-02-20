<?php

namespace Rintveld\Exceptions;

final class NotFoundException extends \Exception
{
    public static function create(string $url): void
    {
        throw new \Exception('404: Url not found: ' . $url);
    }
}
