<?php
declare(strict_types=1);

namespace App\Connection;

use Exception;
use PDO;
use Throwable;

/**
 * Realiza a conexão com a base de dados para o salvamento das mensagens de log
 * apenas uma vez, ou seja, sempre que necessário se comunicar com a base de 
 * dados, a conexão anteriormente aberta é reutilizada
 * Impede a instanciação. Só é possível obter a conexão através do método
 * getConnection()
 */
class Database
{
    private static ?PDO $instance = null;

    private function __construct()
    {
        throw new Exception('Não permitido');
    }

    /**
     * Realiza a conexão com a base de dados
     *
     * @return PDO 
     * @throws Exception Caso a conexão falhe, lança uma exceção com a mensagem de erro
     */
    public static function getConnection(): PDO 
    {
        // verifica se o atributo $instance (conexão) já foi atribuído,
        // se sim retorna a conexão
        if(isset(self::$instance))
        {
            return self::$instance;
        }

        $driver = $_ENV['DRIVER'];
        $host = $_ENV['HOST'];
        $database = $_ENV['DATABASE'];
        $username = $_ENV['USERNAME'];
        $password = $_ENV['PASSWORD'];

        $dsn = "{$driver}:host={$host};dbname={$database};charset=utf8";

        try {
            self::$instance = new PDO($dsn, $username, $password);
            
            // configura o php para lançar as excessões de forma explícita
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return self::$instance;

        } catch (Throwable $e)
        {
            throw new Exception('Erro ao se conectar ao banco de dados: ', 0, $e);
        }
        
    }
}