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



<table class="data display datatable" id="example" cellpadding="2" cellspacing="2" border="4">
<thead>

<tr>



<th> Class TiTle </th>

<th> Start Time</th>
<th> Status </th>

<th> Present </th>

<th> Download </th>

<th> Edit </th>
<th> Delete </th>


</tr>
</thead>
    
<?php

for ($i=0; $i <sizeof($classes) ; $i++) { 
    # code...

    
    foreach ($classes[$i] as $class) {
        
        echo "<tr id='".$class->class_id."'>";
        echo "<td>".$class->class_title."</a></td>";
      
        echo "<td>".$class->class_start_time."</a></td>";
     
        if (date('Y-m-d H:i:s') == $class->class_start_time) {
                echo "<td style='color:green'> Started </td>";
        }elseif(date('Y-m-d H:i:s') < $class->class_start_time){

                echo "<td style='color:blue'> Upcoming </td>";
        }else{

                 echo "<td style='color:red'>  Finished </td>";
        }

        echo "<td><a href='".$class->class_presenter_url."'>Present </a></td>";
   
        echo "<td><a href=../classcontroller/downloadrecord?classId=".$class->class_id.">Download </a></td>";

        echo "<td><a href='../classcontroller/edit?id=".$class->class_id."'>Edit</a></td>";

        echo "<td><button  onclick='deleteclass(".$class->class_id.")' > Delete button </button></td>";

        echo "</tr>";
   
    }
}


?>

</table>

<script type="text/javascript">


$('#example').dataTable(
{
  "bSort" : false
} );


</script>

</body>
</html>