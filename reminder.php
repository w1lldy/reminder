<?php
session_start();

$servername = "localhost"; // адрес сервера Mysql
$username = "usertest"; // имя пользователя, обязательно проверьте возможность ввода данным пользователем
$password = "№№####№№"; // соответственно пароль
$dbname = "nameDB"; // наименование базы данных, учитывайте регистр 

// Подключение к базе данных
$conn = new mysqli($servername, $username, $password, $dbname);
// Проверка соединения с базой данных
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Обработка формы
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// Получение данных из формы
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $title = $_POST['task_title'];
    $description = $_POST['task_description'];
    $datetime = $_POST['task_datetime'];
    $datetime = str_replace('T', ' ', $datetime);
    $priority = $_POST['task_priority'];

    // Использование подготовленного выражения для предотвращения SQL-инъекций
    $stmt = $conn->prepare("INSERT INTO reminder (task_title, task_description, task_datetime, task_priority, user_id, username) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $title, $description, $datetime, $priority, $user_id, $username);

    if ($stmt->execute()) {
        // Уведомление об успешной записи данных, выводит браузерное сообщение
        echo "<script>alert('Данные внесены'); window.location.href = 'https://мухаринов.рф/reminder';</script>";
        // Вызов функции отправки уведомления в Telegram
//        send_telegram_notification($title, $description, $username);
    } else {
        echo "Ошибка: " . $stmt->error;
    }

    $stmt->close();
}

// Функция для отправки уведомлений в Telegram
// стадия разработки
function send_telegram_notification($title, $description, $username) {
    
}

$conn->close();
?>