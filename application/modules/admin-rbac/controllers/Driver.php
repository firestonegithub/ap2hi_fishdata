<?php

defined('BASEPATH') OR exit('No direct script access allowed');



/**

 * Created by PhpStorm.

 * User: Mystic

 * Date: 06/04/15

 * Time: 14:31

 */



class Driver extends CI_Controller {



    public function __construct(){

        parent::__construct();

        $this->load->library('rbac/session');

        $this->load->library('rbac/user');

        $this->load->library('rbac/role');

    }



    public function add_session(){

        $this->session->unset_userdata('user');

        $user = $this->user->getByIdUser('1008605002');

        //$user->login_string=$login_string;

        $un_user = serialize($user);

        $this->session->set_userdata('user',$un_user);

        var_dump($un_user);



    }



    public function session(){

        $un_user = $this->session->userdata('user');

        $user = unserialize($un_user);
        //$user = $un_user;

        echo "<pre>";

        var_dump($user);

    }



    public function check_permission($permission){

        var_dump($this->auth->hasPrivilege($permission));

    }





}

