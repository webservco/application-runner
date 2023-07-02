<?php

declare(strict_types=1);

namespace WebServCo\Application\Service;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use WebServCo\Application\Contract\ApplicationRunnerInterface;
use WebServCo\Emitter\Contract\EmitterInterface;

/**
 * General application runner class implementation.
 *
 * Must work with interfaces only.
 */
final class ApplicationRunner implements ApplicationRunnerInterface
{
    public function __construct(
        private EmitterInterface $emitter,
        private RequestHandlerInterface $requestHandler,
        private ServerRequestInterface $serverRequest,
    ) {
    }

    public function run(): bool
    {
        // Object: \Psr\Http\Message\ResponseInterface
        $response = $this->requestHandler->handle($this->serverRequest);

        return $this->emitter->emit($response);
    }
}
