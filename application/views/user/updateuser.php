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

     <label for="firstname">First Name:</label>
     <input type="text" size="20" id="firstname" name="firstname" value="<?php if(empty( set_value('firstname') ) ){ 
                                                                              echo $result['user_first_name'];
                                                                             }else{ 
                                                                              echo set_value('firstname');
                                                                              }
                                                                        ?>"/>
     <span style="color:red"> <?php echo form_error('firstname'); ?> </span>
     <br/>

     <label for="lastname">Last Name:</label>
     <input type="text" size="20" id="lastname" name="lastname" value="<?php if(empty( set_value('lastname') ) ){ 
                                                                              echo $result['user_last_name'];
                                                                             }else{ 
                                                                              echo set_value('lastname');
                                                                              }
                                                                        ?>"/>
     <span style="color:red"> <?php echo form_error('lastname'); ?> </span>
     <br/>
     
     <input type="hidden" size="20" id="id" name="id" value="<?php echo $result['user_id'];?>"  />
     <br/>

     <label for="email">Email:</label>
     <input type="text" size="20" id="email" name="email" value="<?php if(empty( set_value('email') ) ){ 
                                                                              echo $result['user_email'];
                                                                             }else{ 
                                                                              echo set_value('email');
                                                                              }
                                                                 ?>"/>
     <br/>



  

     <label for="username">Type:</label>
<select id="type" name="type" onchange="fun()">
  <option value="<?php echo $result['user_type']; ?>"><?php echo $result['user_type']; ?> </option>
  <?php 

  if($result['user_type']== "teacher")
    {

      ?>
  <option value="student">student</option>

  <?php 

}
if($result['user_type']== "student")
{
  ?>
  <option value="teacher">teacher</option>

<?php 
}
?>

</select>     <br/>


     <br/>


<select id="admin" name="admin">
  <option value="<?php if($result['user_admin'] == 0) echo 'not admin'; else echo 'admin'; ?>"> <?php if($result['user_admin'] == 0) echo "not admin"; else echo "admin";?> </option>
  <?php 

  if($result['user_admin']== 0)
    {

      ?>
  <option value="admin">admin</option>

  <?php 

}
if($result['user_admin']== 1)
{
  ?>
  <option value="not">not admin</option>

<?php 
}
?>

</select>     <br/>



     


     <input type="submit" value="Edit"/>
   </form>


<script> 
<?php 
if($result['user_type'] == "student" || $result['user_type'] == "admin" || $result['user_type'] == "super admin")
{
  ?>

    document.getElementById("admin").style.visibility= "hidden";
<?php 
}
?>
function fun()
{
if(document.getElementById("type").value == "teacher")
    document.getElementById("admin").style.visibility= "visible";

if(document.getElementById("type").value == "student")
    document.getElementById("admin").style.visibility= "hidden";
}

function mob()

{
    arr=[];
    len=document.getElementById("mobile").value.length;
    if(document.getElementById("mobile").value[0] == document.getElementById("mobile").value[1]){
        arr.push(0);
        arr.push(0);

        flag= document.getElementById("mobile").value[0];
        for(i=2 ; i<len ; i++){
            if(document.getElementById("mobile").value[i] == flag){
                arr.push(0);
            }
        }

    }
    if(arr.length == len){ 
      document.getElementById("mob").innerHTML="<span style='color:red'>enter valid mobile number </span> ";
      document.getElementById('sub').disabled = 'disabled';
    }else {
      document.getElementById("mob").innerHTML="";
      document.getElementById('sub').disabled = false;
    }
 


}


</script>
</body>
</html>