<!DOCTYPE html>
<html>
<head>

 
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


	<title>List Categories</title>
</head>
<body>

<a href="addcategory">Add Category</a>

<table class="data display datatable" id="example" cellpadding="0" cellspacing="0" border="2">

<thead>
<tr>


<th> Category ID </th> 
<th> Category Name </th>
<th> Parent </th>


<th> Edit </th>
<th> Delete </th>


</tr>
</thead>
<tbody>
	
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
</tbody>
</table>

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