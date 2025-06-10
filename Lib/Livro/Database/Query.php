<?php
namespace Livro\Database;

class Query{

    protected static $conn;
    
      public static function setConnection()
    {
        if (empty(self::$conn)) {
            $ini = parse_ini_file('App/Config/livro.ini');
            $host = $ini['DB1_HOST'];
            $name = $ini['DB1_NAME'];
            $user = $ini['DB1_USER'];
            $pass = $ini['DB1_PASSWORD'] ?? '';
            self::$conn = new \mysqli($host, $user, $pass, $name, 3306);
            if (self::$conn->connect_error) {
                die("Erro de conexão: " . self::$conn->connect_error);
            }
        }
        return self::$conn;
    }
}