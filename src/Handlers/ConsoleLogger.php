<?php
declare(strict_types=1);

namespace App\Handlers;

use App\Enums\LogLevel;
use App\Interfaces\LoggerInterface;
use DateTime;
use DateTimeZone;

/**
 * Exibe a mensagem de log no terminal
 */
class ConsoleLogger implements LoggerInterface
{
    /**
     * Esta função recebe uma mensagem de log e formata uma saída adicionando data e nível de severidade
     *
     * @param string $message A mensagem de log
     * @param LogLevel $level O nível de severidade da mensagem
     * @return void
     */
    public function log(string $message, LogLevel $level=LogLevel::INFO): void
    {
        // pega a data/hora atual no time zone de São Paulo
        $date = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
        $dateFormated = $date->format('d-m-Y H:i:s');
        
        echo "Data: {$dateFormated} - Nível: {$level->value} - Mensagem: {$message}".PHP_EOL;
    }
}
