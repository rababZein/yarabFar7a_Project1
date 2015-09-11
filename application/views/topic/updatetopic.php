<!DOCTYPE html>
<html>
<head>
	<title>Update Course</title>
</head>
<body>

<h1>Update Course </h1>
   <?php echo validation_errors(); ?>

   <?php echo form_open('topiccontroller/updatetopic'); ?>
     

     
     <input type="text" size="20" id="id" name="id" value="<?php echo $result['topic_id'];?>"  hidden/>
     
     <br/>

     <label for="topic_title">Title:</label>
     <input type="text" size="20" id="topic_title" name="topic_title" value="<?php if(empty( set_value('topic_title') ) ){ 
                                                                              echo $result['topic_title'];
                                                                             }else{ 
                                                                              echo set_value('topic_title');
                                                                              }
                                                              ?>"/>
     <br/>


     <label for="topic_desc">Description :</label>
     <textarea   id="topic_desc" name="topic_desc"> <?php if(empty( set_value('topic_desc') ) ){ 
                                                                              echo $result['topic_desc'];
                                                                             }else{ 
                                                                              echo set_value('topic_desc');
                                                                             }
                                                                   ?></textarea>

     <br/>



     <input type="submit" value="Edit"/>
   </form>


   <script src="http://code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>
   

</body>
</html>