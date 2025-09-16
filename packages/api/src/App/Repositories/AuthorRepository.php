<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Database\Database;
use App\Database\Schemas\AuthorSchema;
use App\Database\Tables\AuthorTable;
use PDO;
use Ramsey\Uuid\Uuid;

class AuthorRepository
{
  public function __construct(private Database $db) {}

  public function getAll(): array
  {
    $pdo = $this->db->getConnection();
    $stmt = $pdo->query(AuthorSchema::SQL_SELECT_ALL);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getById(int $id): array | bool
  {
    $pdo = $this->db->getConnection();
    $stmt = $pdo->prepare(AuthorSchema::SQL_SELECT_BY_ID);

    $stmt->bindValue(
      (':' . AuthorTable::COL_ID),
      $id,
      PDO::PARAM_INT
    );

    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function getByAuthorId(string $authorId): array | bool
  {
    $pdo = $this->db->getConnection();
    $stmt = $pdo->prepare(AuthorSchema::SQL_SELECT_BY_AUTHOR_ID);

    $stmt->bindValue(
      ':' . AuthorTable::COL_AUTHOR_ID,
      $authorId,
      PDO::PARAM_STR
    );

    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function create(array $data): string
  {
    $pdo = $this->db->getConnection();
    $stmt = $pdo->prepare(AuthorSchema::SQL_INSERT);

    $stmt->bindValue(
      (':' . AuthorTable::COL_AUTHOR_ID),
      Uuid::uuid4()->toString(),
      PDO::PARAM_STR
    );

    $stmt->bindValue(
      (':' . AuthorTable::COL_NAME),
      $data[AuthorTable::COL_NAME],
      PDO::PARAM_STR
    );

    $stmt->execute();
    return $pdo->lastInsertId();
  }

  public function update(int $id, array $data): int
  {
    $pdo = $this->db->getConnection();
    $stmt = $pdo->prepare(AuthorSchema::SQL_UPDATE_BY_ID);

    $stmt->bindValue(
      (':' . AuthorTable::COL_AUTHOR_ID),
      $data[AuthorTable::COL_AUTHOR_ID],
      PDO::PARAM_STR
    );

    $stmt->bindValue(
      (':' . AuthorTable::COL_NAME),
      $data[AuthorTable::COL_NAME],
      PDO::PARAM_STR
    );

    $stmt->bindValue(
      (':' . AuthorTable::COL_ID),
      $id,
      PDO::PARAM_INT
    );

    $stmt->execute();
    return $stmt->rowCount();
  }

  public function updateByAuthorId(string $authorId, array $data): int
  {
    $pdo = $this->db->getConnection();
    $stmt = $pdo->prepare(AuthorSchema::SQL_UPDATE_BY_AUTHOR_ID);

    $stmt->bindValue(
      ':' . AuthorTable::COL_NAME,
      $data[AuthorTable::COL_NAME],
      PDO::PARAM_STR
    );

    $stmt->bindValue(
      ':' . AuthorTable::COL_AUTHOR_ID,
      $authorId,
      PDO::PARAM_STR
    );

    $stmt->execute();
    return $stmt->rowCount();
  }

  public function delete(int $id): int
  {
    $pdo = $this->db->getConnection();
    $stmt = $pdo->prepare(AuthorSchema::SQL_DELETE_BY_ID);

    $stmt->bindValue(
      (':' . AuthorTable::COL_ID),
      $id,
      PDO::PARAM_INT
    );

    $stmt->execute();
    return $stmt->rowCount();
  }

  public function deleteByAuthorId(string $authorId): int
  {
    $pdo = $this->db->getConnection();
    $stmt = $pdo->prepare(AuthorSchema::SQL_DELETE_BY_AUTHOR_ID);

    $stmt->bindValue(
      ':' . AuthorTable::COL_AUTHOR_ID,
      $authorId,
      PDO::PARAM_STR
    );

    $stmt->execute();
    return $stmt->rowCount();
  }
}
