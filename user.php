<!DOCTYPE html>
<html>
<head>
	<title>List users</title>

  <link rel="stylesheet" type="text/css" href="/yarabfar7a1/css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="/yarabfar7a1/css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="/yarabfar7a1/css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="/yarabfar7a1/css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="/yarabfar7a1/css/nav.css" media="screen" />
    <link href="/yarabfar7a1/css/table/demo_page.css" rel="stylesheet" type="text/css" />


      
    <script src="/yarabfar7a1/js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="/yarabfar7a1/js/table/jquery.dataTables.min.js" type="text/javascript"></script>
	<script src="/yarabfar7a1/js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="/yarabfar7a1/js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="/yarabfar7a1/js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="/yarabfar7a1/js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="/yarabfar7a1/js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="/yarabfar7a1/js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/dataTables.bootstrap.min.css">

</head>
<body>

	<br>

<table class="data display datatable" id="example" cellpadding="0" cellspacing="0" border="0">
<thead>
<tr>


<th> User ID </th> 
<th> User Name </th>
<th> User Type </th>
<th> User Email </th>
<th> Edit </th>
<th> Delete </th>


</tr>
	
	</thead>

	                    <tbody>

<?php

	foreach ($users as $row) {
		echo "<tr id='".$row->user_id."'>";
		echo "<td>".$row->user_id."</td>";
		echo "<td>".$row->user_name."</td>";
		echo "<td>".$row->user_type."</td>";
		echo "<td>".$row->user_email."</td>";
		echo "<td><a href='edit?id=".$row->user_id."'>Edit</a></td>";
		
		echo "<td><button  onclick='deleteuser(".$row->user_id.")' > Delete button </button></td>";
		echo "</tr>";
	}


?>
</tbody>
</table>

<script type="text/javascript">

var base_url="<?=base_url()?>";
	
$(document).ready(function() {
    $('#example').dataTable();
});

	function deleteuser (id){
        alert(id);
		$.get(base_url+"usercontroller/deleteuser",{userid:id},function(data){

				

			var row=document.getElementById(id);

			 row.remove();


		});


	}





</script>

</body>
</html>