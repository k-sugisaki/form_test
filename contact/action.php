<!-- http://localhost:8888/php/action.php を開くとcsvが出力される-->
<?php

$data = [
    array(
        'corp_name' => '法人名',
        'tel' => '電話番号',
        'category' => '会員区分',
        'name' => '参加者名',
        'name_kana' => 'フリガナ',
        'mail' => 'メールアドレス',
    ),
    array(
        'corp_name' => $corp_name,
        'tel' => $tel,
        'category' => $category,
        'name' => $name,
        'name_kana' => $name_kana,
        'mail' => $mail,
        )
];
 
$save_path = "sample.csv";

/**
 * CSVを生成
 * @param array CSVに変換する2次元配列
 * @param string CSVの保存先
 * @return csv
 */
function create_csv($data, $save_path)
{

  //一時データを開く
  $fp = fopen('php://temp', 'r+b');
 
  //fputcsvでCSVデータを作る
  foreach ($data as $val) {
    fputcsv($fp, $val);
  }
 
  //ファイルポインタを先頭に戻す
  rewind($fp);
 
  //ストリームの中身をテキストデータに変換、
  //さらにテキストデータをUTF-8からSJIS-winに変換する
  $str = str_replace(PHP_EOL, "\r\n", stream_get_contents($fp));
  $str = mb_convert_encoding($str, 'SJIS-win', 'UTF-8');
 
  //一時データのファイルポインタを閉じる
  fclose($fp);
 
  //CSVファイルを生成して、データを書き込んで保存する
  $fp2 = fopen($save_path, "w");
  fwrite($fp2, $str);
  fclose($fp2);
}

create_csv($data, $save_path);
?>