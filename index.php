<?php

// Полное включение вывода ошибок прямо на страницу
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Подменяем переменные окружения для работы в облаке Vercel
$_ENV['APP_STORAGE'] = '/tmp/storage';
$_ENV['VIEW_COMPILED_PATH'] = '/tmp/storage/framework/views';
$_ENV['LOG_CHANNEL'] = 'stderr';
$_ENV['SESSION_DRIVER'] = 'array'; // Сессии будут в памяти, а не в файлах
$_ENV['CACHE_DRIVER'] = 'array';   // Кэш будет в памяти, а не в файлах

// Создаем нужные директории во временной папке сервера
$storagePaths = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/cache',
    '/tmp/storage/logs'
];

foreach ($storagePaths as $path) {
    if (!is_dir($path)) {
        mkdir($path, 0755, true);
    }
}

// Нагло врем серверу, что папка public является корнем запроса
$_SERVER['DOCUMENT_ROOT'] = __DIR__ . '/../public';
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/../public/index.php';

// Запускаем основной движок игрового сайта
require __DIR__ . '/../public/index.php';
