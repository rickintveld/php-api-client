<?php

namespace Rintveld\Clients;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;
use Rintveld\Contracts\Clients\ApiClientInterface;
use Rintveld\Contracts\Payload\PayloadInterface;
use Rintveld\Models\ActionUri;
use Rintveld\Exceptions\BadRequestException;
use Rintveld\Exceptions\ForbiddenException;
use Rintveld\Exceptions\UnauthorizedException;
use Rintveld\Exceptions\NotFoundException;

abstract class ApiClient implements ApiClientInterface
{
    public Client $client;

    public function __construct(string $baseUri)
    {
        if (!$this->client) {
            $this->client = new Client(['base_uri' => $baseUri]);
        }
    }

    public function get(ActionUri $url): string
    {
        try {
            /** @var ResponseInterface $response */
            $response = $this->client->get($url->uri(), $this->headers());

            $this->validateHttpStatusCode($response, $url->uri());
        } catch (ClientException $clientException) {
            throw $clientException;
        }

        return $response->getBody()->getContents();
    }

    public function post(ActionUri $url, PayloadInterface $payload): string
    {
        try {
            /** @var ResponseInterface $response */
            $response = $this->client->post(
                $url->uri(),
                array_merge($this->headers(), $payload->toJSON())
            );

            $this->validateHttpStatusCode($response, $url->uri());
        } catch (ClientException $clientException) {
            throw $clientException;
        }

        return $response->getBody()->getContents();
    }

    public function patch(ActionUri $url, PayloadInterface $payload): string
    {
        try {
            /** @var ResponseInterface $response */
            $response = $this->client->patch(
                $url->uri(),
                array_merge($this->headers(), $payload->toJSON())
            );

            $this->validateHttpStatusCode($response, $url->uri());
        } catch (ClientException $clientException) {
            throw $clientException;
        }

        return $response->getBody()->getContents();
    }

    public function delete(ActionUri $url, array $parameters): string
    {
        try {
            /** @var ResponseInterface $response */
            $response = $this->client->delete($url->uri(), $this->headers());

            $this->validateHttpStatusCode($response, $url->uri());
        } catch (ClientException $clientException) {
            throw $clientException;
        }

        return $response->getBody()->getContents();
    }

    /**
     * @param ResponseInterface $response
     * @param string $url
     * @throws \Exception
     */
    private function validateHttpStatusCode(ResponseInterface $response, string $url): void
    {
        match ($response->getStatusCode()) {
            404 => NotFoundException::create($url),
            403 => ForbiddenException::create($url),
            401 => UnauthorizedException::create($url),
            400 => BadRequestException::create($url),
        };

        // fallback for other unwanted HTTP status codes.
        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Bad response: on url: ' . $url . ', no error messages provided');
        }
    }

    public abstract function headers(): array;
}
