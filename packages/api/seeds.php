<?php

declare(strict_types=1);

use DI\ContainerBuilder;

define('APP_ROOT', __DIR__);

require APP_ROOT . '/vendor/autoload.php';

Dotenv\Dotenv::createImmutable(APP_ROOT)->load();

$builder = new ContainerBuilder;
$container = $builder->addDefinitions(APP_ROOT . '/config/definitions.php')->build();

$seederName = $argv[1] ?? null;

if (!$seederName) {
  echo "Usage: php seeds.php <SeederName>\n";
  echo "Example: php seeds.php BookSeeder\n";
  exit(1);
}

$seederClass = 'App\\Seeders\\' . $seederName;

if (!class_exists($seederClass)) {
  echo "Error: Seeder class '{$seederClass}' does not exist.\n";
  exit(1);
}

$seeder = $container->get($seederClass);
$seeder->run();

echo "Seeder '{$seederName}' executed successfully.\n";
