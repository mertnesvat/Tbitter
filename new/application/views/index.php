<?php //session_start();?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
include 'lib/EpiCurl.php';
include 'lib/EpiOAuth.php';
include 'lib/EpiTwitter.php';
include 'lib/secret.php';

$twitterObj = new EpiTwitter($consumer_key, $consumer_secret);
$oauth_token = $_GET['oauth_token'];

// cookie toplanacak
// veri tabanina baglanip kullanici id ile oauth u cookie olarak gomulecek!
if($_GET['oauth_token'] == '' && $_SESSION['ot'] == '' && $_SESSION['ots'] == '')
{
	$url = $twitterObj->getAuthorizationUrl();
	echo "<div style='width:200px;margin-top:200px;margin-left:auto;margin-right:auto'>";
	echo "<a href='$url'>Sign In with Twitter</a>";
	echo "</div>";
	//         echo 'if ----------------------------------<br><pre>';
	//         print_r($twitterObj);
	//         echo "</pre>";
}
else
{
	if($_SESSION['ot'] == '' && $_SESSION['ots'] == ''){
		$twitterObj->setToken($oauth_token);
		$token = $twitterObj->getAccessToken();
		$twitterObj->setToken($token->oauth_token, $token->oauth_token_secret);
		$_SESSION['ot'] = $token->oauth_token;
		$_SESSION['ots'] = $token->oauth_token_secret;
	}
	else
	{
		$twitterObj->setToken($_SESSION['ot'], $_SESSION['ots']);
	}
	echo "<br> ot = ".$_SESSION['ot']."ots = ".$_SESSION['ots'];
	$twitterInfo= $twitterObj->get_accountVerify_credentials();
	// et accountVerify_credentials() aldiktan sonra hersey hazir!
	echo "<p>twitterinfo.Response = ";
	print_r($twitterInfo->response);
	echo " </p>";

	$username = $twitterInfo->screen_name;
	$profilepic = $twitterInfo->profile_image_url;

	include 'update.php';
	//         echo 'else ----------------------------------<br><pre>';
	//         print_r($twitterObj);
	//         echo "</pre>";
}

if(isset($_POST['submit']))
{
	$msg = $_REQUEST['tweet'];


	$id = 84951786;

	$twitterObj->setToken($_SESSION['ot'], $_SESSION['ots']);
	echo "<br>ses ot = ".$_SESSION['ot'].' session ots = '.$_SESSION['ots'];
	$update_status = $twitterObj->post_statusesUpdate(array('user_id' => $id));
	$temp = $update_status->response;

	echo 'else ----------------------------------<br><pre>';
	print_r($temp);
	echo "</pre>";
	echo "<div align='center'> Added new Bird.</div>";

}
echo "<div style='margin-top:100px;'>";
echo "<p>";
echo "<center>";
echo "<a href='http://www.1stwebdesigner.com/tutorials/how-to-update-twitter-using-php-and-twitter-api/'>Back to Tutorial</a>";
echo "</center>";
echo "</p>";
echo "</div>";

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php 
/*
 <style type="text/css">
body {
background-image: url(http://smashmaterials.com/wp-content/uploads/2012/06/Beautiful-Birds-Photographs-5.jpg);
}*/
?>
</head>

<body>


</body>
</html>
