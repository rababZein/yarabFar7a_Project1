<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coursecontroller extends CI_Controller {


	function __construct(){
	    parent::__construct();
	    if ( ! $this->session->userdata('logged_in'))
	    { 
	        // Allow some methods?
	        $allowed = array();
	        if ( ! in_array($this->router->fetch_method(), $allowed))
	        {
	            redirect('login');
	        }
	    }
	}

    public function addcourse(){

		$this->load->model('category');		
		$data['parentCategories']=$this->category->getByParent(0);

		
        $this->load->helper(array('form'));
		$data['content'] = "course/addcourse";
		$this->load->view('lay',$data);

	}




	public function getCatChild(){


        $categoryId = $this->input->get('catSelected');
		$this->load->model('category');
		$childCategories=$this->category->getByParent($categoryId);

	    $this->load->model('course');
	    $this->course->getAllTeachers();
		if (count($childCategories)){
				echo json_encode($childCategories);
	    }


	}

	 public	function storecourse(){

       $this->load->library('form_validation');
	   $this->form_validation->set_rules('course_title', 'Course_title', 'trim|required|xss_clean');
	   $this->form_validation->set_rules('course_start_time', 'Course_start_time', 'trim|xss_clean');
       $this->form_validation->set_rules('course_end_time', 'Course_end_time', 'trim|required|xss_clean');

	   if($this->form_validation->run() == FALSE){


	   	$this->load->model('category');

		$data['parentCategories']=$this->category->getByParent(0);

        $this->load->helper(array('form'));

		//$this->load->view('course/addcourse',$data);
		$data['content'] = "course/addcourse";
		$this->load->view('lay',$data);

        
       }else{

       		

        	$data['course_cat_id'] = $this->input->post('category');

	        $data['course_teacher_id'] = '1';

			
			$data['course_title'] = $this->input->post('course_title');

	        $data['course_desc'] = $this->input->post('course_desc'); 

	        $data['course_start_time'] = $this->input->post('course_start_time');

	        $data['course_end_time'] = $this->input->post('course_end_time'); 

	        $data['course_time_zone'] = $this->input->post('course_time_zone'); 
	        //var_dump($data); 

			$this->load->model('course');
			$this->course->addcourse($data);

		    redirect('coursecontroller/listcourses', 'location');


      }


	}

	public function listcourses(){

		$session_data = $this->session->userdata('logged_in');

		$this->load->model('course');
		if($session_data['type']=='admin' || $session_data['type']=='super admin'){
			$data['courses']=$this->course->getAllCourses();
			//var_dump($data['courses'][1]->course_title); exit();
	    }elseif ($session_data['type']=='teacher') {
	    	# code...

	    	$data['courses']=$this->course->getCoursesOfTeacher($session_data['id']);
	    

	    }else {
	    	# code...
           // echo "string"; exit();
	    	$this->load->model('coursestudent');
	    	//echo $session_data['id']; exit();
            $coursesID=$this->coursestudent->getcourses($session_data['id']);
            //var_dump($coursesID); exit();
            $this->load->model('course');
            foreach ($coursesID as $courseId) {

            		$data['courses']=$this->course->getCourse($courseId->coursestudent_course_id);

            }

	    }
        $this->load->model('category');
        $i=0;
        if(!empty($data['courses'])){
		       foreach ($data['courses'] as $row) {
		       	   
		       	   $category=$this->category->get_category($row->course_cat_id);
		           $data['category'][$i]=$category[0];
		           $i++;

		       }
		       $this->load->model('course');
		       $i=0;
		       foreach ($data['courses'] as $row) {
		       	   
		       	   $teacher=$this->course->getTeacher($row->course_teacher_id);
		           $data['teacher'][$i]=$teacher[0];
		           $i++;

		       }
		 //var_dump()
       } 
       $data['content'] = "course/listcourses";
	   $this->load->view('lay',$data);
        

		//$this->load->view('course/listcourses',$data);

	}

    public function deletecourse(){

		$this->load->model('course');
		$id = $this->input->get('courseId');
		$this->course->delete($id);

	}

	public function edit(){


        $data['id'] = $this->input->get('id');
        $data = $this->db->get_where(
	        'course',
	        array(
	        'course_id' => $data['id']
	        )
        );
		$data = $data->result_array();

	    $data['result'] = $data[0];

        $this->load->model('category');

       // get all parent category 
        $data['parentCategories']=$this->category->getByParent(0);

       //get category of course .
        $data['catSelected']=$this->category->get_category($data['result']['course_cat_id']);

        //get parent category of course .
        $data['ParentCatSelected']=$this->category->get_category($data['catSelected'][0]->cat_parent_id);

       //get all category of parent of course
        $data['parentCategories']=$this->category->getByParent(0);


        $data['childCategories']=$this->category->getByParent($data['catSelected'][0]->cat_parent_id);



        $this->load->model('category');
        $category=$this->category->get_category($data['result']['course_cat_id']);
        $data['category']=$category[0];
        //var_dump($data['category']); exit();

        // get teacher info of course 
        $this->load->model('course');
        $data['teacher']=$this->course->getTeacher($data['result']['course_teacher_id']);

      //  var_dump($teacher); exit();


		$this->load->helper(array('form'));
		//$this->load->view('course/updatecourse',$data);
		$data['content'] = "course/updatecourse";
	   $this->load->view('lay',$data);
	}


    public function updatecourse(){

	   $id=$this->input->post('id');
	   $this->load->library('form_validation');
	   $this->form_validation->set_rules('course_title', 'Course_title', 'trim|required|xss_clean');
	   $this->form_validation->set_rules('course_start_time', 'Course_start_time', 'trim|xss_clean');
       $this->form_validation->set_rules('course_end_time', 'Course_end_time', 'trim|required|xss_clean');

	 
	   if($this->form_validation->run() == FALSE )
	   {
	     

	   	    $data = $this->db->get_where(
								        'course',array('course_id' => $id)
	                                   );
			$data = $data->result_array();

		    $data['result'] = $data[0];


		    $this->load->model('category');

            // get all parent category 
            $data['parentCategories']=$this->category->getByParent(0);

            //get category of adv .
            $data['catSelected']=$this->category->get_category($data['result']['course_cat_id']);

            //get parent category of adv .
            $data['ParentCatSelected']=$this->category->get_category($data['catSelected'][0]->cat_parent_id);

            //get all category of parent of adv
            $data['parentCategories']=$this->category->getByParent(0);


            $data['childCategories']=$this->category->getByParent($data['catSelected'][0]->cat_parent_id);


             // get teacher info of course 
        	$this->load->model('course');
        	$data['teacher']=$this->course->getTeacher($data['result']['course_teacher_id']);

            
			$this->load->helper(array('form'));

			//$this->load->view('course/updatecourse',$data);
			$data['content'] = "course/updatecourse";
	   		$this->load->view('lay',$data);


	   }
	   else
	   {
	    
	   	$this->load->model('course');
	


	    $data['course_cat_id'] = $this->input->post('category');

        $data['course_teacher_id'] = '1';

		
		$data['course_title'] = $this->input->post('course_title');

        $data['course_desc'] = $this->input->post('course_desc'); 

        $data['course_start_time'] = $this->input->post('course_start_time');

        $data['course_end_time'] = $this->input->post('course_end_time'); 

        $data['course_time_zone'] = $this->input->post('course_time_zone'); 
        //var_dump($data); 

		$data['course_id']=$this->input->post('id');
        $this->course->update($data);

	    redirect('coursecontroller/listcourses', 'location');

	   }





		
	}

	public function showcourse(){

        $courseId = $this->input->get('id');
		$this->load->model('course');
		$data['course']=$this->course->getCourse($courseId);
		$data['teacher']=$this->course->getTeacher($data['course'][0]->course_teacher_id);
		$this->load->model('category');
		$data['category']=$this->category->get_category($data['course'][0]->course_cat_id);
		$data['parent']=$this->category->get_category($data['category'][0]->cat_parent_id);

		$this->load->model('topic');
		$data['topics']=$this->topic->getTopicByCourseId($data['course'][0]->course_id);      


		//$this->load->view('course/showcourse',$data);
		$data['content'] = "course/showcourse";
	   $this->load->view('lay',$data);

	}


	public function listStudent(){

		$data['courseId'] = $this->input->get('courseId');
		$this->load->model('course');
		$data['students']=$this->course->listStudent();

		//$this->load->view('course/liststudent',$data);
		$data['content'] = "course/liststudent";
	    $this->load->view('lay',$data);
	}

	public function inviteAll(){

		$courseId = $this->input->get('courseId');
		$this->load->model('course');
		$course=$this->course->getCourse($courseId);
		$students=$this->course->listStudent();
		$teacher=$this->course->getTeacher($course[0]->course_teacher_id);

		$config = Array(		
				    'protocol' => 'smtp',
				    'smtp_host' => 'ssl://smtp.googlemail.com',
				    'smtp_port' => 465,
				    'smtp_user' => 'rababzein2012@gmail.com',
				    'smtp_pass' => 'vfhf2011',
				    'smtp_timeout' => '4',
				    'mailtype'  => 'text', 
				    'charset'   => 'iso-8859-1'
				  );

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");



		foreach ($students as $student) {
		 	# code...


			$this->email->from('rababzein2012@gmail.com', 'rababzein2012');
			$this->email->to($student->user_email);
			// $this->email->cc('rababelzen@yahoo.com');
			// $this->email->bcc('rababelzen@yahoo.com');

		    $this->email->subject('Invitation To Attend '.$course[0]->course_title);
			$this->email->message('Dear  '.$student->user_name.'  ,
You are Invite to attende this Course :

	 TiTle : '.$course[0]->course_title.'
	 Description : '.$course[0]->course_desc.'
	 Start time : '.$course[0]->course_start_time.'
	 Duration : '.$course[0]->course_end_time.'
	 Teacher : '.$teacher[0]->user_name.'
	 For contact with teacher : '.$teacher[0]->user_email.' 



Courses Team

<br>

Thanks');

			$this->email->send();

	    $D['coursestudent_course_id']=$course[0]->course_id;
		$D['coursestudent_student_id']=$student->user_id;
		$this->load->model('coursestudent');

		$S=$this->coursestudent->getStudent($student->user_id);

		if(empty($S[0]->coursestudent_student_id)){
				$this->coursestudent->addcoursestudent($D);
		}

		
		 }
//echo $S;
	}

	public function inviteStudent(){

		$courseId = $this->input->get('courseId');
		$studentId = $this->input->get('studentId');
		$this->load->model('course');
		$student=$this->course->getStudent($studentId);
		$course=$this->course->getCourse($courseId);
		$teacher=$this->course->getTeacher($course[0]->course_teacher_id);

		$config = Array(		
				    'protocol' => 'smtp',
				    'smtp_host' => 'ssl://smtp.googlemail.com',
				    'smtp_port' => 465,
				    'smtp_user' => 'rababzein2012@gmail.com',
				    'smtp_pass' => 'vfhf2011',
				    'smtp_timeout' => '4',
				    'mailtype'  => 'text', 
				    'charset'   => 'iso-8859-1'
				  );

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from('rababzein2012@gmail.com', 'rababzein2012');
		$this->email->to($student[0]->user_email);
		// $this->email->cc('rababelzen@yahoo.com');
		// $this->email->bcc('rababelzen@yahoo.com');

		$this->email->subject('Invitation To Attend '.$course[0]->course_title);
		$this->email->message('Dear  '.$student[0]->user_name.'  ,
You are Invite to attende this Course :

	 TiTle : '.$course[0]->course_title.'
	 Description : '.$course[0]->course_desc.'
	 Start time : '.$course[0]->course_start_time.'
	 Duration : '.$course[0]->course_end_time.'
	 Teacher : '.$teacher[0]->user_name.'
	 For contact with teacher : '.$teacher[0]->user_email.' 



Courses Team

<br>

Thanks');

		$this->email->send();

	//	echo $this->email->print_debugger();
		$D['coursestudent_course_id']=$course[0]->course_id;
		$D['coursestudent_student_id']=$student[0]->user_id;
		$this->load->model('coursestudent');

		
		$S=$this->coursestudent->getStudent($student[0]->user_id);

		if(empty($S[0]->coursestudent_student_id)){
				$this->coursestudent->addcoursestudent($D);
		}

	}

	public function outsideInvitationView(){
		$data['courseId'] = $this->input->get('courseId');
		//$this->load->view('course/outsideInvitationView',$data);
		$data['content'] = "course/outsideInvitationView";
		$this->load->view('lay',$data);
	}

    public function outsideInvitation(){

        $courseId = $this->input->get('courseId');
    	$emails=$this->input->get('emails');
        $studentEmails = explode(",", $emails);
        $this->load->model('course');
        $course=$this->course->getCourse($courseId);
        $teacher=$this->course->getTeacher($course[0]->course_teacher_id);
        
		$config = Array(		
				    'protocol' => 'smtp',
				    'smtp_host' => 'ssl://smtp.googlemail.com',
				    'smtp_port' => 465,
				    'smtp_user' => 'rababzein2012@gmail.com',
				    'smtp_pass' => 'vfhf2011',
				    'smtp_timeout' => '4',
				    'mailtype'  => 'text', 
				    'charset'   => 'iso-8859-1'
				  );

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");



		foreach ($studentEmails as $studentEmail) {
		 	# code...


			$this->email->from('rababzein2012@gmail.com', 'rababzein2012');
			$this->email->to($studentEmail);
			// $this->email->cc('rababelzen@yahoo.com');
			// $this->email->bcc('rababelzen@yahoo.com');

		    $this->email->subject('Invitation To Attend '.$course[0]->course_title);
			$this->email->message('Dear  Student  ,
You are Invite to attende this Course :

	 TiTle : '.$course[0]->course_title.'
	 Description : '.$course[0]->course_desc.'
	 Start time : '.$course[0]->course_start_time.'
	 Duration : '.$course[0]->course_end_time.'
	 Teacher : '.$teacher[0]->user_name.'
	 For contact with teacher : '.$teacher[0]->user_email.' 



Courses Team

<br>

Thanks');

			$this->email->send();
		 }
    }


    public function listUserInCourse(){

    	$courseId=$this->input->get('courseId');
    	//var_dump($courseId); exit();
    	$this->load->model('course');
    	$data['course']=$this->course->getCourse($courseId);
    	
    	$this->load->model('coursestudent');
    	$students=$this->coursestudent->getStudentInCourse($courseId);
    	//var_dump($students[0]->coursestudent_student_id); exit();
   // 	$students=array();
    	$i=0;
    	$this->load->model('user');
    	foreach ($students as $student) {
//var_dump($student); exit();
    		$students[$i]=$this->user->get_user($student->coursestudent_student_id);
    		$i++;


    		
    	}

    	$data['students']=$students;

    //	var_dump($data['students'][0]); exit();

    	$data['content'] = "course/liststudentincourse";
	    $this->load->view('lay',$data);

    	//return view()
    }


}

