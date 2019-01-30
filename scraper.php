<?php
class scraper{
	private $curl;
	public function __construct(){
		$this->curl;
    $this->headers = [];
    $this->user_agents = [

    'Google Chrome Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36',

    'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.110 Safari/537.36',

    'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36',

    'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:63.0) Gecko/20100101 Firefox/63.0',

    'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36',

    'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.0.1 Safari/605.1.15'
    ];
    $this->cookie_file = 'cookies.txt';
    $this->user_agent = $this->user_agents[array_rand($this->user_agents)];
  }

  public function force_user_agent($user_agent){
    $this->user_agent = $user_agent;
  }

  public function add_header($headers){
    if(is_array($headers)){
      foreach($headers as $header){
        $this->headers[] = $header;
      }
    }
    else{
      $this->headers[] = $headers;
    }
    return $this;

  }

  public function clear_cookies(){
    $cookie_file = fopen($this->id.'.txt', 'w');
    fwrite($cookie_file, "");
    fclose($cookie_file);
  }

  public function set_headers($headers){
    $this->headers = $headers;
  }

  private function set_up(){
		curl_setopt($this->curl, CURLOPT_USERAGENT, $this->user_agent);
    curl_setopt($this->curl, CURLOPT_HTTPHEADER, $this->headers);
		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt ($this->curl, CURLOPT_COOKIEJAR, $this->cookie_file); 
    curl_setopt ($this->curl, CURLOPT_COOKIEFILE, $this->cookie_file); 
	}

  public function set_cookie_jar_name($name){
    $this->cookie_file = $name;
  }

	public function __destruct(){
		$this->curl->close();
	}

	public function set_user_agent($user_agent_string){
		curl_setopt($this->curl,CURLOPT_USERAGENT,$user_agent_string);
	}

	public function get_html($url){
    $this->curl = curl_init($url);
    $this->set_up();
		curl_setopt($this->curl, CURLOPT_POST, false);
		$responce = curl_exec($this->curl);
		return $responce;
	}
	public function post_data($url, $arr){
    $this->curl = curl_init($url);
    $this->set_up();
		curl_setopt($this->curl, CURLOPT_POST, True);
		curl_setopt($this->curl, CURLOPT_POSTFIELDS, $arr);
		return curl_exec($this->curl);
	}
		
}

