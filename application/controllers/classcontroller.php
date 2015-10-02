<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require("add_schedule.php");
require("ModifyClass.php");
require("CancelClass.php");


class Classcontroller extends CI_Controller {


	
	function __construct(){
	    parent::__construct();
	    if ( ! $this->session->userdata('logged_in'))
	    { 
	        // Allow some methods?
	        $allowed = array();
	        if ( ! in_array($this->router->fetch_method(), $allowed))
	        {
	            redirect('login');
	        }
	    }
	}

	 public function addclass()
	{
		# code...
		$data['courseId']= $this->input->get('courseId');
		$data['topicId']= $this->input->get('topicId');
        $this->load->model('country');
		$data['countries']=$this->country->get_countries();
	    $this->load->helper(array('form'));
		$data['content'] = "class/addclass";
		$this->load->view('lay',$data);



	}

	public function storeClass(){

	 
	
	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
	   $this->form_validation->set_rules('duration', 'Duration', 'trim|xss_clean');
	   $this->form_validation->set_rules('start_time', 'Start_time', 'trim|required|xss_clean');
	   //$this->form_validation->set_rules('attendee_limit', 'Attendee_limit', 'trim|xss_clean');

	   if($this->form_validation->run() == FALSE){
            $data['courseId']= $this->input->post('courseId');
		    $data['topicId']= $this->input->post('topicId');
	        $this->load->helper(array('form'));
			$data['content'] = "class/addclass";
		    $this->load->view('lay',$data);

        
       }else{

       	 // echo $this->input->post('timezone'); exit();
            $courseId= $this->input->post('courseId');
		    $topicId= $this->input->post('topicId');
      	   // $data['class_course_id'] = $this->input->post('courseId');
      	    
		     //$data['class_start_time'] = 
			//$data['class_attendee_limit'] = $this->input->post('attendee_limit');
	       

	        $this->load->model('course');
	        $course=$this->course->getCourse($courseId);
	       // $teacher=$this->course->getTeacher($course[0]->course_teacher_id);
	        

            $this->load->model('user');
            $presenter=$this->user->get_user($course[0]->course_teacher_id);

           // var_dump($presenter); exit();

			//connect with web site 
			// $access_key="NUh89jJp5jc=";
   //          $secretAcessKey="X7Hxt9Fs383plSbsXWB3nQ==";
            $this->load->model('settingwiziq');
            $settingdata['setting']=$this->settingwiziq->getSetting();

            $access_key=$settingdata['setting'][0]->access_key;
            $secretAcessKey=$settingdata['setting'][0]->secret_key;
            $webServiceUrl="http://class.api.wiziq.com/";
            $parmeters = array();
            $parmeters['start_time'] = $this->input->post('start_time').' '.$this->input->post('hour').':'.$this->input->post('minute').':00';
		    $date = new DateTime($parmeters['start_time']);
            $parmeters['start_time'] =  $date->format('Y-m-d H:i:s'); 
            $parmeters["presenter_email"]=$presenter[0]->user_email; 
		    #for room based account pass parameters 'presenter_id', 'presenter_name'
		    //$requestParameters["presenter_id"] = "40";
		    //$requestParameters["presenter_name"] = "vinugeorge";  
		    //$parmeters["start_time"] = $array['start_time'];
		    $parmeters["title"]= $this->input->post('title');//Required
		    $parmeters["duration"]=$this->input->post('duration'); //optional
		    $parmeters["time_zone"]=$this->input->post('timezone'); //optional
		    $parmeters["attendee_limit"]=""; //optional
		    $parmeters["control_category_id"]=""; //optional
		    $parmeters["create_recording"]=$this->input->post('gpRecordClass'); //optional
		    $parmeters["return_url"]=""; //optional
		    $parmeters["status_ping_url"]=""; //optional
		    $parmeters["language_culture_name"]="ar-SA";


		    //repeat daily
		    if ($this->input->post('repeatType')==1) {

		    	$parmeters['start_time'] = $this->input->post('start_time').' '.$this->input->post('hour').':'.$this->input->post('minute').':00';
	            if(!empty($this->input->post('numberOfClasses'))){
			            for ($i=0; $i < $this->input->post('numberOfClasses'); $i++) { 
			            
				            	$d=date('Y-m-d H:i:s', strtotime($parmeters['start_time']. ' + 1 days'));
           
            	                

			                    $obj = new addschedule($secretAcessKey,$access_key,$webServiceUrl,$parmeters);
			                    $result = $obj->return_result();
						        if($result['state']){
						            
						            $data['class_id']=$result['id'];
						            $data['class_presenter_url']=$result['presenter_url'];
						            $data['class_start_time']=$parmeters['start_time'];
						            $data['class_presenter_email']=$result['presenter_email'];
						            $data['class_recording_url']=$result['recording_url'];
						            $data['class_topic_id']= $this->input->post('topicId');
									$data['class_title'] = $this->input->post('title');
									$data['class_duration'] = $this->input->post('duration');
									$data["class_time_zone"]= $this->input->post('timezone') ;	
									$data['class_create_recording']=$parmeters["create_recording"];			
									$this->load->model('Liveclass');
									$this->Liveclass->addclass($data);


									$dat['msg']= "Your Class Has created Successfully  <br/> Recording Url is : ".$result['presenter_url']."<br/> Presenter Email is : ".$result['presenter_email']."<br/> Teacher Access By This Link : <br/>".$data['class_presenter_url'];
									
                                    

						        }else{

						            $dat['msg']= $result['errorMsg'];
									
						        }

						        $parmeters['start_time']=$d;

			            }

			            
				        $dat['content'] = "user/Msg";
					    $this->load->view('lay',$dat);
					//end date     
				}elseif(!empty($this->input->post('end_time'))){


					$end_time = $this->input->post('end_time').' '.$this->input->post('hour').':'.$this->input->post('minute').':00';
	   				$end_time=date('Y-m-d H:i:s', strtotime($end_time. ' + 0 days'));
	   				$parmeters['start_time']=date('Y-m-d H:i:s', strtotime($parmeters['start_time']. ' + 0 days'));


				    while ($end_time > $parmeters['start_time']) {

					   		 $d=date('Y-m-d H:i:s', strtotime($parmeters['start_time']. ' + 1 days'));

					   		 $obj = new addschedule($secretAcessKey,$access_key,$webServiceUrl,$parmeters);
				             $result = $obj->return_result();
						     if($result['state']){
						            
						            $data['class_id']=$result['id'];
						            $data['class_presenter_url']=$result['presenter_url'];
						            $data['class_start_time']=$parmeters['start_time'];
						            $data['class_presenter_email']=$result['presenter_email'];
						            $data['class_recording_url']=$result['recording_url'];
						            $data['class_topic_id']= $this->input->post('topicId');
									$data['class_title'] = $this->input->post('title');
									$data['class_duration'] = $this->input->post('duration');
									$data["class_time_zone"]= $this->input->post('timezone') ;	
									$data['class_create_recording']=$parmeters["create_recording"];			
									$this->load->model('Liveclass');
									$this->Liveclass->addclass($data);


									$dat['msg']= "Your Class Has created Successfully  <br/> Recording Url is : ".$result['presenter_url']."<br/> Presenter Email is : ".$result['presenter_email']."<br/> Teacher Access By This Link : <br/>".$data['class_presenter_url'];
									
				                    

						     }else{

						            $dat['msg']= $result['errorMsg'];
									
						     }

				             $parmeters['start_time']=$d;


				    }


				    $dat['content'] = "user/Msg";
					$this->load->view('lay',$dat);
                 
					

				}

			// repeate weekly
			}elseif($this->input->post('repeatType')==4){


				$parmeters['start_time'] = $this->input->post('start_time').' '.$this->input->post('hour').':'.$this->input->post('minute').':00';
	            if(!empty($this->input->post('numberOfClasses'))){
			            for ($i=0; $i < $this->input->post('numberOfClasses'); $i++) { 
			            
				            	$d=date('Y-m-d H:i:s', strtotime($parmeters['start_time']. ' + 1 week'));
           
            	                

			                    $obj = new addschedule($secretAcessKey,$access_key,$webServiceUrl,$parmeters);
			                    $result = $obj->return_result();
						        if($result['state']){
						            
						            $data['class_id']=$result['id'];
						            $data['class_presenter_url']=$result['presenter_url'];
						            $data['class_start_time']=$parmeters['start_time'];
						            $data['class_presenter_email']=$result['presenter_email'];
						            $data['class_recording_url']=$result['recording_url'];
						            $data['class_topic_id']= $this->input->post('topicId');
									$data['class_title'] = $this->input->post('title');
									$data['class_duration'] = $this->input->post('duration');
									$data["class_time_zone"]= $this->input->post('timezone') ;	
									$data['class_create_recording']=$parmeters["create_recording"];			
									$this->load->model('Liveclass');
									$this->Liveclass->addclass($data);


									$dat['msg']= "Your Class Has created Successfully  <br/> Recording Url is : ".$result['presenter_url']."<br/> Presenter Email is : ".$result['presenter_email']."<br/> Teacher Access By This Link : <br/>".$data['class_presenter_url'];
									
                                    

						        }else{

						            $dat['msg']= $result['errorMsg'];
									
						        }

						        $parmeters['start_time']=$d;

			            }

			            
				        $dat['content'] = "user/Msg";
					    $this->load->view('lay',$dat);

			    // end date		    
				}elseif(!empty($this->input->post('end_time'))){
                 
                    $end_time = $this->input->post('end_time').' '.$this->input->post('hour').':'.$this->input->post('minute').':00';
	   				$end_time=date('Y-m-d H:i:s', strtotime($end_time. ' + 0 days'));
	   				$parmeters['start_time']=date('Y-m-d H:i:s', strtotime($parmeters['start_time']. ' + 0 days'));


				    while ($end_time > $parmeters['start_time']) {

					   		 $d=date('Y-m-d H:i:s', strtotime($parmeters['start_time']. ' + 1 week'));

					   		 $obj = new addschedule($secretAcessKey,$access_key,$webServiceUrl,$parmeters);
				             $result = $obj->return_result();
						     if($result['state']){
						            
						            $data['class_id']=$result['id'];
						            $data['class_presenter_url']=$result['presenter_url'];
						            $data['class_start_time']=$parmeters['start_time'];
						            $data['class_presenter_email']=$result['presenter_email'];
						            $data['class_recording_url']=$result['recording_url'];
						            $data['class_topic_id']= $this->input->post('topicId');
									$data['class_title'] = $this->input->post('title');
									$data['class_duration'] = $this->input->post('duration');
									$data["class_time_zone"]= $this->input->post('timezone') ;	
									$data['class_create_recording']=$parmeters["create_recording"];			
									$this->load->model('Liveclass');
									$this->Liveclass->addclass($data);


									$dat['msg']= "Your Class Has created Successfully  <br/> Recording Url is : ".$result['presenter_url']."<br/> Presenter Email is : ".$result['presenter_email']."<br/> Teacher Access By This Link : <br/>".$data['class_presenter_url'];
									
				                    

						     }else{

						            $dat['msg']= $result['errorMsg'];
									
						     }

				             $parmeters['start_time']=$d;


				    }


				    $dat['content'] = "user/Msg";
					$this->load->view('lay',$dat);


				}



            //repeat Once every month
			}elseif($this->input->post('repeatType')==5){


				$parmeters['start_time'] = $this->input->post('start_time').' '.$this->input->post('hour').':'.$this->input->post('minute').':00';
	            if(!empty($this->input->post('numberOfClasses'))){
			            for ($i=0; $i < $this->input->post('numberOfClasses'); $i++) { 
			            
				            	$d=date('Y-m-d H:i:s', strtotime($parmeters['start_time']. ' + 1 month'));
           
            	                

			                    $obj = new addschedule($secretAcessKey,$access_key,$webServiceUrl,$parmeters);
			                    $result = $obj->return_result();
						        if($result['state']){
						            
						            $data['class_id']=$result['id'];
						            $data['class_presenter_url']=$result['presenter_url'];
						            $data['class_start_time']=$parmeters['start_time'];
						            $data['class_presenter_email']=$result['presenter_email'];
						            $data['class_recording_url']=$result['recording_url'];
						            $data['class_topic_id']= $this->input->post('topicId');
									$data['class_title'] = $this->input->post('title');
									$data['class_duration'] = $this->input->post('duration');
									$data["class_time_zone"]= $this->input->post('timezone') ;	
									$data['class_create_recording']=$parmeters["create_recording"];			
									$this->load->model('Liveclass');
									$this->Liveclass->addclass($data);


									$dat['msg']= "Your Class Has created Successfully  <br/> Recording Url is : ".$result['presenter_url']."<br/> Presenter Email is : ".$result['presenter_email']."<br/> Teacher Access By This Link : <br/>".$data['class_presenter_url'];
									
                                    $parmeters['start_time']=$d;

						        }else{

						            $dat['msg']= $result['errorMsg'];
									
						        }

			            }

			            
				        $dat['content'] = "user/Msg";
					    $this->load->view('lay',$dat);

				// end date	    
				}elseif(!empty($this->input->post('end_time'))){
                 
                    $end_time = $this->input->post('end_time').' '.$this->input->post('hour').':'.$this->input->post('minute').':00';
	   				$end_time=date('Y-m-d H:i:s', strtotime($end_time. ' + 0 days'));
	   				$parmeters['start_time']=date('Y-m-d H:i:s', strtotime($parmeters['start_time']. ' + 0 days'));


				    while ($end_time > $parmeters['start_time']) {

					   		 $d=date('Y-m-d H:i:s', strtotime($parmeters['start_time']. ' + 1 month'));

					   		 $obj = new addschedule($secretAcessKey,$access_key,$webServiceUrl,$parmeters);
				             $result = $obj->return_result();
						     if($result['state']){
						            
						            $data['class_id']=$result['id'];
						            $data['class_presenter_url']=$result['presenter_url'];
						            $data['class_start_time']=$parmeters['start_time'];
						            $data['class_presenter_email']=$result['presenter_email'];
						            $data['class_recording_url']=$result['recording_url'];
						            $data['class_topic_id']= $this->input->post('topicId');
									$data['class_title'] = $this->input->post('title');
									$data['class_duration'] = $this->input->post('duration');
									$data["class_time_zone"]= $this->input->post('timezone') ;	
									$data['class_create_recording']=$parmeters["create_recording"];			
									$this->load->model('Liveclass');
									$this->Liveclass->addclass($data);


									$dat['msg']= "Your Class Has created Successfully  <br/> Recording Url is : ".$result['presenter_url']."<br/> Presenter Email is : ".$result['presenter_email']."<br/> Teacher Access By This Link : <br/>".$data['class_presenter_url'];
									
				                    

						     }else{

						            $dat['msg']= $result['errorMsg'];
									
						     }

				             $parmeters['start_time']=$d;


				    }


				    $dat['content'] = "user/Msg";
					$this->load->view('lay',$dat);


				}



				//single class
			}elseif ($this->input->post('repeatType')==6) {
				# code...

				$parmeters['start_time'] = $this->input->post('start_time').' '.$this->input->post('hour').':'.$this->input->post('minute').':00';
				$obj = new addschedule($secretAcessKey,$access_key,$webServiceUrl,$parmeters);
                $result = $obj->return_result();
		        if($result['state']){
		            
		            $data['class_id']=$result['id'];
		            $data['class_presenter_url']=$result['presenter_url'];
		            $data['class_start_time']=$parmeters['start_time'];
		            $data['class_presenter_email']=$result['presenter_email'];
		            $data['class_recording_url']=$result['recording_url'];
		            $data['class_topic_id']= $this->input->post('topicId');
					$data['class_title'] = $this->input->post('title');
					$data['class_duration'] = $this->input->post('duration');
					$data["class_time_zone"]= $this->input->post('timezone') ;	
					$data['class_create_recording']=$parmeters["create_recording"];			
					$this->load->model('Liveclass');
					$this->Liveclass->addclass($data);


					$dat['msg']= "Your Class Has created Successfully  <br/> Recording Url is : ".$result['presenter_url']."<br/> Presenter Email is : ".$result['presenter_email']."<br/> Teacher Access By This Link : <br/>".$data['class_presenter_url'];
					

		        }else{

		            $dat['msg']= $result['errorMsg'];
					
		        }

		        $dat['content'] = "user/Msg";
				$this->load->view('lay',$dat);


			}

		}
	}

