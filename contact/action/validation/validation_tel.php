<?php
class TelClass
{
  function trimInput()
  {
    $params = [];
    $params["tel"] = trim(filter_input(INPUT_POST, 'tel'));
    return $params;
  }

  function useInput()
  {
    $trim = self::trimInput();
    $trim_tel = $trim['tel'];
    return $trim_tel;
  }
}

$input = new TelClass;
$POST_tel = $input->useInput();
