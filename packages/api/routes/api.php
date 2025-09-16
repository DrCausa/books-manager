<?php

declare(strict_types=1);

use Slim\Routing\RouteCollectorProxy;
use App\Controllers\Book;
use App\Database\Tables\BookTable;
use App\Middleware\General\BookLoader;
use App\Middleware\Validation\BookValidator;
use App\Controllers\Author;
use App\Database\Tables\AuthorTable;
use App\Middleware\General\AuthorLoader;
use App\Middleware\Validation\AuthorValidator;
use App\Controllers\Genre;
use App\Database\Tables\GenreTable;
use App\Middleware\General\GenreLoader;
use App\Middleware\Validation\GenreValidator;

return function (RouteCollectorProxy $group) {
  $group->group('/books', function (RouteCollectorProxy $group) {
    $group->get('', [Book::class, 'index']);
    $group->post('', [Book::class, 'create'])
      ->add(BookValidator::class);

    $group->group('/{' . BookTable::COL_ID . ':[0-9]+}', function (RouteCollectorProxy $group) {
      $group->get('', [Book::class, 'show']);
      $group->patch('', [Book::class, 'update']);
      $group->delete('', [Book::class, 'delete']);

      $group->get('/authors', [Book::class, 'authors']);
      $group->get('/genres', [Book::class, 'genres']);
    })->add(BookLoader::class);

    $group->group('/{' . BookTable::COL_BOOK_ID . ':[a-zA-Z0-9_-]+}', function (RouteCollectorProxy $group) {
      $group->get('', [Book::class, 'showByBookId']);
      $group->patch('', [Book::class, 'updateByBookId']);
      $group->delete('', [Book::class, 'deleteByBookId']);

      $group->get('/authors', [Book::class, 'authors']);
      $group->get('/genres', [Book::class, 'genres']);
    })->add(BookLoader::class);
  });

  $group->group('/authors', function (RouteCollectorProxy $group) {
    $group->get('', [Author::class, 'index']);
    $group->post('', [Author::class, 'create'])
      ->add(AuthorValidator::class);

    $group->group('/{' . AuthorTable::COL_ID . ':[0-9]+}', function (RouteCollectorProxy $group) {
      $group->get('', [Author::class, 'show']);
      $group->patch('', [Author::class, 'update']);
      $group->delete('', [Author::class, 'delete']);

      $group->get('/books', [Author::class, 'books']);
    })->add(AuthorLoader::class);

    $group->group('/{' . AuthorTable::COL_AUTHOR_ID . ':[a-zA-Z0-9_-]+}', function (RouteCollectorProxy $group) {
      $group->get('', [Author::class, 'showByAuthorId']);
      $group->patch('', [Author::class, 'updateByAuthorId']);
      $group->delete('', [Author::class, 'deleteByAuthorId']);

      $group->get('/books', [Author::class, 'books']);
    })->add(AuthorLoader::class);
  });

  $group->group('/genres', function (RouteCollectorProxy $group) {
    $group->get('', [Genre::class, 'index']);
    $group->post('', [Genre::class, 'create'])
      ->add(GenreValidator::class);

    $group->group('/{' . GenreTable::COL_ID . ':[0-9]+}', function (RouteCollectorProxy $group) {
      $group->get('', [Genre::class, 'show']);
      $group->patch('', [Genre::class, 'update']);
      $group->delete('', [Genre::class, 'delete']);

      $group->get('/books', [Genre::class, 'books']);
    })->add(GenreLoader::class);

    $group->group('/{' . GenreTable::COL_GENRE_ID . ':[a-zA-Z0-9_-]+}', function (RouteCollectorProxy $group) {
      $group->get('', [Genre::class, 'showByGenreId']);
      $group->patch('', [Genre::class, 'updateByGenreId']);
      $group->delete('', [Genre::class, 'deleteByGenreId']);

      $group->get('/books', [Genre::class, 'books']);
    })->add(GenreLoader::class);
  });
};
