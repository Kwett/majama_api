<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpClient\Exception\TransportExceptionInterface;

class GoogleMapsService
{
    private $httpClient;
    private $googleApiKey;

    public function __construct(HttpClientInterface $httpClient, string $googleApiKey)
    {
        $this->httpClient = $httpClient;
        $this->googleApiKey = $googleApiKey;
    }

    public function findPlaceFromText(string $query): array
    {
        $url = sprintf(
            'https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=%s&inputtype=textquery&fields=geometry&key=%s',
            urlencode($query),
            $this->googleApiKey
        );

        try {
            $response = $this->httpClient->request('GET', $url);
            $data = $response->toArray();
        } catch (TransportExceptionInterface $e) {
            // Log error or handle exception as needed
            throw new \RuntimeException('Error fetching data from Google Places API: ' . $e->getMessage());
        }

        return $data;
    }
}
