<?php
declare(strict_types=1);

namespace Tests;

use App\Handlers\ConsoleLogger;
use App\Handlers\FileLogger;
use App\Handlers\LoggerManager;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class LoggerManagerTest extends TestCase
{
    public function testCreateConsoleLogger()
    {
        $logger = LoggerManager::make('console');
        $this->assertInstanceOf(ConsoleLogger::class, $logger);
    }

    public function testCreateFileLogger()
    {
        $logger = LoggerManager::make('file');
        $this->assertInstanceOf(FileLogger::class, $logger);
    }

    public function testForInvalidTypes()
    {
        $this->expectException(InvalidArgumentException::class);
        LoggerManager::make('test');
    }
}