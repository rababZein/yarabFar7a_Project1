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

<link rel="stylesheet" href="../css/bootstrap.css">

	<title>Update Topic</title>
</head>
<body>

<h1>Update Topic </h1>
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


   

</body>
</html>