<?php
namespace Livro\Database;

use Exception;

class ConnectionProduto
{
    private function __construct() {}

    public static function open(string $name)
    {
        $configFile = "config/{$name}.ini";

        if (!file_exists($configFile)) {
            throw new Exception("Arquivo {$name} não encontrado");
        }

        $db = parse_ini_file($configFile);

        $host = $db['DB2_HOST'] ?? 'localhost';
        $user = $db['DB2_USER'] ?? 'root';
        $password = $db['DB2_PASSWORD'] ?? '';
        $database = $db['DB2_NAME'] ?? 'produtos';
        $port = 3306;

        $conn = new \mysqli($host, $user, $password, $database, $port);

        if ($conn->connect_error) {
            throw new Exception("Falha na conexão: " . $conn->connect_error);
        }

        return $conn;
    }
}
