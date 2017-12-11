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

function searchUserByEmail($email, $users) {
	$result = null;
	foreach ($users as $user) {
		if ($user['email'] == $email) {
			$result = $user;
			break;
		}
	}

	return $result;
}

function query($db_connect, $sql) {
    $result = mysqli_query($db_connect, $sql);

    //echo '<pre>';
    //var_dump($result);
    //echo '</pre>';

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
          'user'        => [],
          'user_avatar' => ''
        ]);
        print($layout_content);
        exit();
    } else {
        if ($result === true) {
            // its insert or update query mabe
        } else {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
    }
}

function lot_expire_timer ($exp_ts) {
    $diff = $exp_ts - strtotime('now');
    return round($diff/3600).':'.date('i:s',$diff);
}

?>