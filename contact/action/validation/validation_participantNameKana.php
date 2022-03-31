<?php
class ParticipantNameKanaClass
{
  function trimInput()
  {
    $params = [];
    $params["participant_name_kana"] = trim(filter_input(INPUT_POST, 'participant_name_kana'));
    return $params;
  }

  function useInput()
  {
    $trim = self::trimInput();
    $trim_participant_name_kana = $trim['participant_name_kana'];
    return $trim_participant_name_kana;
  }
}

/**
 * 参加者名カナ（60文字以下）
 *
 * @param String $str チェック文字列
 * @return boolean true：エラー無し false：validationエラーあり
 */

function isParticipantName($str) {
  if (60 < mb_strlen($str)) {
      return true;
  }
  return false;
}

$input = new ParticipantNameKanaClass;
$POST_participant_name_kana = $input->useInput();
