

<!DOCTYPE html>
<html>
<head>
	<title>Update Whish</title>
</head>
<body>

<h1>Update Whish </h1>
   <?php echo validation_errors(); ?>
   <?php

        if (!empty($checkPriceMsg)) {
          echo $checkPriceMsg;
          echo 'not empty';
        }else{

          echo "empty";
        }


   ?>
   <?php echo form_open('whishcontroller/updatewhish'); ?>
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
     
     <input type="text" size="20" id="id" name="id" value="<?php echo $result['whish_id'];?>"  hidden/>
     <br/>

     <label for="min">Min:</label>
     <input type="text" size="20" id="min" name="min" value="<?php if(empty( set_value('min') ) ){ 
                                                                              echo $result['whish_price_min'];
                                                                             }else{ 
                                                                              echo set_value('min');
                                                                              }
                                                              ?>"/>
     <br/>

     <label for="max">Max:</label>
     <input type="text" size="20" id="max" name="max" value="<?php if(empty( set_value('max') ) ){ 
                                                                              echo $result['whish_price_max'];
                                                                             }else{ 
                                                                              echo set_value('max');
                                                                             }
                                                                   ?>"/>
     <br/>



     <input type="submit" value="Edit"/>
   </form>


   <script src="http://code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>
   <script type="text/javascript">

          var flag=199999;
          var base_url="<?=base_url()?>";



          //function on change select :
          //****************************
        /*  function addchild() {
            if(flag==0){

            var addAnotherChild = document.getElementById('addAnotherChild');

           addAnotherChild.innerHTML=" ";


            var x=document.getElementById('sel');

            value = x.value;
        
            $.get(base_url+"whishcontroller/getCatChild",{catSelected:value},function(data){
           
             // var addCatChild = document.getElementById('addCatChild');
              var label = document.createElement('label');
              label.innerHTML= 'Sub Category : ';
              var sell = document.createElement('select');

              sell.id='sel';

              sell.name='categorySub';
   
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
                   sell.appendChild(opt);


              }
               
               //sell.onchange=addchild();
               sell.onchange=function(){

                flag=0;

                addchild();



              };
               addAnotherChild.appendChild(label);
               addAnotherChild.appendChild(sell);



              });
                // flag=1;
             }
             flag=1;
            }*/

              //////////////////////////////////////


          $('select#parent').on('change', function() {


              alert( this.value ); 

              var addCatChild = document.getElementById('addCatChild');

              addCatChild.innerHTML=" ";
              //addAnotherChild.innerHTML=" ";

              var addAnotherChild = document.getElementById('addAnotherChild');

              addAnotherChild.innerHTML=" ";

              $.get(base_url+"whishcontroller/getCatChild",{catSelected:this.value},function(data){

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
              /* sel.onchange=function(){

                flag=0;
                addchild();



              };*/
               //sel.setAttribute('onchange',function(){addchild()});
               addCatChild.appendChild(label);
               addCatChild.appendChild(sel);




              });
           }); 




   </script>

</body>
</html>