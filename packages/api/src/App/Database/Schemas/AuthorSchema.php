<?php

declare(strict_types=1);

namespace App\Database\Schemas;

use App\Database\Tables\AuthorTable;

final class AuthorSchema
{
  public const SQL_CREATE = "
    CREATE TABLE " . AuthorTable::NAME . " (
      " . AuthorTable::COL_ID . " INT AUTO_INCREMENT PRIMARY KEY,
      " . AuthorTable::COL_AUTHOR_ID . " VARCHAR(64) NOT NULL UNIQUE,
      " . AuthorTable::COL_NAME . " VARCHAR(255) NOT NULL,
      " . AuthorTable::COL_CREATED_AT . " TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      " . AuthorTable::COL_UPDATED_AT . " TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )
  ";

  public const SQL_DROP = "
    DROP TABLE IF EXISTS " . AuthorTable::NAME . "
  ";

  public const SQL_INSERT = "
    INSERT INTO " . AuthorTable::NAME . " (
      " . AuthorTable::COL_AUTHOR_ID . ",
      " . AuthorTable::COL_NAME . "
    ) VALUES (
      :" . AuthorTable::COL_AUTHOR_ID . ",
      :" . AuthorTable::COL_NAME . "
    )
  ";

  public const SQL_UPDATE_BY_ID = "
    UPDATE " . AuthorTable::NAME . "
    SET
      " . AuthorTable::COL_NAME . " = :" . AuthorTable::COL_NAME . "
    WHERE " . AuthorTable::COL_ID . " = :" . AuthorTable::COL_ID . "
  ";

  public const SQL_UPDATE_BY_AUTHOR_ID = "
    UPDATE " . AuthorTable::NAME . "
    SET
      " . AuthorTable::COL_NAME . " = :" . AuthorTable::COL_NAME . "
    WHERE " . AuthorTable::COL_AUTHOR_ID . " = :" . AuthorTable::COL_AUTHOR_ID . "
  ";

  public const SQL_DELETE_BY_ID = "
    DELETE FROM " . AuthorTable::NAME . "
    WHERE " . AuthorTable::COL_ID . " = :" . AuthorTable::COL_ID . "
  ";

  public const SQL_DELETE_BY_AUTHOR_ID = "
    DELETE FROM " . AuthorTable::NAME . "
    WHERE " . AuthorTable::COL_AUTHOR_ID . " = :" . AuthorTable::COL_AUTHOR_ID . "
  ";

  public const SQL_SELECT_ALL = "
    SELECT
      " . AuthorTable::COL_ID . ",
      " . AuthorTable::COL_AUTHOR_ID . ",
      " . AuthorTable::COL_NAME . ",
      " . AuthorTable::COL_CREATED_AT . ",
      " . AuthorTable::COL_UPDATED_AT . "
    FROM " . AuthorTable::NAME . "
  ";

  public const SQL_SELECT_BY_ID = "
    SELECT
      " . AuthorTable::COL_ID . ",
      " . AuthorTable::COL_AUTHOR_ID . ",
      " . AuthorTable::COL_NAME . ",
      " . AuthorTable::COL_CREATED_AT . ",
      " . AuthorTable::COL_UPDATED_AT . "
    FROM " . AuthorTable::NAME . "
    WHERE " . AuthorTable::COL_ID . " = :" . AuthorTable::COL_ID . "
  ";

  public const SQL_SELECT_BY_AUTHOR_ID = "
    SELECT
      " . AuthorTable::COL_ID . ",
      " . AuthorTable::COL_AUTHOR_ID . ",
      " . AuthorTable::COL_NAME . ",
      " . AuthorTable::COL_CREATED_AT . ",
      " . AuthorTable::COL_UPDATED_AT . "
    FROM " . AuthorTable::NAME . "
    WHERE " . AuthorTable::COL_AUTHOR_ID . " = :" . AuthorTable::COL_AUTHOR_ID . "
  ";
}
