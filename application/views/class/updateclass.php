<?php 
$date = date_parse($result['class_start_time']);

//echo $date['year'];

?>

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

        <!-- Bootstrap CSS and bootstrap datepicker CSS used for styling the demo pages-->
        <link rel="stylesheet" href="../css/datepicker.css">
        <link rel="stylesheet" href="../css/bootstrap.css">
    

	<title>Update Class</title>
</head>
<body>

<h1>Update Class </h1>
   <?php echo validation_errors(); ?>

   <?php echo form_open('classcontroller/updateclass'); ?>
     

     
     <input type="hidden" size="20" id="id" name="id" value="<?php echo $result['class_id'];?>"/>
     
     <br/>

     <label for="title">Title:</label>
     <input type="text" size="20" id="title" name="title" value="<?php if(empty( set_value('title') ) ){ 
                                                                              echo $result['class_title'];
                                                                             }else{ 
                                                                              echo set_value('title');
                                                                              }
                                                              ?>"/>
     <br/>
     
     <label for="duration">Duration:</label>
     <input type="text" size="20" id="duration" name="duration" value="<?php if(empty( set_value('duration') ) ){ 
                                                                              echo $result['class_duration'];
                                                                             }else{ 
                                                                              echo set_value('duration');
                                                                              }
                                                              ?>"/>
     <br/>


     <label for="start_time">Start Time:</label>
     <input type="text" placeholder="click to show datepicker"  id="example1" name="start_time" value="<?php if(empty( set_value('start_time') ) ){ 
                                                                              echo $date['year'].'/'.$date['month'].'/'.$date['day'];
                                                                             }else{ 
                                                                              echo set_value('start_time');
                                                                              }
                                                              ?>"/>


     <br/>


     <label for="country">Country:</label>

     <select id="country" name="country">

     <?php
    
          
          foreach ($countries as $country) {
              if ($timezone[0]->code==$country->country_code) {
                echo "<option value='".$country->country_code."' selected>".$country->country_name."</option>";
              }else{
                echo "<option value='".$country->country_code."' >".$country->country_name."</option>";
              }
          }

     ?>

     </select>
     <span style="color:red"> <?php  if(!empty($countryErrMsg)) echo $countryErrMsg; ?> </span>

     <br/>

     <p id='time zone'>

     <label for="country">Time Zone of your country :</label>

     <select  name="timezone">

     <?php

          
        echo "<option value='".$result['class_time_zone']."' >".$result['class_time_zone']."</option>";
          

     ?>

     </select>
       

     </p>

     <div class=" fleft" style="margin-top: 10px;">
                                            
     <div class="left" style="padding-top: 0px">Record this class: </div><div class="right" style="margin-left: 0px;">
      <div id="divRecordClass" class="dv100">
        
        <?php if($result['class_create_recording'] != 1){?>
        <label>
            <span class="fleft" style="cursor: pointer"><input id="rdbRecordClass" name="gpRecordClass" value="1" checked="checked" onclick="ShowUploadRecordingAsMP4();" type="radio"></span>
            <label for="rdbRecordClass" class="radio_align">Yes </label>
        </label>
        <label>
            <span class="fleft fleft10" style="cursor: pointer"><input id="rdbDontRecord" name="gpRecordClass" value="0" onclick="ShowUploadRecordingAsMP4();" type="radio"></span>
            <label for="rdbDontRecord" class="radio_align">No</label>
        </label>
        <?php }else{?>

         <label>
            <span class="fleft" style="cursor: pointer"><input id="rdbRecordClass" name="gpRecordClass" value="1" checked="checked"  type="radio"></span>
            <label for="rdbRecordClass" class="radio_align">Yes </label>
        </label>
        <label>
            <span class="fleft fleft10" style="cursor: pointer"><input id="rdbDontRecord" name="gpRecordClass" value="0"  type="radio"></span>
            <label for="rdbDontRecord" class="radio_align">No</label>
        </label>

        <?php }?>
    </div></div></div>


     <input type="submit" value="Edit"/>
   </form>
<script src="http://code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>
 <!-- Load jQuery and bootstrap datepicker scripts -->
<script src="../bootstrap-datetimepicker-0.0.11/js/bootstrap-datetimepicker.min.js"></script>
<script src="../js/bootstrap-datepicker.js"></script>

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


  $(document).ready(function () {
                
                $('#example1').datepicker({
                    format: "yyyy/mm/dd"
                });  
            
  });


 </script>

   

</body>
</html>