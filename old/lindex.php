<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Make Friend</title>
</head>

<body>
<form method="post" action="" >
<table width="235" border="1">
  <tr>
    <td width="177"><input name="username" type="text" value="Username" /></td>
    <td width="42" rowspan="3"><label for="massage">Tweet:</label>
      <textarea name="massage" id="massage" cols="45" rows="5"></textarea></td>
  </tr>
  <tr>
    <td><input name="password" type="password" value="Password" /></td>
  </tr>
  <tr>
    <td><input name="ok" type="submit" value="Tweetle" />
      <input type="reset" name="reset" id="reset" value="Temizle" /></td>
    </tr>
</table>
</form>


<?php 

session_start();


/*   This class is compatible with >= PHP 5 only due to the use of: 
    SimpleXML:  http://uk2.php.net/simplexml 
                Used to parse XML feeds  
                SimpleXML is enabled by default. If it appears not to be, contact your host. 
                 

    cURL is also required for this script to operate. http://uk.php.net/curl 
     
    The Twitter API documentation used to create this class can be found: 
    http://groups.google.com/group/twitter-development-talk/web/api-documentation 
     
    Written by Matt Jewell 
    http://mediascratch.com 
*/ 

class twitterAPI { 
  
    public  $twitter_base         = 'http://twitter.com/statuses/'; 
    public $twitter_username     = 'your username'; 
    public $twitter_password     = 'your password'; 
     
     

    public function fetch_latest_status() { 
         
        /*  user_timeline 
            Returns the 20 most recent statuses posted in the last 24 hours from the authenticating user.  It's also possible to request another user's timeline via the id parameter below.         
         
            Parameters used: id  
                             count   
        */ 
         
        $buffer = file_get_contents($this -> twitter_base . 'user_timeline/' . $this -> twitter_username . '.xml?count=1'); 
                // Grab the contents of the XML file and store it in the variable. 
                 
        $xml    = new SimpleXMLElement($buffer); 
                // Creating a new XML string for use with the SimpleXML extension. 
                 
        $status_item = $xml -> status; 
                // Creating a new variable using SimpleXML with "status" as the Node. 
        return $status_item -> text; 
                // Grab the current status as the Element. 
    } 
     
     

    public function update_status($message){ 
     
         
        $curl = curl_init(); 
     
        curl_setopt($curl, CURLOPT_URL, $this -> twitter_base . 'update.xml?status='. stripslashes(urlencode($message))); 
            // The variable could also be substituded by the use of CURLOPT_POSTFIELDS 
             
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
            // Enables us to return the result as a string instead of outputting to browser. 

             
        curl_setopt($curl, CURLOPT_POST, 1); 
            // From the Twitter API docs: "Request must be a POST". CURLOPT_POST ensures this./ 
             
        $username = $this -> twitter_username; 
        $pass = $this -> twitter_password; 
             
        curl_setopt($curl, CURLOPT_USERPWD, "$username:$pass"); 
            // Authenticates the user (you) in the post request.    

         
        $exec = curl_exec($curl); 
            // Execute the cURL request. 
             
        // echo curl_error($curl);  
        // Used to debug cURL. 
         
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE); 
            // Return the HTTP headers so we can confirm the request. 
            // A list of what the status codes are and mean can be found here: 
            // http://www.seoconsultants.com/tools/headers.asp#code-200     
         
        curl_close($curl); 
            // Terminate the cURL session 
     
        return ($httpcode == 200) ? 'Updated!' : 'Error!'; 
            /* Ternary operator equivelant to: 
             
               IF httpcode equals 200  
                       Return done 
               ELSE  
                       Return error     
            */ 
             
    } 
} 

$deneme = new twitterAPI();

$deneme->twitter_username = $_POST['username'];
$deneme->twitter_password = $_POST['password'];
$mesaj = $_POST['massage'];
if( $_SESSION['tanim'] ){
$_SESSION['tanim'] = 1;
echo '<br>'.$mesaj;
$deneme->update_status($mesaj);
echo '<br><div align="center"><h5>Tweetiniz Gonderildi!</h5></div>';
$yazdir = $deneme->fetch_latest_status();
echo '<br>'.$yazdir;
}
?>
</body>
</html>