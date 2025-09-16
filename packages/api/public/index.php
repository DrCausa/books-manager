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

$collector = $app->getRouteCollector();
$collector->setDefaultInvocationStrategy(new RequestResponseArgs);

$app->addBodyParsingMiddleware();

$error_middleware = $app->addErrorMiddleware(true, true, true);
$error_handler = $error_middleware->getDefaultErrorHandler();
$error_handler->forceContentType('application/json');

$app->add(AddJsonResponseHeader::class);

$app->group('/api', require APP_ROOT . '/routes/api.php');

$app->run();
