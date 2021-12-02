<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Authentication extends CI_Controller {



    public function __construct(){

        parent::__construct();

    }



    public function login(){

        if($this->auth->is_logged_in()){

            redirect(site_url('home'),'refresh');  

        }

        else{

            $this->load->view('login/login');

        }

    }

    public function login_process(){

        $username = $this->input->post('username');

        $password = $this->input->post('password');

        $redirect_url = $this->input->post('redirect_url');

        $result = $this->auth->login($username,$password);

         if($result==1){

            if ($redirect_url!='') {

                redirect($redirect_url,'refresh');

            }

            else{
                
                redirect(site_url('home/home2'),'refresh');   

            }

        }

        else {

            redirect(site_url('admin-authentication/login?redirect_url='.urlencode($redirect_url)), 'refresh');

        }

    }


     function logout(){

        $this->session->unset_userdata('user');

        redirect(site_url('admin-authentication/login'),'refresh');

    }

}