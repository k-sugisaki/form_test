<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
  ob_start();
}

// ランダムな文字列を生成してセッションに設定
if (!isset($_SESSION['csrf_token'])) {
  $toke_byte = openssl_random_pseudo_bytes(16);
  $csrf_token = bin2hex($toke_byte);
  $_SESSION['csrf_token'] = $csrf_token;
} else {
  $csrf_token = $_SESSION['csrf_token'];
}

// 関数ファイル読み込み
require_once './config/index.php';
require_once ACTION_DIR . '/validation/index.php';

// json読み込み
$url = "./data/seminarList.json";
$json = file_get_contents($url);
$arr = json_decode($json, true);


//最初は入力データがないのでこの初期化をしないとエラーとなる
$POST_corp_name = isset($_POST['corp_name']) ? $POST_corp_name : NULL;
$POST_tel = isset($_POST['tel']) ? $POST_tel : NULL;
$view_flag = 1;
// 先に保存したトークンと送信されたトークンが一致するか確認
$token = filter_input(INPUT_POST, 'csrf_token');
if (
  isset($_SESSION["csrf_token"])
  && $token === $_SESSION['csrf_token']
) {
  //送信ボタンが押された場合の処理
  if (isset($_POST['submitted'])) {
    $_POST = checkInput($_POST);
    $error = array();
    $view_flag = 2;

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

    $count = (int)$_POST['participant_count'];
    if (!ctype_digit($count)) {
      for ($i = 0; $i < $count + 1; $i++) {
        if (!isset($POST_participant_name[$i]) || $POST_participant_name[$i] == '') {
          $error['name'] = $error_text;
        } else if (!isParticipantName($POST_participant_name[$i])) {
          $error['name'] = $error_text;
        }

        if (!isset($POST_participant_name_kana[$i]) || $POST_participant_name_kana[$i] == '') {
          $error['name_kana'] = $error_text;
        } else if (!isParticipantNameKana($POST_participant_name_kana[$i])) {
          $error['name_kana'] = $error_text;
        }

        if (!isset($POST_mail[$i]) || $POST_mail[$i] == '') {
          $error['mail'] = $error_text;
        }
      }
    }
    $seminar = $_POST['seminar'];
    $complete_seminars = "";
    foreach ((array)$seminar as $index => $seminars) {
      $trimSeminar = array_map('trim', $seminars);
      if ($seminars['seminar_title'] === '0') {
        $POST_seminars[] = [];
        continue;
      }
      if (!$complete_seminars) $complete_seminars = $seminars['seminar_title'];
      if (isset($trimSeminar['entry_method']) && $trimSeminar['entry_method'] === '') {
        $error["seminar_method_$index"] = $error_text;
      };

      if (!ctype_digit($trimSeminar['seminar_text'])) {
        $error["seminar_text_$index"] = $error_text;
      };

      $POST_seminars[] = array_values($trimSeminar);
    }

    //それぞれの値をセッションに保存
    $_SESSION['corp_name'] = $POST_corp_name;
    $_SESSION['tel'] = $POST_tel;
    $_SESSION['category'] = $POST_category;
    
    $_SESSION['participant_name'] = $POST_participant_name;
    $_SESSION['participant_name_kana'] = $POST_participant_name_kana;
    $_SESSION['mail'] = $POST_mail;
    $_SESSION['seminar'] = $complete_seminars;

    //エラーがなく且つPOSTでのリクエストの場合
    if (empty($error) && $_SERVER['REQUEST_METHOD'] === 'POST') {
      // require_once './contact/action/create_csv/action.php';
      header('Location: ./complete.php');
      exit;
    }
    include_once './action/views/index_view.php';
  }
} else {
  include_once './action/views/index_view.php';
}