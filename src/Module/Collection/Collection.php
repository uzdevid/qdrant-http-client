<?php declare(strict_types=1);

namespace UzDevid\Qdrant\Http\Module\Collection;

use UzDevid\Qdrant\Http\Conflux\QdrantConfluxInterface;
use UzDevid\Qdrant\Http\Exception\NotSupportedException;
use UzDevid\Qdrant\Http\Module\Collection\Request\GetRequest;
use UzDevid\Qdrant\Http\Module\Collection\Request\ListRequest;
use UzDevid\Qdrant\Module\Collection\CollectionInterface;
use UzDevid\Qdrant\Module\Collection\Input\Vector;
use UzDevid\Qdrant\Module\Collection\Output\CollectionData;

readonly final class Collection implements CollectionInterface {
    /**
     * @param QdrantConfluxInterface $conflux
     */
    public function __construct(
        private QdrantConfluxInterface $conflux
    ) {
    }

    public function get(string $name): CollectionData {
        return $this->conflux->withRequest(new GetRequest($name))->send();
    }

    /**
     * @throws NotSupportedException
     */
    public function create(string $name, Vector $vector): bool {
        throw new NotSupportedException();
    }

    /**
     * @throws NotSupportedException
     */
    public function delete(string $name): bool {
        throw new NotSupportedException();
    }

    /**
     * @throws NotSupportedException
     */
    public function update(string $name): bool {
        throw new NotSupportedException();
    }

    public function list(): array {
        return $this->conflux->withRequest(new ListRequest())->send();
    }

    /**
     * @throws NotSupportedException
     */
    public function exists(string $name): bool {
        throw new NotSupportedException();
    }
}