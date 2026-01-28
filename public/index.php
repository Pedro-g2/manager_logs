<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Enums\LogLevel;
use App\Handlers\FileLogger;
use App\Handlers\ConsoleLogger;

// Se o código rodar sem erro, significa que ele achou a Interface!
$fileLogger = new FileLogger();
$fileLogger->log('Testando ConsoleLogger', LogLevel::ERROR);

$consoleLogger = new ConsoleLogger();
$consoleLogger->log('Testando ConsoleLogger', LogLevel::INFO);

echo "Sucesso! O Log foi gravado e mostrado com sucesso." . PHP_EOL;