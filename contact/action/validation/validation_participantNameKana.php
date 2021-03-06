<?php
class ParticipantNameKanaClass
{
  function trimInput()
  {
    $params = [];
    $params = filter_input(INPUT_POST, 'participant_name_kana',  FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
    if (!empty($params)) $params = array_map('trim', $params);
    return $params;
  }

  function useInput()
  {
    $trim = self::trimInput();
    $trim_participant_name_kana = $trim;
    return $trim_participant_name_kana;
  }
}

/**
 * 参加者名カナ（60文字以下, 全角カナ）
 * @param String $str チェック文字列
 * @return boolean true：エラー無し false：validationエラーあり
 */

function isParticipantNameKana($str) {
  $str = preg_replace('/\s/u', '', $str);
  if (60 > mb_strlen($str) && preg_match("/^[ァ-ヶー]+$/u", $str)) {
      return true;
  }
  return false;
}

$input = new ParticipantNameKanaClass;
$POST_participant_name_kana = $input->useInput();
