<?php declare(strict_types=1);

namespace UzDevid\Qdrant\Http\Module\Collection\Request;

use UzDevid\Conflux\Http\Parser\JsonParser;
use UzDevid\Conflux\Http\Request\ConvertableBodyInterface;
use UzDevid\Conflux\Http\Request\Method;
use UzDevid\Conflux\Http\Request\RequestInterface;
use UzDevid\Conflux\Http\Request\RequestQueryInterface;

class GetRequest implements RequestInterface, RequestQueryInterface, ConvertableBodyInterface {
    use JsonParser;

    /**
     * @param string $name
     */
    public function __construct(
        private readonly string $name
    ) {
    }

    public function getMethod(): Method {
        return Method::GET;
    }

    public function getUrl(): string {
        return '/collections/:name';
    }

    public function getQueryPath(): array {
        return [
            ':name' => $this->name
        ];
    }

    public function getQueryParams(): array {
        return [];
    }

    /**
     * @param array $response
     * @return array
     */
    public function convert(array $response): array {
        return $response['result'];
    }
}