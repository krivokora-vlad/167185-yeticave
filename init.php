<?

require_once 'functions.php';
require_once 'data.php';

$db_connect = @mysqli_connect("localhost", "root", "", "yeticave");

if (!$db_connect) {
    $error = mysqli_connect_error();
    $page_title = 'Ошибка подключения к базе данных';
    $page_content = include_template('error', [
      'categories' => $categories,
      'title' => $page_title,
      'content' => $error
    ]);
    $layout_content = include_template('layout', [
      'content'     => $page_content,
      'title'       => $page_title,
      'user'        => $user,
      'user_avatar' => $user_avatar
    ]);
    print($layout_content);
    exit();
}

mysqli_set_charset($db_connect, "utf8");