<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Enums\LogLevel;
use App\Handlers\LoggerManager;
use Dotenv\Dotenv;

// configurações para adcionar o arquivo de variáveis de ambiente .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// menu 
echo '----------Manager Logs----------'.PHP_EOL;
echo 'Opção de log:'.PHP_EOL;
echo '1 - para mostrar logs no terminal;'.PHP_EOL;
echo '2 - para salvar logs em um arquivo;'.PHP_EOL;
echo '3 - para salvar logs no banco de dados;'.PHP_EOL;

$logOption = readline('Digite uma opção de 1 a 3: ');

try {
    $logger = null;
    switch ($logOption) {
        case '1':
            $logger = LoggerManager::make('console');
            break;
        case '2':
            $logger = LoggerManager::make('file');
            break;
        case '3':
            $logger = LoggerManager::make('database');
            break;
        default:
            throw new InvalidArgumentException('Opção inválida');
    }
    
    // passando a mensagem de log
    $logger->log('Testando - 01', LogLevel::DEBUG);

} catch(Throwable $e) {
    echo 'Erro: ' . $e->getMessage() . PHP_EOL;
}