<?php
class Membership_model extends CI_Model{
 
	function validate()
	{
		$this->db->where('twitterUsername',$this->input->post('username'));//bu method ile username değeri formdaki username ile eşleşen,
		$this->db->where('password',md5($this->input->post('password')));//password değeri formdaki password field ile eşleşen satırları,
		$query = $this->db->get('membership');//membership tablosundan çekiyoruz.
 		$ses = $query->row_array();
		
		
		if($query->num_rows == 1 )//Dönen değerin satır sayısı(yani kullanıcı sayısı) 1 ise formdaki değerler ile eşleşen bir kullanıcı mevcut demektir.Eğer birden fazla çıkıyorsa aynı kullancıı iki kere kaydedilmiş demektir. Yok 0 çıkıyor ise de böyle bir kullanıcı yok demektir.
		{
			if($ses['sessionOt'])return 1; //uygulama iznini de aldik kullanicida olusturduk!
			else return 2;//kullanıcının başarılı giriş yaptığını fakat uygulamaya hala izin vermedigi varsayarak true döndürüyoruz.
		}
	}
	function create_member()
	{
		//database e eklenecek değerleri belirliyoruz.
		
		$new_member_insert_data = array(
				'firstname' => $this->input->post('first_name'),
				'lastname' => $this->input->post('last_name'),
				'email' => $this->input->post('email_address'),
				'twitterUsername' => $this->input->post('user_name'),
				'password' => md5($this->input->post('password')),
				'sessionOt' => '',
				'sessionOts' => '',
				'lastAddedId' => '1'
		);
		
		$this->session->set_userdata('twitter_username' , $this->input->post('user_name'));
		$insert = $this->db->insert('membership',$new_member_insert_data);//insert işlemi gerçekleştiriyoruz.
		
        
		return $insert;//true veya false değeri dönüyor
	}
function authorization_member($twitterUsername,$ot,$ots)// en son burda kaldim
	{
		$query = $this->db->query("UPDATE membership
				SET sessionOt='".$ot."', sessionOts='".$ots."'
				WHERE twitterUsername='".$twitterUsername
				."'");
	}
	function authorization_lastId($twitterUsername,$toplanacakId)// en son burda kaldim
	{
		$que = $this->db->query("SELECT * FROM membership WHERE twitterUsername ='".$twitterUsername."'");
		$ans = $que->row_array();
		$sonId = $ans['lastAddedId'];
		$sonId += $toplanacakId;
		
		$query = $this->db->query("UPDATE membership
				SET lastAddedId='".$sonId."'
				WHERE twitterUsername='".$twitterUsername
				."'");
	}
	function special_quest($username,$want)
	{
		$this->db->where('twitterUsername' ,$username);
		$query = $this->db->get('membership');//membership tablosundan çekiyoruz.
		$dizi = $query->row_array();
		
		return $dizi[$want];
		
	}
	function getXUser($username,$X)
	{	
		$que = $this->db->query("SELECT * FROM membership WHERE twitterUsername ='".$username."'");
		$ans = $que->row_array();
	    $sonId = $ans['lastAddedId'];
		echo 'last added id '.$sonId;
	    $id = $sonId  + $X;
	    echo 'toplanan id ='.$id;
	    
		$query = $this->db->query("SELECT * 
								FROM  `twitter` 
								WHERE id > ".$sonId." AND id < ".$id."");
		
// 		echo '<br><h3>result_array()</h3><pre>';
// 		print_r($query->result_array());
// 		echo "</pre>";
// 		echo '<br><h3>result_object()</h3><pre>';
// 		print_r($query->result_object());
// 		echo "</pre>";
		return $query;
		
	}
	
	
	
 
}
 
?>