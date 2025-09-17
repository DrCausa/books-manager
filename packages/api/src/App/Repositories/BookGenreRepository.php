<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Database\Database;
use App\Database\Tables\BookGenreTable;
use App\Database\Schemas\BookGenreSchema;
use PDO;

class BookGenreRepository
{
  public function __construct(private Database $db) {}

  public function attach(int $bookId, int $genreId): string
  {
    $pdo = $this->db->getConnection();
    $stmt = $pdo->prepare(BookGenreSchema::SQL_INSERT);

    $stmt->bindValue(
      ':' . BookGenreTable::COL_BOOK_ID,
      $bookId,
      PDO::PARAM_INT
    );
    $stmt->bindValue(
      ':' . BookGenreTable::COL_GENRE_ID,
      $genreId,
      PDO::PARAM_INT
    );

    $stmt->execute();
    return $pdo->lastInsertId();
  }

  public function detach(int $bookId, int $genreId): void
  {
    $pdo = $this->db->getConnection();
    $stmt = $pdo->prepare(BookGenreSchema::SQL_DELETE);

    $stmt->bindValue(
      ':' . BookGenreTable::COL_BOOK_ID,
      $bookId,
      PDO::PARAM_INT
    );
    $stmt->bindValue(
      ':' . BookGenreTable::COL_GENRE_ID,
      $genreId,
      PDO::PARAM_INT
    );

    $stmt->execute();
  }

  public function getAll(): array
  {
    $pdo = $this->db->getConnection();
    $stmt = $pdo->query(BookGenreSchema::SQL_SELECT_ALL);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
