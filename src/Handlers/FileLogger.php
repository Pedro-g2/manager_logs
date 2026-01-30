<?php
declare(strict_types=1);

namespace App\Handlers;

use App\Enums\LogLevel;
use App\Interfaces\LoggerInterface;
use DateTime;
use DateTimeZone;

/**
 * Salva uma mensagem de log em um arquivo
 * Se o nome do arquivo não for informado na instanciação da classe,
 * um nome/caminho de arquivo contendo a data do dia é criado automaticamente e salvo
 * na pasta /logs na raíz do projeto
 */
class FileLogger implements LoggerInterface
{
    private string $filePath;

    public function __construct(?string $filePath=null)
    {
        // se $filePath (nome/caminho do arquivo) não for informado, cria um nome automaticamente
        $name = $filePath ?? "log-" . date('d-m-Y') . ".log";
        $this->filePath = __DIR__."/../../logs/{$name}";
    }

    /**
     * Salva os logs em um arquivo de texto
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
        
        $data = [
            'date' => "Data: {$dateFormated} - ",
            'level' => "Nível: {$level->value} - ",
            'body' => "Mensagem: {$message}".PHP_EOL,
        ];

        // Remove o nome do arquivo do caminho
        $dir = dirname($this->filePath);
        if(!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        // adiciona as mensagens de log no final do aquivo
        file_put_contents($this->filePath, $data, FILE_APPEND | LOCK_EX);
    }
}
