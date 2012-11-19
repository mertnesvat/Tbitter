<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Jungle Bird</title>
<link rel="stylesheet" href="http://twitter.mertnesvat.com/css/style.css" type="text/css" media="screen" charset="utf-8">
<link rel="stylesheet" href="http://twitter.mertnesvat.com/css/bootstrap.min.css" type="text/css" media="screen" charset="utf-8">
<link rel="stylesheet" href="http://twitter.mertnesvat.com/css/bootstrap.css" type="text/css" media="screen" charset="utf-8">
</head>

<body>
	<h1>Hesap Yarat</h1>

	<fieldset id="signup_form">

		<form class="form-horizontal well asd" action="http://twitter.mertnesvat.com/index.php/login/create_member" method="post" accept-charset="utf-8">
			<legend>Kişisel Bilgiler</legend>
			<input type="text" name="first_name" value="Name" />
			<input type="text" name="last_name" value="Surname" />
			<input type="text" name="email_address" value="Email" />
	
		<legend>Kullanıcı Bilgileri</legend>

			<input type="text" name="user_name" value="Twitter Username" />
			<input type="password" name="password" value="Pass" />
			<input type="password"name="password2" value="Pass" />
			<br/>
			<input class="btn btn-primary" type="submit"name="submit" value="Get In" />
		</form>
		<?php echo validation_errors('<p class="error">');?>
	</fieldset>
</body>
</html>
<?php /*<h1>Hesap Yarat</h1>
 
<fieldset id="signup_form">
	<legend>Kişisel Bilgiler</legend>
 
	<?php
 
	echo form_open('login/create_member');
	echo form_input('first_name',set_value('first_name','Adın'));
	echo form_input('last_name',set_value('last_name','Soyadın'));
	echo form_input('email_address',set_value('email_address','Email Adresin'));
	?>
 
</fieldset>
<fieldset id="signup_form">
	<legend>Kullanıcı Bilgileri</legend>
 
	<?php
 
	echo form_open('login/create_member');
	echo form_input('user_name',set_value('user_name','Twitter Kullanıcı Adı'));
	echo form_input('password',set_value('password','Şifre'));
	echo form_input('password2',set_value('password2','Şifre Tekrar'));
 
	echo form_submit('submit','Hesap Yarat');
 
	?>
 
	<?php echo validation_errors('<p class="error">');?>
 
</fieldset>
*/?>