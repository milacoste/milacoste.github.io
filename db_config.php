<?php
$host = 'localhost';
$dbname = 'monster_high_feedback';
$username = 'root'; // замените на ваши данные
$password = '';     // замените на ваш пароль

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("SET NAMES utf8");
} catch(PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}
?>