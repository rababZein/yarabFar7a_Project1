<?php


Class Country_t extends CI_Model {


	function get_countries(){

	    $query=$this->db->get('country_t');
	    return $query->result();

    }

     function get_country($id){

    	$this->db->where('country_id',$id);
	    $query=$this->db->get('country_t');
	    return $query->result();

    }

}