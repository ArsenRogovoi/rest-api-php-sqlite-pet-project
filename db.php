<?php

try {
    // создание файла БД и конфигурация аттрибутов:
    $db = new PDO('sqlite:' . __DIR__ . '/data/database.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    echo 'Подключение успешно!<br>';

    // создание таблицы в БД если не существует:
    $db->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        email TEXT NOT NULL UNIQUE
    )");
    echo 'Таблица users создана или уже существует.';
} catch (PDOException $e) {
    echo 'Ошибка подключения: ' . $e->getMessage();
    exit();
}
