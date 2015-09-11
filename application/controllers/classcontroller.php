<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Classcontroller extends CI_Controller {

	 public function addclass()
	{
		# code...
		$data['courseId']= $this->input->get('courseId');
		$data['topicId']= $this->input->get('topicId');

	    $this->load->view('class/addclass',$data);


	}
}