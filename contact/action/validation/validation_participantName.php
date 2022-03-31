<?php
class ParticipantNameClass
{
  function trimInput()
  {
    $params = [];
    $params["participant_name"] = trim(filter_input(INPUT_POST, 'participant_name'));
    return $params;
  }

  function useInput()
  {
    $trim = self::trimInput();
    $trim_participant_name = $trim['participant_name'];
    return $trim_participant_name;
  }
}

/**
 * 参加者名（60文字以下）
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

$input = new ParticipantNameClass;
$POST_participant_name = $input->useInput();
