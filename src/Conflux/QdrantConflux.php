<?php declare(strict_types=1);

namespace UzDevid\Qdrant\Http\Conflux;

use Override;
use Psr\EventDispatcher\EventDispatcherInterface;
use UzDevid\Conflux\Http\ConfluxHttp;
use UzDevid\Conflux\Http\ConfluxHttpInterface;
use UzDevid\Conflux\Http\Exception\ClientErrorException as ConfluxClientErrorException;
use UzDevid\Conflux\Http\Exception\ConfluxException;
use UzDevid\Conflux\Http\Exception\ServerErrorException;
use UzDevid\Conflux\Http\Request\RequestInterface;
use UzDevid\Conflux\Http\RequestHandlerInterface;
use UzDevid\Qdrant\Exception\QdrantException;
use UzDevid\Qdrant\Http\Exception\ClientErrorException;
use UzDevid\Qdrant\Http\Exception\ServiceErrorException;

final class QdrantConflux implements QdrantConfluxInterface {
    private ConfluxHttpInterface $conflux;

    /**
     * @param QdrantConfig $config
     * @param RequestHandlerInterface $requestHandler
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        private readonly QdrantConfig     $config,
        RequestHandlerInterface           $requestHandler,
        readonly EventDispatcherInterface $eventDispatcher
    ) {
        $this->conflux = new ConfluxHttp($this->config, $requestHandler, $this->eventDispatcher);
    }

    public function withRequest(RequestInterface $request): ConfluxHttpInterface {
        return $this->conflux = $this->conflux->withRequest($request);
    }

    /**
     * @throws ServiceErrorException
     * @throws ClientErrorException
     * @throws QdrantException
     */
    public function send(): mixed {
        try {
            return $this->conflux->send();
        } catch (ConfluxClientErrorException $e) {
            throw new ClientErrorException($e->getResponse(), $e->getRequest(), $e->getPrevious());
        } catch (ConfluxException $e) {
            throw new QdrantException($e->getMessage(), $e->getCode(), $e);
        } catch (ServerErrorException $e) {
            throw new ServiceErrorException($e->getResponse(), $e->getRequest(), $e->getPrevious());
        }
    }
}