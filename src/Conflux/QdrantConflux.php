<?php declare(strict_types=1);

namespace UzDevid\Qdrant\Http\Conflux;

use Psr\EventDispatcher\EventDispatcherInterface;
use UzDevid\Conflux\Http\ConfluxHttp;
use UzDevid\Conflux\Http\ConfluxHttpInterface;
use UzDevid\Conflux\Http\Request\RequestInterface;
use UzDevid\Conflux\Http\RequestHandlerInterface;

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

    public function send(): mixed {
        return $this->conflux->send();
    }
}