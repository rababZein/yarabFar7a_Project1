<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   $this->load->model('user','',TRUE);
 }

 function index()
 {
   //This method will have the credentials validation
   $this->load->library('form_validation');

   $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
   $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

   if($this->form_validation->run() == FALSE)
   {
     //Field validation failed.  User redirected to login page
     $this->load->view('user/login');
   }
   else
   {
     //Go to private area
     redirect('coursecontroller/listcourses', 'refresh');
   }

 }

 function check_database($password)
 {
   //Field validation succeeded.  Validate against database
   $email = $this->input->post('email');

   //query the database
   $result = $this->user->login($email, $password);
   if($result)
   {
         if($result[0]->user_active==1){
             $sess_array = array();
             foreach($result as $row)
             {
               $sess_array = array(
                 'id' => $row->user_id,
                 'username' => $row->user_name,
                 'type'=>$row->user_type,
                 'admin'=>$row->user_admin,
                 'active'=>$row->user_active
               );
               $this->session->set_userdata('logged_in', $sess_array);
             }
             return TRUE;
         }else{

             $this->form_validation->set_message('check_database', 'Activate your account first');
             return false;

         }
   }
   else
   {
     $this->form_validation->set_message('check_database', 'Invalid username or password');
     return false;
   }
 }

 
}
?>