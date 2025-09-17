<?php

namespace App\Controllers;

use App\Database\Tables\BookAuthorTable;
use App\Repositories\BookAuthorRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BookAuthor
{
  public function __construct(
    private BookAuthorRepository $bookAuthorRepo,
  ) {}

  public function create(Request $req, Response $res): Response
  {
    $body = $req->getParsedBody();

    $book_id = $body[BookAuthorTable::COL_BOOK_ID];
    $author_id = $body[BookAuthorTable::COL_AUTHOR_ID];

    $id = $this->bookAuthorRepo->attach($book_id, $author_id);

    $body = json_encode([
      'message' => 'book_author created',
      'id' => $id
    ]);
    $res->getBody()->write($body);
    return $res->withStatus(201);
  }
}
