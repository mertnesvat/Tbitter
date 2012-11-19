<?php

class Pizza extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

	}
	function index()
	{
		$this->load->model('pizza_model');
		$data=$this->pizza_model->genel();
		// 		$data['tablo'] = $this->pizza_model->get_all_orders();
		$data['orders'] = $this->pizza_model->get_all_orders();

		// 		$this->load->view('pizza_header',$data);
		// 		$this->load->view('pizza_menu',$data);
		$this->load->view('pizza_view',$data);
		// 		$this->load->view('pizza_footer',$data);
	}
	function order($id = 0)
	{
		$this->load->helper('form'); // form yardimi al
		$this->load->helper('html');//html tagları için htm

		$this->load->model('pizza_model');

		$data=$this->pizza_model->genel();
		///YENI GIRIS VARSA
		if($this->input->post('mysubmit'))// submit tusu basildiginda atesler
		{
			if($this->input->post('id')){//id nin 0 dan farklı olması TRUE kabul edildiği için düzenleme moduna girecek
				$this->pizza_model->order_update();
			}
			else{//eğer id=0 ise yeni sipariş moduna girecek
				$this->pizza_model->insert_new_entry();
			}
		}
		///GIRIS DUZENLEME VARSA
		if((int)$id >0 )
		{
			$query = $this->pizza_model->get_specific_order($id);
			$data['temiz_id']['value'] = $query['id'];
			$data['temiz_isim']['value'] = $query['name'];
			$data['temiz_pizza']['value'] = $query['pizza'];
			$data['temiz_tip']['value'] = $query['type'];
			$data['temiz_adet']['value'] = $query['unit'];
			$data['temiz_adres']['value'] = $query['address'];

			if($query['thin_edge'] == 'yes'){
				$data['temiz_kenar']['checked'] = TRUE;
			}else{
				$data['temiz_kenar']['checked'] = FALSE;
					
			}
		}
			
		$this->load->view('pizza_order',$data);
	}
	///SILME ISLEMI YAPILIYORSA
	function del($id)
	{
		if((int)$id > 0){
			$this->load->model('pizza_model');
			$this->pizza_model->delete($id);
		}
		$data = $this->pizza_model->genel();//sonra kalan siparişleri ekrana yazabilmek için index() fonksiyonunda yaptığımız işlemleri yapıyoruz.
		$data['orders'] = $this->pizza_model->get_all_orders();
		$this->load->view('pizza_view',$data);

	}








	function a_pizza($id='1')//default olarak 1 nolu id deki oyuncuyu çekiyoruz.
	{
		$data['title']='Kodmerkezi.net Pizza Sipariş Sayfası';
		$data['header']='<h1>Siparisler</h1>';

		$this->load->model('pizza_model');
		$data['orders']=$this->pizza_model->get_specific_order($id);//gelen id yi fonksiyona yolluyoruz.

		$this->load->view('pizza_view',$data);
	}
	function get_method($name='',$unit='')
	{
		$data['title']='Kodmerkezi.net Pizza Sipariş Sayfası';
		$data['header']='<h1>Siparişler</h1>';
		if(!$name || !$unit)
		{
			$data['orders']='Sipariş Yok';
		}
		else
		{
			$data['orders']='Adı: '.$name.' Adedi: '.$unit;
		}

		$this->load->view('pizza_view',$data);

	}

}
?>