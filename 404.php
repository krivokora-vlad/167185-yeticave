<?php

require_once('init.php');

http_response_code(404);

$title = 'Ошибка 404';
$message = 'Страница не найдена.';

$page_data = [
  'categories'  => $categories,
  'title'       => $title,
  'message'     => $message,
];
$page_content = include_template('error', $page_data);
$layout_content = include_template('layout', [
  'content'     => $page_content,
  'title'       => $title,
  'categories'  => $categories,
  'user'        => $user,
  'user_avatar' => $user_avatar
]);
print($layout_content);

?>