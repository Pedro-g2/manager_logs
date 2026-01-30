<?php
declare(strict_types=1);

namespace Tests;

use App\Handlers\ConsoleLogger;
use App\Handlers\FileLogger;
use App\Handlers\LoggerManager;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * Realiza testes unitários para a classe LoggerManager
 * Testa a instanciação correta do Loggers e verifica
 * opções de instanciação inválidas
 */
class LoggerManagerTest extends TestCase
{
    /**
     * Verifica se a classe ConsoleLogger é instanciada corretamente
     * quando passada a opção 'console'
     *
     * @return void
     */
    public function testCreateConsoleLogger(): void
    {
        $logger = LoggerManager::make('console');
        $this->assertInstanceOf(ConsoleLogger::class, $logger);
    }

    /**
     * Verifica se a classe FileLogger é instanciada corretamente
     * quando passada a opção 'file'
     *
     * @return void
     */
    public function testCreateFileLogger(): void
    {
        $logger = LoggerManager::make('file');
        $this->assertInstanceOf(FileLogger::class, $logger);
    }

    /**
     * Verifica se o sistema lança corretamente uma exceção
     * se for passada uma opção inválida para o tipo de Logger
     *
     * @return void
     */
    public function testForInvalidTypes(): void
    {
        $this->expectException(InvalidArgumentException::class);
        LoggerManager::make('test');
    }
}