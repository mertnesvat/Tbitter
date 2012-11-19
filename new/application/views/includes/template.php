<?php $this->load->view('includes/header');?>
<?php $this->load->view($main_content);//Dinamik olarak main_contenti yükleyeceğiz ve her sayfamızda aynı footer ve headerla karşılaşarak genel bir şablon hazırlamış olacağız.Yani burada login.php olabilir, signup.php olabilir...
?>
<?php $this->load->view('includes/footer');?>