<!DOCTYPE html>
<html>
<head>
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