<?php


Class Category extends CI_Model {

    function addcategory($data){

		
		  
		 $this->db->insert('category',$data);

    }


    function get_categories(){

	    $query=$this->db->get('category');
	    return $query->result();

    }

    function delete($id){
	    $this->db->where('cat_id',$id);
	    $this->db->delete('category');

    }

    function update($id,$name){
	    $data['cat_name']=$name;
	    
	    $this->db->where('cat_id',$id);
	    $this->db->update('category',$data);
    }

    function get_category($id){

    	$this->db->where('cat_id',$id);
	    $query=$this->db->get('category');
	    return $query->result();

    }

    function getByParent($parentId){

    	$this->db->where('cat_parent_id',$parentId);
	    $query=$this->db->get('category');
	    return $query->result();

    }



}


?>
