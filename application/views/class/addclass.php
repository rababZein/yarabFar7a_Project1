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
  <option value="01">01</option>
  <option value="02">02</option>
  <option value="03">03</option>
  <option value="04">04</option>
  <option value="05">05</option>
  <option value="06">06</option>
  <option value="07">07</option>
  <option value="08">08</option>
  <option value="09">09</option>
  <option value="10">10</option>
  <option value="11">11</option>
  <option selected="selected" value="12">12</option>

</select>
</span><span class="fleft marleft">
<select name="minute" id="RecurringControl1_drpMinute" class="dropbx_all" style="width: 53px">
  <option value="00">00</option>
  <option value="01">01</option>
  <option value="02">02</option>
  <option value="03">03</option>
  <option value="04">04</option>
  <option value="05">05</option>
  <option value="06">06</option>
  <option value="07">07</option>
  <option value="08">08</option>
  <option value="09">09</option>
  <option value="10">10</option>
  <option value="11">11</option>
  <option value="12">12</option>
  <option value="13">13</option>
  <option value="14">14</option>
  <option value="15">15</option>
  <option value="16">16</option>
  <option value="17">17</option>
  <option value="18">18</option>
  <option value="19">19</option>
  <option value="20">20</option>
  <option value="21">21</option>
  <option value="22">22</option>
  <option value="23">23</option>
  <option value="24">24</option>
  <option value="25">25</option>
  <option value="26">26</option>
  <option value="27">27</option>
  <option value="28">28</option>
  <option value="29">29</option>
  <option value="30">30</option>
  <option value="31">31</option>
  <option value="32">32</option>
  <option value="33">33</option>
  <option value="34">34</option>
  <option value="35">35</option>
  <option selected="selected" value="36">36</option>
  <option value="37">37</option>
  <option value="38">38</option>
  <option value="39">39</option>
  <option value="40">40</option>
  <option value="41">41</option>
  <option value="42">42</option>
  <option value="43">43</option>
  <option value="44">44</option>
  <option value="45">45</option>
  <option value="46">46</option>
  <option value="47">47</option>
  <option value="48">48</option>
  <option value="49">49</option>
  <option value="50">50</option>
  <option value="51">51</option>
  <option value="52">52</option>
  <option value="53">53</option>
  <option value="54">54</option>
  <option value="55">55</option>
  <option value="56">56</option>
  <option value="57">57</option>
  <option value="58">58</option>
  <option value="59">59</option>

</select>
    </span><span class="fleft marleft">
<select name="RecurringControl1drpAmPm" id="RecurringControl1_drpAmPm" class="dropbx_all" style="width: 58px">
  <option value="AM">AM</option>
  <option selected="selected" value="PM">PM</option>

</select>
</span><span id="RecurringControl1_spUpdateTime" class="lightxt11 martop5 fleft fleft10" style="color:#3e8f0c; background-color:#fdffd6"></span></span>

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
<select name="repeatType" id="RecurringControl1_drpRepeatType" class="dropbx_all" style="">
  <option value="0">Select when class repeats</option>
  <option value="1">Daily (all 7 days)</option>
  <option value="2">6 Days(Mon-Sat)</option>
  <option value="3">5 Days(Mon-Fri)</option>
  <option value="4">Weekly</option>
  <option value="5">Once every month</option>

</select>
</span></div>
<div id="RecurringControl1_dvEndDate" class="schedulewhiteinn top30" style="padding-top: 20px; padding-bottom: 20px;">
    <div class="dv100">
        <span class="left">*Ends:</span> <span class="right"><span class="fleft padtop" style="margin-left:-5px">
            <input value="0" name="RecurringControl1enddate" id="RecurringControl1_rdoEndAfter" class="fleft" checked="checked" style="cursor: pointer" type="radio">
            <label for="RecurringControl1_rdoEndAfter" class="radio_align marleft">After </label>
        </span><span class="fleft marleft" style="padding-left: 2px;">
            <input name="numberOfClasses" maxlength="3" id="RecurringControl1_txtOccurence" class="aspNetDisabled" onkeypress="return onlyNumbers(event);" style="width: 30px;" type="text">
        </span><span class="fleft marleft" style="padding-top:7px;">Classes</span> </span>
    </div>
    <div class="dv100 martop5">
        <span class="left"></span><span class="right"><span class="fleft" style="margin-left:-5px">
            <input value="1" name="RecurringControl1enddate" id="RecurringControl1_rdoEndBy" class="fleft" style="cursor: pointer" type="radio">
            <label for="RecurringControl1_rdoEndBy" class="radio_align marleft">On </label>
        </span><span class="fleft marleft">
            <input disabled="" readonly="readonly" name="RecurringControl1txtEndDate" id="RecurringControl1_txtEndDate" class="txtbx_all hasDatepicker" style="width: 90px;" type="text">
        </span><span class="fleft padtop marleft"></span></span>
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
                    format: "dd/mm/yyyy"
                });  
            
            });

 </script>

</body>
</html>


