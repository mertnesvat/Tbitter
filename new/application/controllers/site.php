<?php
class Site extends CI_Controller
{
	
	public function deneme()
	{
		
		$this->load->library('postmark');
		// option, you can set these in config/postmark.php
		$this->postmark->from('info@mertnesvat.com', 'Jungle Bird');
		
		$this->postmark->to('mertnesvat@gmail.com', 'Bittermouse');
		
// 		$this->postmark->cc('cc@example.com', 'Cc Name');
// 		$this->postmark->bcc('bcc@example.com', 'BCC Name');
		$this->postmark->reply_to('us@us.com', 'Reply To');
		
		// optional
		$this->postmark->tag('Some Tag');
		
		$this->postmark->subject('Example subject');
		$this->postmark->message_plain('Testing...');
		$this->postmark->message_html('<html><strong>Testing...</strong></html>');
		
// 		// add attachments (optional)
// 		$this->postmark->attach(PATH TO FILE);
// 		$this->postmark->attach(PATH TO OTHER FILE);
		
		// send the email
		$this->postmark->send();
		
// 		require("postmark.php"); // POSTMARK
// 		$a = "<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\">
// 		<html><head>
// 		<title>Jungle Bird Seni Selamliyor</title>
// 		</head><body>
// 		<h1>".$username."</h1>
// 		<p>You don't have permission to access /
// 		on this server.</p>
// 		</body></html>
// 		";
		
		
// 		$postmark = new Postmark("c9a63084-5fb4-42aa-8225-81998813dd46","info@mertnesvat.com");
		
// 		$result = $postmark->to($email)
// 		->subject("Welcome To The Jungle! " )
// 		->plain_message($a)
// 		->attachment('File.pdf', $file_as_string, 'application/pdf')
// 		->send();
		
// 		if($result === true)
// 			echo "Message sent";
	}
	public function welcome()
	{
		include 'lib/EpiCurl.php';
		include 'lib/EpiOAuth.php';
		include 'lib/EpiTwitter.php';
		include 'lib/secret.php';
		
		$oauth_token = $_GET['oauth_token'];
		echo 'hosgeldin tamamdir!';
		
		$twitterObj = new EpiTwitter($consumer_key, $consumer_secret);
		$twitterObj->setToken($oauth_token);
		$token = $twitterObj->getAccessToken();
		$twitterObj->setToken($token->oauth_token, $token->oauth_token_secret);
		$_SESSION['ot'] = $token->oauth_token;
		$_SESSION['ots'] = $token->oauth_token_secret;
		
		$twitterInfo= $twitterObj->get_accountVerify_credentials();
		
		$this->load->model('membership_model');
		
		$username = $this->session->userdata('twitter_username');
		echo '<br><br>is username ='.$username;
		//kayit islemlerini yapiyor!
		$this->membership_model->authorization_member($username,$token->oauth_token, $token->oauth_token_secret); 
		
		$email = $this->membership_model->special_quest($username,'email');
		echo 'emailiniz = '.$email;
		
		
		
// 		$this->load->library('email'); //CODEIGNITER KUTUPHANESI ILE MAIL GONDERILMESI!
		
// 		$this->email->from('Junglebird@gmail.com', 'Jungle Bird');
// 		$this->email->to($email);
		
// 		$this->email->subject('Welcome To Jungle');
// 		$this->email->message('<pre><h2>Jungle Bird</h2> <br> <h3>Seni Selamliyor...</h3><br>'.$username.'</pre>');
		
// 		$this->email->send();

		//EMAIL OLAYLARI
		
		
		
		redirect('site/hubble');
		///ekleme islemlerini yapiyoruz!;
// 			$id = 84951786;
// 			$update_status = $twitterObj->post_statusesUpdate(array('user_id' => $id));
// 			$temp = $update_status->response;
		
	}
	//------------------------TWEETT------------==++====++==_+)+=0-------------------------------------
	
	public function ididit($asd){
		$gec = 0;
		include 'lib/EpiCurl.php';
		include 'lib/EpiOAuth.php';
		include 'lib/EpiTwitter.php';
		include 'lib/secret.php';
	
		$twitterObj = new EpiTwitter($consumer_key, $consumer_secret);
		
		echo 'SESSION<br><pre>';
		print_r($_SESSION);
		echo '</pre>';
		if(isset( $_GET['oauth_token']) )
		{
			$oauth_token = $_GET['oauth_token'];
		}
		if(!isset($_GET['oauth_token' ]) )
		{
			$url = $twitterObj->getAuthorizationUrl();
			echo '<h3>Bir defalik bu uygulamaya izin vermeniz gerekiyor!</h3>';
			echo "<a href='$url'>Get In with Twitter</a>";
		}
		else
		{
			if($_SESSION['ot'] == '' && $_SESSION['ots'] == '')
			{
				$twitterObj->setToken($oauth_token);
				$token = $twitterObj->getAccessToken();
				$twitterObj->setToken($token->oauth_token, $token->oauth_token_secret);
				$_SESSION['ot'] = $token->oauth_token;
				$_SESSION['ots'] = $token->oauth_token_secret;
					
			}
			else
			{
				
				$twitterObj->setToken($_SESSION['ot'], $_SESSION['ots']);
				$gec = 1;
			}
					
			$twitterInfo= $twitterObj->get_accountVerify_credentials();
			// et accountVerify_credentials() aldiktan sonra hersey hazir!
					
	
	
		}
				if($gec)
				{
// 					echo '<h2>Sen -></h2><br><pre>';
// 					print_r($twitterInfo);
// 					echo '<br>';
// 					echo $twitterInfo->screen_name.'<br>'.$twitterInfo->profile_image_url.'</pre>';
					$id = 84951786;
					$update_status = $twitterObj->post_statusesUpdate(array('user_id' => $id));
					$temp = $update_status->response;
		
					echo '<h2>update_status -> Response </h2><br><pre>';
					print_r($twitterObj);
					echo '</pre>';
				}
	}
	
	//------------------------TWEETT--------------------------------------------------------------------
	function __construct()//site classı her çağrıldığında otomatik çalışan fonksiyon
	{
		parent::__construct();
		$this->is_logged_in();//members_area her çağrıldığında öncelikle bu fonksiyon çalışacak
	}
	function members_area()
	{
		$this->ididit(2);
	}
	function is_logged_in()//giriş yapmış kullanıcı var ise members_area erişimine izin verecek aksi halde engelleyecek.
	{
		$is_logged_in = $this->session->userdata('is_logged_in');//Burada oturumdan is_logged_in değerini çekiyoruz. Eğer true dönerse bir kullanıcı giriş yapmış demektir.
 
		if(!isset($is_logged_in) || $is_logged_in != true)//is_logged_in set edilmiş mi ve set edildi ise değeri true mu? Cevabımız evet ise bu fonksiyon bir problem çıkarmıyor ve yolumuza devam edip sayfamıza erişiyoruz.
		{
			echo 'Bu sayfaya erisim yetkiniz yok <a href="../login">Giris</a>';//Aksi halde erişim yok uyarısı verip,
			die();//işlemi durduruyoruz.
		}
	}
	function hubble()
	{
		echo '( uyelik + izin ) tamamdir sayfasi!';
	}
}
?>