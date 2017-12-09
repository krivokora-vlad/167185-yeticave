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

?>