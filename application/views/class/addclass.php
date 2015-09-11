<?php
//$id = $_GET['ID'] ;
//$Msg="";

$par=array();
$par["name"]='rabab';
    $par["email"]= 'Mohamed_tc@hotmail.com';
    $par["password"]= '123456';
    $par["image"]= 'abd.jpg';
    $par["phone_number"]= '+20 1284064635';
    
    $par["about_the_teacher"]= "Online Facilitator and Teacher, British Columbia, Canada";
    $par["is_active"]= '1';
  $access_key="FneRTyilJ9Q=";
                $secretAcessKey="bKfMCZOU3ZhUsJqtHRsFpQ==";
                $webServiceUrl="http://class.api.wiziq.com/";
                require("add_techer.php");
          //$obj = new addteacher($secretAcessKey,$access_key,$webServiceUrl,$par);


  $parmeters = array();
  //$start_time = $_POST['d_year'].'-'.sprintf('%02d', intval($_POST['d_month'])).'-'.sprintf('%02d', intval($_POST['d_day'])).' '.sprintf('%02d', intval($_POST['d_hour'])).':'.sprintf('%02d', intval($_POST['d_minute']));
  $parmeters['start_time'] = '20:15 2016-9-12';  // 20:15 2013-12-22

  $parmeters["presenter_email"]='mosleh7@hotmail.com';
    #for room based account pass parameters 'presenter_id', 'presenter_name'
    //$requestParameters["presenter_id"] = "40";
    //$requestParameters["presenter_name"] = "vinugeorge";  
    //$parmeters["start_time"] = $array['start_time'];
    $parmeters["title"]= 'yarab far7a' ;//Required
    $parmeters["duration"]=""; //optional
    $parmeters["time_zone"]="Africa/Cairo"; //optional
    $parmeters["attendee_limit"]=""; //optional
    $parmeters["control_category_id"]=""; //optional
    $parmeters["create_recording"]=""; //optional
    $parmeters["return_url"]=""; //optional
    $parmeters["status_ping_url"]=""; //optional
        $parmeters["language_culture_name"]="ar-SA";
               
                $webServiceUrl="http://class.api.wiziq.com/";
                require("add_schedule.php");
          $obj = new addschedule($secretAcessKey,$access_key,$webServiceUrl,$parmeters);
          
          $result = $obj->return_result();
          if($result['state']){
            echo 'done';
            
           // RunQuery("INSERT INTO schedule ($row) VALUES ($values) ");
          }

?>


