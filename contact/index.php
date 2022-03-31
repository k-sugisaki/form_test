<?php
session_start();

// ランダムな文字列を生成してセッションに設定
$toke_byte = openssl_random_pseudo_bytes(16);
$csrf_token = bin2hex($toke_byte);
$_SESSION['csrf_token'] = $csrf_token;

// 関数ファイル読み込み
require_once './action/validation/validation_common.php';
require_once './action/validation/validation_corpName.php';
require_once './action/validation/validation_tel.php';

// json読み込み
$url = "./data/seminarList.json";
$json = file_get_contents($url);
$arr = json_decode($json, true);

include_once './action/views/index_view.php';

// 先に保存したトークンと送信されたトークンが一致するか確認
if (
  isset($_POST["csrf_token"])
  && $_POST["csrf_token"] === $_SESSION['csrf_token']
) {
  //送信ボタンが押された場合の処理
  if (isset($_POST['submitted'])) {
    $_POST = checkInput($_POST);
    $error = array();

    if (!isset($POST_corp_name) || $POST_corp_name == '') {
      $error['corp_name'] = $error_text;
    } else if (!isCorpName($POST_corp_name)) {
      $error['corp_name'] = $error_text;
    }

    if (!isset($POST_tel) || $POST_tel == '') {
      $error['tel'] = $error_text;
    } else if (!isPhoneNumber($POST_tel)) {
      $error['tel'] = $error_text;
    }

    if (!isset($POST_category) || $POST_category == '') {
      $error['category'] = $empty_text;
    }

    //それぞれの値をセッションに保存
    // if (isset($_POST['seminar']) && is_array($_POST['seminar'])) {
    //   $_SESSION['seminar'] = $_POST['seminar'];
    // }
    $_SESSION['corp_name'] = $POST_corp_name;
    $_SESSION['tel'] = $_POST_tel;
    $_SESSION['category'] = $_POST_category;
    // $_SESSION['participant_name'] = $_POST_participant_name;
    // $_SESSION['participant_name_kana'] = $_POST_participant_name_kana;
    // $_SESSION['mail'] = $_POST_mail;

    //エラーがなく且つPOSTでのリクエストの場合
    if (empty($error) && $_SERVER['REQUEST_METHOD'] === 'POST') {
      require_once './contact/action/create_csv/action.php';
      header('Location: ./complete.php');
      exit;
    }
    include_once './action/views/index_view.php';
  }
}
