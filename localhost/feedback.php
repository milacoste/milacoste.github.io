<?php 
$page_title = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monster High - Обратная связь</title>
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
                <li><a href="todo.html">ToDo List</a></li>
            </ul>
        </nav>
    </header>

    <main class="feedback-page">
        <h1>Оставьте отзыв о Monster High</h1>
        
        <?php if(isset($_GET['success'])): ?>
            <div class="success-message">
                Спасибо! Ваш отзыв отправлен. Гулии уже изучает его!
            </div>
        <?php endif; ?>
        
        <form action="process_feedback.php" method="POST" class="feedback-form">
            <input type="hidden" name="page_url" value="<?= htmlspecialchars($page_title) ?>">
            
            <div class="form-group">
                <label for="name">Ваше имя:</label>
                <input type="text" id="name" name="name" required placeholder="Например, Дракулаура">
            </div>
            
            <div class="form-group">
                <label for="email">Ваш email:</label>
                <input type="email" id="email" name="email" required placeholder="monster@example.com">
            </div>
            
            <div class="form-group">
                <label for="message">Ваш отзыв или вопрос:</label>
                <textarea id="message" name="message" rows="5" required 
                          placeholder="Расскажите, какая кукла Monster High вам нравится больше всего и почему..."></textarea>
            </div>
            
            <div class="form-group">
                <label>Ваша любимая кукла:</label>
                <div class="doll-options">
                    <label><input type="radio" name="favorite_doll" value="Дракулаура"> Дракулаура</label>
                    <label><input type="radio" name="favorite_doll" value="Клео де Нил"> Клео де Нил</label>
                    <label><input type="radio" name="favorite_doll" value="Фреки Штейн"> Фреки Штейн</label>
                    <label><input type="radio" name="favorite_doll" value="Клаудин Вульф"> Клаудин Вульф</label>
                    <label><input type="radio" name="favorite_doll" value="Гулия Йелпс"> Гулия Йелпс</label>
                </div>
            </div>
            
            <button type="submit" class="submit-btn">Отправить отзыв</button>
        </form>
        
        <div class="view-feedback-link">
            <a href="view_feedback.php">Посмотреть все отзывы</a>
        </div>
    </main>

    <footer>
        <div class="contact-info">
            <h3>Свяжитесь с нами</h3>
            <p>Email: info@monsterhigh-fan.ru</p>
            <p>Телефон: +7 (123) 456-78-90</p>
            <p>Адрес: ул. Призрачная, 13, г. Монстрвиль</p>
        </div>
        <p class="copyright">&copy; 2025 Monster High.</p>
    </footer>
</body>
</html>