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


<table class="data display datatable" id="example" cellpadding="0" cellspacing="0" border="2">
<thead>

<tr>



<th> Topic TiTle </th>

<th> Add Live Class</th>

<th> Edit </th>
<th> Delete </th>

</tr>
</thead>
    
<?php
    
    foreach ($topics as $topic) {
        
        echo "<tr id='".$topic->topic_id."'>";
        echo "<td><a href='../topiccontroller/showtopic?id=".$topic->topic_id."'>".$topic->topic_title."</a></td>";
        echo "<td><a href='../classcontroller/addclass?courseId=".$topic->topic_course_id."&topicId=".$topic->topic_id."'>Add Class</a></td>";

        echo "<td><a href='../topiccontroller/edit?id=".$topic->topic_id."'>Edit</a></td>";
        
        echo "<td><button  onclick='deletetopic(".$topic->topic_id.")' > Delete button </button></td>";
        echo "</tr>";
   
    }


?>

</table>

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