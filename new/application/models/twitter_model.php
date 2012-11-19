<?php 
class Twitter_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();//database baÄŸlantÄ±sÄ± yapÄ±yoruz.
	}
	function sonId($secim , $gelen = 0)
	{
		switch ($secim )
		{
			case 'al':
	
				$query = $this->db->get_where('enSonId', array('id'=>'1'));
				$dizi = $query->row_array();
				return $dizi['enSonId'];
				break;
					
			case 'yaz':
				$query = $this->db->query("UPDATE enSonId SET enSonId='".$gelen."' WHERE id = '1'");
	
				break;
					
		}
	}
	function twitter_id_insert($id)
	{
		$data = array( 
				'id' =>'',
				'twitterId' => $id
				);
		$this->db->insert('twitter',$data);
	} 
	function get_twitterId($id)
	{
		$query = $this->db->get_where('twitter',array('id'=>$id));//id = 1 olan verileri seÃ§iyoruz sadece.
		return $query->row_array();
	}
	function new_user($twitterId,$ot,$ots)
	{
		$data = array(
				'id' => '',
				'twitterId'=>$twitterId,
				'sessionOt'=>$ot,
				'sessionOts'=>$ots
				);
		
		$this->db->insert('twitter_user',$data);
	}
	function new_user2($data)
	{
		
		
		$this->db->insert('twitter_user',$data);
	}
	function get_users()
	{
		$query = $this->db->query("SELECT * FROM membership");
		return $query->result_array();
	}
	
}



?>