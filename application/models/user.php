<?php
Class User extends CI_Model
{
 function login($email, $password)
 {
   
   $this -> db -> where('user_email', $email);
   $this -> db -> where('user_password', MD5($password));
   $this -> db -> limit(1);
   //$this -> db -> get('user');

   $query = $this -> db -> get('user');

   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }

 function update($data){
    
    $this->db->where('user_id',$data['user_id']);
    $this->db->update('user',$data);
 }

 function get_users(){

    $query=$this->db->get('user');
    return $query->result();

 }

 function get_user($id){

      $this->db->where('user_id',$id);
      $query=$this->db->get('user');
      return $query->result();

}

function get_user_by_email($email){

      $this->db->where('user_email',$email);
      $query=$this->db->get('user');
      return $query->result();

}

 function adduser($data){
  $this->db->insert('user',$data);

 }

 function delete($id){
    $this->db->where('user_id',$id);
    $this->db->delete('user');

 }


 function checkAnswer($answer){


      $this->db->where('user_answer',$answer);
      $query=$this->db->get('user');
      return $query->result();

 }


 function getAllUsersAsObject(){
   
     $query=$this->db->get('user');
     return $query ;


 }



}
?>