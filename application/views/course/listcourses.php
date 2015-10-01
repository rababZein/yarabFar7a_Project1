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
<link rel="stylesheet" href="../css/bootstrap.css">

	<title>List Courses</title>
</head>
<body>
<?php $session_data = $this->session->userdata('logged_in'); ?>
<table class="data display datatable" id="example" cellpadding="0" cellspacing="0" border="0">


<thead>
<tr>



<th> Course TiTle </th>
<th> Course category </th>
<th> Course Teacher </th>
<th> Status </th>

<?php if($session_data['type']=='admin' || $session_data['type']=='super admin' || $session_data['admin']==1){?>
<th> Student </th>
<th> Send Invitation To Student </th>

<th> Add Topic </th>

<th> Edit </th>
<th> Delete </th>
<?php }?>

</tr>
	</thead>

	<tbody>
<?php
        $i=0;
        if(!empty($courses)){
				foreach ($courses as $course) {
					
					echo "<tr id='".$courses[$i]->course_id."'>";
			
					echo "<td><a href='showcourse?id=".$courses[$i]->course_id."'>".$courses[$i]->course_title."</a></td>";
					echo "<td>".$category[$i]->cat_name."</td>";
					echo "<td>".$teacher[$i]->user_name."</td>";
					if ( date('Y-m-d H:i:s')  > $courses[$i]->course_end_time ) {
						echo "<td style='color:red'>  Finished </td>";
					}else {
						if (date('Y-m-d H:i:s') >= $courses[$i]->course_start_time) {
								echo "<td style='color:green'> Started </td>";
						}else{

							    echo "<td style='color:blue'> Upcoming </td>";
						}
					}
if($session_data['type']=='admin' || $session_data['type']=='super admin' || $session_data['admin']==1){
					    echo "<td><a href='listUserInCourse?courseId=".$courses[$i]->course_id."'>List</a></td>";
						echo "<td><a href='listStudent?courseId=".$courses[$i]->course_id."'>Invite</a></td>";
						echo "<td><a href='../topiccontroller/addtopic?id=".$courses[$i]->course_id."'>Add Topic</a></td>";
						echo "<td><a href='edit?id=".$courses[$i]->course_id."'>Edit</a></td>";
						
						echo "<td><button  onclick='deletecourse(".$courses[$i]->course_id.")' > Delete button </button></td>";
						}
					echo "</tr>";
					$i++;
				}
        }


?>
</tbody>
</table>



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


$(document).ready(function() {
    $('#example').dataTable();
});




</script>

</body>
</html>