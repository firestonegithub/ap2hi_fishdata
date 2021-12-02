<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Rbac_model extends CI_Model

{


	var $table_user = 'tb_user';

    var $primary_user = 'id_user';

    var $table_permission = 'tb_permissions';

    var $primary_permission = 'perm_id';

    var $table_role = 'tb_roles';

    var $table_role_permission = 'tb_role_perm';

    var $primary_role = 'role_id';


  public function __construct(){

        $this->load->database();

    }


  function getByIdUser($username){

        $sql = "select u.id_user, u.username, d.* ,  s.supplier_data, s.landing_data

                from tb_user as u

                left join tb_user_detail  as d on d.id_user=u.id_user

                left join tb_user_supplier as s on u.id_user = s.id_user

                where u.username='".$username."'

                and u.active = '1'";

        $run_query = $this->db->query($sql);

        return $run_query->result();  

    }


    function load_menu(){

        $query = $this->db->query("

            SELECT tb_menu.*,tb_permissions.perm_desc 

            FROM tb_menu

            LEFT JOIN tb_permissions ON tb_permissions.id_menu=tb_menu.id_menu

            GROUP BY tb_menu.id_menu , tb_permissions.perm_desc 

            ORDER BY tb_menu.weight ASC");

        $arrs = array();

        foreach($query->result_array() as $row){

                 $arrs[] = $row;
            

        }

        return $arrs;

    }


    function load_menu_v2($user_id){

        $query = $this->db->query("

            SELECT tb_menu.*, tb_permissions.perm_id ,  tb_permissions.perm_desc 

            FROM tb_menu

            LEFT JOIN tb_permissions ON tb_permissions.id_menu=tb_menu.id_menu

            GROUP BY tb_menu.id_menu ,tb_permissions.perm_id ,  tb_permissions.perm_desc 

            ORDER BY tb_menu.weight ASC");

        $arrs = array();

        foreach($query->result_array() as $row){

            if($row['perm_id'] != ""){
                
                if( $this->checkPermission($row['perm_id'] , $user_id ) ){
                     $arrs[] = $row;
                } 
            }
            else{
                $arrs[] = $row;
            }

        }
        
        return $arrs;

    }


    function checkPermission($perm_id  , $user_id){

        $query = $this->db->query("SELECT role_id FROM tb_user_role WHERE id_user = '".$user_id."'") ; 
        foreach($query->result_array() as $row){
            $role_id = $row['role_id']; 
        }
        //echo "SELECT * FROM tb_role_perm WHERE role_id = '".$role_id."' and perm_id = '".$perm_id."'"; 
        //echo "<br>"; 

        $get = ""; 

        $query = $this->db->query("SELECT * FROM tb_role_perm WHERE role_id = '".$role_id."' and perm_id = '".$perm_id."'"); 
         foreach($query->result_array() as $row1){
            $get = $row1['perm_id']; 

         }

         //echo $get; 
         //echo "<br>";

         if($get == ""){
             return FALSE ; 
         }else{
            return TRUE ; 
         }
       
    }


    function getRoleByIdUser($id_user){

        $sql = "SELECT t1.role_id , t2.role_name FROM tb_user_role as t1

                JOIN tb_roles as t2 ON t1.role_id = t2.role_id

                WHERE t1.id_user ='".$id_user."'";

        $run_query = $this->db->query($sql);

        return $run_query->result();

    }


     public function getRolePerms($role_id){

        $sql = "SELECT t2.perm_desc FROM tb_role_perm as t1

                JOIN tb_permissions as t2 ON t1.perm_id = t2.perm_id

                WHERE t1.role_id =  '".$role_id."'";

        $run_query = $this->db->query($sql);

        return $run_query->result();

    }


}



?>