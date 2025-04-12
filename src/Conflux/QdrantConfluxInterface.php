<?php

namespace UzDevid\Qdrant\Http\Conflux;

use UzDevid\Conflux\Http\ConfluxHttpInterface;
use UzDevid\Qdrant\Exception\QdrantException;
use UzDevid\Qdrant\Http\Exception\ClientErrorException;
use UzDevid\Qdrant\Http\Exception\ServiceErrorException;

interface QdrantConfluxInterface extends ConfluxHttpInterface {
    /**
     * @throws ServiceErrorException
     * @throws ClientErrorException
     * @throws QdrantException
     */
    public function send(): mixed;
}