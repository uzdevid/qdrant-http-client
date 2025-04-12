<?php declare(strict_types=1);

namespace UzDevid\Qdrant\Http\Exception;

use UzDevid\Conflux\Http\Exception\ServerErrorException as ConfluxClientErrorException;
use UzDevid\Qdrant\Exception\ServiceErrorExceptionInterface;

class ServiceErrorException extends ConfluxClientErrorException implements ServiceErrorExceptionInterface { }