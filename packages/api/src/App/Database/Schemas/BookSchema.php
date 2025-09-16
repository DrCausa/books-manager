<?php

declare(strict_types=1);

namespace App\Database\Schemas;

use App\Database\Tables\BookTable;

final class BookSchema
{
  public const SQL_CREATE = "
    CREATE TABLE " . BookTable::NAME . " (
      " . BookTable::COL_ID . " INT AUTO_INCREMENT PRIMARY KEY,
      " . BookTable::COL_BOOK_ID . " VARCHAR(64) NOT NULL UNIQUE,
      " . BookTable::COL_TITLE . " VARCHAR(255) NOT NULL,
      " . BookTable::COL_PUBLICATION_DATE . " DATE NOT NULL,
      " . BookTable::COL_CREATED_AT . " TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      " . BookTable::COL_UPDATED_AT . " TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )
  ";

  public const SQL_DROP = "
    DROP TABLE IF EXISTS " . BookTable::NAME . "
  ";

  public const SQL_INSERT = "
    INSERT INTO " . BookTable::NAME . " (
      " . BookTable::COL_BOOK_ID . ",
      " . BookTable::COL_TITLE . ",
      " . BookTable::COL_PUBLICATION_DATE . "
    ) VALUES (
      :" . BookTable::COL_BOOK_ID . ",
      :" . BookTable::COL_TITLE . ",
      :" . BookTable::COL_PUBLICATION_DATE . "
    )
  ";

  public const SQL_UPDATE_BY_ID = "
    UPDATE " . BookTable::NAME . "
    SET
      " . BookTable::COL_TITLE . " = :" . BookTable::COL_TITLE . ",
      " . BookTable::COL_PUBLICATION_DATE . " = :" . BookTable::COL_PUBLICATION_DATE . "
    WHERE " . BookTable::COL_ID . " = :" . BookTable::COL_ID . "
  ";

  public const SQL_UPDATE_BY_BOOK_ID = "
    UPDATE " . BookTable::NAME . "
    SET
      " . BookTable::COL_TITLE . " = :" . BookTable::COL_TITLE . ",
      " . BookTable::COL_PUBLICATION_DATE . " = :" . BookTable::COL_PUBLICATION_DATE . "
    WHERE " . BookTable::COL_BOOK_ID . " = :" . BookTable::COL_BOOK_ID . "
  ";

  public const SQL_DELETE_BY_ID = "
    DELETE FROM " . BookTable::NAME . "
    WHERE " . BookTable::COL_ID . " = :" . BookTable::COL_ID . "
  ";

  public const SQL_DELETE_BY_BOOK_ID = "
    DELETE FROM " . BookTable::NAME . "
    WHERE " . BookTable::COL_BOOK_ID . " = :" . BookTable::COL_BOOK_ID . "
  ";

  public const SQL_SELECT_ALL = "
    SELECT
      " . BookTable::COL_ID . ",
      " . BookTable::COL_BOOK_ID . ",
      " . BookTable::COL_TITLE . ",
      " . BookTable::COL_PUBLICATION_DATE . ",
      " . BookTable::COL_CREATED_AT . ",
      " . BookTable::COL_UPDATED_AT . "
    FROM " . BookTable::NAME . "
  ";

  public const SQL_SELECT_BY_ID = "
    SELECT
      " . BookTable::COL_ID . ",
      " . BookTable::COL_BOOK_ID . ",
      " . BookTable::COL_TITLE . ",
      " . BookTable::COL_PUBLICATION_DATE . ",
      " . BookTable::COL_CREATED_AT . ",
      " . BookTable::COL_UPDATED_AT . "
    FROM " . BookTable::NAME . "
    WHERE " . BookTable::COL_ID . " = :" . BookTable::COL_ID . "
  ";

  public const SQL_SELECT_BY_BOOK_ID = "
    SELECT
      " . BookTable::COL_ID . ",
      " . BookTable::COL_BOOK_ID . ",
      " . BookTable::COL_TITLE . ",
      " . BookTable::COL_PUBLICATION_DATE . ",
      " . BookTable::COL_CREATED_AT . ",
      " . BookTable::COL_UPDATED_AT . "
    FROM " . BookTable::NAME . "
    WHERE " . BookTable::COL_BOOK_ID . " = :" . BookTable::COL_BOOK_ID . "
  ";
}
