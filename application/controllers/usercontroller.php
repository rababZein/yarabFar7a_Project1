<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usercontroller extends CI_Controller {


	public function listuser(){

		$this->load->model('user');
		$data['users']=$this->user->get_users();

		$this->load->view('user',$data);

	}

	
	public function edit(){


        $data['id'] = $this->input->get('id');
       // $this->uri->segment(4);
        $data = $this->db->get_where(
	        'user',
	        array(
	        'user_id' => $data['id']
	        )
        );
		$data = $data->result_array();

	    $data['result'] = $data[0];
		$this->load->helper(array('form'));

		$this->load->view('updateuser',$data);
	}

	public function updateuser(){

	   $id=$this->input->post('id');
	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
	   $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
	   $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|xss_clean');
       $this->form_validation->set_rules('type', 'Type', 'trim|required|xss_clean');
	   $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');

	   if($this->form_validation->run() == FALSE)
	   {
	     

	   	    $data = $this->db->get_where(
								        'user',array('user_id' => $id)
	                                   );
			$data = $data->result_array();

		    $data['result'] = $data[0];
			$this->load->helper(array('form'));

			$this->load->view('updateuser',$data);

	   	//echo "FALSE"; exit();

	   }
	   else
	   {
	    
	   	$this->load->model('user');
		$name = $this->input->post('username');

		$mobile = $this->input->post('mobile');
		$address = $this->input->post('address');
		$type = $this->input->post('type');
		
		$id=$this->input->post('id');
	    $this->user->update($id,$name,$mobile,$address,$type);
	    redirect('usercontroller/listuser', 'location');
	   }





		
	}

	public function deleteuser(){

		$this->load->model('user');
		$id = $this->input->get('userid');
		$this->user->delete($id);

	}



}
