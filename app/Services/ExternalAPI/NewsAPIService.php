<?php

namespace App\Services\ExternalAPI;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class NewsAPIService
{

    public Http $http;

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
        $this->baseUrl = config('newsapi.base_url');
        $this->headers = [
            'x-api-key' => config('newsapi.api_key'),
        ];


    }

    public function initHttpClient(): \Illuminate\Http\Client\PendingRequest
    {
        return Http::withHeaders($this->headers);
    }


    /**
     * @throws ConnectionException
     */
    public function fetchNews(string $query = '*', string $fromDate = '',
                              string $toDate = '', string $sortBy = 'publishedAt')
    {
        try {
            $response = $this->initHttpClient()->get($this->baseUrl.'everything', [
                'q' => $query,
                'from' => $fromDate,
                'to' => $toDate,
                'sortBy' => $sortBy
            ]);

            return $response->json();
        } catch (ConnectionException $e) {
            throw new ConnectionException($e->getMessage());
        }

    }

    /**
     * @throws ConnectionException
     */
    public function fetchSources(): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
    {
        try {
            return $this->initHttpClient()->get($this->baseUrl.'top-headlines/sources');
        } catch (ConnectionException $e) {
            throw new ConnectionException($e->getMessage());
        }


    }

}
