<?php

declare(strict_types=1);

namespace App\Database\Tables;

final class BookTable
{
  public const NAME = 'book';

  public const COL_ID = 'id';
  public const COL_BOOK_ID = 'book_id';
  public const COL_TITLE = 'title';
  public const COL_PUBLICATION_DATE = 'publication_date';
  public const COL_CREATED_AT = 'created_at';
  public const COL_UPDATED_AT = 'updated_at';

  public const ALL = [
    self::COL_ID,
    self::COL_BOOK_ID,
    self::COL_TITLE,
    self::COL_PUBLICATION_DATE,
    self::COL_CREATED_AT,
    self::COL_UPDATED_AT,
  ];
}
