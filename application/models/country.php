<?php


Class Country extends CI_Model {


	function get_countries(){

	    $query=$this->db->get('country');
	    return $query->result();

    }

     function get_country($id){

    	$this->db->where('country_id',$id);
	    $query=$this->db->get('country');
	    return $query->result();

    }

    function getCountryByCode($code){

    	$this->db->where('country_code',$id);
	    $query=$this->db->get('country');
	    return $query->result();

    }

}