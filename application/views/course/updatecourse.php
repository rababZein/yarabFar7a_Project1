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
<link rel="stylesheet" href="../css/bootstrap.css">


	<title>Update Course</title>
</head>
<body>

<h1>Update Course </h1>
   <?php echo validation_errors(); ?>

   <?php echo form_open('coursecontroller/updatecourse'); ?>
     <label for="category">Category:</label>
     <select id="parent">
     <?php

           
        if (count($parentCategories)) {
          foreach ($parentCategories as $category) {
              if ($ParentCatSelected[0]->cat_id==$category->cat_id) {
                echo "<option value='".$ParentCatSelected[0]->cat_id."'  selected='selected'>".$ParentCatSelected[0]->cat_name."</option>";
              }else{
                echo "<option value='".$category->cat_id."' >".$category->cat_name."</option>";
              }

          }
      }



     ?>

     </select>


  

     <p id='addCatChild'>


     <label for="category">Sub Category:</label>
     <select name="category">
     <?php

           
        if (count($childCategories)) {
          foreach ($childCategories as $category) {
              if ($catSelected[0]->cat_id==$category->cat_id) {
                echo "<option value='".$catSelected[0]->cat_id."'  selected='selected'>".$catSelected[0]->cat_name."</option>";
              }else{
                  echo "<option value='".$category->cat_id."' >".$category->cat_name."</option>";
              }          

          }
      }



     ?>

     </select>


     <br/>
       

     </p>

     <p id="addAnotherChild">


       

     </p>
     
     <input type="text" size="20" id="id" name="id" value="<?php echo $result['course_id'];?>"  hidden/>
     <br/>

     <label for="course_title">Title:</label>
     <input type="text" size="20" id="course_title" name="course_title" value="<?php if(empty( set_value('course_title') ) ){ 
                                                                              echo $result['course_title'];
                                                                             }else{ 
                                                                              echo set_value('course_title');
                                                                              }
                                                              ?>"/>
     <br/>

     <label for="course_teacher">Teacher:</label>
     <input type="text" size="20" id="course_teacher" name="course_teacher" value="<?php if(empty( set_value('course_teacher') ) ){ 
                                                                              echo $teacher[0]->user_name;
                                                                             }else{ 
                                                                              echo set_value('course_teacher');
                                                                              }
                                                              ?>"/>
     <br/>

     <label for="course_start_time">Start Time:</label>
     <input type="date" size="20" id="course_start_time" name="course_start_time" value="<?php if(empty( set_value('course_start_time') ) ){ 
                                                                              echo $result['course_start_time'];
                                                                             }else{ 
                                                                              echo set_value('course_start_time');
                                                                             }
                                                                   ?>"/>
     <br/>

     <label for="course_end_time">End Time:</label>
     <input type="date" size="20" id="course_end_time" name="course_end_time" value="<?php if(empty( set_value('course_end_time') ) ){ 
                                                                              echo $result['course_end_time'];
                                                                             }else{ 
                                                                              echo set_value('course_end_time');
                                                                             }
                                                                   ?>"/>
     <br/>


     <label for="course_desc">Description :</label>
     <textarea   id="course_desc" name="course_desc"> <?php if(empty( set_value('course_desc') ) ){ 
                                                                              echo $result['course_desc'];
                                                                             }else{ 
                                                                              echo set_value('course_desc');
                                                                             }
                                                                   ?></textarea>

     <br/>






     <input type="submit" value="Edit"/>
   </form>


   <script type="text/javascript">

          var flag=199999;
          var base_url="<?=base_url()?>";

          $('select#parent').on('change', function() {


              alert( this.value ); 

              var addCatChild = document.getElementById('addCatChild');

              addCatChild.innerHTML=" ";
              //addAnotherChild.innerHTML=" ";

              var addAnotherChild = document.getElementById('addAnotherChild');

              addAnotherChild.innerHTML=" ";

              $.get(base_url+"coursecontroller/getCatChild",{catSelected:this.value},function(data){

             // var addCatChild = document.getElementById('addCatChild');
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