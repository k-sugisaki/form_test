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
                <?= '<input type="radio" id="entry_venue_' . $seminar["id"] . '" name="entry_method_' . $seminar["id"] . '" value="venue" />' ?>
                <?= '<label for="entry_venue_' . $seminar["id"] . '">会場</label>' ?>
                <?= '<input type="radio" id="entry_zoom_' . $seminar["id"] . '" name="entry_method_' . $seminar["id"] . '" value="zoom" />' ?>
                <?= '<label for="entry_zoom_' . $seminar["id"] . '">ZOOM</label>' ?>
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
        <input type="radio" id="category_member" name="category" value="member" />
        <label for="category_member">会員</label>
        <input type="radio" id="category_not-member" name="category" value="not-member" />
        <label for="category_not-member">一般</label>
        </dd>
      </dl>
      <div class="participant_info">
        <dl>
          <dt class="name">参加者名:
            <span class="error-php"><?php if (isset($error['name'])) echo $error['name']; ?></span>
          </dt>
          <dd><input type="text" name="participant_name[]" data-error-required="お名前は必須です。" class="required" /></dd>
        </dl>
        <dl>
          <dt class="name_kana">フリガナ:
            <span class="error-php"><?php if (isset($error['name_kana'])) echo $error['name_kana']; ?></span>
          </dt>
          <dd><input type="text" name="participant_name_kana[]" class="required" /></dd>
        </dl>
        <dl>
          <dt class="mail">メールアドレス:
            <span class="error-php"><?php if (isset($error['mail'])) echo $error['mail']; ?></span>
          </dt>
          <dd><input type="text" name="mail[]" class="required" /></dd>
        </dl>
      </div>
      <div class="participant_info">
        <dl>
          <dt class="name">参加者名:
            <span class="error-php"><?php if (isset($error['name'])) echo $error['name']; ?></span>
          </dt>
          <dd><input type="text" name="participant_name[]" data-error-required="お名前は必須です。" class="required" /></dd>
        </dl>
        <dl>
          <dt class="name_kana">フリガナ:
            <span class="error-php"><?php if (isset($error['name_kana'])) echo $error['name_kana']; ?></span>
          </dt>
          <dd><input type="text" name="participant_name_kana[]" class="required" /></dd>
        </dl>
        <dl>
          <dt class="mail">メールアドレス:
            <span class="error-php"><?php if (isset($error['mail'])) echo $error['mail']; ?></span>
          </dt>
          <dd><input type="text" name="mail[]" class="required" /></dd>
        </dl>
      </div>
      <button name="submitted" type="submit" class="btn btn-primary">送信</button>
      <input type="hidden" name="csrf_token" value="<?=$csrf_token?>">
    </form>
  </main>
</body>

</html>