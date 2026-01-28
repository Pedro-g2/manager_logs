<?php
declare(strict_types=1);

namespace App\Handlers;

use App\Enums\LogLevel;
use App\Interfaces\LoggerInterface;
use DateTimeZone;

class FileLogger implements LoggerInterface
{
    private string $filePath;

    public function __construct(?string $filePath=null)
    {
        $name = $filePath ?? "log-" . date('d-m-Y') . ".log";
        $this->filePath = __DIR__."/../../logs/{$name}";
    }

    public function log(string $message, LogLevel $level=LogLevel::INFO): void
    {
        $date = new \DateTime('now', new DateTimeZone('America/Sao_Paulo'));
        $dateFormated = $date->format('d-m-Y H:i:s');
        
        $data = [
            'date' => "Data: {$dateFormated} - ",
            'level' => "Nível: {$level->value} - ",
            'body' => "Mensagem: {$message}".PHP_EOL,
        ];

        $dir = dirname($this->filePath);
        if(!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        file_put_contents($this->filePath, $data, FILE_APPEND | LOCK_EX);
    }
}
