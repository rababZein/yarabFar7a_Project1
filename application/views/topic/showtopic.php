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


	<title> Show Topic </title>
</head>
<body>

<p>
	TiTle: <?php echo $topic[0]->topic_title; ?>
    <br/>
	
    Description : <?php echo $topic[0]->topic_desc; ?>
    <br/>
    
</p>

<p>
    

</p>


<table class="data display datatable" id="example" cellpadding="0" cellspacing="0" border="2">
<thead>

<tr>



<th> Class TiTle </th>
<th> Duration </th>
<th> Start Time</th>



</tr>
</thead>
    
<?php
    
    foreach ($classes as $class) {
        
        echo "<tr>";
        echo "<td>".$class->class_title."</a></td>";
        echo "<td>".$class->class_duration."</a></td>";
        echo "<td>".$class->class_start_time."</a></td>";

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