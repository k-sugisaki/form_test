<?php
/*
Template Name: 固定ページ／麹町法人会について
*/
?>
<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
  ob_start();
}
?>
<?php get_header(); ?>
<?php
require_once get_template_directory() . '/contact/config/index.php';
if(
    isset($_SESSION['csrf_token']) && !empty($_SESSION['csrf_token']) && isset($_SESSION['finish'])
) {
    $corp_name = $_SESSION['corp_name'];
    $tel = $_SESSION['tel'];
    $category = $_SESSION['category'];
    $name = $_SESSION['participant_name'];
    $name_kana = $_SESSION['participant_name_kana'];
    $mail = $_SESSION['mail'];
    // $user_name = $_SESSION['user_name'];
    $seminar = $_SESSION['seminar'];
    $seminar_list = $_SESSION['seminar_list'];
    
    include_once get_template_directory() . '/contact/action/views/complete_view.php';
    
    $_SESSION = array();
    session_destroy();
} else { 
    header('Location: ../index.php');
}
?>
<script src="<?php echo get_template_directory_uri(); ?>/contact/js/complete.js"></script>
<?php get_footer(); ?>