$("#submitted").on('click',function() {

  // ボタンを無効にする
  function submitBtnDisable(){
    $("#submitted").prop("disabled", true);
    $("#submitted").addClass("isDisable");
    clearInterval(statusDis);
  }

  // ボタンを有効にする
  function submitBtnAble(){
    $("#submitted").prop("disabled", false);
    $("#submitted").removeClass("isDisable");
    clearInterval(statusAble);
  }

  function submitBtnClicked(){
    statusDis = setInterval(submitBtnDisable, 1);
    statusAble = setInterval(submitBtnAble, 3000);
  }
  submitBtnClicked();
});