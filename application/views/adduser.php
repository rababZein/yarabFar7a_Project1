<!DOCTYPE html>
<html>
<head>
  <title>Add User</title>
</head>
<body>

<h1>Add User </h1>

<form action="/yarabfar7a1/usercontroller/adduser" method="post">
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