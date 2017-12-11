<?

error_reporting(E_ALL);

session_start();

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
      'user'        => [],
      'user_avatar' => ''
    ]);
    print($layout_content);
    exit();
}

mysqli_set_charset($db_connect, "utf8");



require_once('userdata.php');
require_once('data.php');
