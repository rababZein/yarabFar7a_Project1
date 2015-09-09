<!DOCTYPE html>
<html>
<head>
	<title>Update User</title>
</head>
<body>

<h1>Update User </h1>
   <?php echo validation_errors(); ?>
   <?php echo form_open('usercontroller/updateuser'); ?>
     <label for="username">Username:</label>
     <input type="text" size="20" id="username" name="username" value="<?php if(empty( set_value('username') ) ){ 
                                                                              echo $result['user_name'];
                                                                             }else{ 
                                                                              echo set_value('username');
                                                                              }
                                                                        ?>"/>
     <br/>
     
     <input type="text" size="20" id="id" name="id" value="<?php echo $result['user_id'];?>"  hidden/>
     <br/>

     <label for="email">Email:</label>
     <input type="text" size="20" id="email" name="email" value="<?php if(empty( set_value('email') ) ){ 
                                                                              echo $result['user_email'];
                                                                             }else{ 
                                                                              echo set_value('email');
                                                                              }
                                                                 ?>"/>
     <br/>

     <label for="mobile">Mobile:</label>
     <input type="text" size="20" id="mobile" name="mobile" value="<?php if(empty( set_value('mobile') ) ){ 
                                                                              echo $result['user_mobile'];
                                                                             }else{ 
                                                                              echo set_value('mobile');
                                                                             }
                                                                   ?>"/>
     <br/>

     <label for="username">Address:</label>
     <input type="text" size="20" id="address" name="address" value="<?php if(empty( set_value('address') ) ){ 
                                                                              echo $result['user_address'];
                                                                             }else{ 
                                                                              echo set_value('address');
                                                                             }
                                                                     ?>"/>
     <br/>

     <label for="username">Type:</label>
     <input type="text" size="20" id="type" name="type" value="<?php if(empty( set_value('type') ) ){ 
                                                                              echo $result['user_type'];
                                                                             }else{ 
                                                                              echo set_value('type');
                                                                             }
                                                               ?>"/>
     <br/>

     


     <input type="submit" value="Edit"/>
   </form>

</body>
</html>