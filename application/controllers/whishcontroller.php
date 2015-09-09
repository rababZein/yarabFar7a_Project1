<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Whishcontroller extends CI_Controller {


	public function add(){

        $this->load->model('category');

		$data['parentCategories']=$this->category->getByParent(0);

        $this->load->helper(array('form'));

		$this->load->view('addwhish',$data);

	}


	public function getCatChild(){


        $categoryId = $this->input->get('catSelected');
		$this->load->model('category');
		$childCategories=$this->category->getByParent($categoryId);

	
		if (count($childCategories)){
				echo json_encode($childCategories);
	    }


	}

	function addwhish(){

	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('min', 'Min', 'trim|required|xss_clean');
	   $this->form_validation->set_rules('max', 'Max', 'trim|required|xss_clean');

	   if ($this->input->post('min') > $this->input->post('max')) {
	   	  $checkFlag=0;


	   }elseif ($this->input->post('min') == $this->input->post('max')) {
	   	  $checkFlag=0;
	   }else{

	   	  $checkFlag=1;
	   }
       
	   if($this->form_validation->run() == FALSE || $checkFlag==0)
	   {


	   	    $this->load->model('category');

		    $data['parentCategories']=$this->category->getByParent(0);
            
	   	    $data['checkPriceMsg']='min price should be less than max price';
			$this->load->helper(array('form'));

			$this->load->view('addwhish',$data);

	   }else{

        if(empty($this->input->post('categorySub'))){

        	$data['whish_cat_id'] = $this->input->post('category');

        }else{
            echo $this->input->post('categorySub');
            $data['whish_cat_id'] =$this->input->post('categorySub');

        }

	    $session_data = $this->session->userdata('logged_in');
        $data['whish_user_id'] = $session_data['id'];

		
		$data['whish_price_min'] = $this->input->post('min');
		$data['whish_price_max'] = $this->input->post('max');



		$this->load->model('whish');
		$this->whish->addwhish($data);

	    redirect('whishcontroller/listwhish', 'location');

      }

	}


	public function listwhish(){

		$this->load->model('whish');
		$data['whish']=$this->whish->get_whish();
        $this->load->model('category');
        $i=0;
       foreach ($data['whish'] as $row) {
       	   
       	   $category=$this->category->get_category($row->whish_cat_id);
           $data['category'][$i]=$category[0];
           $i++;

       }
       $this->load->model('user');
       $i=0;
       foreach ($data['whish'] as $row) {
       	   
       	   $user=$this->user->get_user($row->whish_user_id);
           $data['user'][$i]=$user[0];
           $i++;

       }
		 //var_dump()
        

        

		$this->load->view('listwhish',$data);

	}

	
	public function edit(){


        $data['id'] = $this->input->get('id');
        $data = $this->db->get_where(
	        'whish',
	        array(
	        'whish_id' => $data['id']
	        )
        );
		$data = $data->result_array();

	    $data['result'] = $data[0];

        $this->load->model('category');

       // get all parent category 
        $data['parentCategories']=$this->category->getByParent(0);

       //get category of adv .
        $data['catSelected']=$this->category->get_category($data['result']['whish_cat_id']);

        //get parent category of adv .
        $data['ParentCatSelected']=$this->category->get_category($data['catSelected'][0]->cat_parent_id);

       //get all category of parent of adv
        $data['parentCategories']=$this->category->getByParent(0);


        $data['childCategories']=$this->category->getByParent($data['catSelected'][0]->cat_parent_id);



        $this->load->model('category');
        $category=$this->category->get_category($data['result']['whish_cat_id']);
        $data['category']=$category[0];
        //var_dump($data['category']); exit();

		$this->load->helper(array('form'));
		$this->load->view('updatewhish',$data);
	}

	public function updatewhish(){

	   $id=$this->input->post('id');
	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('min', 'Min', 'trim|required|xss_clean');
	   $this->form_validation->set_rules('max', 'Max', 'trim|required|xss_clean');

	   if ($this->input->post('min') > $this->input->post('max')) {
	   	  $checkFlag=0;


	   }elseif ($this->input->post('min') == $this->input->post('max')) {
	   	  $checkFlag=0;
	   }else{

	   	  $checkFlag=1;
	   }
       
	   if($this->form_validation->run() == FALSE || $checkFlag==0)
	   {
	     

	   	    $data = $this->db->get_where(
								        'whish',array('whish_id' => $id)
	                                   );
			$data = $data->result_array();

		    $data['result'] = $data[0];


		    $this->load->model('category');

            // get all parent category 
            $data['parentCategories']=$this->category->getByParent(0);

            //get category of adv .
            $data['catSelected']=$this->category->get_category($data['result']['whish_cat_id']);

            //get parent category of adv .
            $data['ParentCatSelected']=$this->category->get_category($data['catSelected'][0]->cat_parent_id);

            //get all category of parent of adv
            $data['parentCategories']=$this->category->getByParent(0);


            $data['childCategories']=$this->category->getByParent($data['catSelected'][0]->cat_parent_id);



            
	   	    $data['checkPriceMsg']='min price should be less than max price';
			$this->load->helper(array('form'));

			$this->load->view('updatewhish',$data);


	   }
	   else
	   {
	    
	   	$this->load->model('whish');
		$data['whish_cat_id'] = $this->input->post('category');
		$data['whish_price_min'] = $this->input->post('min');
		$data['whish_price_max'] = $this->input->post('max');	
		$data['whish_id']=$this->input->post('id');
	    $this->whish->update($data);
	    redirect('whishcontroller/listwhish', 'location');

	   }





		
	}

	public function deletewhish(){

		$this->load->model('whish');
		$id = $this->input->get('whishid');
		//echo $id;
		$this->whish->delete($id);

	}






}
