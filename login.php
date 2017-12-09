<?php

session_start();

require_once('userdata.php');
require_once('functions.php');
require_once('data.php');

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $form = $_POST;

  $required = [
    'email',
    'password'
  ];

  $dict = [
    'email' => 'E-mail',
    'password' => 'Пароль'
  ];

  foreach ($form as $key => $value) {
    if (in_array($key, $required)) {
			if (!$value) {
				$errors[$dict[$key]] = 'Это поле надо заполнить';
			}
    }

    if ($user = searchUserByEmail($form['email'], $users)) {
      if (password_verify($form['password'], $user['password'])) {
        $_SESSION['user'] = $user;
      } else {
        $errors[$dict['password']] = 'Вы ввели неверный пароль';
      }
    } else {
      $errors[$dict['email']] = 'Вы ввели неверный email';
    }
  
  }

  if (!count($errors)) {
    header("Location: /index.php");
    exit();
  }
}

$page_content = include_template('login', [
  'categories' => $categories,
  'errors' => $errors
]);

$layout_content = include_template('layout', [
    'content' => $page_content,
    'title' => 'Страница входа',
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'user_avatar' => $user_avatar
]);

print($layout_content);

?>