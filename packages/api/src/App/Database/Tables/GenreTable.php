<?php

declare(strict_types=1);

namespace App\Database\Tables;

final class GenreTable
{
  public const NAME = 'genre';

  public const COL_ID = 'id';
  public const COL_GENRE_ID = 'genre_id';
  public const COL_NAME = 'name';
  public const COL_COLOR_HEX = 'color_hex';
  public const COL_CREATED_AT = 'created_at';
  public const COL_UPDATED_AT = 'updated_at';

  public const ALL = [
    self::COL_ID,
    self::COL_GENRE_ID,
    self::COL_NAME,
    self::COL_COLOR_HEX,
    self::COL_CREATED_AT,
    self::COL_UPDATED_AT,
  ];
}
