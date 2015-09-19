<?php


Class Question extends CI_Model {


	function get_questions(){

	    $query=$this->db->get('question');
	    return $query->result();

    }


    function getQuestion($id){

      $this->db->where('id',$id);
      $query=$this->db->get('question');
      return $query->result();

    }


}