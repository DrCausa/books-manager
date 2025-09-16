<?php

declare(strict_types=1);

namespace App\Seeders;

use App\Database\Tables\BookTable;
use App\Repositories\BookRepository;

class BookSeeder
{
  private array $seeds = [
    [
      BookTable::COL_TITLE => 'The Great Adventure',
      BookTable::COL_PUBLICATION_DATE => '2020-01-15',
    ],
    [
      BookTable::COL_TITLE => 'Mystery of the Lost City',
      BookTable::COL_PUBLICATION_DATE => '2019-05-23',
    ],
    [
      BookTable::COL_TITLE => 'Secrets of the Universe',
      BookTable::COL_PUBLICATION_DATE => '2021-07-11',
    ],
    [
      BookTable::COL_TITLE => 'Journey to the Unknown',
      BookTable::COL_PUBLICATION_DATE => '2018-09-05',
    ],
    [
      BookTable::COL_TITLE => 'Legends of the Ancient World',
      BookTable::COL_PUBLICATION_DATE => '2022-03-19',
    ],
    [
      BookTable::COL_TITLE => 'The Science of Everything',
      BookTable::COL_PUBLICATION_DATE => '2020-11-30',
    ],
    [
      BookTable::COL_TITLE => 'Tales from the Dark Forest',
      BookTable::COL_PUBLICATION_DATE => '2017-08-22',
    ],
    [
      BookTable::COL_TITLE => 'Chronicles of Time',
      BookTable::COL_PUBLICATION_DATE => '2021-12-01',
    ],
    [
      BookTable::COL_TITLE => 'The Last Kingdom',
      BookTable::COL_PUBLICATION_DATE => '2019-02-14',
    ],
    [
      BookTable::COL_TITLE => 'Whispers of the Wind',
      BookTable::COL_PUBLICATION_DATE => '2022-06-07',
    ],
  ];

  public function __construct(private BookRepository $repo) {}

  public function run(): void
  {
    echo "Seeding book data...\n";

    foreach ($this->seeds as $seed) {
      $this->repo->create($seed);
    }

    echo "Book data seeded successfully.\n";
  }
}
