<?php
// Conexão com MySQL do XAMPP. Ajuste usuário/senha se necessário.
$host = 'localhost';
$db   = 'gerenciador_logistico';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8mb4",
        $user,
        $pass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    );
} catch (PDOException $e) {
    exit('Não foi possível conectar ao banco. Confira o XAMPP e importe database.sql. Detalhe: ' .
         htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8'));
}
