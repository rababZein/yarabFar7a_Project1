<?php


Class Settingwiziq extends CI_Model {


	function getSetting(){

	    $this->db->from('setting');
        $query = $this->db->get();
	    return $query->result();

    }


	function update($data){
	    
	    $this->db->update('setting',$data);
    }


}