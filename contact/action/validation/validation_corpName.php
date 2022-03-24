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

$input = new CorpNameClass;
$POST_corp_name = $input->useInput();
