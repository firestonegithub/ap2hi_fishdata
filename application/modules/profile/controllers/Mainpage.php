<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Mainpage extends CI_Controller {



    public function __construct(){

        parent::__construct();



        $this->load->library('upload');

        $this->load->model('Model_profile');

    }



    public function index(){

        $this->auth->check_login();

        if(!$this->auth->hasPrivilege("ViewMyProfile")){

            redirect('home','refresh');

        }

        $user = $this->auth->get_data_session();

        $id_user = $user->id_user;

        $userData = $this->Model_profile->getUserDetail($id_user);

        $data['countryLists'] =  $this->Model_profile->countryLists();

        $data['userDetail'] = $userData->row() ;

        $data['url_updateForm'] = base_url()."profile/mainpage/updateUser"; ;


        $data['content']="profile/view";

        $this->load->view('template-admin/template',$data);

    }



    public function updateUser(){
         
         $this->auth->check_login();


         $this->form_validation->set_rules('email', 'Email Required', 'required');
         $this->form_validation->set_rules('username', 'Username Required', 'required');
         $this->form_validation->set_rules('name', 'Name Required', 'required');
        
         if ( $this->form_validation->run() ) {

                $updateUser = $this->Model_profile->updateUser();

                redirect(site_url('profile/mainpage'),'refresh');  
                    
         }else{

            redirect(site_url('profile/mainpage'),'refresh');  
         }


    }


}