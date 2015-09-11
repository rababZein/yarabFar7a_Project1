<?php
class editteacher
{
	
	
	function editteacher($secretAcessKey,$access_key,$webServiceUrl,$array = array())
	{
		require_once("AuthBase.php");
		$authBase = new AuthBase($secretAcessKey,$access_key);
		$method = "edit_teacher";
		$requestParameters["signature"]=$authBase->GenerateSignature($method,$requestParameters);
		#for teacher account pass parameter 'presenter_email'
                //This is the unique email of the presenter that will identify the presenter in WizIQ. Make sure to add
                //this presenter email to your organization�s teacher account. � For more information visit at: (http://developer.wiziq.com/faqs)
		$requestParameters["teacher_id"]= $array['teacher_id'];
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
			$XMLReturn=$httpRequest->wiziq_do_post_request($webServiceUrl.'?method=edit_teacher',http_build_query($requestParameters, '', '&')); 
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
			$methodTag=$objDOM->getElementsByTagName("method");
			echo "method=".$method=$methodTag->item(0)->nodeValue;
			$class_idTag=$objDOM->getElementsByTagName("class_id");
			echo "<br>Class ID=".$class_id=$class_idTag->item(0)->nodeValue;
			$recording_urlTag=$objDOM->getElementsByTagName("recording_url");
			echo "<br>recording_url=".$recording_url=$recording_urlTag->item(0)->nodeValue;
			$presenter_emailTag=$objDOM->getElementsByTagName("presenter_email");
			echo "<br>presenter_email=".$presenter_email=$presenter_emailTag->item(0)->nodeValue;
			$presenter_urlTag=$objDOM->getElementsByTagName("presenter_url");
			echo "<br>presenter_url=".$presenter_url=$presenter_urlTag->item(0)->nodeValue;
		}
		else if($attribNode=="fail")
		{
			$error=$objDOM->getElementsByTagName("error")->item(0);
   			echo "<br>errorcode=".$errorcode = $error->getAttribute("code");	
   			echo "<br>errormsg=".$errormsg = $error->getAttribute("msg");	
		}
	 }//end if	
   }//end function
	
}
?>