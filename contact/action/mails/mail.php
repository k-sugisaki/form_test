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
    
        mb_language("ja");
		mb_internal_encoding("UTF-8");
        
        $setIni = parse_ini_file($this->setPath);
        $from = $setIni['from'];
        $to = $setIni['to'];
        $subject = $setIni['subject'];
        $message = $setIni['body'];
        $boundary = "__BOUNDARY__";
        
        
        $headers = "From:  $from\r\n";
		$headers .= "Content-Type: multipart/mixed; boundary=\"{$boundary}\"\n";

        if ($replace) {
            $message = str_replace('{value}', $replace, $message);
        } else {
            $message = str_replace('{value}', '', $message);
        }
        if ($inquire) {
            $message .= $setIni['body2'];
            $message = str_replace('{inquire}', $inquire, $message);
            $message = str_replace('\n', "\n", $message);
        }

        $mime_type = "application/octet-stream";
        
        $message = mb_convert_encoding($message, 'ISO-2022-JP', 'auto');
        $body = "--".$boundary."\n";
        $body .= "Content-Type: text/plain; charset=\"ISO-2022-JP\"\n\n";
        $body .= $message . "\n\n";
        $body .= "--".$boundary."\n";
        if ($files) {
            foreach ($files as $file) {
                // ファイル添付1
                if (!empty($file)) {
                    $body .= "Content-Type: ".$mime_type."; name=\"{$file['fileName']}\"\n";
                    $body .= "Content-Transfer-Encoding: base64\n";
                    $body .= "Content-Disposition: attachment; filename=\"{$file['fileName']}\"\n";
                    $body .= "\n";
                    $body .= chunk_split(base64_encode(file_get_contents($file['filePath'])));
                }
            }
        }
        $body .= "\n\n";
        $body .= "--".$boundary."--";

        if (!mb_send_mail($to, $subject, $body, $headers)) {
            error_log('mb_send_mail fail');
            return false;
        }
        return true;
    }
}
