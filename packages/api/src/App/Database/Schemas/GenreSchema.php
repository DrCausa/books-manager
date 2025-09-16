<?php

declare(strict_types=1);

namespace App\Database\Schemas;

use App\Database\Tables\GenreTable;

final class GenreSchema
{
  public const SQL_CREATE = "
    CREATE TABLE " . GenreTable::NAME . " (
      " . GenreTable::COL_ID . " INT AUTO_INCREMENT PRIMARY KEY,
      " . GenreTable::COL_GENRE_ID . " VARCHAR(64) NOT NULL UNIQUE,
      " . GenreTable::COL_NAME . " VARCHAR(128) NOT NULL,
      " . GenreTable::COL_COLOR_HEX . " CHAR(7) NOT NULL,
      " . GenreTable::COL_CREATED_AT . " TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      " . GenreTable::COL_UPDATED_AT . " TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )
  ";

  public const SQL_DROP = "
    DROP TABLE IF EXISTS " . GenreTable::NAME . "
  ";

  public const SQL_INSERT = "
    INSERT INTO " . GenreTable::NAME . " (
      " . GenreTable::COL_GENRE_ID . ",
      " . GenreTable::COL_NAME . ",
      " . GenreTable::COL_COLOR_HEX . "
    ) VALUES (
      :" . GenreTable::COL_GENRE_ID . ",
      :" . GenreTable::COL_NAME . ",
      :" . GenreTable::COL_COLOR_HEX . "
    )
  ";

  public const SQL_UPDATE_BY_ID = "
    UPDATE " . GenreTable::NAME . "
    SET
      " . GenreTable::COL_NAME . " = :" . GenreTable::COL_NAME . ",
      " . GenreTable::COL_COLOR_HEX . " = :" . GenreTable::COL_COLOR_HEX . "
    WHERE " . GenreTable::COL_ID . " = :" . GenreTable::COL_ID . "
  ";

  public const SQL_UPDATE_BY_GENRE_ID = "
    UPDATE " . GenreTable::NAME . "
    SET
      " . GenreTable::COL_NAME . " = :" . GenreTable::COL_NAME . ",
      " . GenreTable::COL_COLOR_HEX . " = :" . GenreTable::COL_COLOR_HEX . "
    WHERE " . GenreTable::COL_GENRE_ID . " = :" . GenreTable::COL_GENRE_ID . "
  ";

  public const SQL_DELETE_BY_ID = "
    DELETE FROM " . GenreTable::NAME . "
    WHERE " . GenreTable::COL_ID . " = :" . GenreTable::COL_ID . "
  ";

  public const SQL_DELETE_BY_GENRE_ID = "
    DELETE FROM " . GenreTable::NAME . "
    WHERE " . GenreTable::COL_GENRE_ID . " = :" . GenreTable::COL_GENRE_ID . "
  ";

  public const SQL_SELECT_ALL = "
    SELECT
      " . GenreTable::COL_ID . ",
      " . GenreTable::COL_GENRE_ID . ",
      " . GenreTable::COL_NAME . ",
      " . GenreTable::COL_COLOR_HEX . ",
      " . GenreTable::COL_CREATED_AT . ",
      " . GenreTable::COL_UPDATED_AT . "
    FROM " . GenreTable::NAME . "
  ";

  public const SQL_SELECT_BY_ID = "
    SELECT
      " . GenreTable::COL_ID . ",
      " . GenreTable::COL_GENRE_ID . ",
      " . GenreTable::COL_NAME . ",
      " . GenreTable::COL_COLOR_HEX . ",
      " . GenreTable::COL_CREATED_AT . ",
      " . GenreTable::COL_UPDATED_AT . "
    FROM " . GenreTable::NAME . "
    WHERE " . GenreTable::COL_ID . " = :" . GenreTable::COL_ID . "
  ";

  public const SQL_SELECT_BY_GENRE_ID = "
    SELECT
      " . GenreTable::COL_ID . ",
      " . GenreTable::COL_GENRE_ID . ",
      " . GenreTable::COL_NAME . ",
      " . GenreTable::COL_COLOR_HEX . ",
      " . GenreTable::COL_CREATED_AT . ",
      " . GenreTable::COL_UPDATED_AT . "
    FROM " . GenreTable::NAME . "
    WHERE " . GenreTable::COL_GENRE_ID . " = :" . GenreTable::COL_GENRE_ID . "
  ";
}
