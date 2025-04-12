<?php declare(strict_types=1);

namespace UzDevid\Qdrant\Http;

use UzDevid\Qdrant\ClientInterface;
use UzDevid\Qdrant\Http\Conflux\QdrantConfluxInterface;
use UzDevid\Qdrant\Http\Exception\NotSupportedException;
use UzDevid\Qdrant\Http\Module\Collection\Collection;
use UzDevid\Qdrant\Module\AliasInterface;
use UzDevid\Qdrant\Module\Collection\CollectionInterface;
use UzDevid\Qdrant\Module\IndexInterface;
use UzDevid\Qdrant\Module\PointInterface;
use UzDevid\Qdrant\Module\SearchInterface;
use UzDevid\Qdrant\Module\ServiceInterface;
use UzDevid\Qdrant\Module\SnapshotInterface;

readonly final class QdrantClient implements ClientInterface {
    /**
     * @param QdrantConfluxInterface $conflux
     */
    public function __construct(
        private QdrantConfluxInterface $conflux
    ) {
    }

    public function collection(): CollectionInterface {
        return new Collection($this->conflux);
    }

    /**
     * @throws NotSupportedException
     */
    public function point(): PointInterface {
        throw new NotSupportedException();
    }

    /**
     * @throws NotSupportedException
     */
    public function search(): SearchInterface {
        throw new NotSupportedException();
    }

    /**
     * @throws NotSupportedException
     */
    public function index(): IndexInterface {
        throw new NotSupportedException();
    }

    /**
     * @throws NotSupportedException
     */
    public function snapshot(): SnapshotInterface {
        throw new NotSupportedException();
    }

    /**
     * @throws NotSupportedException
     */
    public function alias(): AliasInterface {
        throw new NotSupportedException();
    }

    /**
     * @throws NotSupportedException
     */
    public function service(): ServiceInterface {
        throw new NotSupportedException();
    }
}