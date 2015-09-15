<?php echo set_value('desc');  ?>

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


	<title>Add New Course</title>
</head>
<body>

<h1>Add New Course</h1>
   <?php echo validation_errors(); ?>
   <?php echo form_open('topiccontroller/storetopic'); ?>


     <label for="topic_title">Title:</label>
     <input type="text" size="20" id="topic_title" name="topic_title" value="<?php echo set_value('course_title');?>"/>
     <br/>

     


     <label for="topic_desc">Description:</label>
     <textarea  id="topic_desc" name="topic_desc" ><?php echo set_value('topic_desc'); ?></textarea>
     <br/>

    <input type="hidden"  name="topic_course_id" value="<?php echo $courseId; ?>"/>


   

     <input type="submit" value="Add"/>
   </form>


  

</body>
</html>