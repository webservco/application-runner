<?php

declare(strict_types=1);

namespace WebServCo\Application\Factory;

use Psr\Http\Message\ServerRequestInterface;
use WebServCo\Application\Contract\ApplicationRunnerFactoryInterface;
use WebServCo\Application\Contract\ApplicationRunnerInterface;
use WebServCo\Application\Service\ApplicationRunner;
use WebServCo\Emitter\Service\SapiEmitter;
use WebServCo\Emitter\Service\StackEmitter;
use WebServCo\Http\Contract\Message\Request\RequestHandler\RequestHandlerFactoryInterface;

final class ApplicationRunnerFactory implements ApplicationRunnerFactoryInterface
{
    public function __construct(private RequestHandlerFactoryInterface $requestHandlerFactory)
    {
    }

    public function createApplicationRunner(ServerRequestInterface $serverRequest): ApplicationRunnerInterface
    {
        return new ApplicationRunner(
            new StackEmitter([new SapiEmitter()]),
            $this->requestHandlerFactory->createRequestHandler(),
            $serverRequest,
        );
    }
}