  public function deleteclass(){

	$this->load->model('Liveclass');
	$id = $this->input->get('classId');
	$this->Liveclass->delete($id);

	//$access_key="NUh89jJp5jc=";
    //$secretAcessKey="X7Hxt9Fs383plSbsXWB3nQ==";
    $this->load->model('settingwiziq');
    $data['result']=$this->settingwiziq->getSetting();

    $access_key=$data['result'][0]->access_key;
    $secretAcessKey=$data['result'][0]->secret_key;
    $webServiceUrl="http://class.api.wiziq.com/";
    $obj = new CancelClass($secretAcessKey,$access_key,$webServiceUrl,$id);
								

  }


  public function edit(){


        $data['id'] = $this->input->get('id');
        $data = $this->db->get_where(
	        'class',
	        array(
	        'class_id' => $data['id']
	        )
        );
		$data = $data->result_array();
	    $data['result'] = $data[0];
	 //  var_dump($data['result']['class_time_zone']); exit();
	    $this->load->model('timezone');
	    $data['timezone']=$this->timezone->getByTime($data['result']['class_time_zone']);
	//    var_dump($timezone); exit();
	    $this->load->model('country');
		$data['countries']=$this->country->get_countries();
		$this->load->helper(array('form'));
		//$this->load->view('class/updateclass',$data);
		$data['content'] = "class/updateclass";
		$this->load->view('lay',$data);

	}


