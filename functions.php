<?php

/**
 * Возвращает относительное время от указанного времени до текущего
 *
 * @param $ts timestamp Прошедшая дата
 *
 * @return string gmdate Прошедшее время в относительном формате
 */
function time_of_betting($ts) {
    $now = strtotime('now');
    $diff = $now - $ts;
    $result = '';
    if ($diff > 86400) {
        $result = gmdate("d.m.y в H:i", $ts);
    } else if ($diff > 3600){
        $result = gmdate("H часов назад", $diff);
    } else {
        $result = gmdate("i минут назад", $diff);
    }
    return $result;
}

/**
 * Функция подключения php шаблона
 *
 * @param string $template_name Название файла шаблона, без расширения
 * @param array $data Массив данных для шаблона
 *
 * @return string Возвращает подключенный файл шаблона
 */
function include_template($template_name, $data) {
    $template = 'templates/' . $template_name . '.php';
    if (is_file($template)) {
        ob_start();
        include($template);
        return ob_get_clean();
    } else {
       return '';
    }
}

/**
 * Функция выполнения запроса в базу данных
 * В случае ошибочного запроса - выдаёт страницу ошибки с отладочной информацией
 *
 * @param mysqli_connect $db_connect Подключение к базе
 * @param string $sql Строка запроса
 *
 * @return array Возвращает массив ответа от базы
 */
function query($db_connect, $sql) {
    $result = mysqli_query($db_connect, $sql);

    if (!$result) {
        $error = mysqli_error($db_connect);
        $page_title = 'Ошибка в запросе в базу даных';
        $page_content = include_template('error', [
          'categories' => [],
          'title' => $page_title,
          'content' => $error.'<br>'.$sql,
        ]);
        $layout_content = include_template('layout', [
          'content'     => $page_content,
          'title'       => $page_title,
          'categories'  => [],
          'user'        => []
        ]);
        print($layout_content);
        exit();
    } else {
        if ($result === true) {
        } else {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
    }
}

/**
 * Возвращает время до истечения лота
 *
 * @param $exp_ts timestamp Дата истечения лота
 *
 * @return string gmdate Количество часов, минут и секунд до закрытия лота
 */
function lot_expire_timer ($exp_ts) {
    $diff = $exp_ts - strtotime('now');
    return gmdate('H:i:s',$diff);
}

/**
 * Проверка, был ли загружен файл в определённое поле
 *
 * @param $file Поле загружаемого файла
 *
 * @return bool Результат проверки
 */
function file_is_uploaded ($file) {
    return ($file['error'] == 0) ? true : false;
}

/**
 * Получение типа файла
 *
 * @param $file Проверяемый файл
 *
 * @return bool Результат проверки
 */
function get_file_type ($file) {
    return finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file['tmp_name']);
}

/**
 * Проверка на базовые типы изображений, допустимых для загрузки
 * 
 * @param $file Проверяемый файл
 *
 * @return bool Результат проверки
 */
function file_is_image ($file) {
    $file_type = get_file_type($file);
    return ($file_type !== "image/png" && $file_type !== "image/jpeg") ? false : true;
}


?>