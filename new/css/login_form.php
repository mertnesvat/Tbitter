<div id="login_form"><!--id olarak login_form diyoruz ki daha sonra hazırlayacağımız css dosyasıyla burayı düzenleyebilelim-->
	
 
	<?php
		echo form_open('login/validate_credentials',array('class'=>"form-horizontal well"));//Submit edildiğinde login.php altındaki validate_credentials fonksiyonu çağrılacak ve kullanıcının doğruluğunu kontrol edecek.
		echo '<legend>Welcome To The Jungle!</legend>';
		echo form_input('username','Twitter Username',array('class'=>"input-small"));//Kullanıcı Adı Alanı
		echo form_password('password','Password',array('class'=>"input-small"),array('id'=>"mert"));//Password Alanı
		//echo form_submit('submit','Giriş');//Giriş Butonu
		//echo '<a class=\"btn btn-primary\" type=\'submit\' name=\'submit\' ">Primary</a>';
		echo '<br>';
		echo '<input type="submit" class="btn" name="submit" value="Get In">';
		echo anchor('login/signup','Get Up',array('class'=>"btn",'id'=>"mert"));//Yeni Kullanıcı Kayıt Butonu
		
		//<input type="submit" name="submit" value="Giriş">
	
		?>
	
</div>