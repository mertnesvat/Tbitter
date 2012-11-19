<?php
$to = "mertnesvat@gmail.com";
$subject = "Test mail";
$message = "Hello! This is a simple email message.";
$from = "someonelse@example.com";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
class UserTweets
{
  var $username = '';
  var $page_content = '';
  var $encoded_content = array();
  var $results = array();
  var $user_info = array();
  var $result_count = 0;
  var $connected = false;
 
  function __construct($username, $options = array())
  {
    $this->username = $username;
 
    $request_options = array(
      'since_id', 'max_id', 'count', 'page'
    );
 
    $option_set = array();
    $option_string = 'screen_name='.urlencode($username);
 
    if(!empty($options))
    {
      foreach($request_options as $req)
      {
        if(isset($options[$req]))
        {
          $option_set[$req] = $options[$req];
          $option_string .= '&'.$req.'='.urlencode($options[$req]);
        }
      }
    }
 
    $url = 'http://api.twitter.com/1/statuses/user_timeline.json?'.$option_string;
 
    $connection = @curl_init();
 
    if($connection)
    {
      curl_setopt($connection, CURLOPT_URL, $url);
      curl_setopt($connection, CURLOPT_HEADER, false);
      curl_setopt($connection, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($connection, CURLOPT_CONNECTTIMEOUT, 30);
 
      $this->page_content = curl_exec($connection);
 
      curl_close($connection);
 
      $this->connected = true;
    }
    else
    {
      $connection = @file_get_contents($url);
 
      if($connection)
      {
        $this->page_content = $connection;
 
        $this->connected = true;
      }
    }
 
    if($this->connected)
    {
      $this->results = json_decode($this->page_content, true);
      $this->result_count = count($this->results);
      if($this->result_count > 0)
      {
        $this->user_info = $this->results[0]['user'];
        foreach($this->results as &$result)
        {
          unset($result['user']);
        }
      }
    }
  }
}
/*
$options = array(
  'max_id' => 12402600172,
  'count' => 5
);
 */
$tweets = new UserTweets('mertrix', $options);

if($tweets->result_count > 0)
{
  echo '<h1>Tweets</h1>';
  echo '<ol>';
  foreach($tweets->results as $tweet)
  {
    echo '<li>'.$tweet['text'].'</li>';
  }
  echo '</ol>';
}

?>