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


  <title>Add User</title>
</head>
<body>

<h1>Add User </h1>

<form action="adduser" method="post">
     <label for="username">Username:</label>
     <input type="text" size="20" id="username" name="username"/>
     <br/>

     <label for="email">Email:</label>
     <input type="email" size="20" id="email" name="email"/>
     <br/>


<label for="password">Password</label>
     <input type="password" size="20" id="password" name="password"/>
     <br/>

     <label for="type">Type:</label>
<select id="type" name="type" onchange="fun()">
  <option value="student">student</option>
  <option value="teacher">teacher</option>
</select>     <br/>



<select id = "admin" name="admin">
      <option value="not">not admin</option>
  <option value="admin">admin</option>

</select>     <br/>


     <input type="submit" value="Add"/>
   </form>



<script> 
    document.getElementById("admin").style.visibility= "hidden";

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