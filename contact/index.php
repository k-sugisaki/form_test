<?php require_once '/load.php';?>

<!doctype html>
<html lang="ja">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- CSS -->
  <link rel="stylesheet" href="./css/style.css">

  <title>PHP</title>
</head>

<body>
  <main>

    <?php
    if (isset($result) && !$result) : // 送信が失敗した場合 
    ?>
      <h1>送信失敗</h1>
      <p>申し訳ございませんが、送信に失敗しました。</p>
      <p>しばらくしてもう一度お試しになるか、メールにてご連絡ください。</p>
      <p>メール：<a href="mailto:info@example.com">Contact</a></p>
      <hr>
    <?php endif; ?>

    <h2>Form Practice</h2>
    <form action="" method="post" class="validationForm">
      <div class="seminar__list">
        <?php
        $cls = new Seminar();
        $cls->createSeminarList($arr);
        ?>
      </div>
      <dl>
        <dt class="corp_name">法人名:
          <span class="error-php">
            <?php if (isset($error['corp_name'])) : ?>
              <?= $error['corp_name']; ?>
            <?php endif; ?>
          </span>
        </dt>
        <dd><input type="text" name="corp_name" class="required" /></dd>
      </dl>
      <dl>
        <dt class="tel">電話番号:
          <span class="error-php"><?php if (isset($error['tel'])) echo $error['tel']; ?></span>
        </dt>
        <dd><input type="text" name="tel" class="required" /></dd>
      </dl>
      <dl>
        <dd>
        <dt class="category">
          <span class="error-php"><?php if (isset($error['category'])) echo $error['category']; ?></span>
        </dt>
        <input type="radio" name="category" value="member" />会員
        <input type="radio" name="category" value="not-member" />一般
        </dd>
      </dl>
      <div class="participant_info">
        <dl>
          <dt class="name">参加者名:
            <span class="error-php"><?php if (isset($error['name'])) echo $error['name']; ?></span>
          </dt>
          <dd><input type="text" name="user_name[]" data-error-required="お名前は必須です。" class="required" /></dd>
        </dl>
        <dl>
          <dt class="name_kana">フリガナ:
            <span class="error-php"><?php if (isset($error['name_kana'])) echo $error['name_kana']; ?></span>
          </dt>
          <dd><input type="text" name="user_name_kana[]" class="required" /></dd>
        </dl>
        <dl>
          <dt class="mail">メールアドレス:
            <span class="error-php"><?php if (isset($error['mail'])) echo $error['mail']; ?></span>
          </dt>
          <dd><input type="text" name="user_mail[]" class="required" /></dd>
        </dl>
      </div>
      <div class="participant_info">
        <dl>
          <dt class="name">参加者名:
            <span class="error-php"><?php if (isset($error['name'])) echo $error['name']; ?></span>
          </dt>
          <dd><input type="text" name="user_name[]" data-error-required="お名前は必須です。" class="required" /></dd>
        </dl>
        <dl>
          <dt class="name_kana">フリガナ:
            <span class="error-php"><?php if (isset($error['name_kana'])) echo $error['name_kana']; ?></span>
          </dt>
          <dd><input type="text" name="user_name_kana[]" class="required" /></dd>
        </dl>
        <dl>
          <dt class="mail">メールアドレス:
            <span class="error-php"><?php if (isset($error['mail'])) echo $error['mail']; ?></span>
          </dt>
          <dd><input type="text" name="user_mail[]" class="required" /></dd>
        </dl>
      </div>
      <button name="submitted" type="submit" class="btn btn-primary">送信</button>
    </form>
  </main>
</body>

</html>