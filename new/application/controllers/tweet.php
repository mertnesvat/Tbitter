<?php
class Tweet extends CI_Controller{

	
//------------------------twitter_index---------------------------------------------------------------------------
	public function thousandAdd($username , $ot , $ots , $eklemeAdet = 40)// kullanici ile uygulamaya girerek herkesi ekleme islemini yapar!
    {
        include 'lib/EpiCurl.php';
        include 'lib/EpiOAuth.php';
        include 'lib/EpiTwitter.php';
        include 'lib/secret.php';
        
        $twitterObj = new EpiTwitter($consumer_key, $consumer_secret , $ot , $ots);
        
        $twitterInfo= $twitterObj->get_accountVerify_credentials();
            // et accountVerify_credentials() aldiktan sonra hersey hazir!
        
        //son eklenen id al
        $this->load->model('membership_model');
        $sonid = $this->membership_model->special_quest($username , 'lastAddedId');
        
        echo 'sonId = '.$sonid;
        
        ///twitter tablosundan id ye gore kullanicilari cek 
        
		$que = $this->membership_model->getXUser($username,$eklemeAdet);
		echo 'QUE!';
 		$dizi = $que->result_array();
		
 		//echo '<br>dizi[1][twitterId]='.$dizi[1][twitterId].'id'.$dizi[1][id];
 		
		
		for($a=0;$a<$eklemeAdet-2;$a++)
		{
			echo '<br>#'.$a.' = '.$dizi[$a]['twitterId']; // resource id miz!
			$id = $dizi[$a]['twitterId'];
			echo '   id = '.$id;
			$update_status = $twitterObj->post_ekle(array('user_id' => $id));
			$temp = $update_status->response;
		}
		// kullanicilari ekle ardindan sil
		for($a=0;$a<$eklemeAdet-2;$a++)
		{
		echo '<br>#'.$a.' = '.$dizi[$a]['twitterId']; // resource id miz!
		$id = $dizi[$a]['twitterId'];
		echo '   id = '.$id;
		$update_status = $twitterObj->post_sil(array('user_id' => $id));
				$temp = $update_status->response;
		}
		
        
        
//         $id = 84951786;
//         $update_status = $twitterObj->post_sil(array('user_id' => $id));
        //$update_status = $twitterObj->post_ekle(array('user_id' => $id));
        //$sil = $twitterObj->post_sil(array('user_id' => $id));
        //$update_status = $twitterObj->sil(array('user_id' => $id));
        
//         $temp = $update_status->response;
        
        /// son id kaydet
        $this->membership_model->authorization_lastId($username,$eklemeAdet);
        
    }
    
	
	public function ididit($asd){
			
		$gec = 0;
		include 'lib/EpiCurl.php';
		include 'lib/EpiOAuth.php';
		include 'lib/EpiTwitter.php';
		include 'lib/secret.php';
		
		echo 'consumer_key='.$consumer_key.'secret='.$consumer_secret;
		
		$twitterObj = new EpiTwitter($consumer_key, $consumer_secret);
		if(isset( $_GET['oauth_token']) )$oauth_token = $_GET['oauth_token'];
		
		if(!isset($_GET['oauth_token' ]) )
		{
			$url = $twitterObj->getAuthorizationUrl();
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
		$id = 84951786;
		$update_status = $twitterObj->post_statusesUpdate(array('user_id' => $id));
		$temp = $update_status->response;
		
		echo '<h2>update_status -> Response </h2><br><pre>';
		print_r($temp);
		echo '</pre>';
	}
}
//----------------------------------------------------------------------------------------------------------------
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
		//print_r($xml_sayfa); sayfa bilgilerini aliyoruz..
		$xml = simplexml_load_string($xml_sayfa);
		
		$data['xml'] = $xml ; 
		/// Controls starting here...
		$gecis = 1; 
		if((int)$xml->followers_count > 50 && (int)$xml->friends_count > 50 && !strcmp( $xml->protected, 'false' ))echo ' followeri 100 den fazla ';//follower 100 den fazla ise aliyoruz
		else $gecis = 0;
		
		///  Controls FIN!
		echo '<br>Followers_count .. '.$xml->followers_count;
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
	public function robot()
	{
		//robot twitterdan istedigim filtreden gecen idleri bulmamizi sagliyor durmadan calistirilacak
		//her defasinda 50 id taraniyor...
		
		ini_set('max_execution_time' , 60 ) ;
		//ini_set('memory_limit' ,  ) ;
		$this->load->model('twitter_model');
		$num = $this->twitter_model->sonId('al');//son id mizi aliyoruz ve ekleyerek devam edecez!
		echo 'num = '.$num;
		$a=0;
		while($a != 50)
		{
			$this->kontrol_follow($num);
			$num++;
			$a++;
			echo '<br>a ='.$a.'num ='.$num;
		}
		$this->twitter_model->sonId('yaz',$num);
	}
    
	// kullanici eklemek icin kullaniliyor bu fonksiyon hic parametre almadan direk mvc den cagiriliyor (twitter.mertnesvat.com/tweet/asimo)
    public function asimo()
    { 
    	
        $this->load->model('twitter_model');
        
        $dizi = $this->twitter_model->get_users();
        $a=0;
        
        foreach ($dizi as $person )
        {
        	$a++;
        	echo '<h4>'.$a.'.Adam = '.$person['twitterUsername'].'</h4>';
        	//$this->thousandAdd($person['twitterUsername'],$person['sessionOt'], $person['sessionOts'],40);
        	// create a new cURL resource
        	$ch = curl_init();
        	
        	// set URL and other appropriate options
        	curl_setopt($ch, CURLOPT_URL, "http://twitter.mertnesvat.com/tweet/thousandAdd/".$person['twitterUsername']."/".$person['sessionOt']."/".$person['sessionOts']."/40");
        	curl_setopt($ch, CURLOPT_HEADER, 0);
        	
        	// grab URL and pass it to the browser
        	$a = curl_exec($ch);
//         	echo '<br><h1>AAAAAAAAAAAAA</h1>';
//         	echo $a;
        	
        	// close cURL resource, and free up system resources
        	curl_close($ch);
        	
        	 
        	echo '<p><h5>Ekleme Bitiriliyor...</h5></p><h1>FLUSH</h1>';
        	echo ob_get_flush();
        	ob_get_clean();
        	
        }
        
    }
    
    
 
}