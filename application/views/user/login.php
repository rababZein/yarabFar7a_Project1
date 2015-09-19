
<!DOCTYPE html>
<html>
<head>

     <link rel="stylesheet" type="text/css" href="css/form.css">
	<title></title>


</head>
<body>

<p class="texto">LoGiN</p>
<div class="Registro">
<span class="error">
 <?php echo validation_errors(); ?>
 </span>
 <?php echo form_open('verifylogin'); ?>

<span class="fontawesome-envelope-alt"></span><input type="text"  name="email" id="email" required placeholder="Email .. " autocomplete="off">
<span class="fontawesome-lock"></span><input type="password" name="password" id="password" required placeholder="PassWord .. " autocomplete="off"> 
<input type="submit" value="LoGiN" title="Sign In">

<a title="Registration" href="usercontroller/registration"> Sign Up </a>
<br/>

<a title="Reset PassWord By Question & Answer" href="usercontroller/forgetpasswordView"> Forget Password  , Reset it By Question</a>

<a title="Reset PassWord By Mail" href="usercontroller/forgetPasswordBySendMailView"> Forget Password , Reset it By Mail</a>

</body>
</html>