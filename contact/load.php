<?php
session_start();

require_once './libs/formValidation.php';
require_once './libs/jsonDecode.php';

//エラーがなく且つPOSTでのリクエストの場合
if (empty($error) && $_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['seminar']) && is_array($_POST['seminar'])) {
    $_SESSION['seminar'] = $_POST['seminar'];
  }
  $_SESSION['corp_name'] = $_POST['corp_name'];
  $_SESSION['tel'] = $_POST['tel'];
  $_SESSION['category'] = $_POST['category'];
  $_SESSION['name'] = $_POST['name'];
  $_SESSION['name_kana'] = $_POST['name_kana'];
  $_SESSION['mail'] = $_POST['mail'];
  $_SESSION['user_name'] = $_POST['user_name'];
  header('Location: ./complete.php');
}
?>