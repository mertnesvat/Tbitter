<?php
echo 'Selam!';
require_once 'lib/swift_required.php';

// Create the Transport
$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', '465' , 'ssl')
->setUsername('enes.korukcu@egnity.com')
->setPassword('13579#epi')
;
echo 'Transpord<br><pre>';
var_dump($transport);
echo '</pre>';
/*
 You could alternatively use a different transport such as Sendmail or Mail:

// Sendmail
$transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');

// Mail
$transport = Swift_MailTransport::newInstance();
*/

// Create the Mailer using your created Transport
$mailer = Swift_Mailer::newInstance($transport);
echo 'Mailer<br><pre>';
var_dump($mailer);
echo '</pre>';

// Create a message
// $message = Swift_Message::newInstance('Wonderful Subject')
// ->setFrom(array("no-reply@yukselendegerler.net" => 'Yükselen Değerler'))
// ->setTo(array('mertnesvat@gmail.com','other@domain.org' => 'A name'))
// ->setBody('Here is the message itself')
// ;

$message = Swift_Message::newInstance('Yükselen Değerler Bayi Dokuman Yönetimi: "'.$file->name.'" isimli dosya eklendi')
->setFrom(array("no-reply@yukselendegerler.net" => 'Yükselen Değerler'))
->setTo(array('mertnesvat@gmail.com' , 'other@domain.org' => 'YEHA!'));

//$message->setBcc(array("onur.balci@egnity.com" => 'Onur'));
$message->setBody('Test body', 'text/plain');

echo 'Message<br><pre>';
var_dump($message);
echo '</pre>';

// Send the message
$result = $mailer->send($message);

echo $result;


// require_once 'lib/swift_required.php';

// $url = 'http://'.$_SERVER['HTTP_HOST'].dirname( $_SERVER['REQUEST_URI'] );


// $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465)
// ->setUsername('enes.korukcu@egnity.com')
// ->setPassword('13579#epi')
// ;

// $mailer = Swift_Mailer::newInstance($transport);



// $result = $mailer->send($message);
?>