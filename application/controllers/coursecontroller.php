<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coursecontroller extends CI_Controller {

    public function addcourse(){

		$this->load->model('category');		
		$data['parentCategories']=$this->category->getByParent(0);

        $this->load->helper(array('form'));

		$this->load->view('course/addcourse',$data);

	}




	public function getCatChild(){


        $categoryId = $this->input->get('catSelected');
		$this->load->model('category');
		$childCategories=$this->category->getByParent($categoryId);

	
		if (count($childCategories)){
				echo json_encode($childCategories);
	    }


	}

	 public	function storecourse(){

       $this->load->library('form_validation');
	   $this->form_validation->set_rules('course_title', 'Course_title', 'trim|required|xss_clean');
	   $this->form_validation->set_rules('price', 'Price', 'trim|required|xss_clean');
       
	   if($this->form_validation->run() == FALSE){


	   	$this->load->model('category');

		$data['parentCategories']=$this->category->getByParent(0);

        $this->load->helper(array('form'));

		$this->load->view('course/addcourse',$data);

        
       }else{

       		

        	$data['course_cat_id'] = $this->input->post('category');

	        $data['course_teacher_id'] = '1';

			
			$data['course_title'] = $this->input->post('course_title');

	        $data['course_desc'] = $this->input->post('course_desc'); 

	        $data['course_start_time'] = $this->input->post('course_start_time');

	        $data['course_end_time'] = $this->input->post('course_end_time'); 

	        $data['course_time_zone'] = $this->input->post('course_time_zone'); 
	        //var_dump($data); 

			$this->load->model('course');
			$this->course->addcourse($data);

		    redirect('advcontroller/listadv', 'location');


      }


	}


}

