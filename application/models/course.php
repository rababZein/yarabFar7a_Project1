<?php


Class Course extends CI_Model {

    function getAllCourses(){

	    $query=$this->db->get('course');
	    return $query->result();

    }

    function getCourse($courseId){

    	$this->db->where('course_id',$courseId);
	    $query=$this->db->get('course');
	    return $query->result();
    }

    function delete($id){
	    $this->db->where('course_id',$id);
	    $this->db->delete('course');

    }

    function update($data){
	    
	    $this->db->where('course_id',$data['course_id']);
	    $this->db->update('course',$data);
    }

    function addcourse($data){

		 $this->db->insert('course',$data);

    }

     function getCourseByCategory($parentId){

    	$this->db->where('course_cat_id',$catId);
	    $query=$this->db->get('course');
	    return $query->result();

    }

    function getAllTeachers(){

    	$this->db->where('user_type','teacher');
	    $query=$this->db->get('user');
	    return $query->result();

    }

    function getTeacher($teacherId){

       $this->db->where('user_id',$teacherId);
       $query=$this->db->get('user');
	   return $query->result();
    }


    function listStudent(){

       $this->db->where('user_type','student');
       $query=$this->db->get('user');
       return $query->result();
    }

    function getStudent($studentId){

       $this->db->where('user_id',$studentId);
       $query=$this->db->get('user');
       return $query->result();

    }

    function getCoursesOfTeacher($teacherId){
       $this->db->where('course_teacher_id',$teacherId);
       $query=$this->db->get('course');
       return $query->result();
    }

}


?>