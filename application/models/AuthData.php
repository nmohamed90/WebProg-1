<?php

Class AuthData extends CI_Model {
    
    function setPasswordHash($password){
        return hash('SHA512','fwhDKaPHcxVi9ooQW2f3Hj3u0KHp0ndndxtmBtjn9WbCGyxFCA2UM5TKgXHFjeG' . $password);
    }
    
    function checkLogin($email,$password){
        $query = $this->db->query("select users_id from users where users_email ='" . $email ."' and users_password = '" . $this->setPasswordHash($password) . "';");
        $res = $query->result();
        return $res[0]->users_id;
        
    }
    
    function createUser($data){
        
        $users = array(
          'users_email' => $data['email'],
          'users_password' => $this->setPasswordHash($data['password']),
          'users_status' => 'A',
          'users_firstname' => $data['firstname'],
          'users_lastname' => $data['lastname']
        );
        $this->db->insert('users',$users);
    }
    
}

?>