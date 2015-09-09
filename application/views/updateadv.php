
<!DOCTYPE html>
<html>
<head>
	<title>Update Adv</title>
</head>
<body>

<h1>Update Adv </h1>
   <?php echo validation_errors(); ?>
   <?php echo form_open('advcontroller/updateadv'); ?>
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

     <!--p id="addAnotherChild">


       

     </p-->

     <label for="price">Price:</label>
     <input type="number" size="20" id="price" name="price" value="<?php if(empty(set_value('price'))){
                                                                  echo $result['adv_price'];
                                                                  }else{
                                                                   echo set_value('price');} ?>"/>
     <br/>


     <label for="desc">Desc:</label>
     <input type="textarea"  id="desc" name="desc" value="<?php if(empty(set_value('desc'))){echo $result['adv_desc'];}else{echo set_value('desc');}?>"/>
     <br/>

    <input type="text" size="20" id="id" name="id" value="<?php echo $result['adv_id'];?>"  hidden/>


   

     <input type="submit" value="Add"/>
   </form>


   <script src="http://code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>
   <script type="text/javascript">

          var flag=199999;
          var base_url="<?=base_url()?>";



          //function on change select :
          //****************************
         /* function addchild() {
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

             /* var addAnotherChild = document.getElementById('addAnotherChild');

              addAnotherChild.innerHTML=" ";*/

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
               /*sel.onchange=function(){

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