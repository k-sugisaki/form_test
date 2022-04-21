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
require_once './action/validation/validation_common.php';
require_once './action/validation/validation_corpName.php';
require_once './action/validation/validation_tel.php';
require_once './action/validation/validation_category.php';

// json読み込み
$url = "./data/seminarList.json";
$json = file_get_contents($url);
$arr = json_decode($json, true);

include_once './action/views/index_view.php';

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
    foreach ((array)$seminar as $index => $seminars) {
      if ($seminars['seminar_title'] === '0') {
        continue;
      }
      $trimSeminar = array_map('trim', $seminars);

      if ($trimSeminar['entry_method'] === '') {
        $error["seminar_method_' . $index . '"] = $error_text;
      };

      if (!ctype_digit($trimSeminar['seminar_text'])) {
        $error["seminar_text_' . $index . '"] = $error_text;
      };

      $POST_seminars[] = array_values($trimSeminar);
    }

    //それぞれの値をセッションに保存
    $_SESSION['corp_name'] = $POST_corp_name;
    $_SESSION['tel'] = $POST_tel;
    $_SESSION['category'] = $POST_category;
    // $_SESSION['participant_name'] = $_POST_participant_name;
    // $_SESSION['participant_name_kana'] = $_POST_participant_name_kana;
    // $_SESSION['mail'] = $_POST_mail;
    if(!empty($POST_seminars)){
      $_SESSION['seminar'] = $POST_seminars;
    }

    //エラーがなく且つPOSTでのリクエストの場合
    if (empty($error) && $_SERVER['REQUEST_METHOD'] === 'POST') {
      // require_once './contact/action/create_csv/action.php';
      header('Location: ./complete.php');
      exit;
    }
    include_once './action/views/index_view.php';
  }
}
