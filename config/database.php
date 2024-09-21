<?php

class Database {
    private static $host = 'localhost';
    private static $db_name = 'MCC';
    private static $username = 'postgres'; // Ajuste conforme suas credenciais
    private static $password = 'Mic123456*#'; // Ajuste conforme suas credenciais
    private static $conn = null;

    // Método estático para obter a conexão com o banco de dados
    public static function getConnection() {
        if (self::$conn === null) {
            try {
                self::$conn = new PDO('pgsql:host=' . self::$host . ';dbname=' . self::$db_name, self::$username, self::$password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Erro de Conexão: ' . $e->getMessage();
            }
        }

        return self::$conn;
    }
}
?>
