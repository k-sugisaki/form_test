<?php
class MailClass
{
  function trimInput()
  {
    $params = [];
    $params["mail"] = trim(filter_input(INPUT_POST, 'mail', FILTER_VALIDATE_EMAIL));
    return $params;
  }

  function useInput()
  {
    $trim = self::trimInput();
    $trim_mail = $trim['mail'];
    return $trim_mail;
  }
}

$input = new MailClass;
$POST_mail = $input->useInput();
