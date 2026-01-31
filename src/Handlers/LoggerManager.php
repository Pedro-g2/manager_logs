<?php
declare(strict_types=1);

namespace App\Handlers;

use App\Connection\Database;
use App\Interfaces\LoggerInterface;
use App\Handlers\ConsoleLogger;
use App\Handlers\DatabaseLogger;
use App\Handlers\FileLogger;

/**
 * Gerencia a criação de diferentes tipos de loggers.
 * Esta classe implementa o padrão Static Factory para centralizar
 * a lógica de instanciação dos loggers do sistema.
 */
class LoggerManager
{
    /**
     * Cria e retorna uma instância de logger baseada no tipo fornecido.
     *
     * @param string $type O tipo de logger ('console', 'file', 'database').
     * @return LoggerInterface Uma instância que segue o contrato de log.
     * @throws InvalidArgumentException Caso o tipo fornecido não seja suportado.
     */
    public static function make(string $type): LoggerInterface
    {
        switch ($type) {
            case 'console':
                return new ConsoleLogger();
            case 'file':
                return new FileLogger();
            case 'database':
                return new DatabaseLogger(Database::getConnection());
            default:
                throw new \InvalidArgumentException("Tipo de log [$type] não suportado.");
        }

        // return match($type) {
        //     'console'  => new ConsoleLogger(),
        //     'file'     => new FileLogger('logs.txt'), // Lembre do parâmetro!
        //     'database' => new DatabaseLogger(Database::getConnection()),
        //     default    => throw new \InvalidArgumentException("Tipo de log desconhecido: $type"),
        // };
    }
}
