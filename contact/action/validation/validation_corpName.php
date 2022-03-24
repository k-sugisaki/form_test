<?php
class CorpNameClass
{
  function trimInput()
  {
    $params = [];
    $params["corp_name"] = trim(filter_input(INPUT_POST, 'corp_name'));
    return $params;
  }

  function useInput()
  {
    $trim = self::trimInput();
    $trim_corp_name = $trim['corp_name'];
    return $trim_corp_name;
  }
}

/**
 * 法人名（60文字以下）
 *
 * @param String $str チェック文字列
 * @return boolean true：エラー無し false：validationエラーあり
 */

function isCorpName($str) {
  # 電話番号以外の形式の場合
  if (60 < mb_strlen($str)) {
      return true;
  }
  return false;
}

$input = new CorpNameClass;
$POST_corp_name = $input->useInput();
