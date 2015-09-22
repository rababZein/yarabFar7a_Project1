<?php


Class Coursestudent extends CI_Model {


	function addcoursestudent($data){

		
		  
		 $this->db->insert('coursestudent',$data);

    }

    function getStudent($studentId){

    	$this->db->where('coursestudent_student_id',$studentId);
	    $query=$this->db->get('coursestudent');
	    return $query->result();
    }

    function getcourses($studentId){

    	$this->db->where('coursestudent_student_id',$studentId);
	    $query=$this->db->get('coursestudent');
	    return $query->result();

    }

   function getStudentInCourse($courseId){

   	    $this->db->where('coursestudent_course_id',$courseId);
	    $query=$this->db->get('coursestudent');
	    return $query->result();

    }

    

}
