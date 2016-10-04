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
    
    public function getUserByUsername($emailaddress = ''){
        if(strlen($emailaddress) > 0 ){
            $this->db->select('id, emailaddress, password, salt, templogin, temppassword, tempsalt');
            $this->db->from('user');
            $this->db->where('username', $emailaddress);
            $query = $this->db->get();
            if ($query->num_rows() == 1) {
                foreach ($query->result() as $row) {}
                $data = array(
                    'id'            => $row->id,
                    'emailaddress'  => $row->username,
                    'password'      => $row->password,
                    'salt'          => $row->salt,
                    'templogin'     => $row->templogin,
                    'temppassword'  => $row->temppassword,
                    'tempsalt'      => $row->tempsalt
                );
                
            }
            return true;
        }
        return false;
    }
}
?>

