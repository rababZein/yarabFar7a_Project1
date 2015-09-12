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


</script>
</body>
</html>