<?php

class Usermodel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    public function insertUser(){
        
    }
    
    public function updateUser(){
        
    }
    
    public function deleteUser(){
        
    }
    
    public function getUsers(){
        
    }
    
    public function getUserById(){
        
    }
    
    public function getUserByUsername($username = ''){
        if(strlen($username) > 0 ){
            $this->db->select('id, username, password, salt');
            $this->db->from('user');
            $this->db->where('username', $username);
            $query = $this->db->get();
            if ($query->num_rows() == 1) {
                foreach ($query->result() as $row) {}
                $data = array(
                    'id'        => $row->id,
                    'username'  => $row->username,
                    'password'  => $row->password,
                    'salt'      => $row->salt
                );
                
            }
            
            
            return true;
        }
        return false;
    }
}
?>

