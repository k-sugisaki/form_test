<?php
session_start();

$corp_name = $_SESSION['corp_name'];
$tel = $_SESSION['tel'];
$category = $_SESSION['category'];
$name = $_SESSION['name'];
$name_kana = $_SESSION['name_kana'];
$mail = $_SESSION['mail'];
$user_name = $_SESSION['user_name'];
$seminar = $_SESSION['seminar'];

include_once './action/views/complete_view.php';

$_SESSION = array();
session_destroy();