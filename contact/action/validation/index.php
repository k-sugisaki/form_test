<?php
//　セミナー
require_once get_template_directory() . VALIDATION_DIR . '/validation_common.php';
require_once get_template_directory() . VALIDATION_DIR . '/validation_corpName.php';
require_once get_template_directory() . VALIDATION_DIR . '/validation_tel.php';
require_once get_template_directory() . VALIDATION_DIR . '/validation_category.php';

// 顧客
require_once get_template_directory() . VALIDATION_DIR . '/validation_participantName.php';
require_once get_template_directory() . VALIDATION_DIR . '/validation_participantNameKana.php';
require_once get_template_directory() . VALIDATION_DIR . '/validation_mail.php';
require_once get_template_directory() . VALIDATION_DIR . '/validation_category.php';

//お問合せ
require_once get_template_directory() . VALIDATION_DIR . '/validation_inquire.php';
