<?php

namespace Rintveld\Exceptions;

final class UnauthorizedException extends \Exception
{
    public static function create(string $url): void
    {
        throw new \Exception('401: Unauthorized request for url: ' . $url);
    }
}
