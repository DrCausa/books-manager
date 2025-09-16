<?php

declare(strict_types=1);

namespace App\Database\Tables;

final class AuthorTable
{
  public const NAME = 'author';

  public const COL_ID = 'id';
  public const COL_AUTHOR_ID = 'author_id';
  public const COL_NAME = 'name';
  public const COL_CREATED_AT = 'created_at';
  public const COL_UPDATED_AT = 'updated_at';

  public const ALL = [
    self::COL_ID,
    self::COL_AUTHOR_ID,
    self::COL_NAME,
    self::COL_CREATED_AT,
    self::COL_UPDATED_AT,
  ];
}
