<?php

$url = "./data/seminarList.json";
$json = file_get_contents($url);
$arr = json_decode($json, true);

class Seminar
{
  public function createSeminarList($arr)
  {
    foreach ($arr as $seminar) {
      $title = $seminar["title"];
      $bool_zoom = $seminar["holding_by_zoom"];

      echo '<div class = "seminar__item">';
      self::createCheckbox($title);
      self::createRadio($bool_zoom);
      self::createTextbox();
      echo '</div>';
    };
  }
  function createCheckbox($title)
  {
    echo '<input type="checkbox" name="seminar[]" value="'.$title.'" />', $title;
  }
  function createRadio($bool_zoom)
  {
    if ($bool_zoom) {
      echo '<span>';
      echo '<label>参加方法</label>';
      echo '<input type="radio" name="entry_method[]" value="venue" />会場';
      echo '<input type="radio" name="entry_method[]" value="zoom" />ZOOM';
      echo '</span>';
    } else {
      echo '<input type="hidden" name="entry_method[]" value="venue" />';
    }
  }
  function createTextbox()
  {
    echo '<label>テキスト</label>';
    echo '<input type="text" name="seminar_text[]" class="required" />冊';
  }
}
