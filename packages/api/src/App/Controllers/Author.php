<?php

namespace App\Controllers;

use App\Database\Tables\AuthorTable;
use App\Database\Tables\BookTable;
use App\Repositories\AuthorRepository;
use App\Repositories\BookAuthorRepository;
use App\Repositories\BookRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Author
{
  public function __construct(
    private AuthorRepository $repo,
    private BookAuthorRepository $bookAuthorRepo,
    private BookRepository $bookRepo
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
    $author = $req->getAttribute('author');
    $body = json_encode($author);
    $res->getBody()->write($body);
    return $res;
  }

  public function showByAuthorId(Request $req, Response $res): Response
  {
    $author = $req->getAttribute('author');
    $body = json_encode($author);
    $res->getBody()->write($body);
    return $res;
  }

  public function create(Request $req, Response $res): Response
  {
    $body = $req->getParsedBody();
    $id = $this->repo->create($body);

    $body = json_encode([
      'message' => 'author created',
      'id' => $id
    ]);
    $res->getBody()->write($body);
    return $res->withStatus(201);
  }

  public function update(Request $req, Response $res): Response
  {
    $author = $req->getAttribute('author');
    $body = $req->getParsedBody();
    $rows = $this->repo->update((int) $author[AuthorTable::COL_ID], $body);

    $body = json_encode([
      'message' => 'author updated',
      'rows' => $rows
    ]);
    $res->getBody()->write($body);
    return $res;
  }

  public function updateByAuthorId(Request $req, Response $res): Response
  {
    $author = $req->getAttribute('author');
    $body = $req->getParsedBody();
    $rows = $this->repo->updateByAuthorId($author[AuthorTable::COL_AUTHOR_ID], $body);

    $res->getBody()->write(json_encode([
      'message' => 'author updated',
      'rows' => $rows
    ]));

    return $res;
  }

  public function delete(Request $req, Response $res): Response
  {
    $author = $req->getAttribute('author');
    $rows = $this->repo->delete((int) $author[AuthorTable::COL_ID]);

    $body = json_encode([
      'message' => 'author deleted',
      'rows' => $rows
    ]);

    $res->getBody()->write($body);

    return $res;
  }

  public function deleteByAuthorId(Request $req, Response $res): Response
  {
    $author = $req->getAttribute('author');
    $rows = $this->repo->deleteByAuthorId($author[AuthorTable::COL_AUTHOR_ID]);

    $res->getBody()->write(json_encode([
      'message' => 'author deleted',
      'rows' => $rows
    ]));

    return $res;
  }

  public function books(Request $req, Response $res): Response
  {
    $author = $req->getAttribute('author');
    $relations = $this->bookAuthorRepo->getAll();
    $bookIds = array_map(fn($ba) => $ba['book_id'], array_filter($relations, fn($ba) => $ba['author_id'] == $author[AuthorTable::COL_ID]));

    $books = array_filter($this->bookRepo->getAll(), fn($b) => in_array($b[BookTable::COL_ID], $bookIds));

    $res->getBody()->write(json_encode(array_values($books)));
    return $res;
  }
}
