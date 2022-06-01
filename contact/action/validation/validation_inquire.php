<?php
class InquireClass
{
  function trimInput()
  {
    $params = [];
    $params["inquire"] = trim(filter_input(INPUT_POST, 'message'));
    return $params;
  }

  function useInput()
  {
    $trim = self::trimInput();
    $trim_inquire = $trim['inquire'];
    return $trim_inquire;
  }
}

$input = new InquireClass;
$POST_inquire = $input->useInput();
