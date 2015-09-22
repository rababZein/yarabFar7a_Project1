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
//var_dump($data['countries']); exit();
	    $this->load->helper(array('form'));
		$data['content'] = "class/addclass";
		$this->load->view('lay',$data);



	}

	public function storeClass(){

	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
	   $this->form_validation->set_rules('duration', 'Duration', 'trim|xss_clean');
	   $this->form_validation->set_rules('start_time', 'Start_time', 'trim|xss_clean');
	   //$this->form_validation->set_rules('attendee_limit', 'Attendee_limit', 'trim|xss_clean');

	   if($this->form_validation->run() == FALSE){
            $data['courseId']= $this->input->post('courseId');
		    $data['topicId']= $this->input->post('topicId');
	        $this->load->helper(array('form'));
			$data['content'] = "class/addclass";
		    $this->load->view('lay',$data);

        
       }else{
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
			$access_key="NUh89jJp5jc=";
            $secretAcessKey="X7Hxt9Fs383plSbsXWB3nQ==";
            $webServiceUrl="http://class.api.wiziq.com/";
            $parmeters = array();
            $parmeters['start_time'] = $this->input->post('start_time');
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
		    $parmeters["create_recording"]=""; //optional
		    $parmeters["return_url"]=""; //optional
		    $parmeters["status_ping_url"]=""; //optional
		    $parmeters["language_culture_name"]="ar-SA";
		    $obj = new addschedule($secretAcessKey,$access_key,$webServiceUrl,$parmeters);
          
            $result = $obj->return_result();
	        if($result['state']){
	            
	            $data['class_id']=$result['id'];
	            $data['class_presenter_url']=$result['presenter_url'];
	            $data['class_start_time']=$this->input->post('start_time');
	            $data['class_presenter_email']=$result['presenter_email'];
	            $data['class_recording_url']=$result['recording_url'];
	            $data['class_topic_id']= $this->input->post('topicId');
				$data['class_title'] = $this->input->post('title');
				$data['class_duration'] = $this->input->post('duration');
				$data["class_time_zone"]= $this->input->post('timezone') ;				
				$this->load->model('Liveclass');
				$this->Liveclass->addclass($data);

				//redirect('coursecontroller/listcourses', 'location');

				$data['msg']= "Your Class Has created Successfully  <br/> Recording Url is : ".$result['presenter_url']."<br/> Presenter Email is : ".$result['presenter_email'];
				$data['content'] = "user/Msg";
				$this->load->view('lay',$data);


	        }else{

	            $data['msg']= $result['errorMsg'];
				$data['content'] = "user/Msg";
				$this->load->view('lay',$data);
	        }

//		    redirect('coursecontroller/listcourses', 'location');


      }
	}

  public function deleteclass(){

	$this->load->model('Liveclass');
	$id = $this->input->get('classId');
	$this->Liveclass->delete($id);

	$access_key="NUh89jJp5jc=";
    $secretAcessKey="X7Hxt9Fs383plSbsXWB3nQ==";
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
		$data['class_id']=$this->input->post('id');
		$data["class_time_zone"]=$this->input->post('timezone'); ;

        $this->Liveclass->update($data);


		$access_key="NUh89jJp5jc=";
        $secretAcessKey="X7Hxt9Fs383plSbsXWB3nQ==";
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
		if($result['state']){
			
			$data['msg']= $result['successMsg'];
			$data['content'] = "user/Msg";
		    $this->load->view('lay',$data);
        }else{
        	$data['msg']= $result['errorMsg'];
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
}