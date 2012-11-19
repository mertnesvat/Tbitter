<?php
class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	function index()
	{
		echo '<i>Hey yoo!</i>';
		$data['main_content'] = 'login_form';//açılışta ilk olarak login sayfamız görünecek bu yüzden main_content i login forma eşitliyoruz
		$this->load->view('includes/template',$data);//view dosyamızı yüklüyoruz.
	}
	function validate_credentials()
	{
		$this->load->model('membership_model');//model dosyamızı yükledik. Database işlemleri burada gerçekleşiyor.
		$query = $this->membership_model->validate();//Kullanıcıyı model dosyamız içerisindeki validate() fonksiyonu ile kontrol ediyoruz.
	
		if($query)//Kullanıcı var ise bir sezon oluşturmamız gerekiyor.
		{
			//sezonu oluşturmak için biraz veri hazırlıyoruz. Bu veride giriş yapan kullanıcının kullanıcı kaydı ve giriş yapıldığını gösteren logged_in değişkeni bulunuyor.
			$data = array(
					'username' =>$this->input->post('username'),//kullanıcı ismini formdan alarak yazıyoruz.
					'is_logged_in' =>true//giriş yaptığı için true değerini ekliyoruz.
			);
	
			$this->session->set_userdata($data);//set_userdata yeni bir session oluşturur.
			if($query == 2)redirect('site/members_area');//yeniden yönlendirme yaparak members_area bölümünü açıyoruz.
			if($query == 1)redirect('site/hubble');//yeniden yönlendirme yaparak members_area bölümünü açıyoruz.
			
		}
		else//böyle bir kullanıcı yoksa anasayfaya yönleniyoruz.
		{
			echo '<h2>Couldn\'t Wake Up</h2><br/><h5>Wrong Username or Password!</h5>';
			$this->index();
		}
	}
	function logout()
	{
		$this->session->sess_destroy();//bütün sessionları siler
		$data['main_content'] = 'login_form';//tekrar login sayfasına yönleniyoruz
		$this->load->view('includes/template',$data);
	}
	function signup()
	{
		$data['main_content'] = 'signup_form';
		$this->load->view('includes/template',$data);
	}
	function create_member()
	{
		$this->load->library('form_validation');//girilen bilgilerin doğruluğunu kontrol etmemize yardımcı olan fonksiyonları yüklüyoruz.
		$this->form_validation->set_rules('first_name','Name','trim|required');//bu ve alttaki fonksiyonlar ise kural oluşturmamıza yardımcı olarak girilen bilgilerin bu kurala uygun olmasını sağlıyor
		$this->form_validation->set_rules('last_name','Last Name','trim|required');
		$this->form_validation->set_rules('email_address','Email Address','trim|required|valid_email');
	
		$this->form_validation->set_rules('user_name','Username','trim|required|min_length[4]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2','Password Confirmation','trim|required|matches[password]');
		if($this->form_validation->run() == FALSE )//eğer girilen değerler yukarıdaki kurallara uymuyor ise tekrar forma dönüyoruz.
		{
			$this->signup();
		}
		else//girilen bilgiler doğruysa model dosyamızı çağırıyoruz.
		{
			$this->load->model('membership_model');
			if($query = $this->membership_model->create_member())
			{
				$data['main_content']= 'signup_successful';
				$this->load->view('includes/template',$data);
			}
			else
			{
				$this->load->view('signup_form');
			}
		}
	
	}
}


?>