<?php

session_start();

$_SESSION['userid'] = null;
$_SESSION['user'] = null;

session_destroy();

header('Location: PMS_signUp.php');

?>