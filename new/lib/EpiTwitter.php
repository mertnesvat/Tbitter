<?php
class EpiTwitter extends EpiOAuth
{
  const EPITWITTER_SIGNATURE_METHOD = 'HMAC-SHA1';
  protected $requestTokenUrl = 'http://twitter.com/oauth/request_token';
  protected $accessTokenUrl = 'http://twitter.com/oauth/access_token';
  protected $authorizeUrl = 'http://twitter.com/oauth/authorize';
  protected $apiUrl = 'http://twitter.com';

  public function __call($name, $params = null)
  {
    $parts  = explode('_', $name);
    $method = strtoupper(array_shift($parts));
    $parts  = implode('_', $parts);
    $url    = $this->apiUrl . '/' . preg_replace('/[A-Z]|[0-9]+/e', "'/'.strtolower('\\0')", $parts) . '.json';
    
    echo 'STRCMP='.strcmp($name, 'ekle').'name = '.$name;
    if(!strcmp($parts, 'ekle'))
    {
    	$url = 'http://api.twitter.com/friendships/create.json';
    	$method = 'POST';
    }
    else if(!strcmp($parts, 'sil'))
    {
    	$url = 'http://api.twitter.com/1/friendships/destroy.json';
    	$method = 'POST';
    }
    	
    
    echo "<br> KAM ON ! URL = ".$url."<br> METHOD = ".$method."<br> PARTS = ".$parts;
    if(!empty($params))
      $args = array_shift($params);
	
    echo '<br>ARGS = ';
    print_r($args);
    
    return new EpiTwitterJson(call_user_func(array($this, 'httpRequest'), $method, $url, $args));
  }

  public function __construct($consumerKey = null, $consumerSecret = null, $oauthToken = null, $oauthTokenSecret = null)
  {
    parent::__construct($consumerKey, $consumerSecret, self::EPITWITTER_SIGNATURE_METHOD);
    $this->setToken($oauthToken, $oauthTokenSecret);
  }
}

class EpiTwitterJson
{
  private $resp;

  public function __construct($resp)
  {
    $this->resp = $resp;
  }

  public function __get($name)
  {
    $this->responseText = $this->resp->data;
    $this->response = (array)json_decode($this->responseText, 1);
    foreach($this->response as $k => $v)
    {
      $this->$k = $v;
    }

    return $this->$name;
  }
}
