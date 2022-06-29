<?php
/*
Template Name: 固定ページ／麹町法人会について
*/
?>
<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
  ob_start();
}

// ランダムな文字列を生成してセッションに設定
$toke_byte = openssl_random_pseudo_bytes(16);
$csrf_token = bin2hex($toke_byte);
if (!isset($_SESSION['csrf_token'])) {
  $check_token = $csrf_token;
} else {
  $check_token = $_SESSION['csrf_token'];
}
// sessionトークンの入れ替え
$_SESSION['csrf_token'] = $csrf_token;
?>
<?php get_header(); ?>
<?php
// 関数ファイル読み込み
require_once get_template_directory() . '/contact/config/index.php';
require_once get_template_directory() . ACTION_DIR . '/validation/index.php';
require_once get_template_directory() . '/contact/action/mails/mail.php';
require_once get_template_directory() . '/contact/action/create_csv/action.php';

// json読み込み
$url = get_template_directory() . '/contact/data/seminarList.json';
$json = file_get_contents($url);
$arr = json_decode($json, true);


//最初は入力データがないのでこの初期化をしないとエラーとなる
$POST_corp_name = isset($_POST['corp_name']) ? $POST_corp_name : NULL;
$POST_tel = isset($_POST['tel']) ? $POST_tel : NULL;
$view_flag = 1;
$complete_flg = 0;
// 先に保存したトークンと送信されたトークンが一致するか確認
$token = filter_input(INPUT_POST, 'csrf_token');
if (isset($check_token) && $token === $check_token) {
  //送信ボタンが押された場合の処理
  if (isset($_POST['submitted'])) {
    $_POST = checkInput($_POST);
    $error = array();
    $view_flag = 2;

    if (!isset($POST_corp_name) || $POST_corp_name == '') {
      $error['corp_name'] = $empty_text;
    } else if (!isCorpName($POST_corp_name)) {
      $error['corp_name'] = $error_text;
    }

    if (!isset($POST_tel) || $POST_tel == '') {
      $error['tel'] = $empty_text;
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
          $error['name'] = $empty_text;
        } else if (!isParticipantName($POST_participant_name[$i])) {
          $error['name'] = $error_text;
        }

        if (!isset($POST_participant_name_kana[$i]) || $POST_participant_name_kana[$i] == '') {
          $error['name_kana'] = $empty_text;
        } else if (!isParticipantNameKana($POST_participant_name_kana[$i])) {
          $error['name_kana'] = $error_text;
        }

        if (!isset($POST_mail[$i]) || $POST_mail[$i] == '') {
          $error['mail'] = $empty_text;
        }
      }
    }
    $seminar = $_POST['seminar'];
    $complete_seminars = "";
    $check_seminars = false;
    foreach ((array)$seminar as $index => $seminars) {
      $trimSeminar = array_map('trim', $seminars);
      if ($seminars['seminar_title'] === '0') {
        $POST_seminars[] = [];
        continue;
      }
      $check_seminars = true;
      if (!$complete_seminars) $complete_seminars = $seminars['seminar_title'];
      if (
        (isset($trimSeminar['entry_method']) && $trimSeminar['entry_method'] === '')
        or !isset($trimSeminar['entry_method'])
      ) {
        $error["seminar_method_$index"] = $empty_text;
      };

      if (!ctype_digit($trimSeminar['seminar_text'])) {
        $error["seminar_text_$index"] = $error_text;
      } else if($trimSeminar['seminar_text'] > 100){
        $error["seminar_text_$index"] = "100以下の数字を入力してください。";
      };

      $POST_seminars[] = array_values($trimSeminar);
      if (empty($error)) {
        $complete_flg = 1;
      } else {
        $complete_flg = 0;
      }
    }
    if (!$check_seminars) $error['seminars'] = 'セミナーを選択してください。';

    //それぞれの値をセッションに保存
    $_SESSION['corp_name'] = $POST_corp_name;
    $_SESSION['tel'] = $POST_tel;
    $_SESSION['category'] = $POST_category;

    $_SESSION['participant_name'] = $POST_participant_name;
    $_SESSION['participant_name_kana'] = $POST_participant_name_kana;
    $_SESSION['mail'] = $POST_mail;
    $_SESSION['seminar_list'] = $POST_seminars;
    $_SESSION['seminar'] = $complete_seminars;

    if ($POST_inquire != '') {
      $_SESSION['inquire'] = $POST_inquire;
    }

    if (empty($error) && $_SERVER['REQUEST_METHOD'] === 'POST'){
      //エラーがなく且つPOSTでのリクエストの場合
      $output = new CsvOutputControllor();
      $result = $output->create_csv();
    }

    if ($complete_flg && $result) {
      $_SESSION['finish'] = true;
      header('Location: ../complete/index.php');
      exit;
    }
  }
  include_once get_template_directory() . '/contact/action/views/index_view.php';
} else {
  include_once get_template_directory() . '/contact/action/views/index_view.php';
}
?>
<?php get_footer(); ?>