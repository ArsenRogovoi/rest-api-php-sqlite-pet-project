<?php
// Подключаем базу данных
try {
    $db = new PDO('sqlite:' . __DIR__ . '/data/database.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    http_response_code(500); // Код ошибки сервера
    echo json_encode(['error' => 'Ошибка подключения к базе данных: ' . $e->getMessage()]);
    exit();
}

header('Content-Type: application/json; charset=utf-8');

// Определяем метод HTTP-запроса и URI
$method = $_SERVER['REQUEST_METHOD'];
$uri = strtok($_SERVER['REQUEST_URI'], '?');

// Простая маршрутизация
if ($uri === '/users' && $method === 'GET') {
    // получение всех пользователей
    try {
        $stmt = $db->query("SELECT * FROM users");
        $users = $stmt->fetchAll();
        echo json_encode($users);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Query error: ' . $e->getMessage()]);
    }
} elseif ($uri === '/users' && $method === 'POST') {
    // Создание нового пользователя
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['name'], $data['email'])) {
        try {
            $stmt = $db->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
            $stmt->execute(['name' => $data['name'], 'email' => $data['email']]);
            echo json_encode(['success' => true, 'id' => $db->lastInsertId()]);
        } catch (PDOException $e) {
            http_response_code(400);
            echo json_encode(['error' => 'User creation error: ' . $e->getMessage()]);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'name and email properties required']);
    }
} elseif (preg_match('#^/users/(\d+)$#', $uri, $matches) && $method === 'GET') {
    // Получение одного пользователя по ID
    $userId = $matches[1];
    $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $userId]);
    $user = $stmt->fetch();
    if ($user) {
        echo json_encode($user);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'The user was not found']);
    }
} elseif (preg_match('#^/users/(\d+)$#', $uri, $matches) && $method === 'DELETE') {
    $userId = $matches[1];
    try {
        $stmt = $db->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute(['id' => $userId]);
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true, 'message' => "Пользователь с ID $userId удален"]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Пользователь не найден']);
        }
    } catch (PDOException $e) {
        http_response_code(500); // Код ошибки сервера
        echo json_encode(['error' => 'Ошибка при удалении пользователя: ' . $e->getMessage()]);
    }
} else {
    // Неизвестный маршрут
    http_response_code(404);
    echo json_encode(['error' => 'The route was not found']);
}
