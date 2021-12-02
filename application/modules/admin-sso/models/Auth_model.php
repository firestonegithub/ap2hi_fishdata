<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Auth_model extends CI_Model{

  
   function __construct(){

        parent::__construct();
       
       $this->load->library('admin-sso/Session');

        $this->load->library('admin-sso/User');

        $this->load->library('admin-sso/Role');

    }


    var $table = 'tb_user';

    var $table_roles = 'tb_roles';



    public function validate_session(){
  		$un_user = $this->session->userdata('user');
      
  		if($un_user!=false){

  			return true;

  		}
  		return false;
  
  }



  public function login($username,$password){

    if($this->check_password($username,$password)){


        $ipaddress=$_SERVER['REMOTE_ADDR'];

        $user_browser = $_SERVER['HTTP_USER_AGENT'];

        $password2 = md5($password);

        $login_string = md5($password2.$ipaddress.$user_browser);

        $user = $this->user->getByIdUser($username);

        $user->login_string=$login_string;

         $un_user = serialize($user);

         $this->session->set_userdata('user',$un_user);

         return 1;

    }
    else{

      return 0;

    }

  }

   public function check_password($username,$password){

        $password_new = md5($password);

        $query = $this->db->get_where($this->table, array('username' => $username, 'password' => $password_new, 'active' => '1' ), 1, 0);

        if ($query->num_rows() > 0){

            return TRUE;

        }

        else{

            return FALSE;

        }

    }


    public function logout(){

        $this->session->unset_userdata('user');

    }

    

    public function get_data_session(){

        $un_user = $this->session->userdata('user');

        $user = unserialize($un_user);

        return $user;

    }

    public function hasPrivilege($privilege){

        $un_user = $this->session->userdata('user');

        $user = unserialize($un_user);

        return $user->hasPrivilege($privilege);

    }

    public function get_id_user(){

        $un_user = $this->session->userdata('user');

        $user = unserialize($un_user);

        return $user->id_user;

    }






}