<!DOCTYPE html>
<html>
<head>
	<title>Add User</title>
</head>
<body>

<h1>Add User </h1>
   <?php echo validation_errors(); ?>
   <?php echo form_open('usercontroller/adduser'); ?>
     <label for="username">Username:</label>
     <input type="text" size="20" id="username" name="username"/>
     <br/>

     <label for="email">Email:</label>
     <input type="text" size="20" id="email" name="email"/>
     <br/>


     <label for="mobile">Mobile:</label>
     <input type="text" size="20" id="mobile" name="mobile"/>
     <br/>


     <label for="type">Type:</label>
     <input type="text" size="20" id="type" name="type"/>
     <br/>

     <label for="address">Address:</label>
     <input type="password" size="20" id="address" name="address"/>
     <br/>
     <input type="submit" value="Add"/>
   </form>

</body>
</html>