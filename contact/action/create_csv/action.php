<!-- http://localhost:8888/php/action.php を開くとcsvが出力される-->
<?php

use Mail\MailModel;

class CsvOutputControllor
{
  // ヘッダーデータ指定
  private $data = [
    array(
      'title' => 'タイトル名',
      'corp_name' => '法人名',
      'tel' => '電話番号',
      'name_kana' => 'フリガナ',
      'name' => '参加者名',
      'mail' => 'メールアドレス',
      'category' => '会員/一般',
      'method' => '参加方法',
      'text' => 'テキスト',
    )
  ];

  // ファイル出力場所指定
  private $save_file = "sample.csv";

  /**
   * CSVを生成
   * @param array  CSVファイルヘッダーデータ
   * @param string CSVの保存先
   * @return csv
   */
  public function create_csv()
  {
    // SESSIONデータセット
    $corp_name = $_SESSION['corp_name'];
    $tel = $_SESSION['tel'];
    $category = $_SESSION['category'];

    // 配列データ
    $name = $_SESSION['participant_name'];
    $name_kana = $_SESSION['participant_name_kana'];
    $mail = $_SESSION['mail'];
    $seminar = $_SESSION['seminar_list'];
    $inq = $_SESSION['inquire'];

    $rep = null;

    //一時データを開く
    $fp = fopen('php://temp', 'r+b');

    //fputcsvでCSVデータを作る
    foreach ($this->data as $val) {
      fputcsv($fp, $val);
    }
    // セミナーデータループ
    foreach ($seminar as $val1) {
      // 空データの場合スキップ
      if (empty($val1)) continue;
      // 参加者データループ
      foreach ($name as $idx => $val2) {
        $array = [
          'title' => $val1[0],
          'corp_name' => $corp_name,
          'tel' => $tel,
          'name_kana' => $name_kana[$idx],
          'name' =>  $val2,
          'mail' => $mail[$idx],
          'category' => CATEGORY[$category],
          'method' => METHOD[$val1[1]],
          'text' => $val1[2],
        ];
        fputcsv($fp, $array);
      }
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
    $fp2 = fopen($this->save_file,  "w");
    fwrite($fp2, $str);
    fclose($fp2);

    $files = [];
    $replace = null;
    $inquire = null;
    if (file_exists($this->save_file)) {
      $files[] = $this->save_file;
    }

    if (isset($inq) && $inq !== '') {
      $inqire = $inq;
    }

    if (isset($rep) && $rep !== '') {
      $replace = $rep;
    }


    $mail = new MailModel();
    $mail->sendMadil($replace, $inquire, $files);
  }
}


$output = new CsvOutputControllor();
$output->create_csv();
