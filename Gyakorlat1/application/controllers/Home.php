<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form'));
        $this->load->library(array('form_validation'));
        $this->load->model(array('usermodel'));
    }

    public function index(){
        //megnézzük, hogy a sessionben szerepel-e id
        // ha igen
        //$_SESSION['userid']
        if($this->session->userdata('userid')){
            $output             = array();
            $output['fullname'] = $this->session->userdata('fullname');
            $this->load->view('home', $output);
        }
        //ha nem
        else{
            $this->load->view('login');
        }
    }

    public function login(){
        //1.par <input name="emailaddress"
        $this->form_validation->set_rules('emailaddress','Felhasználó név','trim|required|valid_email');
        $this->form_validation->set_rules('password','Jelszó','trim|required');
        //nem sikerült, validáció sikertelen
        if ($this->form_validation->run() == FALSE){
            $this->load->view('login');
        }else{
            //itt username, password ellenőrzés szükséges
            $emailaddress   = $this->input->post('emailaddress');
            $password       = $this->input->post('password');
            
            $userdata = $this->usercheck($emailaddress, $password);
            if($userdata){
                $this->session->set_userdata('userid', $userdata['id']);
                $this->session->set_userdata('fullname', $userdata['lastname'].' '.$userdata['firstname']);
                redirect('home/index');
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
        if($userdata){
            if($userdata['password'] === hash('sha512',$password.$userdata['salt'])){
                return $userdata;
            }
        }
        return false;
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('home/index');
    }
}
