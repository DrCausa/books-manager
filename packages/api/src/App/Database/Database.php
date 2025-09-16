<?php

declare(strict_types=1);

namespace App\Database;

use PDO;

class Database
{
  public function __construct(
    private string $host,
    private string $port,
    private string $name,
    private string $user,
    private string $pass
  ) {}

  public function getConnection(): PDO
  {
    $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->name};charset=utf8mb4";
    $pdo = new PDO($dsn, $this->user, $this->pass, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    return $pdo;
  }
}
