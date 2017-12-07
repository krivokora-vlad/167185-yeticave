<?php

require_once('functions.php');
require_once('data.php');

http_response_code(404);

$categories = ['Доски и лыжи', 'Крепления', 'Ботинки', 'Одежда', 'Инструменты', 'Разное'];


$page_data = [
  'categories' => $categories,
  'message' => 'Страница не найдена'
];
$page_content = include_template('404', $page_data);
$layout_content = include_template('layout', [
  'content' => $page_content,
  'title' => 'Страница не найдена',
  'is_auth' => $is_auth,
  'user_name' => $user_name,
  'user_avatar' => $user_avatar
]);

print($layout_content);