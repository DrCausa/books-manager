<?php

declare(strict_types=1);

namespace App\Database\Schemas;

use App\Database\Tables\BookGenreTable;

final class BookGenreSchema
{
  public const SQL_CREATE = "
    CREATE TABLE " . BookGenreTable::NAME . " (
      " . BookGenreTable::COL_BOOK_ID . " INT NOT NULL,
      " . BookGenreTable::COL_GENRE_ID . " INT NOT NULL,
      PRIMARY KEY (" . BookGenreTable::COL_BOOK_ID . ", " . BookGenreTable::COL_GENRE_ID . "),
      FOREIGN KEY (" . BookGenreTable::COL_BOOK_ID . ") REFERENCES book(id) ON DELETE CASCADE,
      FOREIGN KEY (" . BookGenreTable::COL_GENRE_ID . ") REFERENCES genre(id) ON DELETE CASCADE
    )
  ";

  public const SQL_DROP = "
    DROP TABLE IF EXISTS " . BookGenreTable::NAME . "
  ";

  public const SQL_INSERT = "
    INSERT INTO " . BookGenreTable::NAME . " (
      " . BookGenreTable::COL_BOOK_ID . ",
      " . BookGenreTable::COL_GENRE_ID . "
    ) VALUES (
      :" . BookGenreTable::COL_BOOK_ID . ",
      :" . BookGenreTable::COL_GENRE_ID . "
    )
  ";

  public const SQL_DELETE = "
    DELETE FROM " . BookGenreTable::NAME . "
    WHERE " . BookGenreTable::COL_BOOK_ID . " = :" . BookGenreTable::COL_BOOK_ID . "
      AND " . BookGenreTable::COL_GENRE_ID . " = :" . BookGenreTable::COL_GENRE_ID . "
  ";

  public const SQL_SELECT_ALL = "
    SELECT
      " . BookGenreTable::COL_BOOK_ID . ",
      " . BookGenreTable::COL_GENRE_ID . "
    FROM " . BookGenreTable::NAME . "
  ";
}
