<?php echo set_value('desc');  ?>

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
    

	<title>Add New Course</title>
</head>
<body>

<h1>Add New Course</h1>
   <?php echo validation_errors(); ?>
   <?php echo form_open('coursecontroller/storecourse'); ?>


     <label for="Course_title">Title:</label>
     <input type="text" size="20" id="course_title" name="course_title" value="<?php echo set_value('course_title');?>"/>
     <br/>

     <label for="category">Main Category:</label>

     <select id="parent">

     <?php

            
        if (count($parentCategories)) {
        	echo "<option value='empty'> Select Main Category</option>";
          foreach ($parentCategories as $category) {
              echo "<option value='".$category->cat_id."' >".$category->cat_name."</option>";
          }
      }



     ?>

     </select>
     <br/>

     <p id='addCatChild'>
       

     </p>

     <p id="addAnotherChild">


       

     </p>



     <label for="course_desc">Desc:</label>
     <textarea  id="course_desc" name="course_desc" ><?php echo set_value('course_desc'); ?></textarea>
     <br/>


     <label for="teacher">Select Teacher:</label>

     <select name="teacher">

     <?php

            
        if (count($teachers)) {
          echo "<option value='empty'> Select Teacher</option>";
          foreach ($teachers as $teacher) {
              echo "<option value='".$teacher->user_id."' >".$teacher->user_name."</option>";
          }
      }



     ?>

     </select>

     <br/>


     <label for="course_start_time">Start Time:</label>

     <input  type="text" placeholder="click to show datepicker" name="course_start_time" id="example1" value="<?php echo set_value('course_start_time');?>">

     <br/>

     <label for="course_end_time">End Time:</label>
     <input  type="text" placeholder="click to show datepicker" name="course_end_time" id="example2" value="<?php echo set_value('course_end_time');?>">

     <br/>

     
     <input type="submit" value="Add"/>
   </form>


<script src="http://code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>
 <!-- Load jQuery and bootstrap datepicker scripts -->
<script src="../bootstrap-datetimepicker-0.0.11/js/bootstrap-datetimepicker.min.js"></script>
<script src="../js/bootstrap-datepicker.js"></script>

   <script type="text/javascript">

          var flag=199999;
          var base_url="<?=base_url()?>";




          $('select#parent').on('change', function() {


              alert( this.value ); 

              var addCatChild = document.getElementById('addCatChild');

              addCatChild.innerHTML=" ";

              var addAnotherChild = document.getElementById('addAnotherChild');

              addAnotherChild.innerHTML=" ";

              $.get(base_url+"coursecontroller/getCatChild",{catSelected:this.value},function(data){

              var label = document.createElement('label');
              label.innerHTML= 'Sub Category : ';
              var sel = document.createElement('select');
              sel.name='category';
              sel.setAttribute("id", "sel");
              if (data=="") { 

                    return;

              }
              for (var i=0; i<JSON.parse(data).length; i++) {
                  
                   catName=JSON.parse(data)[i].cat_name;
                   catId=JSON.parse(data)[i].cat_id;

                   console.log(catName);

                   opt = document.createElement('option');
                   opt.value = catId;
                   opt.innerHTML = catName;
                   sel.appendChild(opt);


               }
          
               addCatChild.appendChild(label);
               addCatChild.appendChild(sel);




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



   </script>

</body>
</html>