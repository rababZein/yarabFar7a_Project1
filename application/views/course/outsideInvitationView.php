  <link rel="stylesheet" type="text/css" href="../css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href=".../css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../css/nav.css" media="screen" />
    <link href="../css/table/demo_page.css" rel="stylesheet" type="text/css" />


      
    <script src="../js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="../js/table/jquery.dataTables.min.js" type="text/javascript"></script>
	<script src="../js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/dataTables.bootstrap.min.css">

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


