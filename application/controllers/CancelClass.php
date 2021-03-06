<?php
class CancelClass
{
	private $result = array();
	
	function CancelClass($secretAcessKey,$access_key,$webServiceUrl,$id)
	{
		require_once("AuthBase.php");
		$authBase = new AuthBase($secretAcessKey,$access_key);
		$method = "cancel";
		$requestParameters["signature"]=$authBase->GenerateSignature($method,$requestParameters);
		$requestParameters["class_id"] = $id;
		$httpRequest=new HttpRequest();
		try
		{
			$XMLReturn=$httpRequest->wiziq_do_post_request($webServiceUrl.'?method=cancel',http_build_query($requestParameters, '', '&')); 
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
				echo "method=".$method=$methodTag->item(0)->nodeValue;
				$cancelTag=$objDOM->getElementsByTagName("cancel")->item(0);
				echo "<br>cancel=".$cancel = $cancelTag->getAttribute("status");
			    $this->result['successMsg']="<br>cancel=".$cancel = $cancelTag->getAttribute("status");
			}
			else if($attribNode=="fail")
			{
				$this->result['state'] = 0;
				$error=$objDOM->getElementsByTagName("error")->item(0);
				echo "<br>errorcode=".$errorcode = $error->getAttribute("code");	
				echo "<br>errormsg=".$errormsg = $error->getAttribute("msg");	
				$this->result['errorMsg']=$errormsg = $error->getAttribute("msg");
			}
	 	}//end if	
   }//end function

   public function return_result(){
   		return $this->result;
   }
	
}
?>