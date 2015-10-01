

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Typography | BlueWhale Admin</title>
       <link rel="stylesheet"  href="../bootstrap-datetimepicker-0.0.11/css/bootstrap-datetimepicker.min.css">
<script src="http://code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>
 <!-- Load jQuery and bootstrap datepicker scripts -->
 <script src="../bootstrap-datetimepicker-0.0.11/js/bootstrap-datetimepicker.min.js"></script>

   
    <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
      setSidebarHeight();


        });
    </script>

</head>
<body>

<?php session_start(); $session_data = $this->session->userdata('logged_in');  ?>

    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft">
                    <img src="../img/logo.png"  alt="Logo" /></div>
                <div class="floatright">
                    
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Hello <?php echo $session_data['username']?></li>
                          
                            <li><a href="../home/logout">Logout</a></li>
                            <li><a href='../usercontroller/edit?id=<?php echo $session_data['id']?>'>Update Your Profile</a></li>
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


<?php if($session_data['type']=='admin' || $session_data['type']=='super admin' ){?>
                        <li><a class="menuitem">Categories</a>
                            <ul class="submenu">
                              <li><a href="../categorycontroller/listcategories">All category</a> </li>
                                <li><a href="../categorycontroller/addcategory">add category</a> </li>
                               
                               
                            </ul>
                        </li>

<?php }?>
                       <li><a class="menuitem">Courses</a>
                            <ul class="submenu">
                                <li><a href="../coursecontroller/listcourses">All Courses</a> </li>
                             <?php if($session_data['type']=='admin' || $session_data['type']=='super admin' ){?>
   
                                <li><a href="../coursecontroller/addcourse">Add Course</a> </li>
                              <?php } ?>  
                            </ul>
                        </li>

<?php if($session_data['type']=='teacher'){?>
                         <li><a class="menuitem">Live Classes</a>
                            <ul class="submenu">
                                <li><a href="../classcontroller/teacherClasses">Your Classes</a> </li>
                           
                            </ul>
                        </li>
                       
<?php }?>
                     

<?php if($session_data['type']=='admin' || $session_data['type']=='super admin' ){?>


                        <li><a class="menuitem">Users</a>
                            <ul class="submenu">
                                <li><a href="../usercontroller/listuser">All users</a> </li>
                                <li><a href="../usercontroller/add">add user</a> </li>

                            </ul>
                        </li>
                        <li><a href="../usercontroller/settingView"> Setting WiziQ </a></li>
<?php }?>                        
                    </ul>
                </div>
            </div>
        </div>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>
                    </h2>
                <div class="block">


        <?php $this->load->view($content); ?>

     

     


            
                    
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
