<?php
require 'db_config.php';

try {
    $stmt = $conn->query("SELECT * FROM feedback ORDER BY created_at DESC");
    $feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Ошибка при получении данных: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monster High - Просмотр отзывов</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="images/logo.jpg" alt="Monster High Logo" class="logo">
        </div>
        <nav>
            <ul>
                <li><a href="index.html">Главная</a></li>
                <li><a href="freaky.html">Фреки Штейн</a></li>
                <li><a href="cleo.html">Клео де Нил</a></li>
                <li><a href="draculaura.html">Дракулаура</a></li>
                <li><a href="clawdeen.html">Клаудин Вульф</a></li>
                <li><a href="ghoulia.html">Гулия Йелпс</a></li>
                <li><a href="feedback.php">Обратная связь</a></li>
            </ul>
        </nav>
    </header>

    <main class="view-feedback-page">
        <h1>Отзывы о Monster High</h1>
        <a href="feedback.php" class="back-link">Вернуться к форме</a>
        
        <div class="feedback-list">
            <?php if(count($feedbacks) > 0): ?>
                <?php foreach($feedbacks as $feedback): ?>
                    <div class="feedback-item">
                        <div class="feedback-header">
                            <h3><?= htmlspecialchars($feedback['name']) ?></h3>
                            <span class="feedback-doll">Любимая кукла: <?= htmlspecialchars($feedback['favorite_doll']) ?></span>
                        </div>
                        <div class="feedback-meta">
                            <span class="feedback-email"><?= htmlspecialchars($feedback['email']) ?></span>
                            <span class="feedback-date"><?= date('d.m.Y H:i', strtotime($feedback['created_at'])) ?></span>
                            <?php if($feedback['page_url']): ?>
                                <span class="feedback-page">Страница: <?= htmlspecialchars(basename($feedback['page_url'])) ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="feedback-message">
                            <?= nl2br(htmlspecialchars($feedback['message'])) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-feedback">Пока нет отзывов. Будьте первым!</p>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <div class="contact-info">
            <h3>Свяжитесь с нами</h3>
            <p>Email: info@monsterhigh-fan.ru</p>
            <p>Телефон: +7 (123) 456-78-90</p>
            <p>Адрес: ул. Призрачная, 13, г. Монстрвиль</p>
        </div>
        <p class="copyright">&copy; 2025 Monster High Fan Club. Все права защищены.</p>
    </footer>
</body>
</html>