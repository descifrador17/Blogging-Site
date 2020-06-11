<?php

session_start();

$_SESSION['user_fname'] = null;
$_SESSION['user_id'] = null;
$_SESSION['user_role'] = null;

header("Location: ../../index.php");


?>