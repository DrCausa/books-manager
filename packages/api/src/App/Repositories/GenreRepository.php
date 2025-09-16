<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Database\Database;
use App\Database\Schemas\GenreSchema;
use App\Database\Tables\GenreTable;
use PDO;
use Ramsey\Uuid\Uuid;

class GenreRepository
{
  public function __construct(private Database $db) {}

  public function getAll(): array
  {
    $pdo = $this->db->getConnection();
    $stmt = $pdo->query(GenreSchema::SQL_SELECT_ALL);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getById(int $id): array | bool
  {
    $pdo = $this->db->getConnection();
    $stmt = $pdo->prepare(GenreSchema::SQL_SELECT_BY_ID);

    $stmt->bindValue(
      (':' . GenreTable::COL_ID),
      $id,
      PDO::PARAM_INT
    );

    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function getByGenreId(string $genreId): array | bool
  {
    $pdo = $this->db->getConnection();
    $stmt = $pdo->prepare(GenreSchema::SQL_SELECT_BY_GENRE_ID);
    $stmt->bindValue(':' . GenreTable::COL_GENRE_ID, $genreId, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function create(array $data): string
  {
    $pdo = $this->db->getConnection();
    $stmt = $pdo->prepare(GenreSchema::SQL_INSERT);

    $stmt->bindValue(
      (':' . GenreTable::COL_GENRE_ID),
      Uuid::uuid4()->toString(),
      PDO::PARAM_STR
    );

    $stmt->bindValue(
      (':' . GenreTable::COL_NAME),
      $data[GenreTable::COL_NAME],
      PDO::PARAM_STR
    );

    $stmt->bindValue(
      (':' . GenreTable::COL_COLOR_HEX),
      $data[GenreTable::COL_COLOR_HEX],
      PDO::PARAM_STR
    );

    $stmt->execute();
    return $pdo->lastInsertId();
  }

  public function update(int $id, array $data): int
  {
    $pdo = $this->db->getConnection();
    $stmt = $pdo->prepare(GenreSchema::SQL_UPDATE_BY_ID);

    $stmt->bindValue(
      (':' . GenreTable::COL_GENRE_ID),
      $data[GenreTable::COL_GENRE_ID],
      PDO::PARAM_STR
    );

    $stmt->bindValue(
      (':' . GenreTable::COL_NAME),
      $data[GenreTable::COL_NAME],
      PDO::PARAM_STR
    );

    $stmt->bindValue(
      (':' . GenreTable::COL_COLOR_HEX),
      $data[GenreTable::COL_COLOR_HEX],
      PDO::PARAM_STR
    );

    $stmt->bindValue(
      (':' . GenreTable::COL_ID),
      $id,
      PDO::PARAM_INT
    );

    $stmt->execute();
    return $stmt->rowCount();
  }

  public function updateByGenreId(string $genreId, array $data): int
  {
    $pdo = $this->db->getConnection();
    $stmt = $pdo->prepare(GenreSchema::SQL_UPDATE_BY_GENRE_ID);

    $stmt->bindValue(
      (':' . GenreTable::COL_NAME),
      $data[GenreTable::COL_NAME],
      PDO::PARAM_STR
    );

    $stmt->bindValue(
      (':' . GenreTable::COL_COLOR_HEX),
      $data[GenreTable::COL_COLOR_HEX],
      PDO::PARAM_STR
    );

    $stmt->bindValue(
      (':' . GenreTable::COL_GENRE_ID),
      $genreId,
      PDO::PARAM_STR
    );

    $stmt->execute();
    return $stmt->rowCount();
  }

  public function delete(int $id): int
  {
    $pdo = $this->db->getConnection();
    $stmt = $pdo->prepare(GenreSchema::SQL_DELETE_BY_ID);

    $stmt->bindValue(
      (':' . GenreTable::COL_ID),
      $id,
      PDO::PARAM_INT
    );

    $stmt->execute();
    return $stmt->rowCount();
  }

  public function deleteByGenreId(string $genreId): int
  {
    $pdo = $this->db->getConnection();
    $stmt = $pdo->prepare(GenreSchema::SQL_DELETE_BY_GENRE_ID);

    $stmt->bindValue(
      (':' . GenreTable::COL_GENRE_ID),
      $genreId,
      PDO::PARAM_STR
    );

    $stmt->execute();
    return $stmt->rowCount();
  }
}
