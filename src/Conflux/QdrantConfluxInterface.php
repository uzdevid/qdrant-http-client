<?php

namespace UzDevid\Qdrant\Http\Conflux;

use UzDevid\Conflux\Http\ConfluxHttpInterface;

interface QdrantConfluxInterface extends ConfluxHttpInterface {
    public function send(): mixed;
}