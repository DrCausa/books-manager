<?php

declare(strict_types=1);

namespace App\Seeders;

use App\Repositories\BookAuthorRepository;

class BookAuthorSeeder
{
  public function __construct(private BookAuthorRepository $repo) {}

  public function run(array $bookIds, array $authorIds): void
  {
    echo "Seeding book-author relationships...\n";

    foreach ($bookIds as $bookId) {
      $assignedAuthors = (array)array_rand(array_flip($authorIds), rand(1, 2));
      foreach ($assignedAuthors as $authorId) {
        $this->repo->attach($bookId, $authorId);
      }
    }

    echo "Book-author relationships seeded successfully.\n";
  }
}
