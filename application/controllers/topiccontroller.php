<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Topiccontroller extends CI_Controller {

	    public function addtopic(){

			$data['courseId'] = $this->input->get('id');

	        $this->load->helper(array('form'));

			$this->load->view('topic/addtopic',$data);

	   }

	   public	function storetopic(){

       $this->load->library('form_validation');
	   $this->form_validation->set_rules('topic_title', 'Topic_title', 'trim|required|xss_clean');
	   $this->form_validation->set_rules('topic_desc', 'Topic_desc', 'trim|xss_clean');
	   if($this->form_validation->run() == FALSE){
            $data['courseId']= $this->input->post('topic_course_id');
	        $this->load->helper(array('form'));
			$this->load->view('topic/addtopic',$data);

        
       }else{

      	    $data['topic_course_id'] = $this->input->post('topic_course_id');
      	    //echo  $data['topic_course_id']; exit();
			$data['topic_title'] = $this->input->post('topic_title');
	        $data['topic_desc'] = $this->input->post('topic_desc'); 

			$this->load->model('topic');
			$this->topic->addtopic($data);

		    redirect('coursecontroller/listcourses', 'location');


      }


	}

	public function listcourses(){

		$this->load->model('topic');
		$data['topics']=$this->topic->getAllTpoics();
       
		$this->load->view('course/showcourse',$data);

	}

    public function deletetopic(){

		$this->load->model('topic');
		$id = $this->input->get('topicId');
		$this->topic->delete($id);

	}

	public function edit(){


        $data['id'] = $this->input->get('id');
        $data = $this->db->get_where(
	        'topic',
	        array(
	        'topic_id' => $data['id']
	        )
        );
		$data = $data->result_array();
	    $data['result'] = $data[0];
		$this->load->helper(array('form'));
		$this->load->view('topic/updatetopic',$data);
	}


	public function updatetopic(){

	   $id=$this->input->post('id');
	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('topic_title', 'Topic_title', 'trim|required|xss_clean');
	   $this->form_validation->set_rules('topic_desc', 'Topic_desc', 'trim|xss_clean');
	   
	 
	   if($this->form_validation->run() == FALSE )
	   {
	     

	   	    $data = $this->db->get_where(
								        'topic',array('topic_id' => $id)
	                                   );
			$data = $data->result_array();

		    $data['result'] = $data[0];

			$this->load->helper(array('form'));

			$this->load->view('topic/updatetopic',$data);


	   }
	   else
	   {
	    
	   	$this->load->model('topic');
	


	    $data['topic_title'] = $this->input->post('topic_title');
	    $data['topic_desc'] = $this->input->post('topic_desc'); 

		$data['topic_id']=$this->input->post('id');
        $this->topic->update($data);

	    redirect('coursecontroller/listcourses', 'location');

	   }





		
	}


}
