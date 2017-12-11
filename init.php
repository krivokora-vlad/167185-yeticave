<?

error_reporting(E_ALL);

session_start();

// устанавливаем часовой пояс в Московское время
date_default_timezone_set('Europe/Moscow');

require_once('mysql_helper.php');
require_once('functions.php');

$db_connect = mysqli_connect("localhost", "root", "", "yeticave");

if (!$db_connect) {
    $error = mysqli_connect_error();
    $page_title = 'Ошибка подключения к базе данных';
    $page_content = include_template('error', [
      'categories' => [],
      'title' => $page_title,
      'content' => $error
    ]);
    $layout_content = include_template('layout', [
      'content'     => $page_content,
      'title'       => $page_title,
      'categories'  => [],
      'user'        => []
    ]);
    print($layout_content);
    exit();
}

mysqli_set_charset($db_connect, "utf8");


$user = (isset($_SESSION['user'])) ? $_SESSION['user'] : false;

$categories = query($db_connect,'SELECT `id`, `name` FROM category');


