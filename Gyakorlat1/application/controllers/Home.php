<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
        function __construct() {
        parent::__construct();
            $this->load->helper(array('url', 'form'));
            $this->load->library(array('form_validation','session'));
            //$this->load->model(array('usermodel'));
        }
    
        public function index(){
            //megnézzük, hogy a sessionben szerepel-e id
            // ha igen
            //$_SESSION['userid']
            if($this->session->userdata('userid')){
                $this->load->view('home');
            }
            //ha nem
            else{
                $this->load->view('login');
            }
	}
        
        public function login(){
            //1.par <input name="username"
            $this->form_validation->set_rules('username','Felhasználó név','trim|required');
            $this->form_validation->set_rules('password','Jelszó','trim|required');
            //nem sikerült, validáció sikertelen
            if ($this->form_validation->run() == FALSE){
                $this->load->view('login');
            }else{
                //itt username, password ellenőrzés szükséges
                
                
                
            }
            


            //$this->passgen();
            
            
        }
        
        private function passgen(){
            
        }
        
        
}
