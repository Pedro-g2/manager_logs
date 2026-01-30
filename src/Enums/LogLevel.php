<?php
declare(strict_types=1);

namespace App\Enums;

/**
 * Define o nível de severidade das mensagens de log
 */
enum LogLevel: string
{
    case INFO = 'INFO';
    case WARNING = 'WARNING';
    case ERROR = 'ERROR';
    case DEBUG = 'DEBUG';
}