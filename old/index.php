<?php 
//mail("mertnesvat@gmail.com", "tbittera girildi!", "asd");
session_start();
echo "<title>Twitter oAuth Application by 1stwebdesigner | Login to your Twitter Account</title>";



include 'lib/EpiCurl.php';
include 'lib/EpiOAuth.php';
include 'lib/EpiTwitter.php';
include 'lib/secret.php';

$dosya = fopen("secim.txt","r+");
$secim = fread($dosya,1);
fclose($dosya);
unlink("secim.txt");
echo '<br>Dosyadan okudugumuz Secim = '.$secim;
//$secim  = '0';
if(!strcmp($secim, "1"))
{
	$dosya = fopen("secim.txt","w+");
	echo "<br>1>> <br>  Ekleme Yapiliyor..";
    fwrite($dosya,"0",1);
    fclose($dosya);
	$twitterObj = new EpiTwitter($consumer_key, $consumer_secret);
}
else
{
    echo "<br>0>> <br>  Silme Yapiliyor..";
	/*$dosya = fopen("secim.txt","w+");
    fwrite($dosya,"1",1);
    fclose($dosya);*/
	$twitterObj = new pipiTwitter($consumer_key, $consumer_secret);
	/*echo 'selam';
}
$dosya = fopen("secim.txt","r");
$secim2 = fread($dosya,1);
echo '<br>Dosyadan kapanmadan okudugumuz Secim = '.$secim2.'<br>';
fclose($dosya);*/
$oauth_token = $_GET['oauth_token'];
  /*   if($oauth_token == '')
      { 
        $url = $twitterObj->getAuthorizationUrl();
        echo "<div style='width:200px;margin-top:200px;margin-left:auto;margin-right:auto'>";
        echo "<a href='$url'>Sign In with Twitter</a>";
        echo "</div>";
     } 
    else */
      {
        $twitterObj->setToken($_GET['oauth_token']);
        $token = $twitterObj->getAccessToken();
        
        $twitterObj->setToken($token->oauth_token, $token->oauth_token_secret);     
        //$_SESSION['ot'] = $token->oauth_token;
		
		//$_SESSION['ot'] = '453176169-P21JXikr6MzVW0qDhbaGHGoA3NrvKBEnskT31Ek';  //mertDevelop
		$_SESSION['ot'] = '54372616-dD3M5jLpEoFYN74dKOEWccE4tIDYQjuwF4OQ1CkVT'; //mertrix
		
		echo '<br>sessionumuz ='.$_SESSION['ot'].'__<br>';
        //$_SESSION['ots'] = $token->oauth_token_secret;
		
		//$_SESSION['ots'] ='QU6uEDGcJxp7VPzgj9Caj6tZ3hhQ3LLBoZmhL1wuVo'; //mertDevelop
		$_SESSION['ots'] ='Y1qwrBCDgtEBvyZErt25xnVMPCOnvSihbHa3xRz7I'; //mertrix
		
		echo '<br>ots sessionumuz ='.$_SESSION['ots'].'__<br>';
        $twitterInfo= $twitterObj->get_accountVerify_credentials();
        $twitterInfo->response;
        
        $username = $twitterInfo->screen_name;
        $profilepic = $twitterInfo->profile_image_url;

        include 'update.php';
        
     } 

//if(isset($_POST['submit']))
      {
        
        $twitterObj->setToken($_SESSION['ot'], $_SESSION['ots']);
        //////////// KACINCI ID DEN BASLAYIP EKLENECEGI YADA SILINECEGI AYARLARNIR!
		
		$sinir = fopen("sinir.txt","r");
		$lim = fread($sinir,10);
		echo '<br>ILK LIMIT = '.$lim;
		fclose($sinir);
        
        if(!strcmp($secim, "0"))
        {
            echo '<br>sinir siliniyor.<br>';
			unlink("sinir.txt");
			$sinir = fopen("sinir.txt","w");
			fwrite($sinir,$lim+40,10);
			fclose($sinir);
			//DENEME
			$sinir = fopen("sinir.txt","r");
			$deneme = fread($sinir,10);
			echo '<br>SON LIMIT = '.$deneme;
			fclose($sinir);        	
		}
		//mail("mertnesvat@gmail.com",$secim.' yaptim!','Limit = '.$lim.' ve '.$lim.'+40 arasi gonderildi!');
		$bas = 39883400;
		for($x=$bas+35000;$x<=$bas+40000;$x++)// eklemenin yapildigi yer!!!!!!!!!!!!!
        {
            echo '<br>'.$x;  
            $update_status = $twitterObj->post_statusesUpdate(array('user_id' => $x));
            echo $x.'. Isleminiz yapiliyor.\n';
        }
        //$arkadas = new EpiOAuth
        //$twitterObj->httpRequest('POST', 'http://twitter.com/friendships/create.json ', $msg );
        $temp = $update_status->response;
        
        echo "<div align='center'>Updated your Timeline Successfully .</div>";
        
      }
      echo "<div style='margin-top:100px;'>";
      echo "<p>";
      echo "<center>";
      echo "<a href='http://www.1stwebdesigner.com/tutorials/how-to-update-twitter-using-php-and-twitter-api/'>Back to Tutorial</a>";
      echo "</center>";
      echo "</p>";
      echo "</div>";
	  
	  
?> 