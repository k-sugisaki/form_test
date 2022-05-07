<?php

$INPUT_mail = filter_input(INPUT_POST, 'mail', FILTER_VALIDATE_EMAIL, FILTER_REQUIRE_ARRAY);
$POST_mail = array_map('trim', $INPUT_mail);