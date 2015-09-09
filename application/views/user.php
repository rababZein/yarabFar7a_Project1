<!DOCTYPE html>
<html>
<head>
	<title>List users</title>
</head>
<body>

<table border="2">

<tr>


<td> User ID </td> 
<td> User Name </td>
<td> User Type </td>
<td> User Email </td>
<td> User Mobile </td>
<td> User Image </td>
<td> User Address </td>

<td> Action </td>


</tr>
	
<?php

	foreach ($users as $row) {
		echo "<tr id='".$row->user_id."'>";
		echo "<td>".$row->user_id."</td>";
		echo "<td>".$row->user_name."</td>";
		echo "<td>".$row->user_type."</td>";
		echo "<td>".$row->user_email."</td>";
		echo "<td>".$row->user_mobile."</td>";
		echo "<td>".$row->user_image."</td>";
		echo "<td>".$row->user_address."</td>";
		echo "<td><a href='edit?id=".$row->user_id."'>Edit</a></td>";
		
		echo "<td><button  onclick='deleteuser(".$row->user_id.")' > Delete button </button></td>";
		echo "</tr>";
	}


?>

</table>

<script src="http://code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>
<script type="text/javascript">

var base_url="<?=base_url()?>";
	


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