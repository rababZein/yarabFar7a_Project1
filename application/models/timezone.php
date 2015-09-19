<?php


Class Timezone extends CI_Model {
 //echo "string"; exit();

	function get_timezones(){
//echo "string"; exit();
	    $query=$this->db->get('zoneandcode');
	    return $query->result();

    }

     function get_timezone($code){

    	$this->db->where('code',$code);
	    $query=$this->db->get('zoneandcode');
	    return $query->result();

    }

}