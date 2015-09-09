<!DOCTYPE html>
<html>
<head>
	<title>List Adv</title>
</head>
<body>

<table border="2">

<tr>


<td> Adv ID </td> 
<td> category </td>
<td> Owner Name </td>
<td> Price </td>
<td> Desc </td>



<td> Action </td>


</tr>
	
<?php
        $i=0;
	foreach ($adv as $row) {
		
		echo "<tr id='".$row->adv_id."'>";
		echo "<td>".$row->adv_id."</td>";

		echo "<td>".$category[$i]->cat_name."</td>";
		echo "<td>".$user[$i]->user_name."</td>";
		echo "<td>".$row->adv_price."</td>";
		echo "<td>".$row->adv_desc."</td>";

		echo "<td><a href='edit?id=".$row->adv_id."'>Edit</a></td>";
		
		echo "<td><button  onclick='deleteadv(".$row->adv_id.")' > Delete button </button></td>";
		echo "</tr>";
		$i++;
	}


?>

</table>

<script src="http://code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>
<script type="text/javascript">

var base_url="<?=base_url()?>";
	


	function deleteadv (id){
		//alert(id);

		$.get(base_url+"advcontroller/deleteadv",{advid:id},function(data){


			var row=document.getElementById(id);

			 row.remove();

			// alert(data);


		});


	}





</script>

</body>
</html>