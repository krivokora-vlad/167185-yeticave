<?php

session_start();

require_once('functions.php');
require_once('data.php');

require_once('mysql_helper.php');
require_once('init.php');

// устанавливаем часовой пояс в Московское время
date_default_timezone_set('Europe/Moscow');

// записать в эту переменную оставшееся время в этом формате (ЧЧ:ММ)
$lot_time_remaining = "00:00";

// временная метка для полночи следующего дня
$tomorrow = strtotime('tomorrow midnight');

// временная метка для настоящего времени
$now = strtotime('now');

$diff = $tomorrow - $now;
$hours = str_pad(strval(floor($diff / 3600)), 2, "0", STR_PAD_LEFT);
$minutes = str_pad(strval(floor($diff / 60) - ($hours * 60)), 2, "0", STR_PAD_LEFT);

// далее нужно вычислить оставшееся время до начала следующих суток и записать его в переменную $lot_time_remaining
$lot_time_remaining = $hours.':'.$minutes;
// $lot_time_remaining = gmdate("H:i:s", $tomorrow - $now);

$page_data = [
    'categories' => $categories,
    'announcements' => $announcements,
    'lot_time_remaining' => $lot_time_remaining
];
$page_content = include_template('index', $page_data);
$layout_content = include_template('layout', [
    'content' => $page_content,
    'title' => 'Главная',
    'user' => $user,
    'user_avatar' => $user_avatar
]);

print($layout_content);
?>