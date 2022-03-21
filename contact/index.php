<?php
session_start();

// 関数ファイル読み込み
require_once './validation/validation_common.php';
require_once './validation/validation_corpName.php';
require_once './validation/jsonDecode.php';

// json読み込み
$url = "./data/seminarList.json";
$json = file_get_contents($url);
$arr = json_decode($json, true);

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

  include_once './views/index_view.php';
}
