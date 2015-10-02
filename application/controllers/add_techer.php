<?php
class addteacher
{
	
	private $result = array();
	function addteacher($secretAcessKey,$access_key,$webServiceUrl,$array = array())
	{
		require_once("AuthBase.php");
		$authBase = new AuthBase($secretAcessKey,$access_key);
		$method = "add_teacher";
		$requestParameters["signature"]=$authBase->GenerateSignature($method,$requestParameters);
		#for teacher account pass parameter 'presenter_email'
                //This is the unique email of the presenter that will identify the presenter in WizIQ. Make sure to add
                //this presenter email to your organization�s teacher account. � For more information visit at: (http://developer.wiziq.com/faqs)
		
		$requestParameters["name"]= ($array['name']);
		$requestParameters["email"]= $array['email'];
		$requestParameters["password"]= $array['password'];
		$requestParameters["image"]= $array['image'];
		$requestParameters["phone_number"]= $array['phone_number'];
		
		$requestParameters["about_the_teacher"]= "Online Facilitator and Teacher, British Columbia, Canada";
		$requestParameters["is_active"]= $array['is_active'];

		$httpRequest=new HttpRequest();
		try
		{
			$XMLReturn=$httpRequest->wiziq_do_post_request($webServiceUrl.'?method=add_teacher',http_build_query($requestParameters, '', '&')); 
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
			$this->result['teacher_id']=$objDOM->getElementsByTagName("teacher_id")->item(0)->nodeValue;
			//$result['presenter_url']=$presenter_url=$presenter_urlTag->item(0)->nodeValue;
			//echo 'teacher_id'.$objDOM->getElementsByTagName("teacher_id")->item(0)->nodeValue;

		}
		else if($attribNode=="fail")
		{
			$this->result['state'] = 0;
			$error=$objDOM->getElementsByTagName("error")->item(0);
   			//echo "<br>errorcode=".$errorcode = $error->getAttribute("code");	
   			$this->result['errorMsg']="<br>errormsg=".$errormsg = $error->getAttribute("msg");	
		}
	 }//end if	
   }//end function

   public function return_result(){
   		return $this->result;
   }
	
}
?>