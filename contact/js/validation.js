//電話番号入力
const telInput = document.getElementById('tel');

telInput.addEventListener('blur', ()=>{
  let telInputValue = telInput.value;
  telInputValue = telInputValue.replace(/[-ー―‐－]/g, '');
  const replacedValue = telInputValue.replace(/[０-９]/g,
  function(str){
    return String.fromCharCode(str.charCodeAt(0) - 0xFEE0)
  });
  telInput.value = replacedValue;
}, false);


const submitBtn = document.getElementById('submit');
submitBtn.addEventListener('click', ()=>{
  isCheck();
});

function isCheck() {
	const arr_checkBoxes = document.getElementsByClassName("checkBoxes");
	let count = 0;
	for (let i = 0; i < arr_checkBoxes.length; i++) {
		if (arr_checkBoxes[i].checked) {
			count++;
		}
	}
	if (count > 0) {
		return true;
	} else {
		console.log("項目を1つ以上選択してください。");
		return false;
	}
}