<?php
function ae_send_mail($from, $to, $subject, $text, $headers="")
{
    if (strtolower(substr(PHP_OS, 0, 3)) === 'win')
        $mail_sep = "\r\n";
    else
        $mail_sep = "\n";

    function _rsc($s)
    {
        $s = str_replace("\n", '', $s);
        $s = str_replace("\r", '', $s);
        return $s;
    }

    $h = '';
    if (is_array($headers))
    {
        foreach($headers as $k=>$v)
            $h = _rsc($k).': '._rsc($v).$mail_sep;
        if ($h != '') {
            $h = substr($h, 0, strlen($h) - strlen($mail_sep));
            $h = $mail_sep.$h;
        }
    }

    $from = _rsc($from);
    $to = _rsc($to);
    $subject = _rsc($subject);
    mail($to, $subject, $text, 'From: '.$from.$h);
}
?>