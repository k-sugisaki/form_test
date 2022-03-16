<?php

$url = "./data/seminarList.json";
$json = file_get_contents($url);
$arr = json_decode($json, true);

?>