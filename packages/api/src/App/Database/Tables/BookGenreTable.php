<?php

declare(strict_types=1);

namespace App\Database\Tables;

final class BookGenreTable
{
  public const NAME = 'book_genre';

  public const COL_BOOK_ID = 'book_id';
  public const COL_GENRE_ID = 'genre_id';

  public const ALL = [
    self::COL_BOOK_ID,
    self::COL_GENRE_ID,
  ];
}
