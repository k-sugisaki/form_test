<?php

$INPUT_mail = filter_input(INPUT_POST, 'mail', FILTER_VALIDATE_EMAIL);
$POST_mail = array_map('trim', $INPUT_mail);
