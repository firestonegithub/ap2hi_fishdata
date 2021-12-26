<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Auth{

 	var $CI = NULL;



    public function __construct(){

        $this->CI =& get_instance();

        $this->CI->load->model('admin-sso/auth_model');


    }


    public function is_logged_in(){

        return (bool) $this->CI->auth_model->validate_session();

    }

    

    public function check_login(){

        if(!$this->is_logged_in()){
            redirect("admin-authentication/login?redirect_url=".urlencode("http://{$_SERVER["SERVER_NAME"]}{$_SERVER["REQUEST_URI"]}"));

        }

    }


     public function restrict_ajax_login(){

        if(!$this->is_logged_in()){

            $response['submit']     = 403;

            $response['error'] = 'Your session has been expired, please login again';

            echo json_encode($response);

            exit();

        }

        return TRUE;

    }



    public function restrict_ajax_login_datatable(){

        if(!$this->is_logged_in()){

            $response = '{

                "iTotalRecords": 0,

                "iTotalDisplayRecords": 0,

                "aaData": [],

                "submit":403,

                "error":"Your session has been expired, please login again"

            }';

            echo $response;

            exit();

        }

        return TRUE;

    }

     public function login($username,$password){

        return $this->CI->auth_model->login($username,$password);

    }

    

    public function logout(){

        $this->CI->auth_model->logout();

        return true;

    }

    

    public function hasPrivilege($privilege){

        return $this->CI->auth_model->hasPrivilege($privilege);

    }



    public function hasRole($role){

        return $this->CI->auth_model->hasRole($role);

    }



    public function get_id_user(){

        return $this->CI->auth_model->get_id_user();

    }

    

    public function get_data_session(){

        return $this->CI->auth_model->get_data_session();

    }



}