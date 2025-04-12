<?php declare(strict_types=1);

namespace UzDevid\Qdrant\Http\Module\Collection\Request;

use UzDevid\Conflux\Http\Parser\JsonParser;
use UzDevid\Conflux\Http\Request\ConvertableBodyInterface;
use UzDevid\Conflux\Http\Request\Method;
use UzDevid\Conflux\Http\Request\RequestInterface;
use UzDevid\Qdrant\Module\Collection\Output\CollectionData;
use Yiisoft\Hydrator\Hydrator;

class ListRequest implements RequestInterface, ConvertableBodyInterface {
    use JsonParser;

    public function getMethod(): Method {
        return Method::GET;
    }

    public function getUrl(): string {
        return '/collections';
    }

    /**
     * @param array $response
     * @return CollectionData[]
     */
    public function convert(array $response): array {
        $hydrator = new Hydrator();

        return array_map(
            static fn(array $collection) => $hydrator->create(CollectionData::class, $collection),
            $response['result']
        );
    }
}