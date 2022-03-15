<?php
//エスケープ処理を行う関数
// function h($var)
// {
//   if (is_array($var)) {
//     return array_map('h', $var);
//   } else {
//     return htmlspecialchars($var, ENT_QUOTES, 'UTF-8');
//   }
// }

//入力値に不正なデータがないかなどをチェックする関数
function checkInput($var)
{
  if (is_array($var)) {
    return array_map('checkInput', $var);
  } else {
    //NULLバイト攻撃対策
    if (preg_match('/\0/', $var)) {
      die('不正な入力です。');
    }
    //文字エンコードのチェック
    if (!mb_check_encoding($var, 'UTF-8')) {
      die('不正な入力です。');
    }
    //改行、タブ以外の制御文字のチェック
    if (preg_match('/\A[\r\n\t[:^cntrl:]]*\z/u', $var) === 0) {
      die('不正な入力です。制御文字は使用できません。');
    }
    return htmlspecialchars($var, ENT_QUOTES, 'UTF-8');
  }
}

/**
 * 値の初期化とデータの整形
 * @param string POSTされたデータ
 * @return string 変数に格納、前後のホワイトスペースを削除
 */
function hogehoge(){
  $params = [];
  $params["corp_name"] = trim(filter_input(INPUT_POST, 'corp_name');
return $params;
}

$pa = self::hogehoge();

$pa['corp_name']; // ここで加工したものを使える

$POST_tel = trim(filter_input(INPUT_POST, 'tel'));
$POST_category = trim(filter_input(INPUT_POST, 'category'));
$POST_name = trim(filter_input(INPUT_POST, 'name'));
$POST_name_kana = trim(filter_input(INPUT_POST, 'name_kana'));
$POST_mail = trim(filter_input(INPUT_POST, 'mail'));

// class errorCheck
// {
//   public function isExistData($check_data)
//   {
//     if (is_array($check_data)) {
//       return array_map('isExistData', $check_data);
//       //値の未入力チェック
//     } else {

//       }
//   }
// }

//送信ボタンが押された場合の処理
if (isset($_POST['submitted'])) {
  $_POST = checkInput($_POST);
  $error = array();
  $error_text = '入力が正しくありません';

  //値の検証2
  if ($POST_corp_name == '') {
    $error['corp_name'] = $error_text;
    //制御文字、文字数をチェック
  } else if (preg_match('/\A[[:^cntrl:]]{1,50}\z/u', $POST_corp_name) == 0) {
    $error['corp_name'] = $error_text;
  }

  if ($POST_tel == '' && preg_match('/\A\(?\d{2,5}\)?[-(\.\s]{0,2}\d{1,4}[-)\.\s]{0,2}\d{3,4}\z/u', $POST_tel) == 0) {
    $error['tel'] = $error_text;
  }
  if ($POST_category == '') {
    $error['category'] = '*どちらかにチェックをつけてください。';
  }
  if ($POST_name == '') {
    $error['name'] = '*必須項目です。';
    //制御文字、文字数をチェック
  } else if (preg_match('/\A[[:^cntrl:]]{1,30}\z/u', $POST_name) == 0) {
    $error['name'] = $error_text;
  }
  if ($POST_name_kana == '') {
    $error['name'] = $error_text;
    //制御文字、文字数をチェック
  } else if (preg_match('/\A[[:^cntrl:]]{1,30}\z/u', $POST_name_kana) == 0) {
    $error['corp_name'] = $error_text;
  }
  if ($POST_mail == '') {
    $error['mail'] = '*メールアドレスは必須です。';
  } else { //メールアドレスを正規表現でチェック
    $pattern = '/\A([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}\z/uiD';
    if (!preg_match($pattern, $POST_mail)) {
      $error['mail'] = $error_text;
    }
  }
}