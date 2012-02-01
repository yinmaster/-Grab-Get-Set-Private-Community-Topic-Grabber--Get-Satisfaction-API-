<?php
require_once 'HTTP/Request2.php';
require_once 'config.inc.php';

/**
* Class Making a call to Get Satisfaction to pull and parse json topics
*
* PHP version 5
*
* LICENSE:
*
* Copyright (c) 2012-2013, Sheldon Callahan <sheldon.callahan@servicemax.com>
* All rights reserved.
*
* Redistribution and use in source and binary forms, with or without
* modification, are permitted provided that the following conditions
* are met:
*
*    * Redistributions of source code must retain the above copyright
*      notice, this list of conditions and the following disclaimer.
*    * Redistributions in binary form must reproduce the above copyright
*      notice, this list of conditions and the following disclaimer in the
*      documentation and/or other materials provided with the distribution.
*    * The names of the authors may not be used to endorse or promote products
*      derived from this software without specific prior written permission.
*
* THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS
* IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO,
* THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR
* PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR
* CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
* EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
* PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
* PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY
* OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
* NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
* SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/

class Topic 
{
	var $request;
	var $topics;
	var $response;
    var $company;
	var $title;
	var $return_type;
	var $article_amt;
	var $category;
	var $connectionString;
	var $cat_array_value;
	var $list_class_name;



	
	
	function __construct()
	{
	//Intial Class and pull URL Values

	 $this->return_type = $_GET['type'];
	 $this->title = $_GET['title'];	
	 $this->company = $_GET['company'];	
	 $this->article_amt = $_GET['article_amt'];	
	 $this->category = $_GET['category'];
	 $this->list_class_name = $_GET['class_name'];	
	
	
	
	
	
	switch ($this->category) {
		case 'topics':
				$this->connectionString = $auth_config['host']."/companies/".$this->company."/topics.json?";
				
				$this->cat_array_value = "subject";
			break;
			case 'idea':
					$this->connectionString = $auth_config['host']."/companies/".$this->company."/topics.json?style=idea";
					$this->cat_array_value = "subject";
				break;
				
				case 'products':
			
						$this->connectionString = $auth_config['host']."/companies/".$this->company."/products.json?";
						$this->cat_array_value = "name";
					
					break;
		
		default:
				$this->connectionString = $auth_config['host']."/companies/".$this->company."/topics.json?";
				$this->cat_array_value = "subject";
			break;
	}

 


	}
	
	public function open_connection($url, $usr, $pass)
	{
		//Open Connection and sent authorization to Get Satisfaction
	   $this->request = new HTTP_Request2($url,HTTP_Request2::METHOD_GET, array());
		
		$this->request->setAuth($usr,$pass, HTTP_Request2::AUTH_BASIC);
		
	}
	

	
	public function get_topics($type="list", $category="topics", $title='',$article_num = '5',$link, $class_name ="")
	{
			$this->response = $this->request->send();

			$body = $this->response->getBody();

			$data = json_decode($body,true);

			$this->topics = $data;
			
			
			if ($type == "list") {
			

								echo "<ul> <h2 class='{$class_name}'> {$title} </h2>";
								
										for ($i=0; $i < $article_num ; $i++) { 
											echo "<li> <a href='{$link}'>";
											echo $data["data"][$i][$this->cat_array_value];
											echo '</a> </li>' ;         
										}

								
								

								echo '</ul>';
								
			}else if($type == "array"){
									 print_r($this->topics);
				
			}
			
			

			
			
			


  
		
	}
	
	
	
	
	function __destruct()
	{
	
	}
	
	
	
}

$topic = new Topic();
$topic->open_connection(HOST."{$topic->connectionString}" , USERNAME, PASSWORD ) ;
$topic->get_topics( $topic->return_type, $topic->category, $topic->title, $topic->article_amt, COMMUNITYLINK, $topic->list_class_name);









?>