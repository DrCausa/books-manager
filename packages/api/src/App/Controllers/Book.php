<?php

namespace App\Controllers;

use App\Database\Tables\BookAuthorTable;
use App\Database\Tables\BookTable;
use App\Repositories\BookAuthorRepository;
use App\Repositories\BookGenreRepository;
use App\Repositories\BookRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Book
{
  public function __construct(
    private BookRepository $repo,
    private BookAuthorRepository $bookAuthorRepo,
    private BookGenreRepository $bookGenreRepo
  ) {}

  public function index(Request $req, Response $res): Response
  {
    $data = $this->repo->getAll();
    $body = json_encode($data);
    $res->getBody()->write($body);
    return $res;
  }

  public function show(Request $req, Response $res): Response
  {
    $book = $req->getAttribute('book');
    $body = json_encode($book);
    $res->getBody()->write($body);
    return $res;
  }

  public function showByBookId(Request $req, Response $res): Response
  {
    $book = $req->getAttribute('book');
    $body = json_encode($book);
    $res->getBody()->write($body);
    return $res;
  }

  public function create(Request $req, Response $res): Response
  {
    $body = $req->getParsedBody();
    $id = $this->repo->create($body);

    $body = json_encode([
      'message' => 'book created',
      'id' => $id
    ]);
    $res->getBody()->write($body);
    return $res->withStatus(201);
  }

  public function update(Request $req, Response $res): Response
  {
    $book = $req->getAttribute('book');
    $body = $req->getParsedBody();
    $rows = $this->repo->update((int) $book[BookTable::COL_ID], $body);

    $body = json_encode([
      'message' => 'book updated',
      'rows' => $rows
    ]);
    $res->getBody()->write($body);
    return $res;
  }

  public function updateByBookId(Request $req, Response $res): Response
  {
    $book = $req->getAttribute('book');
    $body = $req->getParsedBody();
    $rows = $this->repo->updateByBookId($book[BookTable::COL_BOOK_ID], $body);

    $res->getBody()->write(json_encode([
      'message' => 'book updated',
      'rows' => $rows
    ]));

    return $res;
  }

  public function delete(Request $req, Response $res): Response
  {
    $book = $req->getAttribute('book');
    $rows = $this->repo->delete((int) $book[BookTable::COL_ID]);

    $body = json_encode([
      'message' => 'book deleted',
      'rows' => $rows
    ]);

    $res->getBody()->write($body);

    return $res;
  }

  public function deleteByBookId(Request $req, Response $res): Response
  {
    $book = $req->getAttribute('book');
    $rows = $this->repo->deleteByBookId($book[BookTable::COL_BOOK_ID]);

    $res->getBody()->write(json_encode([
      'message' => 'book deleted',
      'rows' => $rows
    ]));

    return $res;
  }

  public function authors(Request $req, Response $res): Response
  {
    $book = $req->getAttribute('book');
    $relations = $this->bookAuthorRepo->getAll();

    $bookAuthors = array_filter($relations, fn($ba) => $ba[BookAuthorTable::COL_BOOK_ID] == $book[BookTable::COL_ID]);

    $res->getBody()->write(json_encode(array_values($bookAuthors)));
    return $res;
  }

  public function genres(Request $req, Response $res): Response
  {
    $book = $req->getAttribute('book');
    $relations = $this->bookGenreRepo->getAll();

    $bookGenres = array_filter($relations, fn($bg) => $bg[BookAuthorTable::COL_BOOK_ID] == $book[BookTable::COL_ID]);

    $res->getBody()->write(json_encode(array_values($bookGenres)));
    return $res;
  }
}
