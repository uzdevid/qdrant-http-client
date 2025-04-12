<?php declare(strict_types=1);

namespace UzDevid\Qdrant\Http\Conflux;

use GuzzleHttp\ClientInterface;

readonly class QdrantConfig implements QdrantConfigInterface {
    /**
     * @param string $baseUri
     * @param string $apiKey
     * @param ClientInterface $client
     */
    public function __construct(
        private string          $baseUri,
        private string          $apiKey,
        private ClientInterface $client
    ) {
    }

    public function getClient(): ClientInterface {
        return $this->client;
    }

    public function getBaseUri(): string {
        return $this->baseUri;
    }

    public function getDefaultHeaders(): array {
        return [
            'api-key' => $this->apiKey
        ];
    }
}