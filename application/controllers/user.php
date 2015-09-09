<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_controller extends CI_Controller {


	public function listuser(){

		$this->load->model('user');
		$data['users']=$this->user->get_users();

		$this->load->view('user',$data);

	}

}