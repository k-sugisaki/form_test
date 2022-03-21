<?php

function escInput()
{
  $params = [];
  $params["corp_name"] = trim(filter_input(INPUT_POST, 'corp_name'));
  return $params;
}

$pa = self::escInput();

$POST_corpName = $pa['corp_name']; // ここで加工したものを使える

if ($POST_corpName == '') {
  $error['corp_name'] = $error_text;
  //制御文字、文字数をチェック
} else if (preg_match('/\A[[:^cntrl:]]{1,50}\z/u', $POST_corpName) == 0) {
  $error['corp_name'] = $error_text;
}