<?php echo set_value('desc');  ?>

<!DOCTYPE html>
<html>
<head>
	<title>Add New Course</title>
</head>
<body>

<h1>Add New Course</h1>
   <?php echo validation_errors(); ?>
   <?php echo form_open('coursecontroller/storecourse'); ?>

    <label for="price">Price:</label>
     <input type="number" size="20" id="price" name="price" value="<?php echo set_value('price');?>"/>
     <br/>


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
     <textarea  id="course_desc" name="desc" ><?php echo set_value('desc'); ?></textarea>
     <br/>


     <label for="course_start_time">Start Time:</label>

     <input type="date"  id="course_start_time" name="course_start_time" value="<?php echo set_value('course_start_time'); ?>"/>
     <br/>

     <label for="course_end_time">End Time:</label>
     <input type="date"  id="course_end_time" name="course_end_time" value="<?php echo set_value('course_end_time'); ?>"/>
     <br/>

     <label for="course_time_zone">Time Zone:</label>
     <input type="text" size="20" id="course_time_zone" name="course_time_zone" value="<?php echo set_value('course_time_zone');?>"/>
     <br/>
   

     <input type="submit" value="Add"/>
   </form>


   <script src="http://code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>
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




   </script>

</body>
</html>