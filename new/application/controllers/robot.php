<?php
class Robot extends CI_Controller{
	
	public function index()
	{
	mail('mertnesvat@gmail.com' , 'deneme' , 'deneme');
	
		$this->load->controller('tweet');
		ini_set('max_execution_time' , 60 ) ;
		//ini_set('memory_limit' ,  ) ;
		$this->load->model('twitter_model');
		$num = $this->twitter_model->sonId('al');//son id mizi aliyoruz ve ekleyerek devam edecez!
		echo 'num = '.$num;
		$a=0;
		while($a != 50)
		{
			$this->tweet->kontrol_follow($num);
			$num++;
			$a++;
			echo '<br>a ='.$a.'num ='.$num;
		}
		$this->twitter_model->sonId('yaz',$num);
	}

}