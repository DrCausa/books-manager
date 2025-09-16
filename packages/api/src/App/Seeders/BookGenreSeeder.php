<?php

declare(strict_types=1);

namespace App\Seeders;

use App\Repositories\BookGenreRepository;

class BookGenreSeeder
{
  public function __construct(private BookGenreRepository $repo) {}

  public function run(array $bookIds, array $genreIds): void
  {
    echo "Seeding book-genre relationships...\n";

    foreach ($bookIds as $bookId) {
      $assignedGenres = (array)array_rand(array_flip($genreIds), rand(1, 3));
      foreach ($assignedGenres as $genreId) {
        $this->repo->attach($bookId, $genreId);
      }
    }

    echo "Book-genre relationships seeded successfully.\n";
  }
}
