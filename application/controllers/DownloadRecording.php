<?php

header('Content-type: text/xml');

class DownloadRecording
{
	private $result = array();

	function DownloadRecording($secretAcessKey,$access_key,$webServiceUrl,$classId)
	{

		require_once("AuthBase.php");
		$authBase = new AuthBase($secretAcessKey,$access_key);
		$method = "download_recording";
		$requestParameters["signature"]=$authBase->GenerateSignature($method,$requestParameters);
		$requestParameters["class_id"] = $classId;
		$requestParameters["recording_format"] = "zip";

		$httpRequest=new HttpRequest();
		try
		{
			header('Content-type: text/html');
			$XMLReturn=$httpRequest->wiziq_do_post_request($webServiceUrl.'?method=download_recording',http_build_query($requestParameters, '', '&'));
            //echo $XMLReturn;
		}
		catch(Exception $e)
		{
            header('Content-type: text/html');
	  		//echo $e->getMessage();
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
			 // echo $e->getMessage();
			}
		$status=$objDOM->getElementsByTagName("rsp")->item(0);
    	$attribNode = $status->getAttribute("status");
    	//echo $attribNode;
		if($attribNode=="ok")
		{
			$this->result['state'] = 1;
			$methodTag=$objDOM->getElementsByTagName("method");
			$this->result['message']=$objDOM->getElementsByTagName("message")->item(0)->nodeValue;
			//echo "string";
			
		}
		else if($attribNode=="fail")
		{
			$this->result['state'] = 0;
			$error=$objDOM->getElementsByTagName("error")->item(0);
   			//echo "<br>errorcode=".$errorcode = $error->getAttribute("code");	
   			$this->result['message']=$error->getAttribute("msg");	

   			//echo "jjj";
		}
	 }//end if

    }//end function

    public function return_result(){
   		return $this->result;
    }

}
?>