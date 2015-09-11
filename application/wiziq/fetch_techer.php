<?php
class fetchtecher
{
	private $result = array();
	
	function fetchtecher($secretAcessKey,$access_key,$webServiceUrl,$id=0)
	{
		require_once("AuthBase.php");
		$authBase = new AuthBase($secretAcessKey,$access_key);
		$method = "get_teacher_details";
		$requestParameters["signature"]=$authBase->GenerateSignature($method,$requestParameters);
		if($id)
			$requestParameters["teacher_id"] = $id ;
		#for teacher account pass parameter 'presenter_email'

		$httpRequest=new HttpRequest();
		try
		{
			$XMLReturn=$httpRequest->wiziq_do_post_request($webServiceUrl.'?method=get_teacher_details',http_build_query($requestParameters, '', '&')); 
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
		
			

			$methodTag=$objDOM->getElementsByTagName("teacher_id");
			for ($i=0; $i < $methodTag->length; $i++) { 
				$this->result[$i]['id'] =$methodTag->item($i)->nodeValue;
			}
			$methodTag=$objDOM->getElementsByTagName("name");
			for ($i=0; $i < $methodTag->length; $i++) { 
				$this->result[$i]['name'] =$methodTag->item($i)->nodeValue;
			}
			$methodTag=$objDOM->getElementsByTagName("email");
			for ($i=0; $i < $methodTag->length; $i++) { 
				$this->result[$i]['email'] =$methodTag->item($i)->nodeValue;
			}	
			$methodTag=$objDOM->getElementsByTagName("image");
			for ($i=0; $i < $methodTag->length; $i++) { 
				$this->result[$i]['image'] =$methodTag->item($i)->nodeValue;
			}
			$methodTag=$objDOM->getElementsByTagName("phone_number");
			for ($i=0; $i < $methodTag->length; $i++) { 
				$this->result[$i]['phone_number'] =$methodTag->item($i)->nodeValue;
			}
			$methodTag=$objDOM->getElementsByTagName("password");
			for ($i=0; $i < $methodTag->length; $i++) { 
				$this->result[$i]['password'] =$methodTag->item($i)->nodeValue;
			}
			$methodTag=$objDOM->getElementsByTagName("is_active");
			for ($i=0; $i < $methodTag->length; $i++) { 
				$this->result[$i]['is_active'] =$methodTag->item($i)->nodeValue;
			}
			/*$class_idTag=$objDOM->getElementsByTagName("class_id");
			echo "<br>Class ID=".$class_id=$class_idTag->item(0)->nodeValue;
			$recording_urlTag=$objDOM->getElementsByTagName("recording_url");
			echo "<br>recording_url=".$recording_url=$recording_urlTag->item(0)->nodeValue;
			$presenter_emailTag=$objDOM->getElementsByTagName("presenter_email");
			echo "<br>presenter_email=".$presenter_email=$presenter_emailTag->item(0)->nodeValue;
			$presenter_urlTag=$objDOM->getElementsByTagName("presenter_url");
			echo "<br>presenter_url=".$presenter_url=$presenter_urlTag->item(0)->nodeValue;*/
			
		}
		else if($attribNode=="fail")
		{
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