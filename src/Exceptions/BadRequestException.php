<?php

namespace Rintveld\Exceptions;

final class BadRequestException extends \Exception
{
    public static function create(string $url): void
    {
        throw new \Exception('400: Bad request for url: ' . $url);
    }
}
