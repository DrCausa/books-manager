<?php

declare(strict_types=1);

namespace App\Middleware\General;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface as Response;

class AddJsonResponseHeader
{
  public function __invoke(Request $req, RequestHandler $handler): Response
  {
    $res = $handler->handle($req);
    return $res->withHeader('Content-Type', 'application/json');
  }
}
