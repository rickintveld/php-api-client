<?php

namespace Rintveld\Exceptions;

final class ForbiddenException extends \Exception
{
    public static function create(string $url): void
    {
        throw new \Exception('403: Forbidden request for url: ' . $url);
    }
}
