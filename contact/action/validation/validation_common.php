<?php

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
    //エスケープ処理
    return htmlspecialchars($var, ENT_QUOTES, 'UTF-8');
  }
}

$error_text = '不正な入力です。';
$empty_text = '入力してください。';
