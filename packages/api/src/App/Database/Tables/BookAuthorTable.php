<?php

declare(strict_types=1);

namespace App\Database\Tables;

final class BookAuthorTable
{
  public const NAME = 'book_author';

  public const COL_BOOK_ID = 'book_id';
  public const COL_AUTHOR_ID = 'author_id';

  public const ALL = [
    self::COL_BOOK_ID,
    self::COL_AUTHOR_ID,
  ];
}
