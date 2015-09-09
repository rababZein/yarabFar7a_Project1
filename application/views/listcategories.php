<!DOCTYPE html>
<html>
<head>
	<title>List Categories</title>
</head>
<body>

<a href="addcategory">Add Category</a>

<table border="2">

<tr>


<td> Category ID </td> 
<td> Category Name </td>
<td> Parent </td>


<td> Action </td>


</tr>
	
<?php

	foreach ($categories as $row) {
		$flag=1;
		echo "<tr id='".$row->cat_id."'>";
		echo "<td>".$row->cat_id."</td>";
		echo "<td>".$row->cat_name."</td>";
		$parent=$row->cat_parent_id;
		foreach ($categories as $cat) {
			if ($parent==$cat->cat_id) {
				echo "<td>".$cat->cat_name."</td>";
				$flag=0;
			}
		
	    }

	    if ($flag==1) {

	    	echo "<td>No Parent</td>";
	    	
	    }

		
		echo "<td><a href='edit?id=".$row->cat_id."'>Edit</a></td>";
		
		echo "<td><button  onclick='deletecategory(".$row->cat_id.")' > Delete button </button></td>";
		echo "</tr>";
	}


?>

</table>

<script src="http://code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>
<script type="text/javascript">

var base_url="<?=base_url()?>";
	


	function deletecategory (id){
     //   alert(id);
		$.get(base_url+"categorycontroller/deletecategory",{catid:id},function(data){

				

			var row=document.getElementById(id);

			 row.remove();


		});


	}





</script>

</body>
</html>