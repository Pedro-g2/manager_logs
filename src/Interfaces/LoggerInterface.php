<?php

namespace App\Interfaces;

use App\Enums\LogLevel;

/**
 * Possibilita que a classe LoggerManager retorne o tipo de log 
 * que o usuário definir sem ficar estritamente acoplado a um tipo
 * de log específico (file, database ou console)
 */
interface LoggerInterface
{
    /**
     * Define um padrão de recebimento de mensagens de log
     *
     * @param string $message A mensagem de log
     * @param [type] $level O nível de severidade do log
     * @return void
     */
    public function log(string $message, LogLevel $level=LogLevel::INFO): void;
}