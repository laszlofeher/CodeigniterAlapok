<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
        function __construct() {
            parent::__construct();
            $this->load->helper(array('url', 'form'));
            $this->load->library(array('form_validation','session'));
            $this->load->model(array('usermodel'));
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
            $this->form_validation->set_rules('emailaddress','Felhasználó név','trim|required|valid_email');
            $this->form_validation->set_rules('password','Jelszó','trim|required');
            //nem sikerült, validáció sikertelen
            if ($this->form_validation->run() == FALSE){
                $this->load->view('login');
            }else{
                //itt username, password ellenőrzés szükséges
                $emailaddress = $this->input->post('emailaddress');
                $password = $this->input->post('password');
                $id = $this->usercheck($emailaddress, $password);
                if($id){
                    $this->session->set_userdata('userid', $id);
                    $output= array();
                    $this->load->view('home', $output);
                }else{
                    redirect('home/index');
                }
                
                
            }
            //$this->passgen();
        }
        
        private function passgen(){
            
        }
        
        private function usercheck($emailaddress, $password){
            $userdata = $this->usermodel->getUserByEmailaddress($emailaddress);
            //var_dump($userdata);
            if($userdata['password'] === hash('sha512',$password.$userdata['salt'])){
                return $userdata['id'];
            }
            return false;
        }
}
