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

        $dsn = 'mysql:host=php-db-1;dbname=project_logs;charset=utf8';

        try{
            self::$instance = new PDO($dsn, 'pedrophp', '1234');
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return self::$instance;

        }catch(Throwable $e)
        {
            throw new Exception('Erro ao se conectar ao banco de dados: ', 0, $e);
        }
        
    }
}