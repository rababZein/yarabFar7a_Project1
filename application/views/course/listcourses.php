<!DOCTYPE html>
<html>
<head>
	<title>List Courses</title>
</head>
<body>

<table border="2">

<tr>


<td> Course ID </td> 
<td> Course TiTle </td>
<td> Course category </td>
<td> Course Teacher </td>
<td> Send Invitation To Student </td>


<td> Add Topic </td>
<td> Edit </td>
<td> Delete </td>

</tr>
	
<?php
        $i=0;
	foreach ($courses as $course) {
		
		echo "<tr id='".$course->course_id."'>";
		echo "<td>".$course->course_id."</td>";
		echo "<td><a href='showcourse?id=".$course->course_id."'>".$course->course_title."</a></td>";
		echo "<td>".$category[$i]->cat_name."</td>";
		echo "<td>".$teacher[$i]->user_name."</td>";
		echo "<td><a href='listStudent?courseId=".$course->course_id."'>Invite</a></td>";
		echo "<td><a href='../topiccontroller/addtopic?id=".$course->course_id."'>Add Topic</a></td>";
		echo "<td><a href='edit?id=".$course->course_id."'>Edit</a></td>";
		
		echo "<td><button  onclick='deletecourse(".$course->course_id.")' > Delete button </button></td>";
		echo "</tr>";
		$i++;
	}


?>

</table>

<script src="http://code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>
<script type="text/javascript">

var base_url="<?=base_url()?>";
	


	function deletecourse (id){
		//alert(id);

		$.get(base_url+"coursecontroller/deletecourse",{courseId:id},function(data){


			var row=document.getElementById(id);

			 row.remove();

			// alert(data);


		});


	}





</script>

</body>
</html>