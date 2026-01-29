<?php

namespace App\Interfaces;

use App\Enums\LogLevel;

interface LoggerInterface
{
    public function log(string $message, LogLevel $level=LogLevel::INFO);
}