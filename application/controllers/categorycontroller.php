<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categorycontroller extends CI_Controller {


	public function addcategory(){

		//echo "string"; exit();

        $this->load->model('category');
		$data['categories']=$this->category->get_categories();

        $this->load->helper(array('form'));

		$this->load->view('addcategory',$data);

	}


	public function add(){




	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('category', 'Category', 'trim|required|xss_clean');

	   if($this->form_validation->run() == FALSE)
	   {
            $this->load->model('category');
		    $data['categories']=$this->category->get_categories();
	   	    $this->load->view('addcategory',$data);

	   }
	   else
	   {
	    
	        $this->load->model('category');
		   	$data['cat_name'] = $this->input->post('category');
		   	$data['cat_parent_id'] = $this->input->post('id');

			$this->category->addcategory($data);

		    redirect('categorycontroller/listcategories', 'location');

	   }

	}


	public function listcategories(){

		$this->load->model('category');
		$data['categories']=$this->category->get_categories();

		$this->load->view('listcategories',$data);

	}


	public function deletecategory(){

		$this->load->model('category');
		$id = $this->input->get('catid');
		$this->category->delete($id);


	}

	public function edit(){


        $data['id'] = $this->input->get('id');
        $data = $this->db->get_where(
	        'category',
	        array(
	        'cat_id' => $data['id']
	        )
        );


		$data = $data->result_array();



	    $data['result'] = $data[0];
		$this->load->helper(array('form'));
		$this->load->view('updatecategory',$data);
	}

	public function updatecategory(){

	   $id=$this->input->post('id');
	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('category', 'Category', 'trim|required|xss_clean');

	   if($this->form_validation->run() == FALSE)
	   {
	     

	   	    $data = $this->db->get_where(
								         'category',array('cat_id' => $id)
	                                    );
			$data = $data->result_array();

		    $data['result'] = $data[0];
			$this->load->helper(array('form'));

			$this->load->view('updatecategory',$data);


	   }
	   else
	   {
	    
		   	$this->load->model('category');
			$name = $this->input->post('category');
			$id=$this->input->post('id');
		    $this->category->update($id,$name);
		    redirect('categorycontroller/listcategories', 'location');
	   }





		
	}


}