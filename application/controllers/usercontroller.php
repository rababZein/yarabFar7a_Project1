<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once("add_techer.php");
require_once("edit_techer.php");

class Usercontroller extends CI_Controller {


	function __construct(){
	    parent::__construct();
	
	    if ( ! $this->session->userdata('logged_in'))
	    { 
	        // Allow some methods?
	        $allowed = array(
	            'registration',
	            'registrationstore',
	            'countrycode',
	            'approve',
	            'forgetpasswordView',
	            'forgetpasswordGetQuestion',
	            'forgetpasswordCheckAnswer',
	            'resetPassword',
	            'forgetPasswordBySendMailView',
	            'forgetPasswordBySendMail'
	        );
	        if ( ! in_array($this->router->fetch_method(), $allowed))
	        {
	            redirect('login');
	        }
	    }
	}

	public function registration(){

		 $this->load->model('country_t');
		 $this->load->model('question');
		 $data['questions']=$this->question->get_questions();

		 $data['countries']=$this->country_t->get_countries();
		 $this->load->helper(array('form'));
		 $this->load->view('user/registration',$data);

	}

	public function registrationstore()
	{

	    $this->load->library('form_validation');
	    $this->form_validation->set_rules('username', 'User name', 'trim|required|xss_clean|min_length[5]|max_length[12]|is_unique[user.user_name]');
	    $this->form_validation->set_rules('firstname', 'First name', 'trim|required|xss_clean|min_length[5]|max_length[20]]');
	    $this->form_validation->set_rules('lastname', 'Last name', 'trim|required|xss_clean|min_length[5]|max_length[20]');
	    $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|is_unique[user.user_email]');
        $this->form_validation->set_rules('type', 'Type', 'trim|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[5]|max_length[12]|matches[passconf]');
	    $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|xss_clean');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|xss_clean|min_length[5]');
        $this->form_validation->set_rules('question', 'Question', 'trim|required|xss_clean');
        $this->form_validation->set_rules('answer', 'Answer', 'trim|required|xss_clean');

        $country=$this->input->post('country');
       // echo $country; exit();
        if ($country=='empty') {
        	$countryErrMsg='please choose your country';
        	# code...
        }
        if($this->form_validation->run() == FALSE || !empty($countryErrMsg)){

        	    $this->load->model('country_t');
			    $data['countries']=$this->country_t->get_countries();
			    $this->load->model('question');
			    $data['questions']=$this->question->get_questions();
                $this->load->helper(array('form'));
        	   // $data['content'] = 'user/registration';
        	    if(!empty($countryErrMsg)){
        	    	$data['countryErrMsg']=$countryErrMsg;
        	    }
		        $this->load->view('user/registration',$data);

        }else{
				$data['user_name']= $this->input->post('username');
				$data['user_first_name']= $this->input->post('firstname');
				$data['user_last_name']= $this->input->post('lastname');
				$data['user_email']= $this->input->post('email');
				$data['user_question']= $this->input->post('question');
				$data['user_answer']= $this->input->post('answer');
				$data['user_phone']=$this->input->post('code').' '.$this->input->post('mobile');
				$data['user_password']= MD5($this->input->post('password'));					# code...
				$data['user_type']='student';
				
				
				
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


			    $data['msg']= 'Your Account is Created Successfully please  check ypur mail to activated your account';
			    //$data['content'] = "user/Msg";
			    $this->load->view('user/Msg',$data);

				

		}  		


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
        $this->load->helper(array('form', 'url'));
        $data['error']= '';
		$data['content'] = "user/user";
		$this->load->view('lay',$data);


