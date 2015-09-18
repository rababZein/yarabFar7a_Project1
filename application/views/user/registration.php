
<!DOCTYPE html>
<html>
<head>

     <link rel="stylesheet" type="text/css" href="../css/form.css">
	<title></title>


</head>
<body>

<p class="texto">ReGistraTioN</p>
<div class="Registro">
<span class="error">
 <?php echo validation_errors(); ?>
 </span>
 <?php echo form_open('usercontroller/adduser'); ?>

 <span class="fontawesome-user"></span><input type="text" name="username" required placeholder="User Name .." >

<span class="fontawesome-envelope-alt"></span><input type="text"  name="email" id="email" required placeholder="Email .. " >
<span class="fontawesome-lock"></span><input type="password" name="password" id="password" required placeholder="PassWord .. " autocomplete="off"> 
<span class="fontawesome-lock"></span><input type="password" name="passconf" id="passconf" required placeholder="Confirm PassWord .. " autocomplete="off"> 

<input type="submit" value="Sign Up" title="Sign Up">


</body>
</html>