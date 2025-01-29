<?php

namespace App\Services\ExternalAPI;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class GuardianAPIService
{

    /**
     * A base url for endpoint APIs
     * @var string $baseUrl
     */
    public string $baseUrl;

    /**
     * Array of headers That will be sent in each request
     * @var array $headers
     */
    public array $headers;

    /**
     * API Key
     * @var string $apiKey
     */
    public string $apiKey;


    public function __construct()
    {
        $this->baseUrl = config('guardiannews.base_url');
        $this->apiKey = config('guardiannews.api_key');
        $this->headers = [];


    }

    public function initHttpClient(): \Illuminate\Http\Client\PendingRequest
    {
        return Http::withHeaders($this->headers);
    }


    /**
     * @throws ConnectionException
     */
    public function fetchNews(string $query = '*', string $fromDate = '',
                              string $toDate = '', string $sortBy = 'newest')
    {
        try {
            $response = $this->initHttpClient()->get($this->baseUrl.'search', [
                'api-key' => $this->apiKey,
                'from-date' => $fromDate,
//                'to-date' => $toDate,
                'order-by' => $sortBy,
                'show-fields' => 'headline,body,byline',
            ]);

            return $response->json();
        } catch (ConnectionException $e) {
            throw new ConnectionException($e->getMessage());
        }

    }

    /**
     * @throws ConnectionException
     */
    public function fetchSections()
    {
        try {
            return $this->initHttpClient()->get($this->baseUrl.'sections', [
                'api-key' => $this->apiKey
            ]);
        } catch (ConnectionException $e) {
            throw new ConnectionException($e->getMessage());
        }

    }
}
