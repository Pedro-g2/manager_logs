<?php
declare(strict_types=1);

namespace App\Connection;

use Exception;
use PDO;
use Throwable;

class Database
{
    private static ?PDO $instance = null;

    private function __construct()
    {
        throw new \Exception('Não permitido');
    }

    public static function getConnection(): PDO 
    {
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

        try{
            self::$instance = new PDO($dsn, $username, $password);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return self::$instance;

        }catch(Throwable $e)
        {
            throw new Exception('Erro ao se conectar ao banco de dados: ', 0, $e);
        }
        
    }
}