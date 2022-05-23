
<?php get_header(); ?>
<h1>送信成功</h1>
  <p>
      以下の内容で受付いたしました。<br>
      後日、担当者よりご連絡いたしますので<br>
      今しばらくお待ちくださいませ。
  </p>
  <h2>お申込み内容</h2>
  <p><?php echo $corp_name; ?></p>
  <p><?php echo $name[0]; ?></p>
  <p><?php echo $seminar; ?></p>
  
<?php get_footer(); ?>