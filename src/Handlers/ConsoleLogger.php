<?php
declare(strict_types=1);

namespace App\Handlers;

use App\Enums\LogLevel;
use App\Interfaces\LoggerInterface;
use DateTimeZone;

class ConsoleLogger implements LoggerInterface
{
    public function log(string $message, LogLevel $level=LogLevel::INFO): void
    {
        $date = new \DateTime('now', new DateTimeZone('America/Sao_Paulo'));
        $dateFormated = $date->format('d-m-Y H:i:s');
        
        echo "Data: {$dateFormated} - Nível: {$level->value} - Mensagem: {$message}".PHP_EOL;
    }
}
