<?php
Class User extends CI_Model
{
 function login($email, $password)
 {
   $this -> db -> select('user_id, user_name, user_password');
   $this -> db -> from('user');
   $this -> db -> where('user_email', $email);
   $this -> db -> where('user_password', MD5($password));
   $this -> db -> limit(1);

   $query = $this -> db -> get();

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
}
?>