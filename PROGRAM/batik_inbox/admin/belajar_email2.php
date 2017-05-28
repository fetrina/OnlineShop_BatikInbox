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
<?php $site_admin = 'webmaster@localhost';

// function ae_send_mail (see code above) is pasted here

if (($_SERVER['REQUEST_METHOD'] == 'POST') &&
    isset($_POST['subject']) && isset($_POST['text']) &&
    isset($_POST['from1']) && isset($_POST['from2']))
    {
        $from = $_POST['from1'].' <'.$_POST['from2'].'>';
        // nice RFC 2822 From field

        ae_send_mail($from, $site_admin, $_POST['subject'], $_POST['text'],
        array('X-Mailer'=>'PHP script at '.$_SERVER['HTTP_HOST']));
        $mail_send = true;
    }
?>
<html><head><title>Send us mail</title>
</head><body>
<?php
if (isset($mail_send)) {
    echo '<h1>Form has been sent, thank you</h1>';
}
else {
?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
Your Name: <input type="text" name="from1" size="30" /><br />
Your Email: <input type="text" name="from2" size="30" /><br />
Subject: <input type="text" name="subject" size="30" /><br />
Text: <br />
<textarea rows="5" cols="40" name="text"></textarea>
<input type="submit" value="send" />
</form>
<?php } ?>
</body></html>