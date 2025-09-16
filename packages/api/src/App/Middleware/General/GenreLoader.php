<?php

declare(strict_types=1);

namespace App\Middleware\General;

use App\Database\Tables\GenreTable;
use App\Repositories\GenreRepository;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpNotFoundException;
use Slim\Routing\RouteContext;

class GenreLoader
{
  public function __construct(private GenreRepository $repo) {}

  public function __invoke(Request $req, RequestHandler $handler): Response
  {
    $context = RouteContext::fromRequest($req);
    $route = $context->getRoute();

    $id = $route->getArgument(GenreTable::COL_ID);
    $genreId = $route->getArgument(GenreTable::COL_GENRE_ID);

    if ($id !== null) {
      $genre = $this->repo->getById((int) $id);
    } else if ($genreId !== null) {
      $genre = $this->repo->getByGenreId($genreId);
    } else {
      return $handler->handle($req);
    }

    if ($genre === false) {
      throw new HttpNotFoundException($req, message: "genre not found");
    }

    $req = $req->withAttribute('genre', $genre);

    return $handler->handle($req);
  }
}
