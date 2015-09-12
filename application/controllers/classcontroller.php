<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Classcontroller extends CI_Controller {

	 public function addclass()
	{
		# code...
		$data['courseId']= $this->input->get('courseId');
		$data['topicId']= $this->input->get('topicId');

	    $this->load->helper(array('form'));
		$data['content'] = "class/addclass";
		$this->load->view('lay',$data);



	}

	public function storeClass(){

	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
	   $this->form_validation->set_rules('duration', 'Duration', 'trim|xss_clean');
	   $this->form_validation->set_rules('attendee_limit', 'Attendee_limit', 'trim|xss_clean');

	   if($this->form_validation->run() == FALSE){
            $data['courseId']= $this->input->post('courseId');
		    $data['topicId']= $this->input->post('topicId');
	        $this->load->helper(array('form'));
			$data['content'] = "class/addclass";
		    $this->load->view('lay',$data);

        
       }else{

      	   // $data['class_course_id'] = $this->input->post('courseId');
      	    $data['class_topic_id']= $this->input->post('topicId');
			$data['class_title'] = $this->input->post('title');
			$data['class_duration'] = $this->input->post('duration');
			//$data['class_attendee_limit'] = $this->input->post('attendee_limit');
	        $data["class_time_zone"]="Africa/Cairo" ;

	        $this->load->model('course');
	        $course=$this->course->getCourse($courseId);
	        $teacher=$this->course->getTeacher($course[0]->course_teacher_id);
	        

			$this->load->model('Liveclass');
			$this->Liveclass->addclass($data);

		    redirect('coursecontroller/listcourses', 'location');


      }
	}

	  public function deleteclass(){

		$this->load->model('Liveclass');
		$id = $this->input->get('classId');
		$this->Liveclass->delete($id);

	}
}