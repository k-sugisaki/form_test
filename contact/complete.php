<?php
session_start();
if(
    isset($_SESSION['csrf_token']) && !empty($_SESSION['csrf_token']) && isset($_SESSION['finish'])
) {
    $corp_name = $_SESSION['corp_name'];
    $tel = $_SESSION['tel'];
    $category = $_SESSION['category'];
    $name = $_SESSION['participant_name'];
    $name_kana = $_SESSION['participant_name_kana'];
    $mail = $_SESSION['mail'];
    // $user_name = $_SESSION['user_name'];
    $seminar = $_SESSION['seminar'];
    
    include_once './action/views/complete_view.php';
    
    $_SESSION = array();
    session_destroy();
} else { 
    header('Location: ./');
}
