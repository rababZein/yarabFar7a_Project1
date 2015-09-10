<?php


Class Course extends CI_Model {

    function getAllCourses(){

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


}


?>