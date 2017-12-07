<?php

require_once('data.php');
require_once('functions.php');

$lot_id = (isset($_GET['id'])) ? $_GET['id'] : -1;

$page_found = isset($announcements[$lot_id]);
if (!$page_found) {
    error_404();
    show_error('Лот не найден', 'Лот с этим ID не найден >:{');
} else {
    $page_data = [
        'categories' => $categories,
        'lot_id' => $lot_id,
        'announcements' => $announcements,
        'bets' => $bets
    ];
    $page_content = include_template('lot', $page_data);
    $layout_content = include_template('layout', [
        'content' => $page_content,
        'title' => (isset($announcements[$lot_id]['name'])) ? $announcements[$lot_id]['name'] : '',
        'is_auth' => is_auth(),
        'user_name' => $user_name,
        'user_avatar' => $user_avatar
    ]);
    print($layout_content);
}