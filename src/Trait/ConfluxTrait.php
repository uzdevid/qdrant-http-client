<?php

namespace UzDevid\Qdrant\Http\Trait;

use UzDevid\Conflux\Http\Exception\ClientErrorException as ConfluxClientErrorException;
use UzDevid\Conflux\Http\Exception\ConfluxException;
use UzDevid\Conflux\Http\Exception\ServerErrorException;
use UzDevid\Conflux\Http\Request\RequestInterface;
use UzDevid\Qdrant\Exception\QdrantException;
use UzDevid\Qdrant\Http\Exception\ClientErrorException;
use UzDevid\Qdrant\Http\Exception\ServiceErrorException;

/**
 * @internal
 */
trait ConfluxTrait {
    /**
     * @throws ClientErrorException
     * @throws QdrantException
     * @throws ServiceErrorException
     */
    private function send(RequestInterface $request) {
        try {
            return $this->conflux->withRequest($request)->send();
        } catch (ConfluxClientErrorException $e) {
            throw new ClientErrorException($e->getResponse(), $e->getRequest(), $e->getPrevious());
        } catch (ConfluxException $e) {
            throw new QdrantException($e->getMessage(), $e->getCode(), $e);
        } catch (ServerErrorException $e) {
            throw new ServiceErrorException($e->getResponse(), $e->getRequest(), $e->getPrevious());
        }
    }
}