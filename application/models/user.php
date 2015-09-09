<?php
Class User extends CI_Model
{
 function login($username, $password)
 {
   $this -> db -> select('user_id, user_name, user_password');
   $this -> db -> from('user');
   $this -> db -> where('user_name', $username);
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

 function update($id,$name,$mobile,$address,$type){
    $data['user_name']=$name;
    //$data['user_password']=MD5($password);
    $data['user_type']=$type;
    $data['user_mobile']=$mobile;
    $data['user_address']=$address;
    $this->db->where('user_id',$id);
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


 function adduser($name,$password,$type,$email,$address){

  $data['user_name']=$name;
  $data['user_password']=MD5($password);
  $data['user_type']=$type;
  $data['user_email']=$email;
  $data['user_address']=$address;
  $this->db->insert('users',$data);

 }

 function delete($id){
    $this->db->where('user_id',$id);
    $this->db->delete('user');

 }
}
?>