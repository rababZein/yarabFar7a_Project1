<!DOCTYPE html>
<html>
<head>
	<title> Show Course </title>
</head>
<body>

<p>
	TiTle: <?php echo $course[0]->course_title; ?>
	<br/>
	Main Category : <?php echo $parent[0]->cat_name; ?>
    <br/>
	Sub Category : <?php echo $category[0]->cat_name; ?>
    <br/>
    Description : <?php echo $course[0]->course_desc; ?>
    <br/>
    Teacher : <?php echo $teacher[0]->user_name; ?>
    <br/>
    Start Time: <?php echo $course[0]->course_start_time; ?>
    <br/>
    End Time : <?php echo $course[0]->course_end_time; ?>
    <br/>
</p>

<p>
    
 <td><a href='../topiccontroller/addtopic?id=<?php echo $course[0]->course_id; ?>'> Add Topic </a></td>

</p>


<table border="2">

<tr>



<td> Topic TiTle </td>

<td> Add Live Class</td>

<td> Edit </td>
<td> Delete </td>

</tr>
    
<?php
    
    foreach ($topics as $topic) {
        
        echo "<tr id='".$topic->topic_id."'>";
        echo "<td><a href='showcourse?id=".$topic->topic_id."'>".$topic->topic_title."</a></td>";
        echo "<td><a href='../classcontroller/addclass?courseId=".$topic->topic_course_id."&topicId=".$topic->topic_id."'>Add Class</a></td>";

        echo "<td><a href='../topiccontroller/edit?id=".$topic->topic_id."'>Edit</a></td>";
        
        echo "<td><button  onclick='deletetopic(".$topic->topic_id.")' > Delete button </button></td>";
        echo "</tr>";
   
    }


?>

</table>

<script src="http://code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>
<script type="text/javascript">

var base_url="<?=base_url()?>";
    


    function deletetopic (id){
        //alert(id);

        $.get(base_url+"topiccontroller/deletetopic",{topicId:id},function(data){


            var row=document.getElementById(id);

             row.remove();

            // alert(data);


        });


    }





</script>

</body>
</html>