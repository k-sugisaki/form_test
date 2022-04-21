/*js*/
// ボタンを押したら参加人数を追加できる

document.getElementById("add").onclick = function(){
  var mydiv = document.getElementById("new");
    let html ="";
    html += '<div class="entrant ">'
    html += '<div class="primary_only hide">'
    html += '<div class="container">'
    html += '<p class="item">'
    html += '法人名 <span class="required">*必須</span></p>'
    html += '<p class="input">'
    html += '<span class="corporation">'
    html += '<input type="text" name="corporation" value="" size="47" class="form-width" aria-required="true" aria-invalid="false"/></span></p>'
    html += '</div>'
    html += '<div class="container">'
    html += '<p class="item">'
    html += '電話番号 <span class="required">*必須</span></p>'
    html += '<p class="input">'
    html += '<span class="tel"><input type="tel" name="tel" value="" size="47" class="form-width" aria-required="true" aria-invalid="false"/></span></p>'
    html += '</div>'
    html += '<div class="container member">'
    html += '<p class="item">'
    html += '<label><input type="radio" name="level" value="member" />会員</label>'
    html += '<label><input type="radio" name="level" value="ordinary" />一般</label>'
    html += '<span class="required">&nbsp;*必須(どちらか選択してください)</span>'
    html += '</p></div></div>'
    html += '<div class="container">'
    html += '<p class="item">'
    html += '参加者名<span class="required">*必須</span></p>'
    html += '<p class="input">'
    html += '<span class="participant"><input type="text" name="participant" value="" size="47" class="form-width" aria-required="true" aria-invalid="false"/></span></p>'
    html += '</div>'
    html += '<div class="container">'
    html += '<p class="item">フリガナ <span class="required">*必須</span></p>'
    html += '<p class="input">'
    html += '<span class="participant-2"><input type="text" name="participant-2" value="" size="47" class="form-width" aria-required="true" aria-invalid="false"/></span></p>'
    html += '</div>'
    html += '<div class="container">'
    html += '<p class="item">メールアドレス <span class="required">*必須</span></p>'
    html += '<p class="input">'
    html += '<span class="mail"><input type="email" name="mail" value="" size="47" class="form-width" aria-required="true" aria-invalid="false"/></span></p>'
    html += '</div>'
    html += '<div class="button"><div id="off" class="off"><img src="img/cross.png" /></div></div>'
    mydiv.insertAdjacentHTML('beforeend',html);
    /* 参加者削除ボタン */
    document.getElementById("off").onclick = function(){
      mydiv.remove();
    }
  }