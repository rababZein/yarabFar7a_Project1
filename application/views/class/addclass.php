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


  <title>Add New Class </title>
</head>
<body>

 <?php echo validation_errors(); ?>
 <?php echo form_open('classcontroller/storeclass'); ?>

 <label for="title">Title:</label>
 <input type="text" size="20" id="title" name="title" value="<?php echo set_value('title');?>"/>
 <br/>

 <label for="Duration">Duration:</label>
 <input type="number" size="20" id="duration" name="duration" value="<?php echo set_value('duration');?>"/>
 <br/>

 <label for="attendee_limit">attendee_limit:</label>
 <input type="text" size="20" id="attendee_limit" name="attendee_limit" value="<?php echo set_value('attendee_limit');?>"/>
 <br/>

  <label for="start_time">start_time:</label>
 <input type="data" size="20" id="start_time" name="start_time" value="<?php echo set_value('start_time');?>"/>
 <br/>

 <input type="hidden" name="topicId" value="<?php echo $topicId;?>">
  <input type="hidden" name="courseId" value="<?php echo $courseId;?>">
 <input type="submit" value="Add"/>

 </form>

</body>
</html>


