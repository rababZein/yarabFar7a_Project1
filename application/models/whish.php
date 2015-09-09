<?php


Class Whish extends CI_Model {

    function get_whish(){

	    $query=$this->db->get('whish');
	    return $query->result();

    }

    function delete($id){
	    $this->db->where('whish_id',$id);
	    $this->db->delete('whish');

    }

    function update($data){
	    
	    $this->db->where('whish_id',$data['whish_id']);
	    $this->db->update('whish',$data);
    }

    function addwhish($data){

		 $this->db->insert('whish',$data);

    }


}


?>
