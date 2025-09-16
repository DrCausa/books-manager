<?php

declare(strict_types=1);

namespace App\Middleware\General;

use App\Database\Tables\AuthorTable;
use App\Repositories\AuthorRepository;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpNotFoundException;
use Slim\Routing\RouteContext;

class AuthorLoader
{
  public function __construct(private AuthorRepository $repo) {}

  public function __invoke(Request $req, RequestHandler $handler): Response
  {
    $context = RouteContext::fromRequest($req);
    $route = $context->getRoute();

    $id = $route->getArgument(AuthorTable::COL_ID);
    $authorId = $route->getArgument(AuthorTable::COL_AUTHOR_ID);

    if ($id !== null) {
      $author = $this->repo->getById((int) $id);
    } else if ($authorId !== null) {
      $author = $this->repo->getByAuthorId($authorId);
    } else {
      return $handler->handle($req);
    }

    if ($author === false) {
      throw new HttpNotFoundException($req, message: "author not found");
    }

    $req = $req->withAttribute('author', $author);

    return $handler->handle($req);
  }
}
