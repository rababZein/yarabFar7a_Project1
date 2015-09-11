<!DOCTYPE html>
<html>
<head>
	<title>List Courses</title>
</head>
<body>

Select All : <input id="selectAll" type="checkbox" onclick="checkAll(this,<?php echo $courseId;?>);"> 
<span id='actionOfSelectAll'></span>
		<table border="2" id="studentTable" >
			<thead>
				<tr>
				
					<th>User Name</th>
					<th>Invite</th>
					<th> Action </th>
				</tr>
			</thead>
			<tbody>
				

				<?php foreach ($students as $student) {?>
				        <tr  class="success" id="$student->id ">
				          
				            <td class="text-center"> <?php echo $student->user_name ;?></a></td>
				           
				            <td class="text-center">
				             <input id='<?php echo $student->user_name; ?>' class="group1" type="checkbox" onclick="sendinvitation(<?php echo $student->user_id ?>,<?php echo $courseId; ?>,'<?php echo $student->user_name;?>');">
				            </td>
				            <td id='action'></td>
				        </tr>
		     	<?php } ?>
	
			</tbody>
		</table>
		<input type="hidden"  name="id" value="<?php echo $courseId ;?>" >

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>  

<script type="text/javascript">

var base_url="<?=base_url()?>";
function checkAll(bx,courseId) {
	//alert('yarab far7a');
 $("#actionOfSelectAll").text("Wait To Send .....");
  var cbs = document.getElementsByTagName('input');
  for(var i=0; i < cbs.length; i++) {
    if(cbs[i].type == 'checkbox') {
      cbs[i].checked = bx.checked;
    }
  }

  $.get(base_url+"coursecontroller/inviteAll",{courseId:courseId},function(data){


			//var row=document.getElementById(id);

			// row.remove();

			//alert('congratulation your invitation was send successfully  ^_^');

			var selectAllButton=document.getElementById('selectAll');
  			selectAllButton.disabled= true;
  			$("input.group1").attr("disabled", true);
  			$("#actionOfSelectAll").text("Done ^_^");


	});



}
function sendinvitation(studentId,courseId,studentName){

	$("#action").text("Wait To Send .....");

	$.get(base_url+"coursecontroller/inviteStudent",{courseId:courseId,studentId:studentId},function(data){

             //alert('congratulation your invitation was send successfully  ^_^');
			 $("#"+studentName).attr("disabled", true);
			 $("#action").text(" ");
			 $("#action").text("Done ^_^ ")


	});


}

</script>
</body>
</html>