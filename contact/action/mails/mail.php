<?php

namespace  Mail;

/**
 * メール送信
 */
class MailModel
{
    // ファイル出力場所指定
    private $template = "csv_send.ini";
    private $commonPath = __DIR__ . "../../../config/MailTmp/";
    private $setPath;

    public function __construct($template = null)
    {
        if (!$template) $template = $this->template;
        $this->setPath = $this->commonPath . $this->template;
    }

    /**
     * メール送信処理
     *
     * @param string $replace
     * @param array $files
     * @return void
     */
    public function sendMadil($replace = null, $inquire = null, $files = [])
    {
        $setIni = parse_ini_file($this->setPath);
        $from = $setIni['from'];
        $to = $setIni['to'];
        $subject = $setIni['subject'];
        $message = $setIni['body'];
        $headers = "From:  $from";

        if ($replace) {
            $message = str_replace('{value}', $replace, $message);
        } else {
            $message = str_replace('{value}', '', $message);
        }
        if ($inquire) {
            $message .= $setIni['body2'];
            $message = str_replace('{inquire}', $inquire, $message);
        }

        mb_language("ja");
        mb_internal_encoding('utf-8');
        $message = mb_convert_encoding($message, 'ISO-2022-JP', 'auto');
        $body = "--__BOUNDARY__\n";
        $body .= "Content-Type: text/plain; charset=\"ISO-2022-JP\"\n\n";
        $body .= $message . "\n";
        $body .= "--__BOUNDARY__\n";

        if ($files) {
            echo $files;
            foreach ($files as $file) {
                // ファイル添付1
                if (!empty($file)) {
                    $body .= "Content-Type: application/octet-stream; name=\"{$file['fileName']}\"\n";
                    $body .= "Content-Disposition: attachment; filename=\"{$file['fileName']}\"\n";
                    $body .= "Content-Transfer-Encoding: base64\n";
                    $body .= "\n";
                    $body .= chunk_split(base64_encode(file_get_contents($file['filePath'])));
                    $body .= "--__BOUNDARY__\n";
                }
            }
        }
        if (!mb_send_mail($to, $subject, $body, $headers)) {
            error_log('mb_send_mail fail');
            return false;
        }
        return true;
    }
}
