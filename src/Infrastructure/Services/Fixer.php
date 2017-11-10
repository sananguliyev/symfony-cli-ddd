<?php

namespace Webbala\Infrastructure\Services;

use GuzzleHttp\ClientInterface;
use Webbala\Domain\Services\ProviderInterface;

/**
 * Class Fixer
 * @package Webbala\Infrastructure\Services
 */
class Fixer implements ProviderInterface
{

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var string
     */
    private $endpoint;

    /**
     * Fixer constructor.
     * @param ClientInterface $client
     * @param string $endpoint
     */
    public function __construct(ClientInterface $client, string $endpoint)
    {
        $this->client = $client;
        $this->endpoint = $endpoint;
    }

    /**
     * @param string $date
     * @param string $base
     * @param array $symbols
     * @return array
     */
    public function getRates(string $date, string $base, array $symbols)
    {
        $result = [];

        $endpoint = $this->generateFinalEndpoint($date, $base, $symbols);

        $request = $this->client->request('GET', $endpoint);

        if ($request->getStatusCode() == 200){
            $apiResult = json_decode($request->getBody(), true);
            foreach ($apiResult['rates'] as $key => $rate) {
                $result[] = [$key, $rate];
            }
        }

        return $result;
    }

    /**
     * @param string $date
     * @param string $base
     * @param array $symbols
     * @return string
     */
    private function generateFinalEndpoint(string $date, string $base, array $symbols)
    {
        $endpoint = $this->endpoint . $date . '?base=' . $base;

        if (count($symbols) > 0){
            $endpoint .= '&symbols=' . implode(',', $symbols);
        }

        return $endpoint;
    }
}