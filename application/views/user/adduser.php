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
<script src="http://code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="../css/bootstrap.css">

  <title>Add User</title>
</head>
<body>

<h1>Add User </h1>


<form action="adduser" method="post">
     <label for="username">Username:</label>
     <input type="text" size="20" id="username" name="username" value="<?php echo set_value('username');?>"/>
     <span style="color:red"> <?php echo form_error('username'); ?> </span>
     <br/>

     <label for="email">Email:</label>
     <input type="email" size="20" id="email" name="email" value="<?php echo set_value('email');?>"/>
     <span style="color:red"> <?php echo form_error('email'); ?> </span>
     <br/>


     <label for="password">Password</label>
     <input type="password" size="20" id="password" name="password"/>
     <span style="color:red"> <?php echo form_error('password'); ?> </span>
     <br/>

     <label for="password">Confirm Password</label>
     <input type="password" size="20" id="passconf" name="passconf"/>
     <span style="color:red"> <?php echo form_error('passconf'); ?> </span>
     <br/>


     <label for="country">Country:</label>

     <select id="country" name="country">

     <?php

          echo "<option value='empty'>Select Your Country</option>";
          foreach ($countries as $country) {
              echo "<option value='".$country->country_id."' >".$country->short_name."</option>";
          }

     ?>

     </select>
     <span style="color:red"> <?php  if(!empty($countryErrMsg)) echo $countryErrMsg; ?> </span>

     <br/>

     <p id='code'>
       

     </p>

   
     <label for="mobile">Mobile</label> 
     <input type="number" id="mobile" name="mobile" onkeyup="mob()" value="<?php echo set_value('mobile');?>"/> 
     <span style="color:red"> <?php echo form_error('mobile'); ?> </span>
     <br/> 
     <div id="mob"> </div>


     <label for="question">Question:</label>

     <select id="question" name="question">

     <?php

          echo "<option value='empty'>Select Question</option>";
          foreach ($questions as $question) {
              echo "<option value='".$question->id."' >".$question->question."</option>";
          }

     ?>

     </select>
     <span style="color:red"> <?php  if(!empty($countryErrMsg)) echo $countryErrMsg; ?> </span>

     <br/>


     <label for="answer">Answer: </label>
     <input type="text" size="20" id="answer" name="answer" value="<?php echo set_value('answer');?>"/>
     <span style="color:red"> <?php echo form_error('answer'); ?> </span>
     <br/>

     <label for="type">Type:</label>
     <select id="type" name="type" onchange="fun()">
     <option value="student">student</option>
     <option value="teacher">teacher</option>
     </select> 
     <br/>



      <select id = "admin" name="admin">
            <option value="not">not admin</option>
        <option value="admin">admin</option>

      </select>     <br/>


     <input type="submit" id='sub' value="Add"/>
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

    var base_url="<?=base_url()?>";




   


    $(document).ready(function(){
        $('select#country').on('change', function() {

            alert( this.value ); 

            var codePrag = document.getElementById('code');

            codePrag.innerHTML=" ";

            $.get(base_url+"usercontroller/countrycode",{country:this.value},function(data){

              console.log(data);

              var label = document.createElement('label');
              label.innerHTML= 'code of your country : ';
              var sel = document.createElement('select');
              sel.name='code';
             // sel.setAttribute("id", "sel");
             /* if (data=="") { 

                    return;

              }*/
              for (var i=0; i<JSON.parse(data).length; i++) {
                  
                   code=JSON.parse(data)[i].calling_code;
                   countryId=JSON.parse(data)[i].country_id;

                   //console.log(catName);

                   opt = document.createElement('option');
                   opt.value = countryId;
                   opt.innerHTML = code;
                   sel.appendChild(opt);


               }
          
               codePrag.appendChild(label);
               codePrag.appendChild(sel);




              });

        });
    });

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