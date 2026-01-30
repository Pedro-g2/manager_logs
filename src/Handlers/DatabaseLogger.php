<?php
declare(strict_types=1);

namespace App\Handlers;

use App\Connection\Database;
use App\Enums\LogLevel;
use App\Interfaces\LoggerInterface;
use PDO;
use Throwable;

/**
 * Faz uma conexão com o banco de dados e persiste as mensagens de log
 * Esta classe recebe uma injeção de depência via construtor: a conexão com o banco de dados
 */
class DatabaseLogger implements LoggerInterface
{
    public PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    /**
     * Salva uma mensagem de log no banco de dados
     *
     * @param string $message A mensage de log a ser persistida no banco de dados
     * @param LogLevel $level O nível de atenção que a mensagem exige ('INFO', 'WARNING', 'ERROR', 'DEBUG')
     * @return void
     * @throws Throwable $e A exceção ser lançada no log do servidor HTTP ou exibida no terminal conforme configuração (php.ini)
     */
    public function log(string $message, LogLevel $level=LogLevel::INFO): void
    {
        try{
            $connection = $this->conn;

            $prepare = $connection->prepare('insert into logs(level, message) values(:level, :message)');
            $prepare->execute([
                'level' => $level->value,
                'message' => $message,
            ]);

        } catch(Throwable $e) {
            error_log("Erro no DatabaseLogger: {$e->getMessage()}");
        }
    }
}