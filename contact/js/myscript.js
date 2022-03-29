/*js*/
// ボタンを押したら参加人数を追加できる
function addForm() {
const ELEMENTS = document.getElementById("target");
const copied = ELEMENTS.lastElementChild.cloneNode(true);
ELEMENTS.appendChild(copied);
}
// ボタンにイベントハンドラをセット
const BTN = document.getElementById("add"); 
BTN.addEventListener("click", addForm, false);

// 2人目以降の参加者から（代表者）を削除
// うまくいっていないので相談する
$('.representative:nth-child(n+2)').remove();

// 代表者のみの入力項目を削除（法人名・電話番号・会員or一般）
// うまくいっていないので相談する
$('.primary_only:nth-child(n+2)').remove();