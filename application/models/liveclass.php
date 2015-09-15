<?php


Class Liveclass extends CI_Model {

	function addclass($data){
  
		 $this->db->insert('class',$data);

    }

    function delete($id){

	    $this->db->where('class_id',$id);
	    $this->db->delete('class');

    }

    function update($data){
	  	    
	    $this->db->where('class_id',$data['class_id']);
	    $this->db->update('class',$data);
    }

    function getAllClasses(){

	    $query=$this->db->get('class');
	    return $query->result();

    }

    function getClass($id){

    	$this->db->where('class_id',$id);
	    $query=$this->db->get('class');
	    return $query->result();

    }

     function getTopicByTopicId($topicId){

    	$this->db->where('class_topic_id',$topicId);
	    $query=$this->db->get('class');
	    return $query->result();

    }

}