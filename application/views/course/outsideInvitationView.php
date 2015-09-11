<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>  
<script type="text/javascript">
var base_url="<?=base_url()?>";

function outsideInvitation (courseId) {
	$("#msg").text("Wait .. ");
	var emails = document.getElementById('emails').value;

	$.ajax({
	    url: base_url+'coursecontroller/outsideInvitation' ,
	    type: 'GET',
	    data: {  
	   		emails: emails, 
            courseId: courseId,
	   	    },
	    success: function(result) {
	    			$("#msg").text("Done ^_^");
	    			document.getElementById('emails').value="";
				  },
		error: function(jqXHR, textStatus, errorThrown) {
	                $("#msg").text("Failed try again .. ");
	           }

	});
		    	


}
</script>

<label> Enter all Emails of student , who not in site , by coma seperator  like this ( , ).</label>
		<br/>
		<textarea id='emails' name="enterEmails" cols="70" rows="5"></textarea>
		<button id="button" onclick="outsideInvitation(<?php echo $courseId;?>)">Send</button> 


		<span id='msg'></span>


