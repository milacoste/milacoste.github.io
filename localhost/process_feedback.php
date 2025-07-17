<?php
require 'db_config.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST['message']);
    
    try {
        $stmt = $conn->prepare("INSERT INTO feedback (name, email, message) VALUES (:name, :email, :message)");
        
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);
        
        if($stmt->execute()) {
            header("Location: feedback.php?success=1");
            exit();
        } else {
            die("Ошибка выполнения запроса");
        }
    } catch(PDOException $e) {
        die("Ошибка при сохранении: " . $e->getMessage());
    }
} else {
    header("Location: feedback.php");
    exit();
}
?>