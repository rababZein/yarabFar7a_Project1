<?php


Class Adv extends CI_Model {

    function get_adv(){

	    $query=$this->db->get('adv');
	    return $query->result();

    }

    function delete($id){
	    $this->db->where('adv_id',$id);
	    $this->db->delete('adv');

    }

    function update($data){
	    
	    $this->db->where('adv_id',$data['adv_id']);
	    $this->db->update('adv',$data);
    }

    function addadv($data){

		 $this->db->insert('adv',$data);

    }


}


?>
