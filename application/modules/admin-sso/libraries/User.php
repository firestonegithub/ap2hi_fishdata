<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User implements Serializable
{
    public $roles;
    public $id_user;
    public $username;
    public $login_string;
    public $arr_menu;
    public $photo_profile;
    public $name;
    public $role_active;
    public $list_supp ; 
    public $list_landing ; 

    public function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->model('admin-rbac/rbac_model');
    }


    public function serialize(){
        return serialize(
            array(
                'id_user' => $this->id_user,
                'roles' => $this->roles,
                'username' => $this->username,
                'login_string' => $this->login_string,
                'arr_menu' => $this->arr_menu,
                'photo' => $this->photo_profile,
                'name' => $this->name,
                'role_active' => $this->role_active,
                'list_supp' => $this->list_supp,
                'list_landing' => $this->list_landing,
                  )
                );
    }
    
    public function unserialize($data){
        $data=unserialize($data);
        $this->id_user = $data['id_user'];
        $this->roles = $data['roles'];
        $this->username = $data['username'];
        $this->login_string = $data['login_string'];
        $this->arr_menu = $data['arr_menu'];
        $this->photo_profile = $data['photo'];
        $this->name = $data['name'];
        $this->role_active = $data['role_active'];
        $this->list_supp = $data['list_supp'];
        $this->list_landing = $data['list_landing'];
    }


    public function getByIdUser($id_user){
        $result = $this->CI->rbac_model->getByIdUser($id_user);
        if(!empty($result)){
             $user = new User();
             $user->id_user = $result['0']->id_user;
             $user->username = $result['0']->username;
             $user->arr_menu = $this->CI->rbac_model->load_menu_v2($result['0']->id_user);
             $user->photo_profile = $result['0']->photo;
             $user->name = $result['0']->name;
             $user->initRoles();
             $user->role_active = key($user->roles);
             $user->list_supp = $this->processSupp($result['0']->supplier_data); 
             $user->list_landing = $this->processSupp($result['0']->landing_data); 
             return $user;
        }else {
            return false;
        }


    }


    public function processSupp($data){
        $generatedData = array();
        

        if($data){


            $data = str_replace('[', '',$data );

            $data = str_replace(']', '',$data );
            
            $data = str_replace('"', '',$data );

            $data = explode(',',$data) ; 

            $generatedData = $data ; 
        }

        return $generatedData ; 
    }


    /**
     * Fungsi untuk mendapatkan seluruh permission pada suatu user bedasarkan role_id yang didapat
     */
    protected function initRoles(){
        $this->roles = array();
        $results = $this->CI->rbac_model->getRoleByIdUser($this->id_user);
        foreach($results as $result){
            $rolexx = new Role;
            $this->roles[$result->role_name] = $rolexx->getRolePerms($result->role_id);
        }
    }


    public function hasPrevilege($perm){
        if(!is_null($this->roles)){
            foreach($this->roles as $role){
                if($role->hasPerm($perm)){
                    return true;
                }
            }
        }
        return false;
    }

    public function hasPrivilege($privilege){
        if(!is_null($this->roles)){
            if($this->roles[$this->role_active]->hasPerm($privilege)){
                return true;
          }
        }
        return false;
    }

    public function hasRole($role_name){
        return isset($this->roles[$role_name]);
    }

    public function getLoginString(){
        return $this->login_string;
    }

}

