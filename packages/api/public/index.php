<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Slim\Handlers\Strategies\RequestResponseArgs;
use App\Middleware\General\AddJsonResponseHeader;

define('APP_ROOT', dirname(__DIR__));
require APP_ROOT . '/vendor/autoload.php';
Dotenv\Dotenv::createImmutable(APP_ROOT)->load();

$builder = new ContainerBuilder;
$container = $builder->addDefinitions(APP_ROOT . '/config/definitions.php')->build();

AppFactory::setContainer($container);

$app = AppFactory::create();

$app->add(function ($request, $handler) {
  $response = $handler->handle($request);

  return $response
    ->withHeader("Access-Control-Allow-Origin", "http://localhost:5173")
    ->withHeader("Access-Control-Allow-Headers", "Content-Type, Authorization, X-Requested-With")
    ->withHeader("Access-Control-Allow-Methods", "GET, POST, PUT, PATCH, DELETE, OPTIONS")
    ->withHeader("Access-Control-Allow-Credentials", "true");
});

$app->options('/{routes:.+}', function ($request, $response, $args) {
  return $response;
});

$collector = $app->getRouteCollector();
$collector->setDefaultInvocationStrategy(new RequestResponseArgs);

$app->addBodyParsingMiddleware();

$error_middleware = $app->addErrorMiddleware(true, true, true);
$error_handler = $error_middleware->getDefaultErrorHandler();
$error_handler->forceContentType('application/json');

$app->add(AddJsonResponseHeader::class);

$app->group('/api', require APP_ROOT . '/routes/api.php');

$app->run();
