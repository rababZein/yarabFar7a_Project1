<!DOCTYPE html>
<html>
<head>
	<title> Forget Password</title>
</head>
<body>


<form method="post" action="resetPassword">
     <label for="password">Password</label>
     <input type="password" size="20" id="password" name="password"/>
     <span style="color:red"> <?php echo form_error('password'); ?> </span>
     <br/>

     <label for="password">Confirm Password</label>
     <input type="password" size="20" id="passconf" name="passconf"/>
     <span style="color:red"> <?php echo form_error('passconf'); ?> </span>
     <br/>

    <input type="hidden" size="50" id="id" name="id" value="<?php echo  $user_id; ?>" />

     <input type="submit" value="Add"/>
</form>

</body>
</html>