	public function updateclass(){

	   $id=$this->input->post('id');
	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
	   $this->form_validation->set_rules('duration', 'Duration', 'trim|xss_clean');
	   $this->form_validation->set_rules('start_time', 'Start_time', 'trim|xss_clean');
	 
	   if($this->form_validation->run() == FALSE )
	   {
	     

	   	    $data = $this->db->get_where(
								        'class',array('class_id' => $id)
	                                   );
			$data = $data->result_array();

		    $data['result'] = $data[0];

			$this->load->helper(array('form'));

			$data['content'] = "class/updateclass";
		    $this->load->view('lay',$data);


	   }
	   else
	   {
	    
	   	$this->load->model('Liveclass');
	


	    $data['class_title'] = $this->input->post('title');
	    $data['class_duration'] = $this->input->post('duration');
        $data['class_start_time'] = $this->input->post('start_time');
        $data['class_start_time'] = $this->input->post('start_time').' '.$this->input->post('hour').':'.$this->input->post('minute').':00';

		$data['class_id']=$this->input->post('id');
		$data["class_time_zone"]=$this->input->post('timezone'); ;

        //$this->Liveclass->update($data);


		// $access_key="NUh89jJp5jc=";
  //       $secretAcessKey="X7Hxt9Fs383plSbsXWB3nQ==";
        $this->load->model('settingwiziq');
        $d['result']=$this->settingwiziq->getSetting();

        $access_key=$d['result'][0]->access_key;
        $secretAcessKey=$d['result'][0]->secret_key;
        $webServiceUrl="http://class.api.wiziq.com/";

		$parmeters = array();
		$parmeters['class_id']=$data['class_id'];
        $parmeters['start_time'] = $data['class_start_time'];
        //$parmeters["presenter_email"]='mosleh7@hotmail.com';
	    #for room based account pass parameters 'presenter_id', 'presenter_name'
	    //$requestParameters["presenter_id"] = "40";
	    //$requestParameters["presenter_name"] = "vinugeorge";  
	    //$parmeters["start_time"] = $array['start_time'];
	    $parmeters["title"]= $data['class_title'] ;//Required
	    $parmeters["duration"]=$data['class_duration']; //optional
	    $parmeters["time_zone"]=$data["class_time_zone"]; //optional
	    $parmeters["attendee_limit"]=""; //optional
	    $parmeters["control_category_id"]=""; //optional
	    $parmeters["create_recording"]=""; //optional
	    $parmeters["return_url"]=""; //optional
	    $parmeters["status_ping_url"]=""; //optional
	    $parmeters["language_culture_name"]="ar-SA";

								
		$obj = new ModifyClass($secretAcessKey,$access_key,$webServiceUrl,$parmeters);
		$result = $obj->return_result();
		if(!empty($result)){
			if($result['state']){
				$this->Liveclass->update($data);
				$data['msg']= $result['successMsg'];
				$data['content'] = "user/Msg";
			    $this->load->view('lay',$data);
	        }else{
	        	$data['msg']= $result['errorMsg'];
				$data['content'] = "user/Msg";
			    $this->load->view('lay',$data);
	        }
        }else{

        	$data['msg']= 'There are error in your internet connection please try agin later';
			$data['content'] = "user/Msg";
			$this->load->view('lay',$data);

        }
       // exit();

	   // redirect('coursecontroller/listcourses', 'location');

	   }





		
	}


