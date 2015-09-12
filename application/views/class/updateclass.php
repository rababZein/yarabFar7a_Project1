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


	<title>Update Course</title>
</head>
<body>

<h1>Update Course </h1>
   <?php echo validation_errors(); ?>

   <?php echo form_open('classcontroller/updateclass'); ?>
     

     
     <input type="text" size="20" id="id" name="id" value="<?php echo $result['class_id'];?>"  hidden/>
     
     <br/>

     <label for="title">Title:</label>
     <input type="text" size="20" id="title" name="title" value="<?php if(empty( set_value('title') ) ){ 
                                                                              echo $result['class_title'];
                                                                             }else{ 
                                                                              echo set_value('title');
                                                                              }
                                                              ?>"/>
     <br/>
     
     <label for="duration">Duration:</label>
     <input type="text" size="20" id="duration" name="duration" value="<?php if(empty( set_value('duration') ) ){ 
                                                                              echo $result['class_duration'];
                                                                             }else{ 
                                                                              echo set_value('duration');
                                                                              }
                                                              ?>"/>
     <br/>


     <label for="start_time">Start Time:</label>
     <input type="text" size="20" id="start_time" name="start_time" value="<?php if(empty( set_value('start_time') ) ){ 
                                                                              echo $result['class_start_time'];
                                                                             }else{ 
                                                                              echo set_value('start_time');
                                                                              }
                                                              ?>"/>
     <br/>


     <input type="submit" value="Edit"/>
   </form>


   

</body>
</html>