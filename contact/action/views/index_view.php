<!doctype html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>お申込みフォーム | 公益社団法人 麹町法人会</title>
  <link rel="stylesheet" href="./css/style.css">
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

    <h2 class="form-title">お申込みフォーム</h2>
    <form action="" method="post" class="validationForm">
      <div class="seminar__list">
        <p class="item__title">
          タイトル名<span class="required-text">*必須（複数選択可能です）</span>
        </p>
        <?php foreach ($arr as $index => $seminar) : ?>
          <div class="seminar__item">
            <div>
              <input type="hidden" name="<?= 'seminar[' . $index . '][seminar_title]' ?>" value="0" />
              <?php if ($view_flag === 2 && (isset($POST_seminars[$index]) && (isset($POST_seminars[$index][0]) && $POST_seminars[$index][0] == $seminar["title"]))) : ?>
                <label><input type="checkbox" name="<?= 'seminar[' . $index . '][seminar_title]' ?>" value="<?= $seminar["title"] ?>" checked /><?= $seminar["title"] ?></label>
              <?php else : ?>
                <label><input type="checkbox" name="<?= 'seminar[' . $index . '][seminar_title]' ?>" value="<?= $seminar["title"] ?>" /><?= $seminar["title"] ?></label>
              <?php endif; ?>
            </div>
            <div class="seminar-item__entry-metod">
              <?php if ($seminar["holding_by_zoom"]) : ?>
                <span>参加方法</span>
                <?php if ($view_flag === 1) : ?>
                  <label class="radio-previous"><input type="radio" name="<?= 'seminar[' . $index . '][entry_method]' ?>" value="venue" /><?=METHOD['venue']?></label>
                  <label class="radio-behind"><input type="radio" name="<?= 'seminar[' . $index . '][entry_method]' ?>" value="zoom" /><?=METHOD['zoom']?></label>
                <?php else : ?>
                  <label class="radio-previous"><input type="radio" name="<?= 'seminar[' . $index . '][entry_method]' ?>" value="venue" <?php if (isset($POST_seminars[$index]) && (isset($POST_seminars[$index][1]) && $POST_seminars[$index][1] == "venue")): ?> checked <?php endif; ?> /><?=METHOD['venue']?></label>
                  <label class="radio-behind"><input type="radio" name="<?= 'seminar[' . $index . '][entry_method]' ?>" value="zoom" <?php if (isset($POST_seminars[$index]) && (isset($POST_seminars[$index][1]) && $POST_seminars[$index][1] == "zoom")): ?> checked <?php endif;?> /><?=METHOD['zoom']?></label>
                <?php endif; ?>
              <?php else : ?>
                <input type="hidden" name="<?= 'seminar[' . $index . '][entry_method]' ?>" value="venue" />
              <?php endif; ?>
              <span class="error-php"><?php if (isset($error['seminar_method_'.$index])) echo $error['seminar_method_'.$index]; ?></span>
            </div>
            <div class="seminar-item__seminar-text">
              <label for="<?= 'seminar_text_' . $index ?>">テキスト</label>
              <?php if ($view_flag === 2 && isset($POST_seminars[$index]) && isset($POST_seminars[$index][2])) : ?>
                <input type="text" id="<?= 'seminar_text_' . $index ?>" name="<?= 'seminar[' . $index . '][seminar_text]' ?>" value="<?= $POST_seminars[$index][2] ?>" class="input__seminar-text" />冊
              <?php else : ?>
                <input type="text" id="<?= 'seminar_text_' . $index ?>" name="<?= 'seminar[' . $index . '][seminar_text]' ?>" class="input__seminar-text" />冊
              <?php endif; ?>
              <span class="error-php"><?php if (isset($error['seminar_text_'.$index])) echo $error['seminar_text_'.$index]; ?></span>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="info__common">
        <dl>
          <dt class="corp_name">
            <label for="corp_name">法人名:<span class="required-text">*必須</span></label>
            <span class="error-php"><?php if (isset($error['corp_name'])) echo $error['corp_name']; ?></span>
            </span>
          </dt>
          <dd><input type="text" id="corp_name" name="corp_name" required class="required" value="<?= $POST_corp_name ?>" /></dd>
        </dl>
        <dl>
          <dt class="tel">
            <label for="tel">電話番号:<span class="required-text">*必須</span></label>
            <span class="error-php"><?php if (isset($error['tel'])) echo $error['tel']; ?></span>
          </dt>
          <dd><input type="tel" id="tel" name="tel" required class="required" value="<?= $POST_tel ?>" /></dd>
        </dl>
        <dl>
          <dd>
          <dt class="category">
            <span class="error-php"><?php if (isset($error['category'])) echo $error['category']; ?></span>
          </dt>
          <label class="radio-previous"><input type="radio" name="category" value="member" <?php if (isset($_POST['category']) && $_POST['category'] === 'member') echo 'checked' ?> /><?=CATEGORY['member']?></label>
          <label class="radio-behind"><input type="radio" name="category" value="not-member" <?php if (isset($_POST['category']) && $_POST['category'] === 'not-member') echo 'checked' ?> /><?=CATEGORY['not-member']?></label>
          <span class="required-text">*必須(どちらか選択してください)</span>
          </dd>
        </dl>
      </div>
      <?php if ($view_flag === 1) : ?>
        <div class="participant_info">
          <dl>
            <dt class="name">
              <label for="participant_name_1">参加者名:<span class="required-text">*必須</span></label>
              <span class="error-php"><?php if (isset($error['name_1'])) echo $error['name_1']; ?></span>
            </dt>
            <dd><input type="text" name="participant_name[]" data-error-required="お名前は必須です。" class="required" /></dd>
          </dl>
          <dl>
            <dt class="name_kana">
              <label for="participant_name_kana_1">フリガナ:<span class="required-text">*必須</span></label>
              <span class="error-php"><?php if (isset($error['name_kana_1'])) echo $error['name_kana_1']; ?></span>
            </dt>
            <dd><input type="text" name="participant_name_kana[]" class="required" /></dd>
          </dl>
          <dl>
            <dt class="mail">
              <label for="mail_1">メールアドレス:<span class="required-text">*必須</span></label>
              <span class="error-php"><?php if (isset($error['mail_1'])) echo $error['mail_1']; ?></span>
            </dt>
            <dd><input type="email" id="mail_1" name="mail[]" required class="required" /></dd>
          </dl>
        </div>
        <input type="hidden" name="participant_count" value="0" id="participant_count">
      <?php else : ?>
        <?php foreach ($POST_participant_name as $id => $val) : ?>
          <div class="participant_info">
            <dl>
              <dt class="name">
                <label for="participant_name_<?= $id ?>">参加者名:<span class="required-text">*必須</span></label>
                <span class="error-php"><?php if (isset($error['name_' . $id])) echo $error['name_' . $id]; ?></span>
              </dt>
              <dd><input type="text" name="participant_name[]" data-error-required="お名前は必須です。" <?php if (isset($val)) : ?> value="<?= $val ?>" <?php endif; ?>class="required" /></dd>
            </dl>
            <dl>
              <dt class="name_kana">
                <label for="participant_name_kana_<?= $id ?>">フリガナ:<span class="required-text">*必須</span></label>
                <span class="error-php"><?php if (isset($error['name_kana_' . $id])) echo $error['name_kana_.$id']; ?></span>
              </dt>
              <dd><input type="text" name="participant_name_kana[]" <?php if (isset($POST_participant_name_kana[$id])) : ?> value="<?= $POST_participant_name_kana[$id] ?>" <?php endif; ?> class="required" /></dd>
            </dl>
            <dl>
              <dt class="mail">
                <label for="mail_<?= $id ?>">メールアドレス:<span class="required-text">*必須</span></label>
                <span class="error-php"><?php if (isset($error['mail_' . $id])) echo $error['mail_' . $id]; ?></span>
              </dt>
              <dd><input type="email" id="mail_<?= $id ?>" name="mail[]" required <?php if (isset($POST_mail[$id])) { ?> value="<?= $POST_mail[$id] ?>" <?php } ?>class="required" /></dd>
            </dl>
          </div>
        <?php endforeach; ?>
        <input type="hidden" name="participant_count" <?php if (isset($id)) : ?> value="<?= $id ?>" <?php endif; ?> id="participant_count">
      <?php endif; ?>
      <div id="add_participantArea"></div>
      <!-- 参加人数追加ボタン 始まり-->
      <div id="add" class="addition_button">
        <div class="position">
          <img src="img/add_square_icon.png" />
          <span>(参加人数を追加する)</span>
        </div>
      </div>
      <!-- 参加人数追加ボタン 終わり-->
      <div class="contact_detail">
        <label for="message" class="label">お問合せ内容</label>
        <textarea name="message" cols="120" rows="10" class="form-width" aria-required="true" aria-invalid="false"></textarea>
      </div>
      <button name="submitted" type="submit" class="btn btn-primary">送信する</button>
      <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
    </form>
  </main>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="./js/add_participant.js"></script>
</body>

</html>