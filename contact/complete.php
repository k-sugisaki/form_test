<?php
session_start();

$corp_name = $_SESSION['corp_name'];
$tel = $_SESSION['tel'];
$category = $_SESSION['category'];
$name = $_SESSION['name'];
$name_kana = $_SESSION['name_kana'];
$mail = $_SESSION['mail'];
$user_name = $_SESSION['user_name'];
$seminar = $_SESSION['seminar'];

require './action.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<h1>送信成功</h1>
  <p>
      以下の内容で受付いたしました。<br>
      後日、担当者よりご連絡いたしますので<br>
      今しばらくお待ちくださいませ。
  </p>
  <h2>お申込み内容</h2>
  <p><?php echo $name; ?></p>
  <!-- user_name[] の引っ張り成功 -->
  <p><?php echo $user_name[0]; ?></p>
    <!-- seminar[] の引っ張り成功 -->
  <p><?php echo $seminar[0]; ?></p>

<?php
$_SESSION = array();
session_destroy();
?>
</body>
</html>