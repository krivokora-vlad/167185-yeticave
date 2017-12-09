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
    $is_bet = false;
    $cookie_value = [];
    if (isset($_COOKIE['bets'])) {
        $cookie_value = json_decode($_COOKIE['bets'], true);
    }
    if (isset($cookie_value[$lot_id])) {
        $is_bet = true;
    }
    $errors = [];
    if (!$is_bet) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cost = intval((isset($_POST['cost'])) ? $_POST['cost'] : 0);
            $price = intval($announcements[$lot_id]['price']);

            if ( $price >= $cost ) {
                $errors['cost'] = 'Ставка должна быть больше стоимости товара.';
            } else {
                $cookie_name = 'bets';
                $cookie_value = [];
                $expire = strtotime("+30 days");
                $path = "/";
                if (isset($_COOKIE['bets'])) {
                    $cookie_value = json_decode($_COOKIE['bets'], true);
                }
                $cookie_value[$lot_id] = [
                    'cost' => $cost,
                    'time' => time()
                ];
                setcookie($cookie_name, json_encode($cookie_value), $expire, $path);
                header("Location: /mylots.php");
                exit();
            }
        }
    }
    $page_data = [
        'categories' => $categories,
        'lot' => $announcements[$lot_id],
        'bets' => $bets,
        'lot_id' => ($lot_id >= 0) ? $lot_id : '',
        'is_bet' => $is_bet,
        'errors' => $errors,
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