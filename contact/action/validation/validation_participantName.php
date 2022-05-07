<?php
class ParticipantNameClass
{
  function trimInput()
  {
    $params = [];
    $params = filter_input(INPUT_POST, 'participant_name',  FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
    if (!empty($params)) $params = array_map('trim', $params);
    return $params;
  }

  function useInput()
  {
    $trim = self::trimInput();
    $trim_participant_name = $trim;
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
  if (60 > mb_strlen($str)) {
      return true;
  }
  return false;
}

$input = new ParticipantNameClass;
$POST_participant_name = $input->useInput();
