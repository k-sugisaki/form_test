<?php get_header(); ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/contact/css/complete.css">
<div class="massage">
  <h1 class="message__title">お申込みを受付けました。</h1>
  <p class="massage__text">ご入力頂いたメールアドレス宛に、お申込み内容の確認メールを自動送信しております。<br>
    以下の内容でお申込みを受付けいたしました。</p>
  <p class="massage__text">内容にお間違いがないか必ずご確認ください。<br>
    後日、担当者よりご連絡いたしますので、今しばらくお待ちくださいませ。</p>
  <p class="massage__text">※しばらく経ってもメールが届かない場合は、恐れ入りますが<a href="http://www.koujimachi.or.jp/inquiry/">お問合せフォーム</a>よりお知らせください。</p>
</div>
<div class="confirmation">
  <h2 class="confirmation__title">お申込み内容</h2>
  <?php foreach ((array)$seminar_list as $val1) : ?>
    <!--  空データの場合スキップ -->
    <?php if (empty($val1)) continue; ?>
    <div class="confirmation__seminar-title"><?php echo $val1[0] ?></div>
    <!--  参加者データループ -->
    <p>参加方法：<?php echo METHOD[$val1[1]] ?></p>
    <p>テキスト部数：<?php echo $val1[2] ?>冊</p>
    <p>法人名：<?php echo $corp_name ?></p>
    <p>電話番号：<?php echo $tel ?></p>
    <p>会員ステータス：<?php echo CATEGORY[$category] ?></p>
    <?php foreach ($name as $idx => $val2) : ?>
      <p class="confirmation__participant">	&lt;参加者<?php echo $idx + 1 ?>&gt;</p>
      <p>参加者名：<?php echo $val2 ?></p>
      <p>フリガナ：<?php echo $name_kana[$idx] ?></p>
      <p>メールアドレス：<?php echo $mail[$idx] ?></p>
    <?php endforeach; ?>
  <?php endforeach; ?>
</div>
<?php get_footer(); ?>