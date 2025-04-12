<?php declare(strict_types=1);

namespace UzDevid\Qdrant\Http\Exception;

use UzDevid\Conflux\Http\Exception\ClientErrorException as ConfluxClientErrorException;
use UzDevid\Qdrant\Exception\ClientErrorExceptionInterface;

class ClientErrorException extends ConfluxClientErrorException implements ClientErrorExceptionInterface { }