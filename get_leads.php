<?php
// Имитируем задержку сервера (0.8 секунды)
usleep(800000); 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// ЗАГОЛОВКИ ПРОТИВ КЭША (PHP версия)
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Массив заявок (позже здесь будет запрос к SQL)
$leads = [
    ["id" => 1, "name" => "Обновленный Евгений Батькович", "phone" => "+79001234567", "date" => "10.05.2024 13:45", "is_new" => true, "text" => "Комментарий..."],
    ["id" => 2, "name" => "Феоктистов Михаил Игнатьевич", "phone" => "+79001234567", "date" => "10.05.2024 13:45"],
    ["id" => 3, "name" => "Антип Федоров", "phone" => "+79161234567", "date" => "10.05.2024 13:45", "is_new" => true, "is_spam" => true],
    ["id" => 4, "name" => "Степан И.", "phone" => "+78009993344", "date" => "10.05.2024 13:45"],
    ["id" => 5, "name" => "Анна Фролова", "phone" => "+79001234567", "date" => "10.05.2024 13:45", "is_new" => true],
    ["id" => 6, "name" => "Иван Иванов", "phone" => "+79001234567", "date" => "10.05.2024 13:45"],
    ["id" => 7, "name" => "Кирилл", "phone" => "+79001234567", "date" => "10.05.2024 13:45", "is_new" => true],
    ["id" => 8, "name" => "Федор Федоров", "phone" => "+79001234567", "date" => "10.05.2024 13:45"],
    ["id" => 9, "name" => "Jon Doie", "phone" => "+78009993344", "date" => "10.05.2024 13:45"]
];

// Читаем параметры из POST или GET
$page = isset($_REQUEST['page']) ? (int)$_REQUEST['page'] : 1;
$limit = 10;
$start = ($page - 1) * $limit;

// Обрезаем массив для пагинации
$chunk = array_slice($leads, $start, $limit);

// Отдаем результат
echo json_encode([
    "chunk" => $chunk,
    "hasMore" => ($start + $limit) < count($leads)
]);
