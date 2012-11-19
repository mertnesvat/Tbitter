<?php
class Pizza_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();//database bağlantısı yapıyoruz.
	}

	function get_all_orders()
	{
		//$this->load->library('table'); // tablo kutuphanesi!

		$query = $this->db->get('codeigniter');//pizza tablosundaki bütün verileri çekiyoruz.
		//$table = $this->table->generate($query); // tablo olustur table degiskenine ata

		//return $table;
		return $query->result();
	}
	function get_specific_order($id)//fonksiyona gelen id ye göre tablomuzdan ilgili satırı çekiyoruz.
	{
		$query = $this->db->get_where('codeigniter',array('id'=>$id));//id = 1 olan verileri seçiyoruz sadece.
		return $query->row_array();
	}

	function genel()
	{
		$data['title']='Kodmerkezi.net Pizza Sipariş Sayfası';
		$data['header']='<h1>Pizza Siparis Projesi</h1>';
		$data['footer']='© copyright kodmerkezi.net';

		$data['base']		= $this->config->item('base_url');//projemizin ana dizinini çekiyoruz.
		$data['css']		= $this->config->item('css');	//css dosyamızı çekiyoruz
			

		$this->load->library('MyMenu');
		$menu = new MyMenu;
		$data['menu'] = $menu->show_menu();

		$data['temiz_id']['value'] = 0;
		$data['temiz_isim']['value'] = 0;
		$data['temiz_pizza']['value'] = 0;
		$data['temiz_tip']['value'] = 0;
		$data['temiz_adet']['value'] = 0;
		$data['temiz_adres']['value'] = 0;


		$data['isim']	 	= 'İsminiz &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
		$data['pizza']		='Pizza Seçin';
		$data['pizzalar']	 	= array('cilgin pizza'=>'cilgin pizza',
				'tavuklu'=>'tavuklu',
				'acili'=>'acili',
				'mantarli'=>'mantarli',
				'karisik'=>'karisik',
				'margarita'=>'margarita');
		$data['tip']	 	= 'Boyut&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
		$data['tipler']	 	= array('kücük'=>'kücük',
				'büyük'=>'büyük',
				'normal'=>'normal');
		$data['adet']	 	= 'Adet &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
		$data['kenar']	 	= 'İnce Kenar';
		$data['adres']	 	= 'Adres &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
		$data['temiz_isim']	= array('name'=>'isim',
				'size'=>30);
		$data['temiz_adet']	= array('name'=>'adet',
				'size'=>30);
		$data['temiz_kenar']= array('name'=>'kenar',
				'value'=>'yes',
				'checked'=>TRUE );
		$data['temiz_adres']= array('name'=>'adres',
				'rows'=>5,
				'cols'=>30);
			
		$data['baslik']  = 'Sipariş Sayfası';

		return $data;
	}
	function delete($id)
	{
		$this->db->delete('codeigniter', array ( 'id'=>$id ) );
	}

	function order_update(){
		$data = array(
				'name'=>$this->input->post('isim'),//formdaki verileri teker teker arraya atıyoruz
				'pizza'=>$this->input->post('pizza'),
				'thin_edge'=>$this->input->post('kenar'),
				'unit'=>$this->input->post('adet'),
				'address'=>$this->input->post('adres'),
				'type'=>$this->input->post('tip'),
				'cost'=>'20',//burası dediğimiz gibi fiyat hesaplayan bir fonksiyon yazarak halledilebilir.
		);
		$this->db->where('id',$this->input->post('id'));//id=$id olan satırı buluyoruz.
		$this->db->update('codeigniter',$data);  //ve bu satırı $data arrayı ile güncelliyoruz.
	}

	function insert_new_entry()
	{
		$data = array(
				'name' =>$this->input->post('isim'),
				'pizza'=>$this->input->post('pizza'),
				'type'=>$this->input->post('tip'),
				'unit'=>$this->input->post('adet'),
				'thin_edge'=>$this->input->post('kenar'),
				'address'=>$this->input->post('adres'),
				'cost'=>$this->input->post('20')

		);
		$this->db->insert('codeigniter', $data);
	}
}
?>