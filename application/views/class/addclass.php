<?php 
$date = date_parse(date('Y-m-d H:i:s'));


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

        <!-- Bootstrap CSS and bootstrap datepicker CSS used for styling the demo pages-->
        <link rel="stylesheet" href="../css/datepicker.css">
        <link rel="stylesheet" href="../css/bootstrap.css">
    

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
 <input  type="text" placeholder="click to show datepicker" name="start_time" id="example1" value="<?php echo set_value('start_time');?>">
 <br/>


<div class="schedulewhiteinn" style="padding-top:10px;padding-bottom:18px;">
  <div class="dv100">
        <span class="left"></span><span class="right"><span class="lighttxt11" style="margin-left: 0px;">Hour</span> <span class="lighttxt11" style="margin-left: 30px;">Minutes</span></span>
  </div>
  <div class="dv100">
  <span class="right"><span class="fleft">
  <select name="hour" id="RecurringControl1_drpHour" class="dropbx_all" style="width: 53px">
 <?php for ($i=0; $i < 24; $i++) { 
    # code...
  
      if ($date['hour']==$i) {
        # code...
             if ($i > 9) {
               # code...
                echo '<option selected="selected" value="'.$i.'">'.$i.'</option>';
             }else{
                echo '<option selected="selected" value="0'.$i.'">0'.$i.'</option>';

             }
      }else{

             if ($i > 9) {
               # code...
                echo '<option value="'.$i.'">'.$i.'</option>';
             }else{
                echo '<option value="0'.$i.'">0'.$i.'</option>';

             }

      }
  }?>

</select>
</span><span class="fleft marleft">
<select name="minute" id="RecurringControl1_drpMinute" class="dropbx_all" style="width: 53px">
  <?php for ($i=0; $i < 60; $i++) { 
    # code...
  
      if ($date['minute']==$i) {
        # code...
             if ($i > 9) {
               # code...
                echo '<option selected="selected" value="'.$i.'">'.$i.'</option>';
             }else{
                echo '<option selected="selected" value="0'.$i.'">0'.$i.'</option>';

             }
      }else{

             if ($i > 9) {
               # code...
                echo '<option value="'.$i.'">'.$i.'</option>';
             }else{
                echo '<option value="0'.$i.'">0'.$i.'</option>';

             }

      }
  }?>

</select>
    
</div>

</div>




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
   
   <div class=" fleft" style="margin-top: 10px;">
                                            
   <div class="left" style="padding-top: 0px">Record this class: </div><div class="right" style="margin-left: 0px;">
    <div id="divRecordClass" class="dv100">
      

      <label>
          <span class="fleft" style="cursor: pointer"><input id="rdbRecordClass" name="gpRecordClass" value="1" checked="checked" onclick="ShowUploadRecordingAsMP4();" type="radio"></span>
          <label for="rdbRecordClass" class="radio_align">Yes </label>
      </label>
      <label>
          <span class="fleft fleft10" style="cursor: pointer"><input id="rdbDontRecord" name="gpRecordClass" value="0" onclick="ShowUploadRecordingAsMP4();" type="radio"></span>
          <label for="rdbDontRecord" class="radio_align">No</label>
      </label>
    </div></div></div>


<div id="RecurringControl1_dvRepeatType" class="fleft">
<span>
<select name="repeatType" id="repeatType" class="dropbx_all" style="">
  <option value="0">Select when class repeats</option>
  <option value="1">Daily (all 7 days)</option>
 <!--  <option value="2">6 Days(Mon-Sat)</option>
  <option value="3">5 Days(Mon-Fri)</option> -->
  <option value="4">Weekly</option>
  <option value="5">Once every month</option>
  <option value="6">Single</option>

</select>
</span></div>
<div id="repeatediv" class="schedulewhiteinn top30" style="padding-top: 20px; padding-bottom: 20px;">
    <div class="dv100">
        <span class="left">*Ends:</span> <span class="right"><span class="fleft padtop" style="margin-left:-5px">
            <input value="0" name="after" id="after" class="fleft" checked="checked" style="cursor: pointer" type="radio">
            <label for="RecurringControl1_rdoEndAfter" class="radio_align marleft">After </label>
        </span><span class="fleft marleft" style="padding-left: 2px;">
            <input name="numberOfClasses" maxlength="3" id="numberOfClasses" class="aspNetDisabled" onkeypress="return onlyNumbers(event);" style="width: 30px;" type="text">
        </span><span class="fleft marleft" style="padding-top:7px;">Classes</span> </span>
    </div>
    <div class="dv100 martop5">
        <span class="left"></span><span class="right"><span class="fleft" style="margin-left:-5px">
            <input value="1" name="after" id="on" class="fleft" style="cursor: pointer" type="radio">
            <label for="RecurringControl1_rdoEndBy" class="radio_align marleft">On </label>
        </span><span class="fleft marleft">
            <input  disabled="" readonly="readonly" type="text" placeholder="click to show datepicker" name="end_time" id="example2" value="<?php echo set_value('end_time');?>" class="txtbx_all hasDatepicker" >

<!--             <input disabled="" readonly="readonly" name="RecurringControl1txtEndDate" id="RecurringControl1_txtEndDate" class="txtbx_all hasDatepicker" style="width: 90px;" type="text">
 -->        </span><span class="fleft padtop marleft"></span></span>
    </div>
</div>


          


 <input type="hidden" name="topicId" value="<?php echo $topicId;?>">
  <input type="hidden" name="courseId" value="<?php echo $courseId;?>">
 <input type="submit" value="Add"/>

 </form>

<script src="http://code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>
 <!-- Load jQuery and bootstrap datepicker scripts -->
<script src="../bootstrap-datetimepicker-0.0.11/js/bootstrap-datetimepicker.min.js"></script>
<script src="../js/bootstrap-datepicker.js"></script>

<script type="text/javascript">

 var base_url="<?=base_url()?>";


 $(document).ready(function(){

  $('#repeatediv').hide();
 });


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

      $(document).ready(function () {
                
                $('#example2').datepicker({
                    format: "yyyy/mm/dd"
                });  
            
      });

      $(document).ready(function(){

            $("#after").change(function(){

                 $('#numberOfClasses').attr('readonly', false);
               
                 $('#example2').prop("disabled", true); // Element(s) are now enabled.

                 $('#example2').prop("readonly", true);
            })

      });


        $(document).ready(function(){

            $("#on").change(function(){

                $('#numberOfClasses').attr('readonly', true);
            
                $('#example2').prop("disabled", false); // Element(s) are now enabled.

                $('#example2').prop("readonly", false);
            })

      });

        $(document).ready(function(){
            $("#repeatType").change(function(){
            var e = document.getElementById("repeatType");
                       if(e.value==6){

alert('if');
                        var repeatediv = document.getElementById("repeatediv");

                        // repeatediv.style.display = "none";

                         $('#repeatediv').hide();
    



                       }else{

                        alert('else');

                        // repeatediv.style.display = "block";
                         $('#repeatediv').show();

                       }
             });          
        });

 </script>

</body>
</html>


