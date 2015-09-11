<?php echo set_value('desc');  ?>

<!DOCTYPE html>
<html>
<head>
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


   <script src="http://code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>
  

</body>
</html>