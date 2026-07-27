<?php

$host = getenv('DB_HOST') ?: getenv('MYSQLHOST') ?: 'mysql.railway.internal';
$port = getenv('DB_PORT') ?: getenv('MYSQLPORT') ?: '3306';
$dbname = getenv('DB_NAME') ?: getenv('MYSQLDATABASE') ?: 'railway';
$user = getenv('DB_USER') ?: getenv('MYSQLUSER') ?: 'root';
$password = getenv('DB_PASSWORD') ?: getenv('MYSQLPASSWORD') ?: '';

try {
    $pdo = new PDO(
        "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4",
        $user,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    die('Erro ao conectar ao banco: ' . $e->getMessage());
}