<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Role implements Serializable
{

    protected $permissions;

      public function __construct(){

        $this->CI =& get_instance();

        $this->CI->load->model('admin-rbac/rbac_model');

    }



    public function serialize(){

        return serialize(

            array(

                'permissions' => $this->permissions)

            );

    }

    

    public function unserialize($data){

        $data = unserialize($data);

        $this->permissions = $data['permissions'];

    }


    public function getRolePerms($role_id){

        $role = new Role();

        $results = $this->CI->rbac_model->getRolePerms($role_id);

        foreach($results as $result){

            $role->permissions[$result->perm_desc] = true;

        }

        return $role;

    }

    public function hasPerm($permission){

        return isset($this->permissions[$permission]);

    }


}





?>