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


	<title>Update Category</title>
</head>
<body>

<h1>Update User </h1>
   <?php echo validation_errors(); ?>
   <?php echo form_open('categorycontroller/updatecategory'); ?>
     <label for="category">Category:</label>
     <input type="text" size="20" id="category" name="category" value="<?php echo $result['cat_name'];?>"/>
     <br/>
     <input type="text" size="20" id="id" name="id" value="<?php echo $result['cat_id'];?>" hidden/>
     <br/>

   
     <input type="submit" value="Add"/>
   </form>

</body>
</html>