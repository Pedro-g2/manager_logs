<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Enums\LogLevel;
use App\Handlers\LoggerManager;

$logger = LoggerManager::make('database');

// $consoleLogger = new ConsoleLogger();
$logger->log('Testando', LogLevel::INFO);

echo "Sucesso! Logado com sucesso." . PHP_EOL;