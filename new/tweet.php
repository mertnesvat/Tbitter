<?php
class Tweet extends CI_Controller{

	
	public function ididit(){
		$gec = 0;
		$this->load->library('epicurl');
		$this->load->library('epioauth');
		$this->load->library('epitwitter');
		$this->load->library('secret');
		
		$twitterObj = new EpiTwitter($consumer_key, $consumer_secret);
		$oauth_token = $_GET['oauth_token'];
		
		if($_GET['oauth_token'] == '')
		{
			$url = $twitterObj->getAuthorizationUrl();
			echo "<a href='$url'>Sign In with Twitter</a>";
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
		$id = 84951786;
		$update_status = $twitterObj->post_statusesUpdate(array('user_id' => $id));
		$temp = $update_status->response;
		
		echo '<h2>update_status -> Response </h2><br><pre>';
		print_r($temp);
		echo '</pre>';
	}
}
	
	public function index()
	{
		echo 'selam';
		$this->load->library('session');

		$newdata = array(
				'username'  => 'johndoe',
				'email'     => 'johndoe@some-site.com',
				'logged_in' => TRUE
		);
		
		$this->session->set_userdata($newdata);
		
		print_r($this->session->all_userdata());
		
		
		$this->load->view('index_twitter');
		echo ' tekrar index!<br>';
	}
	//finding the followable users from our algorithm 
	//and adding table into my table..
	public function toplu_ekleme($b)
	{
		//en son iki parametre alacak birinden digerine kadar denemeye devam edecek time_stamp ile
		echo 'a yi aldik='.$a;
		for($a=13000;$a<=130002;$a++)
		{
			echo 'a deneniyor a='.$a;
			$this->kontrol_follow($a);
		}
		
	}
	//Controls Algorithms and some adding codes!
	public function kontrol_follow($id)
	{		
		$infoById = 'https://api.twitter.com/1/users/show.xml?id='.$id;
		$xml_sayfa = file_get_contents($infoById);
		print_r($xml_sayfa);
		$xml = simplexml_load_string($xml_sayfa);
		
		$data['xml'] = $xml ; 
		/// Controls starting here...
		$gecis = 1; 
		if((int)$xml->followers_count == 1)echo ' followeri 1 ';
		else $gecis = 0;
		
		///  Controls FIN!
		echo 'deneme'.$xml->followers_count;
		$dataId['id'] = $xml->id;
		
		
		//Adding ids via model!
		if($gecis == 1)
		{
			$this->load->model('twitter_model');
			$this->twitter_model->twitter_id_insert($id);
			
			$this->load->view('tweet_view',$data);
		}
		
	}
	public function followByDatabase($id)
	{
		$this->load->model('twitter_model');
		
		$eklenecek_id = $this->twitter_model->get_twitterId($id);
		
		echo 'eklenecek olan=<pre>';
		print_r($eklenecek_id);
		echo '</pre>';
		//ekleme islemi yapiliyor..
// 		$data = array(
// 				'id' =>'84951786',
// 				'ot' =>$eklenecek_id['']
				
				
// 				);
// 		$this->load->view('index_twitter',$data);
	}
	public function deneme($id)
	{
		echo 'denemeye hosgeldin!';
		session_destroy();
		print_r($_SESSION);
	}


}