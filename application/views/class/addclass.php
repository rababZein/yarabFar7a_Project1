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


  <title>Add New Class </title>
</head>
<body>

 <?php echo validation_errors(); ?>
 <?php echo form_open('classcontroller/storeclass'); ?>

 <label for="title">Title:</label>
 <input type="text" size="20" id="title" name="title" value="<?php echo set_value('title');?>"/>
 <br/>

 <label for="Duration">Duration:</label>
 <input type="number" size="20" id="duration" name="duration" value="<?php echo set_value('duration');?>"/>
 <br/>

 

<label for="start_time">start_time:</label>
 <input type="date" size="20" id="start_time" name="start_time" value="<?php echo set_value('start_time');?>"/>
 <br/>


 <label for="country">Country:</label>

     <select id="country" name="country">

     <?php

          echo "<option value='empty'>Select Your Country</option>";
          foreach ($countries as $country) {
              echo "<option value='".$country->country_code."' >".$country->country_name."</option>";
          }

     ?>

     </select>
     <span style="color:red"> <?php  if(!empty($countryErrMsg)) echo $countryErrMsg; ?> </span>

     <br/>

     <p id='time zone'>
       

     </p>
   




 <input type="hidden" name="topicId" value="<?php echo $topicId;?>">
  <input type="hidden" name="courseId" value="<?php echo $courseId;?>">
 <input type="submit" value="Add"/>

 </form>

<script src="http://code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>

<script type="text/javascript">

 var base_url="<?=base_url()?>";
 $(document).ready(function(){
        $('select#country').on('change', function() {

            alert( this.value ); 

            var timezonePrag = document.getElementById('time zone');

            timezonePrag.innerHTML=" ";

            $.get(base_url+"classcontroller/gettimezone",{code:this.value},function(data){

              console.log(data);

              var label = document.createElement('label');
              label.innerHTML= 'Time Zone of your country : ';
              var sel = document.createElement('select');
              sel.name='timezone';
             // sel.setAttribute("id", "sel");
             /* if (data=="") { 

                    return;

              }*/
              for (var i=0; i<JSON.parse(data).length; i++) {
                  
                   //code=JSON.parse(data)[i].code;
                   timezone=JSON.parse(data)[i].timezone;

                   //console.log(catName);

                   opt = document.createElement('option');
                   opt.value = timezone;
                   opt.innerHTML = timezone;
                   sel.appendChild(opt);


               }
          
               timezonePrag.appendChild(label);
               timezonePrag.appendChild(sel);




              });

        });
    });


 </script>

</body>
</html>


