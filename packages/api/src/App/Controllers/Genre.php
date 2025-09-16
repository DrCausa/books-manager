<?php

namespace App\Controllers;

use App\Database\Tables\BookTable;
use App\Database\Tables\GenreTable;
use App\Repositories\BookGenreRepository;
use App\Repositories\BookRepository;
use App\Repositories\GenreRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Genre
{
  public function __construct(
    private GenreRepository $repo,
    private BookGenreRepository $bookGenreRepo,
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
    $genre = $req->getAttribute('genre');
    $body = json_encode($genre);
    $res->getBody()->write($body);
    return $res;
  }

  public function showByGenreId(Request $req, Response $res): Response
  {
    $genre = $req->getAttribute('genre');
    $body = json_encode($genre);
    $res->getBody()->write($body);
    return $res;
  }

  public function create(Request $req, Response $res): Response
  {
    $body = $req->getParsedBody();
    $id = $this->repo->create($body);

    $body = json_encode([
      'message' => 'genre created',
      'id' => $id
    ]);
    $res->getBody()->write($body);
    return $res->withStatus(201);
  }

  public function update(Request $req, Response $res, string $id): Response
  {
    $body = $req->getParsedBody();
    $rows = $this->repo->update((int) $id, $body);

    $body = json_encode([
      'message' => 'genre updated',
      'rows' => $rows
    ]);
    $res->getBody()->write($body);
    return $res;
  }

  public function updateByGenreId(Request $req, Response $res): Response
  {
    $genre = $req->getAttribute('genre');
    $body = $req->getParsedBody();
    $rows = $this->repo->updateByGenreId($genre[GenreTable::COL_GENRE_ID], $body);

    $res->getBody()->write(json_encode([
      'message' => 'genre updated',
      'rows' => $rows
    ]));

    return $res;
  }

  public function delete(Request $req, Response $res): Response
  {
    $genre = $req->getAttribute('genre');
    $rows = $this->repo->delete((int) $genre[GenreTable::COL_ID]);

    $body = json_encode([
      'message' => 'genre deleted',
      'rows' => $rows
    ]);

    $res->getBody()->write($body);

    return $res;
  }

  public function deleteByGenreId(Request $req, Response $res): Response
  {
    $genre = $req->getAttribute('genre');
    $rows = $this->repo->deleteByGenreId($genre[GenreTable::COL_GENRE_ID]);

    $res->getBody()->write(json_encode([
      'message' => 'genre deleted',
      'rows' => $rows
    ]));

    return $res;
  }

  public function books(Request $req, Response $res): Response
  {
    $genre = $req->getAttribute('genre');
    $relations = $this->bookGenreRepo->getAll();
    $bookIds = array_map(fn($bg) => $bg['book_id'], array_filter($relations, fn($bg) => $bg['genre_id'] == $genre[GenreTable::COL_ID]));

    $books = array_filter($this->bookRepo->getAll(), fn($b) => in_array($b[BookTable::COL_ID], $bookIds));

    $res->getBody()->write(json_encode(array_values($books)));
    return $res;
  }
}
