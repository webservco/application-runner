# webservco/application-runner

A PHP component/library. Please see [webservco/sandbox](https://webservco.github.io/sandbox/) for an example project using these types of components.

Runs a PSR-15 request handler for the current request and sends the response to the client.

- Related: `webservco/application-default` (uses the runner), `webservco/emitter` (sends the response), `webservco/http-request-handler` (the request handler)

---

## Installation

```shell
composer require webservco/application-runner
```

---

## Usage

Give the factory something that builds your request handler (the middleware stack). The server application factory in `webservco/application-default` then asks it for a runner.

```php
use WebServCo\Application\Factory\ApplicationRunnerFactory;

$runnerFactory = new ApplicationRunnerFactory(
    // \WebServCo\Http\Contract\Message\Request\RequestHandler\RequestHandlerFactoryInterface
    $requestHandlerFactory,
);

// \WebServCo\Application\Contract\ApplicationRunnerInterface
$runner = $runnerFactory->createApplicationRunner($serverRequest);
$runner->run();
```

`run()` passes the request to the handler, then emits the response through a `StackEmitter` that contains a `SapiEmitter`.

---

## Contracts

| Interface | Implementation | Purpose |
| --- | --- | --- |
| `Contract\ApplicationRunnerFactoryInterface` (`webservco/application`) | `Factory\ApplicationRunnerFactory` | Creates a runner for a server request. |
| `Contract\ApplicationRunnerInterface` (`webservco/application`) | `Service\ApplicationRunner` | Handles the request and emits the response. |

Namespaces are relative to `WebServCo\Application\`.

---

## Notes

The runner is for web requests only. In CLI, `SapiEmitter` refuses to emit and the emitter stack throws an `UnderflowException`. Use a command runner (`webservco/command`) for scripts.

---

## Development

```shell
# Start project.
ddev start
# Install dependencies.
ddev c u
# Run all validations.
ddev c c
# Run unit tests.
ddev c test:dox
```

---

## License

[MIT](LICENSE.md)
