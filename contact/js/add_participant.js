/*js*/
// ボタンを押したら参加人数を追加できる

const addArea = document.getElementById("add_participantArea");
let id = 2;
const counter = document.getElementById("participant_count");
counter.value = 0;

document.getElementById("add").onclick = function () {
  console.log(counter.value);
  let html = "";
  html += '<div class="participant_info">';
  html += '<div class="off"><img src="img/cross.png" /></div>';
  html += '<dl>';
  html += '<dt class="name">';
  html += `<label for="participant_name_${id}">参加者名:<span class="required-text">*必須</span></label>`;
  html += `<span class="error-php"></span>`;
  html += '</dt>';
  html += '<dd><input type="text" name="participant_name[]" data-error-required="お名前は必須です。" value="" class="required" /></dd>';
  html += '</dl>';
  html += '<dl>';
  html += '<dt class="name_kana">';
  html += `<label for="participant_name_kana_${id}">フリガナ:<span class="required-text">*必須</span></label>`;
  html += `<span class="error-php"></span>`;
  html += '</dt>';
  html += `<dd><input type="text" name="participant_name_kana[]" value="" class="required" /></dd>`;
  html += '</dl>';
  html += '<dl>';
  html += '<dt class="mail">';
  html += `<label for="mail_${id}">メールアドレス:<span class="required-text">*必須</span></label>`;
  html += `<span class="error-php"></span>`;
  html += '</dt>';
  html += `<dd><input type="email" id="mail_${id}" name="mail[]" required value="" class="required" /></dd>`;
  html += '</dl>';
  html += '</div>';
  addArea.insertAdjacentHTML("beforeend", html);
  id++;
  counter.value++;
};

/* 参加者削除ボタン */
/* jQuery */
$(document).on("click", '.off', function (e) {
  const test = $(e.target).closest(".participant_info");
  console.log(test);
  test.remove();
  counter.value--;
});