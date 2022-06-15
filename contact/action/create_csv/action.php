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
      'category' => '会員／一般',
      'method' => '参加方法',
      'text' => 'テキスト',
    )
  ];

  // ファイル出力場所指定
  private $filePath = 'contact/data/csv';

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

    date_default_timezone_set('Asia/Tokyo');
    $save_file_name = date("YmdHis") . '.csv';
    $save_file =  $this->filePath. $save_file_name;

    //一時データを開く
    $fp = fopen('php://temp', 'r+b');

    //fputcsvでCSVデータを作る
    foreach ($this->data as $val) {
      $out1 = $this->__fCsvPut($val);

      fwrite($fp, $out1);
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
        $out2 = $this->__fCsvPut($array);

        fwrite($fp, $out2);
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
      $files[] = [
        'fileName' => $this->save_file_name,
        'filePath' => $this->save_file,
      ];
    } else {
      return false;
    }

    if (isset($inq) && $inq !== '') {
      $inquire = $inq;
    }

    if (isset($rep) && $rep !== '') {
      $replace = $rep;
    }

    $mail = new MailModel();
	return $mail->sendMadil($replace, $inquire, $files);
  }

  /**
   * CSV用書き出しデータ整形
   *
   * @param array $array
   * @return void
   */
  private function __fCsvPut($array)
  {
    $out = '';
    $row_tmp = '"';
    $row_tmp .= implode('","', $array);
    $row_tmp .= '"' . "\n";
    $out .= $row_tmp;
    return $out;
  }
}
