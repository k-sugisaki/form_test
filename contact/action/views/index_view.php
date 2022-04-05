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
        <?php foreach ($arr as $seminar) : ?>
          <div class="seminar__item">
            <div>
              <?= '<input type="checkbox" id="checkbox_' . $seminar["id"] . '" name="seminar_' . $seminar["id"] . '" />' ?>
              <?= '<label for="checkbox_' . $seminar["id"] . '">' . $seminar["title"] . '</label>' ?>
            </div>
            <?php if ($seminar["holding_by_zoom"]) : ?>
              <div>
                <span>参加方法</span>
                <?= '<label><input type="radio" name="entry_method_' . $seminar["id"] . '" value="venue" />会場</label>' ?>
                <?= '<label><input type="radio" name="entry_method_' . $seminar["id"] . '" value="zoom" />ZOOM</label>' ?>
              </div>
            <?php else : ?>
              <?= '<input type="hidden" name="entry_method_' . $seminar["id"] . '" value="venue" />' ?>
            <?php endif; ?>
            <div>
              <?= '<label for="seminar_text_' . $seminar["id"] . '">テキスト</label>' ?>
              <?= '<input type="text" id="seminar_text_' . $seminar["id"] . '" name="seminar_text_' . $seminar["id"] . '" />冊' ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <dl>
        <dt class="corp_name">
          <label for="corp_name">法人名:</label>
          <span class="error-php"><?php if (isset($error['corp_name'])) echo $error['corp_name']; ?></span>
          </span>
        </dt>
        <dd><input type="text" id="corp_name" name="corp_name" required class="required" /></dd>
      </dl>
      <dl>
        <dt class="tel">
          <label for="tel">電話番号:</label>
          <span class="error-php"><?php if (isset($error['tel'])) echo $error['tel']; ?></span>
        </dt>
        <dd><input type="tel" id="tel" name="tel" required class="required" /></dd>
      </dl>
      <dl>
        <dd>
        <dt class="category">
          <span class="error-php"><?php if (isset($error['category'])) echo $error['category']; ?></span>
        </dt>
        <label><input type="radio" name="category" value="member" />会員</label>
        <label><input type="radio" name="category" value="not-member" />一般</label>
        </dd>
      </dl>
      <div class="participant_info">
        <dl>
          <dt class="name">
            <label for="participant_name_1">参加者名:</label>
            <span class="error-php"><?php if (isset($error['name'])) echo $error['name']; ?></span>
          </dt>
          <dd><input type="text" name="participant_name[]" data-error-required="お名前は必須です。" class="required" /></dd>
        </dl>
        <dl>
          <dt class="name_kana">
            <label for="participant_name_kana_1">フリガナ:</label>
            <span class="error-php"><?php if (isset($error['name_kana'])) echo $error['name_kana']; ?></span>
          </dt>
          <dd><input type="text" name="participant_name_kana[]" class="required" /></dd>
        </dl>
        <dl>
          <dt class="mail">
          <label for="mail_1">メールアドレス:</label>
            <span class="error-php"><?php if (isset($error['mail'])) echo $error['mail']; ?></span>
          </dt>
          <dd><input type="email" id="mail_1" name="mail_1" required class="required" /></dd>
        </dl>
      </div>
      <div class="participant_info">
        <dl>
          <dt class="name">
            <label for="participant_name_2">参加者名:</label>
            <span class="error-php"><?php if (isset($error['name'])) echo $error['name']; ?></span>
          </dt>
          <dd><input type="text" name="participant_name[]" data-error-required="お名前は必須です。" class="required" /></dd>
        </dl>
        <dl>
          <dt class="name_kana">
            <label for="participant_name_kana_2">フリガナ:</label>
            <span class="error-php"><?php if (isset($error['name_kana'])) echo $error['name_kana']; ?></span>
          </dt>
          <dd><input type="text" name="participant_name_kana[]" class="required" /></dd>
        </dl>
        <dl>
          <dt class="mail">
          <label for="mail_2">メールアドレス:</label>
            <span class="error-php"><?php if (isset($error['mail'])) echo $error['mail']; ?></span>
          </dt>
          <dd><input type="email" id="mail_2" name="mail_2" required class="required" /></dd>
        </dl>
      </div>
      <input type="hidden" name="participant_count" value="2">
      <button name="submitted" type="submit" class="btn btn-primary">送信</button>
      <input type="hidden" name="csrf_token" value="<?=$csrf_token?>">
    </form>
  </main>
</body>

</html>