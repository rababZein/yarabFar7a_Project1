<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Typography | BlueWhale Admin</title>
    <link rel="stylesheet" type="text/css" href="/q8DZ/css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="/q8DZ/css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="/q8DZ/css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="/q8DZ/css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="/q8DZ/css/nav.css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" /><![endif]-->
    <link href="/q8DZ/css/table/demo_page.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN: load jquery -->
    <script src="/q8DZ/js/jquery-1.6.4.min.js" type="text/javascript"></script>
           <script src="http://code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>

    <script type="text/javascript" src="/q8DZ/js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="/q8DZ/js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="/q8DZ/js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="/q8DZ/js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="/q8DZ/js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="/q8DZ/js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="/q8DZ/js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="/q8DZ/js/table/jquery.dataTables.min.js" type="text/javascript"></script>












    <!-- END: load jquery -->
    <script type="text/javascript" src="/q8DZ/js/table/table.js"></script>
    <script src="/q8DZ//js/setup.js" type="text/javascript"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
      setSidebarHeight();


        });
    </script>
</head>
<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft">
                    <img src="img/logo.png" alt="Logo" /></div>
                <div class="floatright">
                    
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Hello <?php session_start(); ?></li>
                          
                            <li><a href="http://localhost/q8DZ/login/logout">Logout</a></li>
                        </ul>
                        <br />
                       
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="#"><span>Home</span></a> </li>
               

            </ul>
        </div>
        <div class="clear">
        </div>
        <div class="grid_2">
            <div class="box sidemenu">
                <div class="block" id="section-menu">
                    <ul class="section menu">


                       <li><a class="menuitem">Advertisements</a>
                            <ul class="submenu">
                                <li><a href="/q8DZ/advcontroller/listadv">All advertisements</a> </li>
                                <li><a href="/q8DZ/advcontroller/add">add advertise</a> </li>
                                                <li><a href="/q8DZ/advcontroller/approval">approval advertisements</a> </li>

                                   </ul>
                        </li>
                       

                         <li><a class="menuitem">Users</a>
                            <ul class="submenu">
                                <li><a href="/q8DZ/usercontroller/listuser">All users</a> </li>
                                <li><a href="/q8DZ/usercontroller/add">add user</a> </li>

                            </ul>
                        </li>


                        <li><a class="menuitem">Wishes</a>
                            <ul class="submenu">
                               <li><a href="/q8DZ/whishcontroller/listwhish">All wishes</a> </li>
                                <li><a href="/q8DZ/advcontroller/add" >Add wish</a> </li>
                               
                            </ul>
                        </li>
                        <li><a class="menuitem">Categories</a>
                            <ul class="submenu">
                              <li><a href="/q8DZ/categorycontroller/listcategories">All category</a> </li>
                                <li><a href="/q8DZ/categorycontroller/addcategory">add category</a> </li>
                               
                               
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>
                    Add Adv </h2>
                <div class="block">


        <?php $this->load->view($content); ?>

     

     
<script> 
    document.getElementById("admin").style.visibility= "hidden";

function fun()
{
if(document.getElementById("type").value == "teacher")
    document.getElementById("admin").style.visibility= "visible";

if(document.getElementById("type").value == "student")
    document.getElementById("admin").style.visibility= "hidden";
}


</script>
<script>
document.getElementById('selectarea').style.display = 'none';
$('#selectcity').change(function(){
city_id=(document.getElementById("selectcity").value);

if(city_id != "choose")
{

$.ajax({
  url: "http://localhost/q8DZ/areas?q="+city_id,
})
.done(function(data) {
  console.log(data);
 
    obj=     eval ("(" + data + ")");

var opt = null;
document.getElementById('selectarea').style.display = 'block';

sel=document.getElementById('selectarea');

sel.removeChild(sel.childNodes[0]);

for(i in obj) { 

    opt = document.createElement('option');
    opt.value = obj[i]['area_id'];
    opt.innerHTML = obj[i]['area_name'];
    sel.appendChild(opt);
}


})
.fail(function() {
  alert("Ajax failed to fetch data")
})


}


else{

document.getElementById('selectarea').style.display = 'none';


}
  });

</script>


   <script type="text/javascript">

          var flag=199999;
          var base_url="<?=base_url()?>";



          //function on change select :
          //****************************
          function addchild() {
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
            }

              //////////////////////////////////////


          $('.cat').on('change', function() {


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
               sel.onchange=function(){

                flag=0;
                addchild();



              };
               //sel.setAttribute('onchange',function(){addchild()});
               addCatChild.appendChild(label);
               addCatChild.appendChild(sel);




              });
           }); 




   </script>

            
                    
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
    <div id="site_info">

        <br>  <br>  <br><br><br><br><br>
        <p>
            Copyright <a href="#">BlueWhale Admin</a>. All Rights Reserved.
        </p>
    </div>
</body>
</html>
