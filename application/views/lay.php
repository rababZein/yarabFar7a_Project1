

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Typography | BlueWhale Admin</title>

    <link rel="stylesheet" type="text/css" href="../css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../css/nav.css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" /><![endif]-->
    <link href="../css/table/demo_page.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN: load jquery -->
    <script src="../js/jquery-1.6.4.min.js" type="text/javascript"></script>

    <script type="text/javascript" src="../js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src=".../js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="../js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="../js/table/jquery.dataTables.min.js" type="text/javascript"></script>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/dataTables.bootstrap.min.css">


    <!-- END: load jquery -->

    <script src="../js/setup.js" type="text/javascript"></script>

    <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
      setSidebarHeight();


        });
    </script>

</head>
<body>

<?php session_start(); $session_data = $this->session->userdata('logged_in'); ?>

    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft">
                    <img src="img/logo.png" alt="Logo" /></div>
                <div class="floatright">
                    
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Hello </li>
                          
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


<?php if($session_data['type']!='student'){?>
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
                                <li><a href="../coursecontroller/addcourse">Add Course</a> </li>

                            </ul>
                        </li>
                       

                     

<?php if($session_data['type']!='student'){?>


                        <li><a class="menuitem">Users</a>
                            <ul class="submenu">
                                <li><a href="../usercontroller/listuser">All users</a> </li>
                                <li><a href="../usercontroller/add">add user</a> </li>

                            </ul>
                        </li>
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
