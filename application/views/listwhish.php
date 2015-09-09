<!DOCTYPE html>
<html>
<head>
	<title>List users</title>
</head>
<body>

<table border="2">

<tr>


<td> Whish ID </td> 
<td> Whish category ID </td>
<td> User Name </td>
<td> Whish min price </td>
<td> Whish max price </td>



<td> Action </td>


</tr>
	
<?php
        $i=0;
	foreach ($whish as $row) {
		
		echo "<tr id='".$row->whish_id."'>";
		echo "<td>".$row->whish_id."</td>";

		echo "<td>".$category[$i]->cat_name."</td>";
		echo "<td>".$user[$i]->user_name."</td>";
		echo "<td>".$row->whish_price_min."</td>";
		echo "<td>".$row->whish_price_max."</td>";

		echo "<td><a href='edit?id=".$row->whish_id."'>Edit</a></td>";
		
		echo "<td><button  onclick='deletewhish(".$row->whish_id.")' > Delete button </button></td>";
		echo "</tr>";
		$i++;
	}


?>

</table>

<script src="http://code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>
<script type="text/javascript">

var base_url="<?=base_url()?>";
	


	function deletewhish (id){
		//alert(id);

		$.get(base_url+"whishcontroller/deletewhish",{whishid:id},function(data){


			var row=document.getElementById(id);

			 row.remove();

			// alert(data);


		});


	}





</script>

</body>
</html>