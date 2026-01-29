<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Enums\LogLevel;
use App\Handlers\LoggerManager;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$logger = LoggerManager::make('database');

// $consoleLogger = new ConsoleLogger();
$logger->log('Testando', LogLevel::INFO);

echo "Sucesso! Logado com sucesso." . PHP_EOL;