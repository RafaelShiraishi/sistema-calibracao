<?php

class Database
{
    public static function conectar(): PDO
    {
        $host = "mysql";
        $dbname = "sistema_calibracao";
        $user = "usuario";
        $password = "senha123";
        $port = 3306;

        try {

            $pdo = new PDO(
                "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
                $user,
                $password
            );

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;

        } catch (PDOException $e) {

            die("Erro ao conectar: " . $e->getMessage());

        }
    }
}