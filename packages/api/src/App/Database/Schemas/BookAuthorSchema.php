<?php

declare(strict_types=1);

namespace App\Database\Schemas;

use App\Database\Tables\BookAuthorTable;

final class BookAuthorSchema
{
  public const SQL_CREATE = "
    CREATE TABLE " . BookAuthorTable::NAME . " (
      " . BookAuthorTable::COL_BOOK_ID . " INT NOT NULL,
      " . BookAuthorTable::COL_AUTHOR_ID . " INT NOT NULL,
      PRIMARY KEY (" . BookAuthorTable::COL_BOOK_ID . ", " . BookAuthorTable::COL_AUTHOR_ID . "),
      FOREIGN KEY (" . BookAuthorTable::COL_BOOK_ID . ") REFERENCES book(id) ON DELETE CASCADE,
      FOREIGN KEY (" . BookAuthorTable::COL_AUTHOR_ID . ") REFERENCES author(id) ON DELETE CASCADE
    )
  ";

  public const SQL_DROP = "
    DROP TABLE IF EXISTS " . BookAuthorTable::NAME . "
  ";

  public const SQL_INSERT = "
    INSERT INTO " . BookAuthorTable::NAME . " (
      " . BookAuthorTable::COL_BOOK_ID . ",
      " . BookAuthorTable::COL_AUTHOR_ID . "
    ) VALUES (
      :" . BookAuthorTable::COL_BOOK_ID . ",
      :" . BookAuthorTable::COL_AUTHOR_ID . "
    )
  ";

  public const SQL_DELETE = "
    DELETE FROM " . BookAuthorTable::NAME . "
    WHERE " . BookAuthorTable::COL_BOOK_ID . " = :" . BookAuthorTable::COL_BOOK_ID . "
      AND " . BookAuthorTable::COL_AUTHOR_ID . " = :" . BookAuthorTable::COL_AUTHOR_ID . "
  ";

  public const SQL_SELECT_ALL = "
    SELECT
      " . BookAuthorTable::COL_BOOK_ID . ",
      " . BookAuthorTable::COL_AUTHOR_ID . "
    FROM " . BookAuthorTable::NAME . "
  ";
}
