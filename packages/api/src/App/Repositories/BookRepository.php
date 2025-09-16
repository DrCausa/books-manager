<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Database\Database;
use App\Database\Schemas\BookSchema;
use App\Database\Tables\BookTable;
use PDO;
use Ramsey\Uuid\Uuid;

class BookRepository
{
  public function __construct(private Database $db) {}

  public function getAll(): array
  {
    $pdo = $this->db->getConnection();
    $stmt = $pdo->query(BookSchema::SQL_SELECT_ALL);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getById(int $id): array | bool
  {
    $pdo = $this->db->getConnection();
    $stmt = $pdo->prepare(BookSchema::SQL_SELECT_BY_ID);

    $stmt->bindValue(
      (':' . BookTable::COL_ID),
      $id,
      PDO::PARAM_INT
    );

    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function getByBookId(string $bookId): array | bool
  {
    $pdo = $this->db->getConnection();
    $stmt = $pdo->prepare(BookSchema::SQL_SELECT_BY_BOOK_ID);

    $stmt->bindValue(
      ':' . BookTable::COL_BOOK_ID,
      $bookId,
      PDO::PARAM_STR
    );

    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function create(array $data): string
  {
    $pdo = $this->db->getConnection();
    $stmt = $pdo->prepare(BookSchema::SQL_INSERT);

    $stmt->bindValue(
      (':' . BookTable::COL_BOOK_ID),
      Uuid::uuid4()->toString(),
      PDO::PARAM_STR
    );

    $stmt->bindValue(
      (':' . BookTable::COL_TITLE),
      $data[BookTable::COL_TITLE],
      PDO::PARAM_STR
    );

    $stmt->bindValue(
      (':' . BookTable::COL_PUBLICATION_DATE),
      $data[BookTable::COL_PUBLICATION_DATE],
      PDO::PARAM_STR
    );

    $stmt->execute();
    return $pdo->lastInsertId();
  }

  public function update(int $id, array $data): int
  {
    $pdo = $this->db->getConnection();
    $stmt = $pdo->prepare(BookSchema::SQL_UPDATE_BY_ID);

    $stmt->bindValue(
      (':' . BookTable::COL_TITLE),
      $data[BookTable::COL_TITLE],
      PDO::PARAM_STR
    );

    $stmt->bindValue(
      (':' . BookTable::COL_PUBLICATION_DATE),
      $data[BookTable::COL_PUBLICATION_DATE],
      PDO::PARAM_STR
    );

    $stmt->bindValue(
      (':' . BookTable::COL_ID),
      $id,
      PDO::PARAM_INT
    );

    $stmt->execute();
    return $stmt->rowCount();
  }

  public function updateByBookId(string $bookId, array $data): int
  {
    $pdo = $this->db->getConnection();
    $stmt = $pdo->prepare(BookSchema::SQL_UPDATE_BY_BOOK_ID);

    $stmt->bindValue(
      (':' . BookTable::COL_TITLE),
      $data[BookTable::COL_TITLE],
      PDO::PARAM_STR
    );

    $stmt->bindValue(
      (':' . BookTable::COL_PUBLICATION_DATE),
      $data[BookTable::COL_PUBLICATION_DATE],
      PDO::PARAM_STR
    );

    $stmt->bindValue(
      (':' . BookTable::COL_BOOK_ID),
      $bookId,
      PDO::PARAM_STR
    );

    $stmt->execute();
    return $stmt->rowCount();
  }

  public function delete(int $id): int
  {
    $pdo = $this->db->getConnection();
    $stmt = $pdo->prepare(BookSchema::SQL_DELETE_BY_ID);

    $stmt->bindValue(
      (':' . BookTable::COL_ID),
      $id,
      PDO::PARAM_INT
    );

    $stmt->execute();
    return $stmt->rowCount();
  }

  public function deleteByBookId(string $bookId): int
  {
    $pdo = $this->db->getConnection();
    $stmt = $pdo->prepare(BookSchema::SQL_DELETE_BY_BOOK_ID);

    $stmt->bindValue(
      (':' . BookTable::COL_BOOK_ID),
      $bookId,
      PDO::PARAM_STR
    );

    $stmt->execute();
    return $stmt->rowCount();
  }
}
