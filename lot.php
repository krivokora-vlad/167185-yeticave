<?php

require_once('data.php');
require_once('functions.php');

$lot_id = (isset($_GET['id'])) ? $_GET['id'] : -1;

$page_found = isset($announcements[$lot_id]);

if (!$page_found) {
    http_response_code(404);
    $page_title = 'Лот с таким ID не найден';
    $page_data = [
        'categories' => $categories,
        'title' => $page_title
    ];
    $page_content = include_template('error', $page_data);
} else {
    $page_data = [
        'categories' => $categories,
        'lot' => $announcements[$lot_id],
        'bets' => $bets
    ];
    $page_title = $announcements[$lot_id]['name'];
    $page_content = include_template('lot', $page_data);
}

$layout_content = include_template('layout', [
    'content' => $page_content,
    'title' => $page_title,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'user_avatar' => $user_avatar
]);

print($layout_content);

?>