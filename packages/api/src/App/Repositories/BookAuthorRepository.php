<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Database\Database;
use App\Database\Tables\BookAuthorTable;
use App\Database\Schemas\BookAuthorSchema;
use PDO;

class BookAuthorRepository
{
  public function __construct(private Database $db) {}

  public function attach(int $bookId, int $authorId): string
  {
    $pdo = $this->db->getConnection();
    $stmt = $pdo->prepare(BookAuthorSchema::SQL_INSERT);

    $stmt->bindValue(
      ':' . BookAuthorTable::COL_BOOK_ID,
      $bookId,
      PDO::PARAM_INT
    );

    $stmt->bindValue(
      ':' . BookAuthorTable::COL_AUTHOR_ID,
      $authorId,
      PDO::PARAM_INT
    );

    $stmt->execute();
    return $pdo->lastInsertId();
  }

  public function detach(int $bookId, int $authorId): void
  {
    $pdo = $this->db->getConnection();
    $stmt = $pdo->prepare(BookAuthorSchema::SQL_DELETE);

    $stmt->bindValue(
      ':' . BookAuthorTable::COL_BOOK_ID,
      $bookId,
      PDO::PARAM_INT
    );

    $stmt->bindValue(
      ':' . BookAuthorTable::COL_AUTHOR_ID,
      $authorId,
      PDO::PARAM_INT
    );

    $stmt->execute();
  }

  public function getAll(): array
  {
    $pdo = $this->db->getConnection();
    $stmt = $pdo->query(BookAuthorSchema::SQL_SELECT_ALL);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
