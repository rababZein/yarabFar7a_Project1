<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usercontroller extends CI_Controller {

	public function registration(){
		 $this->load->helper(array('form'));
		 $this->load->view('user/registration');

	}

	public function approve ()

	{
		$user_id= $_GET['id'];

		$data['user_id']=$user_id;
		$data['user_active']=1;
		$this->load->model('user');
		$this->user->update($data);
        $user=$this->user->get_user($user_id);
		$sess_array = array(
	                 'id' => $user[0]->user_id,
	                 'username' => $user[0]->user_name,
	                 'type'=>$user[0]->user_type,
	                 'admin'=>$user[0]->user_admin,
	                 'active'=>$user[0]->user_active
                     );
        $this->session->set_userdata('logged_in', $sess_array);

	    redirect('usercontroller/listuser', 'location');

	}

	public function listuser(){

		$this->load->model('user');
		$data['users']=$this->user->get_users();


		$data['content'] = "user/user";
		$this->load->view('lay',$data);


		// $this->load->view('user',$data);

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



$data['content'] = "user/updateuser";
$this->load->view('lay',$data);


	}

	public function updateuser(){

	   $id=$this->input->post('id');
	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
	   $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
       $this->form_validation->set_rules('type', 'Type', 'trim|required|xss_clean');

	   if($this->form_validation->run() == FALSE)
	   {
	     

	   	    $data = $this->db->get_where(
								        'user',array('user_id' => $id)
	                                   );
			$data = $data->result_array();

		    $data['result'] = $data[0];
			$this->load->helper(array('form'));



$data['content'] = "user/updateuser";
$this->load->view('lay',$data);

	   	//echo "FALSE"; exit();

	   }
	   else
	   {
	    
	   	$this->load->model('user');
		$data['user_name'] = $this->input->post('username');
		$data['user_type'] = $this->input->post('type');
		$data['user_email'] = $this->input->post('email');

		if($this->input->post('admin') == "admin")
		$data['user_admin']= 1;

		if($this->input->post('admin') == "not")
		$data['user_admin']= 0;
		
		$data['user_id']=$this->input->post('id');
	    $this->user->update($data);


// $data['content'] = "listuser";
// $this->load->view('lay',$data);
	    redirect('usercontroller/listuser', 'location');
	   }





		
	}

	public function add()
	   {
	   			$data = array('content'=>'user/adduser');
$this->load->view('lay',$data);

	   	
	   }

	public function adduser()
	{

		$data['user_name']= $this->input->post('username');
		$data['user_email']= $this->input->post('email');
		$data['user_password']= MD5($this->input->post('password'));
		if (empty($this->input->post('type'))) {
			# code...
			$data['user_type']='student';
		}else{
				$data['user_type']= $this->input->post('type');
	    }
		
		if($this->input->post('admin') == "admin")
		$data['user_admin']= 1;

		if($this->input->post('admin') == "not")
			 $data['user_admin']= 0;
			
		  



			 $this->load->model('user');
			 $this->user->adduser($data);


			 $this->load->model('user');

			 $user=$this->user->get_user_by_email($data['user_email']); 
			 $user_id= $user[0]->user_id;
			 $config = Array(
			  'protocol' => 'smtp',
			  'smtp_host' => 'ssl://smtp.googlemail.com',
			  'smtp_port' => 465,
			  'smtp_user' => 'engy.elmoshrify@gmail.com', // change it to yours
			  'smtp_pass' => 'engy751093', // change it to yours
			  'mailtype' => 'html',
			  'charset' => 'iso-8859-1',
			  'wordwrap' => TRUE
			);


			 $this->load->helper('url');
 		     $message = "Welcome in our website ! To activate your account please visit the following link: localhost".base_url()."usercontroller/approve?id=".$user_id;


	         $this->load->library('email', $config);
	         $this->email->set_newline("\r\n");
	         $this->email->from('engy.elmoshrify@gmail.com'); 
	         $this->email->to($data['user_email']);
	         $this->email->subject('Activate Your Account !');
	         $this->email->message($message);
	         if($this->email->send()){
	      			echo 'Email sent.';
	     	 }else{
	     			show_error($this->email->print_debugger());
	         }


		    //redirect('coursecontroller/listcourses', 'location');

    echo "Check you mail box to activate account";


	}

	public function deleteuser(){

		$this->load->model('user');
		$id = $this->input->get('userid');
		$this->user->delete($id);

	}



}
