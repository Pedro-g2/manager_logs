<?php
declare(strict_types=1);

namespace App\Handlers;

use App\Connection\Database;
use App\Enums\LogLevel;
use App\Interfaces\LoggerInterface;
use PDO;
use Throwable;

class DatabaseLogger implements LoggerInterface
{
    public PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function log(string $message, LogLevel $level=LogLevel::INFO)
    {
        try{
            $connection = $this->conn;

            $prepare = $connection->prepare('insert into logs(level, message) values(:level, :message)');
            $countLines = $prepare->execute([
                'level' => $level->value,
                'message' => $message,
            ]);

        } catch(Throwable $e) {
            error_log("Erro no DatabaseLogger: {$e->getMessage()}");
        }
    }
}