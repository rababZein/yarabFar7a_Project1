<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Advcontroller extends CI_Controller {


	public function add(){

        $this->load->model('category');

		$data['parentCategories']=$this->category->getByParent(0);

        $this->load->helper(array('form'));

		$this->load->view('addadv',$data);

	}


	public function getCatChild(){


        $categoryId = $this->input->get('catSelected');
		$this->load->model('category');
		$childCategories=$this->category->getByParent($categoryId);

	
		if (count($childCategories)){
				echo json_encode($childCategories);
	    }


	}

	function addadv(){

       $this->load->library('form_validation');
	   $this->form_validation->set_rules('price', 'Price', 'trim|required|xss_clean');
	   $this->form_validation->set_rules('desc', 'Desc', 'trim|required|xss_clean');
       
	   if($this->form_validation->run() == FALSE){


	   	      $this->load->model('category');

		$data['parentCategories']=$this->category->getByParent(0);

        $this->load->helper(array('form'));

		$this->load->view('addadv',$data);

        
       }else{

       		if(empty($this->input->post('categorySub'))){

        	$data['adv_cat_id'] = $this->input->post('category');

	        }else{
	            echo $this->input->post('categorySub');
	            $data['adv_cat_id'] =$this->input->post('categorySub');

	        }

		    $session_data = $this->session->userdata('logged_in');
	        $data['adv_owner_id'] = $session_data['id'];

			
			$data['adv_price'] = $this->input->post('price');

	        $data['adv_desc'] = $this->input->post('desc'); 

	        var_dump($data); 

			$this->load->model('adv');
			$this->adv->addadv($data);

		    redirect('advcontroller/listadv', 'location');


      }


	}

	public function listadv(){

		$this->load->model('adv');
		$data['adv']=$this->adv->get_adv();
        $this->load->model('category');
        $i=0;
       foreach ($data['adv'] as $row) {
       	   
       	   $category=$this->category->get_category($row->adv_cat_id);
           $data['category'][$i]=$category[0];
           $i++;

       }
       $this->load->model('user');
       $i=0;
       foreach ($data['adv'] as $row) {
       	   
       	   $user=$this->user->get_user($row->adv_owner_id);
           $data['user'][$i]=$user[0];
           $i++;

       }
		 

		$this->load->view('listadv',$data);

	}

	public function deleteadv(){

		$this->load->model('adv');
		$id = $this->input->get('advid');
		//echo $id;
		$this->adv->delete($id);

	}



	public function edit(){


        $data['id'] = $this->input->get('id');
        $data = $this->db->get_where(
	        'adv',
	        array(
	        'adv_id' => $data['id']
	        )
        );
		$data = $data->result_array();

	    $data['result'] = $data[0];




        $this->load->model('category');

       // get all parent category 
       $data['parentCategories']=$this->category->getByParent(0);

       //get category of adv .
       $data['catSelected']=$this->category->get_category($data['result']['adv_cat_id']);

        //get parent category of adv .
       $data['ParentCatSelected']=$this->category->get_category($data['catSelected'][0]->cat_parent_id);

       //get all category of parent of adv
       $data['parentCategories']=$this->category->getByParent(0);


       $data['childCategories']=$this->category->getByParent($data['catSelected'][0]->cat_parent_id);



		$this->load->helper(array('form'));
		$this->load->view('updateadv',$data);
	}

	public function updateadv(){

	   $id=$this->input->post('id');

	   $this->load->library('form_validation');
	
	   $this->form_validation->set_rules('price', 'Price', 'trim|required|xss_clean');
	   $this->form_validation->set_rules('desc', 'Desc', 'trim|required|xss_clean');
       
	   if($this->form_validation->run() == FALSE)
	   {
	     

	   	    $data = $this->db->get_where(
								        'adv',array('adv_id' => $id)
	                                   );
			$data = $data->result_array();


		    $data['result'] = $data[0];





	        $this->load->model('category');

	       // get all parent category 
	        $data['parentCategories']=$this->category->getByParent(0);

	       //get category of adv .
	        $data['catSelected']=$this->category->get_category($data['result']['adv_cat_id']);

	        //get parent category of adv .
	        $data['ParentCatSelected']=$this->category->get_category($data['catSelected'][0]->cat_parent_id);

	       //get all category of parent of adv
	        $data['parentCategories']=$this->category->getByParent(0);


	        $data['childCategories']=$this->category->getByParent($data['catSelected'][0]->cat_parent_id);





			$this->load->helper(array('form'));

			$this->load->view('updateadv',$data);


	   }
	   else
	   {
	    
	   	$this->load->model('adv');
	

	    $data['adv_cat_id'] = $this->input->post('category');

	   // echo   $data['adv_cat_id']; exit();

	    $session_data = $this->session->userdata('logged_in');
        $data['adv_owner_id'] = $session_data['id'];

		
		$data['adv_price'] = $this->input->post('price');

        $data['adv_desc'] = $this->input->post('desc'); 	
		$data['adv_id']=$this->input->post('id');
	    $this->adv->update($data);
	    redirect('advcontroller/listadv', 'location');

	   }





		
	}



}