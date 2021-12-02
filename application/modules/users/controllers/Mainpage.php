<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Mainpage extends CI_Controller {



    public function __construct(){

        parent::__construct();

        $this->load->Model('Model_users');


    }



    public function index(){

        $this->auth->check_login();

        if(!$this->auth->hasPrivilege("ViewUser")){

            redirect('home','refresh');

        }

        $user = $this->auth->get_data_session();

        $data['url_list_users']=base_url()."users/mainpage/listUsers";

        $data['url_add_user']=base_url()."users/mainpage/addUser";

        $data['urlShowEditUser']=base_url()."users/mainpage/showEditUser";

        $data['url_edit_user']=base_url()."users/mainpage/editUser";

        $data['url_disable_user']=base_url()."users/mainpage/disable_user";

        $data['countryLists'] = $this->Model_users->countryLists();

        $data['roleLists'] = $this->Model_users->roleLists();

        $data['suppLists'] = $this->Model_users->suppLists();

        $data['landingLists'] = $this->Model_users->landingLists();

        $data['content']="users/view";

        $this->load->view('template-admin/template',$data);

    }


    public function listUsers(){


         $this->auth->restrict_ajax_login_datatable();


         $query = $this->Model_users->get_all_users_active();

         $result = array();

         $no = 0;
        
        foreach($query->result() as $row){

                $no++;
        
                $userRole = $this->Model_users->getRoles($row->id_user);

                $role = "";

                foreach($userRole->result() as $res){

                    $role .= $res->role_name.','; 

                }

                $role = substr($role , 0 , -1);


                  $action = '<a type="button" class="btn btn-primary a-btn-slide-text" data-toggle="modal" data-target="#editUserModal" onclick="editData('.$row->id_user.')">
                                <span class="fa fa-plug" aria-hidden="true"></span>
                                <span><strong>Edit</strong></span>            
                            </a>
                             <a type="button" data-toggle="modal" data-target="#disableUserModal" onclick="disableData('.$row->id_user.')" class="btn btn-danger a-btn-slide-text">
                               <span class="fa fa-times" aria-hidden="true"></span>
                                <span><strong>Disable</strong></span>            
                            </a>
                            ' ; 

                $result['data'][]=array(



                        $no , 
                        $row->username , 
                        $role ,  
                        $action
                
                
                ); 

        }


         echo json_encode($result);


    }


    public function addUser(){


         //form validation 
        $this->form_validation->set_rules('username', 'UserName', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('telp', 'Telp', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required');

      
        if ( $this->form_validation->run() ) {
            
            //Insert to Database 
             $saved = $this->Model_users->add_user($this->input->post());

            if ($saved)
            {
                 $success = true;
                 $messages =  "Successfully adding Data! ";
            }
            else
            {
                 $success = false;
                 $messages =  "Insert not working ! ";
            }

            
        }else{

            $success = false;
            $messages = 'Trouble adding Data!';
            
        }

            $validator['success'] = $success;
            $validator['messages'] = $messages;
        

        echo json_encode($validator);


    }


    public function showEditUser(){


        $response = array();

        $id = $_POST['id'];

        $results = $this->Model_users->showEditUser($id);

        $response = array(
                'success' => true, 
                'messages' => $results->result_array()
            ); 

        echo json_encode($response);

    }


    public function editUser(){

        $this->form_validation->set_rules('edit_username', 'UserName', 'required');
        $this->form_validation->set_rules('edit_email', 'Password', 'required');
       

        if ( $this->form_validation->run()  ) {
            
            //Insert to Database 
             $saved = $this->Model_users->edit_user($this->input->post());

            if ($saved)
            {
                 $success = true;
                 $messages =  "Successfully adding Data! ";
            }
            else
            {
                 $success = false;
                 $messages =  "Update not working ! ";
            }

            
        }else{

            $success = false;
            $messages = 'Trouble adding Data!';
            
        }

            $validator['success'] = $success;
            $validator['messages'] = $messages;
        

        echo json_encode($validator);


    }

    public function disable_user(){

          $saved = $this->Model_users->disable_user($_POST['id']);

            if ($saved)
            {
                 $success = true;
                 $messages =  "Successfully disable Data! ";
            }
            else
            {
                 $success = false;
                 $messages =  "disable not working ! ";
            }
        
        $validator['success'] = $success;
        $validator['messages'] = $messages;

        echo json_encode($validator);

    }


    public function roleeditor(){


        $this->auth->check_login();

        if(!$this->auth->hasPrivilege("ViewRoles")){

            redirect('home','refresh');

        }

        $user = $this->auth->get_data_session();

        $data['url_list_roles']=base_url()."users/mainpage/listRoles";

        $data['url_add_roles']=base_url()."users/mainpage/addRoles";

        $data['urlShowEditroles']=base_url()."users/mainpage/showEditRoles";

        $data['url_edit_roles']=base_url()."users/mainpage/editRoles";

        $data['url_disable_roles']=base_url()."users/mainpage/disable_roles";

        $data['roleLists'] = $this->Model_users->permLists();


        $data['content']="users/roles";

        $this->load->view('template-admin/template',$data);



    }


     public function listRoles(){


         $this->auth->restrict_ajax_login_datatable();


         $query = $this->Model_users->roleLists();

         $result = array();

         $no = 0;
        
        foreach($query->result() as $row){

                $no++;
        
               
               
                  $action = '<a type="button" class="btn btn-primary a-btn-slide-text" data-toggle="modal" data-target="#editRoleModal" onclick="editData('.$row->role_id.')">
                                <span class="fa fa-plug" aria-hidden="true"></span>
                                <span><strong>Edit</strong></span>            
                            </a>
                             <a type="button" data-toggle="modal" data-target="#disableRoleModal" onclick="disableData('.$row->role_id.')" class="btn btn-danger a-btn-slide-text">
                               <span class="fa fa-times" aria-hidden="true"></span>
                                <span><strong>Disable</strong></span>            
                            </a>
                            ' ; 

                $result['data'][]=array(



                        $no , 
                        $row->role_name , 
                        $row->role_desc ,  
                        $action
                
                
                ); 

        }


         echo json_encode($result);


    }


    public function addRoles(){


         //form validation 
        $this->form_validation->set_rules('role_name', 'role_name', 'required');
        $this->form_validation->set_rules('role_desc', 'role_desc', 'required');

      
        if ( $this->form_validation->run() ) {
            
            //Insert to Database 
             $saved = $this->Model_users->add_roles($this->input->post());

            if ($saved)
            {
                 $success = true;
                 $messages =  "Successfully adding Data! ";
            }
            else
            {
                 $success = false;
                 $messages =  "Insert not working ! ";
            }

            
        }else{

            $success = false;
            $messages = 'Trouble adding Data!';
            
        }

            $validator['success'] = $success;
            $validator['messages'] = $messages;
        

        echo json_encode($validator);


    }


    public function showEditRoles(){


        $response = array();

        $id = $_POST['id'];

        $results = $this->Model_users->showEditRoles($id);

        $resultsPerms = $this->Model_users->showEditRolesPerm($id);

        //echo json_encode($resultsPerms->result_array());

        $response = array(
                'success' => true, 
                'messages' => $results->result_array(),
                'permissons' => $resultsPerms->result_array()
            ); 

        echo json_encode($response);

    }


    public function editRoles(){

        $this->form_validation->set_rules('edit_role_name', 'role_name', 'required');
        $this->form_validation->set_rules('edit_role_desc', 'edit_role_desc', 'required');
       

        if ( $this->form_validation->run()  ) {
            
            //Insert to Database 
             $saved = $this->Model_users->edit_roles($this->input->post());

            if ($saved)
            {
                 $success = true;
                 $messages =  "Successfully adding Data! ";
            }
            else
            {
                 $success = false;
                 $messages =  "Update not working ! ";
            }

            
        }else{

            $success = false;
            $messages = 'Trouble adding Data!';
            
        }

            $validator['success'] = $success;
            $validator['messages'] = $messages;
        

        echo json_encode($validator);


    }



    public function disable_roles(){

          $saved = $this->Model_users->disable_roles($_POST['id']);

            if ($saved)
            {
                 $success = true;
                 $messages =  "Successfully disable Data! ";
            }
            else
            {
                 $success = false;
                 $messages =  "disable not working ! ";
            }
        
        $validator['success'] = $success;
        $validator['messages'] = $messages;

        echo json_encode($validator);

    }



}