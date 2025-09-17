<?php

namespace App\Controllers;

use App\Database\Tables\BookGenreTable;
use App\Repositories\BookGenreRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BookGenre
{
  public function __construct(
    private BookGenreRepository $bookGenreRepo,
  ) {}

  public function create(Request $req, Response $res): Response
  {
    $body = $req->getParsedBody();

    $book_id = $req->getAttribute(BookGenreTable::COL_BOOK_ID);
    $genre_id = $req->getAttribute(BookGenreTable::COL_GENRE_ID);

    $id = $this->bookGenreRepo->attach($book_id, $genre_id);

    $body = json_encode([
      'message' => 'book_genre created',
      'id' => $id
    ]);
    $res->getBody()->write($body);
    return $res->withStatus(201);
  }
}
