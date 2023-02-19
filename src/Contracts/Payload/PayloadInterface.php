<?php

namespace Rintveld\Contracts\Payload;

interface PayloadInterface
{
    public function toJSON(): string;
}
