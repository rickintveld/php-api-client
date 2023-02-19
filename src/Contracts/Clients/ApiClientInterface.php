<?php

namespace Rintveld\Contracts\Clients;

use GuzzleHttp\Client;
use Rintveld\Models\ActionUri;
use Rintveld\Contracts\Payload\PayloadInterface;

interface ApiClientInterface
{
    private Client $client;

    public function get(ActionUri $url): string;

    public function post(ActionUri $url, PayloadInterface $payload): string;

    public function patch(ActionUri $url, PayloadInterface $payload): string;

    public function delete(ActionUri $url, array $parameters): string;
}
