<?php
class ModifyClass
{
	private $result = array();
	function ModifyClass($secretAcessKey,$access_key,$webServiceUrl,$array = array())
	{
		require_once("AuthBase.php");
		$authBase = new AuthBase($secretAcessKey,$access_key);
		$method = "modify";
		$requestParameters["signature"]=$authBase->GenerateSignature($method,$requestParameters);
		$requestParameters["class_id"] = $array['class_id'];

		$requestParameters["start_time"] = $array['start_time'];; 
		$requestParameters["title"]=$array['title']; //Required
		$requestParameters["duration"]=$array['duration']; //optional
		$requestParameters["time_zone"]="Africa/Cairo"; //optional
		$requestParameters["attendee_limit"]=$array['name']; //optional
		$requestParameters["control_category_id"]=""; //optional
		$requestParameters["create_recording"]=""; //optional
		$requestParameters["return_url"]=""; //optional
		$requestParameters["status_ping_url"]=""; //optional
        $requestParameters["language_culture_name"]="ar-SA";
		$httpRequest=new HttpRequest();
		try
		{
			$XMLReturn=$httpRequest->wiziq_do_post_request($webServiceUrl.'?method=modify',http_build_query($requestParameters, '', '&')); 
		}
		catch(Exception $e)
		{	
	  		echo $e->getMessage();
		}
 		if(!empty($XMLReturn))
 		{
 			try
			{
			  $objDOM = new DOMDocument();
			  $objDOM->loadXML($XMLReturn);
	  
			}
			catch(Exception $e)
			{
			  echo $e->getMessage();
			}
			$status=$objDOM->getElementsByTagName("rsp")->item(0);
    		$attribNode = $status->getAttribute("status");
			if($attribNode=="ok")
			{
				$this->result['state'] = 1;
				$this->result['id'] = $array['class_id'];
				$methodTag=$objDOM->getElementsByTagName("method");
				echo "method=".$method=$methodTag->item(0)->nodeValue;
				$modifyTag=$objDOM->getElementsByTagName("modify")->item(0);
				echo "<br>modify=".$modify = $modifyTag->getAttribute("status");
			}
			else if($attribNode=="fail")
			{
				$this->result['state'] = 0;
				$error=$objDOM->getElementsByTagName("error")->item(0);
				echo "<br>errorcode=".$errorcode = $error->getAttribute("code");	
				echo "<br>errormsg=".$errormsg = $error->getAttribute("msg");	
			}
	 	}//end if	
   }//end function
       public function return_result(){
   		return $this->result;
   }
	
}
?>