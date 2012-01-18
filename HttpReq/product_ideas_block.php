<?php
require_once 'HTTP/Request2.php';
/**
* Class Making a call to Get Satisfaction
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

	
	
	function __construct()
	{
	
		$this->request = "<ul> Product Ideas";
		//$this->topics = array('topic 1', 'topic 2', 'topic 3');

	}
	
	public function open_connection($url, $usr, $pass)
	{
	   $this->request = new HTTP_Request2($url,HTTP_Request2::METHOD_GET, array());
		
		$this->request->setAuth($usr,$pass, HTTP_Request2::AUTH_BASIC);
		
	}
	
	public function get_topics($num = '5')
	{
		$this->response = $this->request->send();
		
		$body = $this->response->getBody();

		$data = json_decode($body,true);
		
		//$this->topics = $data;
	
	
	
		for ($i=0; $i < $num ; $i++) { 


			echo '<li> <a href="http://community.servicemax.com">';
			echo $data["data"][$i]["name"];
			echo '</a> </li>' ;


		}
		echo '</ul>';		
	}
	
	
	function __destruct()
	{
	
	}
	
	
	
}

$topic = new Topic();

echo $topic->request ;
echo $topic->open_connection('http://api.getsatisfaction.com/companies/servicemax/products.json','sheldon.callahan+api@servicemax.com','servicemax123' ) ;
$topic->get_topics(6);




?>