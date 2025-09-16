<?php

declare(strict_types=1);

namespace App\Seeders;

use App\Database\Tables\AuthorTable;
use App\Repositories\AuthorRepository;

class AuthorSeeder
{
  private array $seeds = [
    [
      AuthorTable::COL_NAME => 'J.K. Rowling'
    ],
    [
      AuthorTable::COL_NAME => 'George R.R. Martin'
    ],
    [
      AuthorTable::COL_NAME => 'Isaac Asimov'
    ],
    [
      AuthorTable::COL_NAME => 'Agatha Christie'
    ],
    [
      AuthorTable::COL_NAME => 'J.R.R. Tolkien'
    ],
    [
      AuthorTable::COL_NAME => 'Stephen King'
    ],
    [
      AuthorTable::COL_NAME => 'Ernest Hemingway'
    ],
    [
      AuthorTable::COL_NAME => 'Mark Twain'
    ],
    [
      AuthorTable::COL_NAME => 'Arthur C. Clarke'
    ],
    [
      AuthorTable::COL_NAME => 'Jane Austen'
    ],
  ];

  public function __construct(private AuthorRepository $repo) {}

  public function run(): void
  {
    echo "Seeding author data...\n";

    foreach ($this->seeds as $seed) {
      $this->repo->create($seed);
    }

    echo "Author data seeded successfully.\n";
  }
}
