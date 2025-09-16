<?php

declare(strict_types=1);

namespace App\Seeders;

use App\Database\Tables\AuthorTable;
use App\Database\Tables\BookTable;
use App\Database\Tables\GenreTable;
use App\Repositories\BookRepository;
use App\Repositories\AuthorRepository;
use App\Repositories\GenreRepository;
use App\Repositories\BookAuthorRepository;
use App\Repositories\BookGenreRepository;

class DatabaseSeeder
{
  public function __construct(
    private BookRepository $bookRepo,
    private AuthorRepository $authorRepo,
    private GenreRepository $genreRepo,
    private BookAuthorRepository $bookAuthorRepo,
    private BookGenreRepository $bookGenreRepo,
    private BookSeeder $bookSeeder,
    private AuthorSeeder $authorSeeder,
    private GenreSeeder $genreSeeder,
    private BookAuthorSeeder $bookAuthorSeeder,
    private BookGenreSeeder $bookGenreSeeder
  ) {}

  public function run(): void
  {
    $this->bookSeeder->run();
    $this->authorSeeder->run();
    $this->genreSeeder->run();

    $books = $this->bookRepo->getAll();
    $bookIds = array_map(fn($book) => $book[BookTable::COL_ID], $books);

    $authors = $this->authorRepo->getAll();
    $authorIds = array_map(fn($author) => $author[AuthorTable::COL_ID], $authors);

    $genres = $this->genreRepo->getAll();
    $genreIds = array_map(fn($genre) => $genre[GenreTable::COL_ID], $genres);

    $this->bookAuthorSeeder->run($bookIds, $authorIds);
    $this->bookGenreSeeder->run($bookIds, $genreIds);

    echo "All seeders executed successfully.\n";
  }
}
