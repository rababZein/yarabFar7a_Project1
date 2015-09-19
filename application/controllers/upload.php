<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{
		$this->load->model('user');
		$data['users']=$this->user->get_users();
        $this->load->helper(array('form', 'url'));
        $data['error']='';
		$data['content'] = "user/user";
		$this->load->view('lay',$data);
	}

	function do_upload()
	{
		$config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'text/plain|text/anytext|csv|text/x-comma-separated-values|text/comma-separated-values|application/octet-stream|application/vnd.ms-excel|application/x-csv|text/x-csv|text/csv|application/csv|application/excel|application/vnd.msexcel';		$config['max_size']	= '1024';
		

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$this->load->model('user');
			$data['users']=$this->user->get_users();
	        $this->load->helper(array('form', 'url'));
	        $data['error']= $this->upload->display_errors();
			$data['content'] = "user/user";
			$this->load->view('lay',$data);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			$this->load->library('csvreader');
	        $result =   $this->csvreader->parse_file('./uploads/'.$data['upload_data']['client_name'] );//path to csv file
			//var_dump($result);

			foreach ($result as $row) {
				# code...
				$this->load->model('user');
				$this->user->adduser($row);
			}

				//$this->load->view('upload_success', $data);
			   $data['content'] = "upload_success";
		       $this->load->view('lay',$data);
		}
	}
}
?>