<?php
	class scraper{
		
		private $curl;
		
		public function __construct(){
			$this->curl;
    }
    private function set_up(){
			curl_setopt($this->curl, CURLOPT_USERAGENT,'Google Chrome Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36');
      curl_setopt($this->curl, CURLOPT_HTTPHEADER, [
      'Origin: https://freecarrierlookup.com',
      'Host: freecarrierlookup.com',
      'Referer: https://freecarrierlookup.com/'
      ]);
			curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
      $this->cookie_jar = 'cookies.txt';
      curl_setopt ($this->curl, CURLOPT_COOKIEJAR, $this->cookie_jar); 
      curl_setopt ($this->curl, CURLOPT_COOKIEFILE, $this->cookie_jar); 
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

$scraper = new scraper();
$scraper->get_html("https://freecarrierlookup.com");
echo $scraper->post_data("https://freecarrierlookup.com/getcarrier.php",["phonenum"=>"3146203239", "cc"=>"1", "test"=>"456"]);
echo "done";
?>
