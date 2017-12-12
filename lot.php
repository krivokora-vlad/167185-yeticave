<?php

require_once('init.php');

$lot_id = (isset($_GET['id'])) ? intval($_GET['id']) : -1;

$announcement = query(
    $db_connect,
    'SELECT
        `lot`.`id`,
        `lot`.`name`,
        `lot`.`image`,
        `lot`.`description`,
        `lot`.`price_start`,
        `lot`.`date_expire`,
        MAX(`bet`.`cost`) as `price`,
        `lot`.`bet_step`,
        `category`.`name` as `category`,
        `lot`.`user_id`
    FROM lot
    LEFT JOIN category on `lot`.`category_id` = `category`.`id`
    LEFT JOIN bet ON `lot`.`id` = `bet`.`lot_id`
    WHERE `lot`.`id`='.$lot_id.'
    GROUP BY `bet`.`cost`
    ORDER BY `price` DESC
    LIMIT 1'
);


$page_found = COUNT($announcement);

if (!$page_found) {
    http_response_code(404);
    $page_title = 'Лот с таким ID не найден';
    $page_data = [
        'categories' => $categories,
        'title' => $page_title
    ];
    $page_content = include_template('error', $page_data);
} else {
    $lot = $announcement[0];
    $id = $lot['id'];
    $bets = query(
        $db_connect,
        'SELECT `bet`.`id`, `bet`.`date`, `bet`.`cost`, `bet`.`user_id`, `bet`.`lot_id`, `user`.`name`
        FROM bet
        LEFT JOIN user ON `bet`.`user_id` = `user`.`id`
        WHERE lot_id='.$id.' ORDER BY `bet`.`date` DESC LIMIT 5'
    );

    $bets_count = COUNT($bets);
    $is_bet = false;
    foreach ($bets as $bet) {
        if($bet['user_id'] == $user['id']) {
            $is_bet = true;
        }
    }


    $lot['current_price'] = ($lot['price']) ?? $lot['price_start'];
    $lot['min_bet'] = $lot['current_price'] + $lot['bet_step'];

    $errors = [];
    if (!$is_bet) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cost = intval((isset($_POST['cost'])) ? $_POST['cost'] : 0);
            $price = $lot['min_bet'];

            if ( $price > $cost ) {
                $errors['cost'] = 'Ставка должна быть больше стоимости товара.';
            } else {
                query($db_connect, sprintf("INSERT INTO bet (`date`, `cost`, `user_id`, `lot_id`) VALUES (NOW(), %d, %d, %d)", $cost, $user['id'], $lot['id']));
                header("Location: /mylots.php");
                exit();
            }
        }
    }
    $page_data = [
        'categories' => $categories,
        'lot' => $lot,
        'bets' => $bets,
        'bets_count' => $bets_count,
        'lot_id' => ($lot_id >= 0) ? $lot_id : '',
        'is_bet' => $is_bet,
        'errors' => $errors,
        'user' => $user,
        'lot_expired' => strtotime($lot['date_expire']) <= time(),
        'is_my_lot' => $user['id'] == $lot['user_id'],
    ];

    $page_title = htmlspecialchars($lot['name']);
    $page_content = include_template('lot', $page_data);
}

$layout_content = include_template('layout', [
    'content' => $page_content,
    'title' => $page_title,
    'categories'  => $categories,
    'user' => $user
]);

print($layout_content);

?>