<?php

declare(strict_types=1);

namespace App\Middleware\General;

use App\Database\Tables\BookTable;
use App\Repositories\BookRepository;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpNotFoundException;
use Slim\Routing\RouteContext;

class BookLoader
{
  public function __construct(private BookRepository $repo) {}

  public function __invoke(Request $req, RequestHandler $handler): Response
  {
    $context = RouteContext::fromRequest($req);
    $route = $context->getRoute();

    $id = $route->getArgument(BookTable::COL_ID);
    $bookId = $route->getArgument(BookTable::COL_BOOK_ID);

    if ($id !== null) {
      $book = $this->repo->getById((int) $id);
    } else if ($bookId !== null) {
      $book = $this->repo->getByBookId($bookId);
    } else {
      return $handler->handle($req);
    }

    if ($book === false) {
      throw new HttpNotFoundException($req, message: "book not found");
    }

    $req = $req->withAttribute('book', $book);

    return $handler->handle($req);
  }
}
