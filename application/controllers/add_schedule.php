<?php
class addschedule
{
	
	private $result = array();
	function addschedule($secretAcessKey,$access_key,$webServiceUrl,$array = array())
	{
		require_once("AuthBase.php");
		$authBase = new AuthBase($secretAcessKey,$access_key);
		$method = "create";
		$requestParameters["signature"]=$authBase->GenerateSignature($method,$requestParameters);
		#for teacher account pass parameter 'presenter_email'
                //This is the unique email of the presenter that will identify the presenter in WizIQ. Make sure to add
                //this presenter email to your organization�s teacher account. � For more information visit at: (http://developer.wiziq.com/faqs)
		

		
		$requestParameters["presenter_email"]=$array['presenter_email'];
		#for room based account pass parameters 'presenter_id', 'presenter_name'
		//$requestParameters["presenter_id"] = "40";
		//$requestParameters["presenter_name"] = "vinugeorge";  
		$requestParameters["start_time"] = $array['start_time'];
		$requestParameters["title"]= $array['title'] ;//Required
		$requestParameters["duration"]=$array['duration'];; //optional
		$requestParameters["time_zone"]=$array['time_zone']; //optional
		$requestParameters["attendee_limit"]=$array['attendee_limit']; //optional
		$requestParameters["control_category_id"]=""; //optional
		$requestParameters["create_recording"]=""; //optional
		$requestParameters["return_url"]=""; //optional
		$requestParameters["status_ping_url"]=""; //optional
        $requestParameters["language_culture_name"]="ar-SA";



		$httpRequest=new HttpRequest();
		try
		{
			$XMLReturn=$httpRequest->wiziq_do_post_request($webServiceUrl.'?method=create',http_build_query($requestParameters, '', '&')); 
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
			$methodTag=$objDOM->getElementsByTagName("method");
			//echo "method=".$method=$methodTag->item(0)->nodeValue;
			$class_idTag=$objDOM->getElementsByTagName("class_id");
			$this->result['id'] = $class_idTag->item(0)->nodeValue;
			$recording_urlTag=$objDOM->getElementsByTagName("recording_url");
			//echo "<br>recording_url=".$recording_url=$recording_urlTag->item(0)->nodeValue;
			$this->result['recording_url']=$recording_urlTag->item(0)->nodeValue;
			$presenter_emailTag=$objDOM->getElementsByTagName("presenter_email");
			//echo "<br>presenter_email=".$presenter_email=$presenter_emailTag->item(0)->nodeValue;
			$this->result['presenter_email']=$presenter_emailTag->item(0)->nodeValue;
			$presenter_urlTag=$objDOM->getElementsByTagName("presenter_url");
			$this->result['presenter_url'] =$presenter_urlTag->item(0)->nodeValue;
		}
		else if($attribNode=="fail")
		{
			$this->result['state'] = 0;
			
			$error=$objDOM->getElementsByTagName("error")->item(0);
   			//echo "<br>errorcode=".$errorcode = $error->getAttribute("code");	
   			$this->result['errorMsg']="<br>".$errormsg = $error->getAttribute("msg");	
		}
	 }//end if	
   }//end function
    public function return_result(){
   		return $this->result;
   }
	
}
?>