		// $this->load->view('user',$data);

	}

	
	public function edit(){
        $data['id'] = $this->input->get('id');
        $session_data = $this->session->userdata('logged_in'); 
		if($session_data['id'] == $data['id'] || $session_data['type'] == 'admin' || $session_data['type'] == 'super admin'){
	        
	        $data = $this->db->get_where(
		        'user',
		        array(
		        'user_id' => $data['id']
		        )
	        );
			$data = $data->result_array();

			if(!empty($data[0])){

			    $data['result'] = $data[0];
				$this->load->helper(array('form'));
				$data['content'] = "user/updateuser";
				$this->load->view('lay',$data);
			}else{

				$data['msg']= "There isn't user with this id here";
				$data['content'] = "user/Msg";
				$this->load->view('lay',$data);

			}
		}else{

			$data['msg']= "You Don't Have A permission To Access This Profile";
			$data['content'] = "user/Msg";
			$this->load->view('lay',$data);
		}


	}

	public function updateuser(){

	   $id=$this->input->post('id');
	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
	   // $this->form_validation->set_rules('firstname', 'First name', 'trim|required|xss_clean|min_length[5]|max_length[20]]');
	   // $this->form_validation->set_rules('lastname', 'Last name', 'trim|required|xss_clean|min_length[5]|max_length[20]');
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
		$data['user_first_name']= $this->input->post('firstname');
		$data['user_last_name']= $this->input->post('lastname');
		$data['user_type'] = $this->input->post('type');
		$data['user_email'] = $this->input->post('email');

		if($this->input->post('admin') == "admin")
		$data['user_admin']= 1;

		if($this->input->post('admin') == "not")
		$data['user_admin']= 0;
		
		$data['user_id']=$this->input->post('id');
	    $this->user->update($data);

	    if($this->input->post('type')=='teacher'){
   //          $access_key="NUh89jJp5jc=";
			// $secretAcessKey="X7Hxt9Fs383plSbsXWB3nQ==";
			$this->load->model('settingwiziq');

		    $d['result']=$this->settingwiziq->getSetting();
		    $access_key=$d['result'][0]->access_key;
		    $secretAcessKey=$d['result'][0]->secret_key;

			$webServiceUrl="http://class.api.wiziq.com/";
			$requestParameters["name"]= $this->input->post('username');
			$requestParameters["email"]= $this->input->post('email');
			$requestParameters["password"]= '12345678';
			$requestParameters["image"]= "image.png";
			//$requestParameters["phone_number"]= "+2 01284064635";
			//$requestParameters["work_number"]="+2 01284064635";
			$requestParameters["about_the_teacher"]= "Online Facilitator and Teacher, British Columbia, Canada";
			$requestParameters["is_active"]=1;
			$requestParameters['teacher_id']=$data['user_id'];
	        $obj = new editteacher($secretAcessKey,$access_key,$webServiceUrl,$requestParameters);
//exit();

            $result = $obj->return_result();

					
			if ($result['state']) {
            	# code...
            	$data['msg']='update teacher account Done';
            }else{

            	$data['msg']= $result['errorMsg'];
						
            }

            $data['content'] = "user/Msg";
		    $this->load->view('lay',$data);
	    }else{

	    	redirect('usercontroller/listuser', 'location');
	    }


// $data['content'] = "listuser";
// $this->load->view('lay',$data);
	    
	   }





		
	}

	public function add()
	   {

		   	$this->load->model('country_t');
			$this->load->model('question');
			$data['questions']=$this->question->get_questions();

			$this->load->helper(array('form'));
			$data['content'] ='user/adduser';
			$data['countries']=$this->country_t->get_countries();
			$this->load->view('lay',$data);

	   	
	   }

	public function adduser()
	{

	    $this->load->library('form_validation');
	    $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length[5]|max_length[12]|is_unique[user.user_name]');
	    $this->form_validation->set_rules('firstname', 'First name', 'trim|required|xss_clean|min_length[5]|max_length[12]');
	    $this->form_validation->set_rules('lastname', 'Last name', 'trim|required|xss_clean|min_length[5]|max_length[12]');
	    $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|is_unique[user.user_email]');
        $this->form_validation->set_rules('type', 'Type', 'trim|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[5]|max_length[12]|matches[passconf]');
	    $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|xss_clean');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|xss_clean|min_length[5]');
        $this->form_validation->set_rules('question', 'Question', 'trim|required|xss_clean');
        $this->form_validation->set_rules('answer', 'Answer', 'trim|required|xss_clean');

        $country=$this->input->post('country');
       // echo $country; exit();
        if ($country=='empty') {
        	$countryErrMsg='please choose your country';
        	# code...
        }
        if($this->form_validation->run() == FALSE || !empty($countryErrMsg)){

        	    $this->load->model('country_t');
			    $data['countries']=$this->country_t->get_countries();
			    $this->load->model('question');
			    $data['questions']=$this->question->get_questions();
                $this->load->helper(array('form'));
        	    $data['content'] = 'user/adduser';
        	    if(!empty($countryErrMsg)){
        	    	$data['countryErrMsg']=$countryErrMsg;
        	    }
		        $this->load->view('lay',$data);

        }else{
				$data['user_name']= $this->input->post('username');
				$data['user_first_name']= $this->input->post('firstname');
				$data['user_last_name']= $this->input->post('lastname');
				$data['user_email']= $this->input->post('email');
				$data['user_question']= $this->input->post('question');
				$data['user_answer']= $this->input->post('answer');
				$data['user_phone']=$this->input->post('code').' '.$this->input->post('mobile');
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

			    
					
				if($this->input->post('type')=='teacher'){

		   //          $access_key="NUh89jJp5jc=";
					// $secretAcessKey="X7Hxt9Fs383plSbsXWB3nQ==";

					$this->load->model('settingwiziq');
		            $d['result']=$this->settingwiziq->getSetting();

		            $access_key=$d['result'][0]->access_key;
		            $secretAcessKey=$d['result'][0]->secret_key;

					$webServiceUrl="http://class.api.wiziq.com/";
					$requestParameters["name"]= $this->input->post('username');
					$requestParameters["email"]= $this->input->post('email');
					$requestParameters["password"]= '12345678';
					$requestParameters["image"]= "image.png";
					$requestParameters["phone_number"]= $data['user_phone'];
					//$requestParameters["work_number"]="+2 01284064635";
					$requestParameters["about_the_teacher"]= "Online Facilitator and Teacher, British Columbia, Canada";
					$requestParameters["is_active"]=1;

					$obj = new addteacher($secretAcessKey,$access_key,$webServiceUrl,$requestParameters);
		           
					$result = $obj->return_result();

					
					if ($result['state']) {
                        $data['user_id']=$result['teacher_id'];
						$this->load->model('user');
			            $this->user->adduser($data);
			            $data['msg']= "Your Teacher Has created Successfully ";
				        $data['content'] = "user/Msg";
				        $this->load->view('lay',$data);
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
				      //   $this->email->message($message);
				      //   if($this->email->send()){
				      // 			//echo 'Email sent.';
				     	// }else{
				     	// 		//show_error($this->email->print_debugger());
				      //   }
				        $data['msg']= 'Your Teacher account was created Successfully , please tell him to check his mail to activate account';
						$data['content'] = "user/Msg";
				        $this->load->view('lay',$data);

					}else{

						$data['msg']= $result['errorMsg'];
						$data['content'] = "user/Msg";
				        $this->load->view('lay',$data);

				        //exit();

					}
		            
				} else{ 


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
			       //   $this->email->message($message);
			       //   if($this->email->send()){
			      	// 		echo 'Email sent.';
			     	 // }else{
			     		// 	show_error($this->email->print_debugger());
			       //   }


				    //redirect('coursecontroller/listcourses', 'location');

		    		//echo "Check you mail box to activate account";

				//echo "done";

				    $data['msg']= 'Your Teacher Account is Created Successfully please tell him to check his mail to activated his account';
				    $data['content'] = "user/Msg";
				    $this->load->view('lay',$data);

				}

		}  		


	}

	public function deleteuser(){

		$this->load->model('user');
		$id = $this->input->get('userid');
		$this->user->delete($id);

	}


	public function countrycode(){

		$this->load->model('country_t');
		$countryId=$this->input->get('country');
		$country=$this->country_t->get_country($countryId);
		echo json_encode($country);
	}


	public function forgetpasswordView(){


		    
		$this->load->helper(array('form'));
		$data['content'] ='user/forgetpasswordView';
		$this->load->view('lay',$data);


	}



	public function forgetpasswordGetQuestion(){

		$email=$this->input->get('email');
        $this->load->model('user');
        $user=$this->user->get_user_by_email($email);
        $questionId=$user[0]->user_question;
        $this->load->model('question');
        $question=$this->question->getQuestion($questionId);
        $data['question']=$question;
        $this->load->helper(array('form'));
		$data['content'] ='user/forgetpasswordViewQuestion';
		$this->load->view('lay',$data);


	}


	public function forgetpasswordCheckAnswer(){


		//echo $this->input->get('question'); exit();

		$this->load->library('form_validation');
	    $this->form_validation->set_rules('answer', 'Answer', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('question', 'Question', 'trim|required|xss_clean');

	    if($this->form_validation->run() == FALSE || !empty($countryErrMsg)){

    	    $data['question']=$this->input->post('question');
    	   // var_dump($this->input->post('question')); exit();
	        $this->load->helper(array('form'));
			$data['content'] ='user/forgetpasswordViewQuestion';
			$this->load->view('lay',$data);

        }else{

            
        	  $answer=$this->input->post('answer');

        	  $this->load->model('user');
              $checkAnswer=$this->user->checkAnswer($answer);



        	if (!empty($checkAnswer)) {
        		# code...

        		//echo "correct";
        		$data['user_id']=$checkAnswer[0]->user_id;
        		$data['content'] ='user/resetPassword';
				$this->load->view('lay',$data);

        	}else{

	        	
				$data['wrongAnswerMsg']='your answer is wrong !!!';

				$data['question']=$this->input->post('question');
	    	   // var_dump($this->input->post('question')); exit();
		        $this->load->helper(array('form'));
				$data['content'] ='user/forgetpasswordViewQuestion';
				$this->load->view('lay',$data);


        	}


        }


	    
	}

	public function resetPassword(){
        
        $data['user_id']=$this->input->post('id');
		$this->load->library('form_validation');
	    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[5]|max_length[12]|matches[passconf]');
	    $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|xss_clean');
        
        if($this->form_validation->run() == FALSE){

    	    $data['content'] ='user/resetPassword';
			$this->load->view('lay',$data);

        }else{


        	$data['user_password']= MD5($this->input->post('password'));
        	$this->load->model('user');
        	$this->user->update($data);

        	redirect('coursecontroller/listcourses', 'location');


        }

	}


	public function forgetPasswordBySendMailView(){

		$this->load->helper(array('form'));
		$data['content'] ='user/forgetpasswordViewuseEmail';
		$this->load->view('lay',$data);


	}

	public function forgetPasswordBySendMail(){



	     $this->load->model('user');
         $data['user_email']=$this->input->post('email');
		 $user=$this->user->get_user_by_email($data['user_email']); 
		 //var_dump($user); exit();
		 if(!empty($user)){
				 $this->load->model('user');

					 $user=$this->user->get_user_by_email($data['user_email']); 
					 $user_id= $user[0]->user_id;

					// var_dump($user); exit();
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
		 		     $message = "To Reset Your Password Follow link: localhost".base_url().'usercontroller/resetpassword?id='.$user[0]->user_id;


			         $this->load->library('email', $config);
			         $this->email->set_newline("\r\n");
			         $this->email->from('engy.elmoshrify@gmail.com'); 
			         $this->email->to($user[0]->user_email);
			         $this->email->subject('Reset Your Password');
			         $this->email->message($message);
			         if($this->email->send()){
			         	    $data['msg']='check you mail';
			      			$data['content'] ='user/Msg';
							$this->load->view('lay',$data);
			     	 }else{
			     			
			     			$data['wrongEmail']=show_error($this->email->print_debugger());
							$this->load->helper(array('form'));
						    $data['content'] ='user/forgetpasswordViewuseEmail';
					        $this->load->view('lay',$data);
			         }
		}else{


			$data['wrongEmail']='Your Email is Wrong , Please insert Your rigth Email';
			$this->load->helper(array('form'));
		    $data['content'] ='user/forgetpasswordViewuseEmail';
	        $this->load->view('lay',$data);

			
		}

	}


	public function extractCSV(){


		// $this->load->database();
		// $query = $this->db->get('user');

		$this->load->model('user');
		$users=$this->user->getAllUsersAsObject();
		 
		$this->load->helper('csv');
		query_to_csv($users, TRUE, 'AllUserInYourWebSite.csv');

		//redirect('usercontroller/listuser');


	}



	public function settingView(){


		$this->load->model('settingwiziq');
		$data['result']=$this->settingwiziq->getSetting();
//var_dump($data['result'][0]->secret_key); exit();

	    $this->load->helper(array('form'));
	    $data['content'] ='setting/settingupdate';
        $this->load->view('lay',$data);


	}

	public function updatesetting(){


	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('access_key', 'Access_key', 'trim|required|xss_clean');
	   $this->form_validation->set_rules('secret_key', 'Secret_key', 'trim|xss_clean\required');
	   
	 
	   if($this->form_validation->run() == FALSE )
	   {
	     
	   	$this->load->model('settingwiziq');
		$data['result']=$this->settingwiziq->getSetting();
	    $this->load->helper(array('form'));
	    $data['content'] ='setting/settingupdate';
        $this->load->view('lay',$data);
	   	    

	   }
	   else
	   {
	    
	   	$this->load->model('settingwiziq');

	    $data['access_key'] = $this->input->post('access_key');
	    $data['secret_key'] = $this->input->post('secret_key'); 

        $this->settingwiziq->update($data);

	    redirect('coursecontroller/listcourses', 'location');

	   }
	}


	
}
