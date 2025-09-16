<?php

declare(strict_types=1);

namespace App\Seeders;

use App\Database\Tables\GenreTable;
use App\Repositories\GenreRepository;

class GenreSeeder
{
  private array $seeds = [
    [
      GenreTable::COL_NAME => 'Fantasy',
      GenreTable::COL_COLOR_HEX => '#8e44ad'
    ],
    [
      GenreTable::COL_NAME => 'Science Fiction',
      GenreTable::COL_COLOR_HEX => '#3498db'
    ],
    [
      GenreTable::COL_NAME => 'Mystery',
      GenreTable::COL_COLOR_HEX => '#2ecc71'
    ],
    [
      GenreTable::COL_NAME => 'Thriller',
      GenreTable::COL_COLOR_HEX => '#e74c3c'
    ],
    [
      GenreTable::COL_NAME => 'Romance',
      GenreTable::COL_COLOR_HEX => '#f1c40f'
    ],
    [
      GenreTable::COL_NAME => 'Historical',
      GenreTable::COL_COLOR_HEX => '#d35400'
    ],
    [
      GenreTable::COL_NAME => 'Horror',
      GenreTable::COL_COLOR_HEX => '#7f8c8d'
    ],
    [
      GenreTable::COL_NAME => 'Biography',
      GenreTable::COL_COLOR_HEX => '#1abc9c'
    ],
    [
      GenreTable::COL_NAME => 'Poetry',
      GenreTable::COL_COLOR_HEX => '#c0392b'
    ],
    [
      GenreTable::COL_NAME => 'Adventure',
      GenreTable::COL_COLOR_HEX => '#16a085'
    ],
  ];

  public function __construct(private GenreRepository $repo) {}

  public function run(): void
  {
    echo "Seeding genre data...\n";

    foreach ($this->seeds as $seed) {
      $this->repo->create($seed);
    }

    echo "Genre data seeded successfully.\n";
  }
}
