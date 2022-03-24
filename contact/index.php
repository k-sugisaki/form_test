<?php
session_start();

// 関数ファイル読み込み
require_once './action/validation/validation_common.php';
require_once './action/validation/validation_corpName.php';
require_once './action/validation/validation_tel.php';

// json読み込み
$url = "./data/seminarList.json";
$json = file_get_contents($url);
$arr = json_decode($json, true);

include_once './action/views/index_view.php';

//送信ボタンが押された場合の処理
if (isset($_POST['submitted'])) {
  $_POST = checkInput($_POST);
  $error = array();

  if ($POST_corp_name == '') {
    $error['corp_name'] = $error_text;
    //制御文字、文字数をチェック
  } else if (preg_match('/\A[[:^cntrl:]]{1,50}\z/u', $POST_corp_name) == 0) {
    $error['corp_name'] = $error_text;
  }

  if ($POST_tel == '') {
    $error['tel'] = $error_text;
  } else if (preg_match('/^[0-9-]{6,9}$|^[0-9-]{13}$/', $POST_tel) == 0) {
    $error['tel'] = $error_text;
  }

  //エラーがなく且つPOSTでのリクエストの場合
  // if (empty($error) && $_SERVER['REQUEST_METHOD'] === 'POST') {


  //   if (isset($_POST['seminar']) && is_array($_POST['seminar'])) {
  //     $_SESSION['seminar'] = $_POST['seminar'];
  //   }
  //   $_SESSION['corp_name'] = $POST_corp_name;
  //   $_SESSION['tel'] = $_POST['tel'];
  //   $_SESSION['category'] = $_POST['category'];
  //   $_SESSION['name'] = $_POST['name'];
  //   $_SESSION['name_kana'] = $_POST['name_kana'];
  //   $_SESSION['mail'] = $_POST['mail'];
  //   $_SESSION['user_name'] = $_POST['user_name'];

  //   require_once './contact/action/create_csv/action.php';
  //   header('Location: ./complete.php');
  //   exit;
  // }
  include_once './action/views/index_view.php';
}