	public function gettimezone(){



		$this->load->model('timezone');
		$code=$this->input->get('code');
		$time=$this->timezone->get_timezone($code);

		echo json_encode($time);
	}

	public function downloadrecord(){

		require("DownloadRecording.php");


		$classId=$this->input->get('classId');

		// $access_key="NUh89jJp5jc=";
	 //    $secretAcessKey="X7Hxt9Fs383plSbsXWB3nQ==";
		$this->load->model('settingwiziq');
		$data['result']=$this->settingwiziq->getSetting();

		$access_key=$data['result'][0]->access_key;
		$secretAcessKey=$data['result'][0]->secret_key;
	    $webServiceUrl="http://class.api.wiziq.com/";

	    $obj = new DownloadRecording($secretAcessKey,$access_key,$webServiceUrl,$classId);
	    $result = $obj->return_result();
		if($result['state']){
			
			$data['msg']= $result['message'];
			$data['content'] = "user/Msg";
		   $this->load->view('lay',$data);
        }else{
         	$data['msg']= $result['message'];
			$data['content'] = "user/Msg";
		    $this->load->view('lay',$data); 
        }

	}


	public function teacherClasses(){

        $session_data = $this->session->userdata('logged_in');
		$teacherId=$session_data['id'];

		$this->load->model('course');
		$teacherCourses=$this->course->getCoursesOfTeacher($teacherId);


		//var_dump($teacherCourses);
		$i=0;
		$y=0;
		foreach ($teacherCourses as $teacherCourse) {
			# code...
			$this->load->model('topic');
			$topics[$i]=$this->topic->getTopicByCourseId($teacherCourse->course_id);

			foreach ($topics[$i] as $topic) {
				# code...
				$this->load->model('liveclass');
			    $data['classes'][$y]=$this->liveclass->getAllClassesByTopicId($topic->topic_id);
			    $y++;
			
			}

			$i++;



		}

		//var_dump($data['classes'][0]);
		$data['content'] = "class/teacherClasses.php";
		$this->load->view('lay',$data); 
	}
}