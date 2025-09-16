<?php

use App\Database\Database;

return [
  Database::class => function () {
    $host = $_ENV['DB_HOST'] ?? '127.0.0.1';
    $port = $_ENV['DB_PORT'] ?? '3306';
    $name = $_ENV['DB_NAME'] ?? 'books_manager_db';
    $user = $_ENV['DB_USER'] ?? 'root';
    $pass = $_ENV['DB_PASS'] ?? '';

    return new Database(
      host: $host,
      port: $port,
      name: $name,
      user: $user,
      pass: $pass
    );
  }
];
