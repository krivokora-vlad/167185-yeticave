<?php

require_once('init.php');

$errors = [];

if ($user) {
  header("Location: /index.php");
  exit();
} else {
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
      }

      $email = mysqli_real_escape_string($db_connect, $form['email']);

      $user = query($db_connect, sprintf("SELECT * FROM user WHERE `email`='%s'", $email));

      if (count($user)) {
        if (password_verify($form['password'], $user[0]['password'])) {
          $_SESSION['user'] = $user[0];
        } else {
          $errors[$dict['password']] = 'Вы ввели неверный пароль';
        }
      } else {
        $errors[$dict['email']] = 'Вы ввели неверный email';
      }
    
      if (!count($errors)) {
        header("Location: /index.php");
        exit();
      }
    }
    
    $page_content = include_template('login', [
      'categories'    => $categories,
      'errors'        => $errors
    ]);
    
    $layout_content = include_template('layout', [
        'content'     => $page_content,
        'categories'  => $categories,
        'title'       => 'Страница входа',
        'user'        => $user
    ]);
    
    print($layout_content);
}



?>