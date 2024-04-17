<?php 

session_start();

$_SESSION['id_user'] = null;
$_SESSION['id_role'] = null;
$_SESSION['fullname'] = null;
$_SESSION['phone'] = null;
$_SESSION['email'] = null;
$_SESSION['user_status'] = null;

header('Location: ../index.php');


?>