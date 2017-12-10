<?php

require_once('mysql_helper.php');
require_once('init.php');

session_start();

$_SESSION = [];

header("Location: /index.php");
exit();

?>