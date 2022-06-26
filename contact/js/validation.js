//電話番号入力
const telInput = document.getElementById("tel");
const errorTel = document.getElementById("error-tel");
if (telInput) {
  telInput.addEventListener("blur",() => {
    replaceStr();
    checkInputValue();
    countValue();
  }, false);
}

function replaceStr(){
  let telInputValue = telInput.value;
  telInputValue = telInputValue.replace(/[-ー―‐－]/g, "");
  const replacedValue = telInputValue.replace(/[０-９]/g, function (str) {
    return String.fromCharCode(str.charCodeAt(0) - 0xfee0);
  });
  telInput.value = replacedValue;
}

function checkInputValue(){
  if (!telInput.value.match(/^[0-9]+$/)){
    errorTel.textContent = "半角数字を入力してください";
  }
}

function countValue(){
  if(telInput.value.length > 11){
    errorTel.textContent = "11文字以内で入力してください";
  }
}