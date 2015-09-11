<?php


Class Topic extends CI_Model {

	 function addtopic($data){

		 $this->db->insert('topic',$data);

    }

    function delete($id){
	    $this->db->where('topic_id',$id);
	    $this->db->delete('topic');

    }

    function update($data){
	    
	    $this->db->where('topic_id',$data['topic_id']);
	    $this->db->update('topic',$data);
    }

    function getAllTopics(){

	    $query=$this->db->get('topic');
	    return $query->result();

    }

    function getTopicByCourseId($courseId){

    	$this->db->where('topic_course_id',$courseId);
	    $query=$this->db->get('topic');
	    return $query->result();

    }



}