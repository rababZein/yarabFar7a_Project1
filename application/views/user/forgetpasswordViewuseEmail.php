<!DOCTYPE html>
<html>
<head>
	<title> Forget Password</title>
</head>
<body>


<form method="post" action="forgetPasswordBySendMail">
     <label for="email">Enter Your Email:</label>
     <input type="email" size="20" id="email" name="email" value="<?php echo set_value('email');?>"/>
     <span style="color:red"> <?php echo form_error('email'); ?>  <?php if(!empty($wrongEmail)) echo $wrongEmail;?></span>
     <br/>

     <input type="submit" value="Add"/>
</form>

</body>
</html>