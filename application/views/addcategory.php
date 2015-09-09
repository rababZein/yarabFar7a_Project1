<!DOCTYPE html>
<html>
<head>
	<title> Add Category </title>
</head>
<body>

   <?php echo validation_errors(); ?>
   <?php echo form_open('categorycontroller/add'); ?>
     <label for="category">Category:</label>
     <input type="text" size="20" id="category" name="category"/>
     <br/>
     <label for='parent'>Parent: </label>
     <select name='id' id='id'>

     <option value="0">No Parent </option>

     <?php

           
     		if (count($categories)) {
			    foreach ($categories as $category) {
			        echo "<option value='".$category->cat_id."' >".$category->cat_name."</option>";
			    }
			}



     ?>

     </select>
     <br/>
     
     <input type="submit" value="submit"/>
   </form>

</body>
</html>
