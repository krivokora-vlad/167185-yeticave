<?php

function time_of_betting($ts) {
    $now = strtotime('now');
    $diff = $now - $ts;
    if ($diff > 86400) {
        return gmdate("d.m.y в H:i", $ts);
    } else if ($diff > 3600){
        return gmdate("H часов назад", $diff);
    } else {
        return gmdate("i минут назад", $diff);
    }
}

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

//function error_404 () {
//    http_response_code(404);
//}

//function show_error ($title, $message) {
//    $page_data = [
//        'categories' => $categories,
//        'title' => $title,
//        'message' => $message,
//    ];
//    $page_content = include_template('error', $page_data);
//    $layout_content = include_template('layout', [
//        'content' => $page_content,
//        'title' => $title,
//        'is_auth' => $is_auth,
//        'user_name' => $user_name,
//        'user_avatar' => $user_avatar
//    ]);
//    print($layout_content);
//}