<?php

class Model_users extends CI_Model{

	function __construct(){

		parent::__construct();

			date_default_timezone_set('Asia/Jakarta');
		
	}


	public function get_all_users_active(){



		$query = $this->db->query("SELECT  
					  tb_user.id_user ,
					  tb_user_detail.name ,
					  username ,
					  password ,
					  address ,
					  current_address ,
					  photo ,
					  no_telp ,
					  no_hp ,
					  nationality ,
					  email ,
					  active 
					  FROM tb_user , tb_user_detail where tb_user.id_user = tb_user_detail.id_user and active = '1' order by  tb_user.id_user
			");
		
		return $query;


	}


	public function getRoles($id_user){


		$query = $this->db->query("SELECT tb_roles.role_id , role_name
									  FROM tb_user_role , tb_roles 
									where tb_user_role.role_id  = tb_roles.role_id
									and tb_user_role.id_user = '".$id_user."'
									  ");

		return $query;
	}



    public function countryLists(){

        $query = $this->db->query("Select * from static_country order by country_name");

        return $query;
    }

    public function roleLists(){

        $query = $this->db->query("Select role_id , role_name, role_desc from tb_roles where status=1 order by role_id");

        return $query;
    }

    public function suppLists(){

    	$query = $this->db->query(" Select id_supplier , nama_perusahaan from master_supplier order by id_supplier ");

        return $query;
    }

    public function landingLists(){

    	$query = $this->db->query(" Select id_landing , nama_landing from master_landing order by id_landing ");

        return $query;
    }


    public function checkIfUsernameExsist($username , $id_user=""){

    	$addition="";
    	if($id_user!=""){
    		$addition = " and id_user NOT in ('".$id_user."')" ; 
    	}

    	$query = $this->db->query(" Select id_user from tb_user where username = '".$username."' ".$addition." and active = '1' ");


    		if ( $query->num_rows() > 0 )
			{
			    return FALSE;
			}
			else
			{
			    return TRUE;
			}

    }


    public function add_user($data=array()){


    	if ($data)
        {

        	if( $this->checkIfUsernameExsist($_POST['username']) ) {
		    
        	$user = $this->auth->get_data_session();
        	$id_user_create = $user->id_user;
        	$create_date = date('Y-m-d h:i:s');
        	


        	$this->db->select_max('id_user');
        	$query  = $this->db->get('tb_user');
        	$maxId = $query->row_array(); 
        	$id_user = $maxId["id_user"] + 1;

        	


        	$sql = "INSERT INTO tb_user(
            		id_user, name, username, password, active, created_by, created_date)
			    	VALUES ('".$id_user."' , '".$_POST['name']."', '".$_POST['username']."', '".md5($_POST['password'])."', '1', '".$id_user_create."', '".$create_date."' );"; 
			$this->db->query($sql);


        	$sql = "INSERT INTO tb_user_detail(
				            id_user, name, address, 
				            no_telp, no_hp, nationality, email)
				    VALUES ('".$id_user."', '".$_POST['name']."', '".$_POST['address']."', '".$_POST['telp']."', '".$_POST['mobile']."', '".$_POST['nationality']."',  '".$_POST['email']."' ); "; 
			$this->db->query($sql);
			

			$sql = "INSERT INTO tb_user_role(
					            id_user, role_id)
					    VALUES ('".$id_user."', '".$_POST['role']."');"; 
			$this->db->query($sql);

			
			if($_POST['role'] == 3 || $_POST['role'] == 4  ){
			 	$supp_data="";
			 	$landing_data="";
			 	if(isset($_POST['supp_id'])){
		            $supp_data = json_encode($_POST['supp_id']);
		         }
		         if(isset($_POST['landing_id'])){
		            $landing_data = json_encode($_POST['landing_id']);
		         }

		         $sql = "DELETE FROM tb_user_supplier
								   
								 WHERE id_user = '".$id_user."'
								";
					    	$this->db->query($sql);

				if($supp_data !="" | $landing_data != ""){	    	

		            $sql = "INSERT INTO tb_user_supplier (id_user,supplier_data,landing_data)
								   VALUES ( '".$id_user ."' , '".$supp_data."', '".$landing_data."' )
								";
					    	$this->db->query($sql);
					}
		        }


		        

			return TRUE;
			
        }


    } 


        return FALSE;


    }


    public function edit_user($data=array()){

    	$now = date('Y-m-d h:i:s'); 

    		if ($data)
        {

        	if( $this->checkIfUsernameExsist($_POST['edit_username'] , $_POST['edit_id_user'] ) ) { 



        	$user = $this->auth->get_data_session();
        	$id_user_change = $user->id_user;

        	/*
        	echo $_POST['edit_id_user'] ; 
        	echo $_POST['edit_username'] ;
        	echo $_POST['edit_email'] ;
			echo $_POST['edit_name'] ;
			echo $_POST['edit_password'] ;
			echo $_POST['edit_address'] ;
			echo $_POST['edit_telp'] ;
			echo $_POST['edit_mobile'] ;
			echo $_POST['edit_nationality'] ;
			echo $_POST['edit_role'] ;
			 var_dump( $_POST['edit_supp_id'] );
			*/

			 $pass = "" ; 
			 if($_POST['edit_password'] != '' ){

			 	$pass = "password = '".md5($_POST['edit_password'])."' , " ; 

			 }

			 $sql = "UPDATE tb_user
					   SET name= '".$_POST['edit_name']."', username= '".$_POST['edit_username']."' , ".$pass." changed_by='".$id_user_change."', 
					       changed_date='".$now."'
					 WHERE id_user = '".$_POST['edit_id_user'] ."' "; 
			$this->db->query($sql);


        	$sql = "UPDATE tb_user_detail
						   SET name= '".$_POST['edit_name']."', address='".$_POST['edit_address']."', 
						       no_telp='".$_POST['edit_telp']."', no_hp='".$_POST['edit_mobile']."', nationality='".$_POST['edit_nationality']."', email='".$_POST['edit_email'] ."'
						  WHERE id_user = '".$_POST['edit_id_user'] ."' ;
						"; 
			$this->db->query($sql);


			$sql = "UPDATE tb_user_role
						   SET  role_id='".$_POST['edit_role']."'
						 WHERE id_user = '".$_POST['edit_id_user'] ."'"; 
			$this->db->query($sql);



			 if($_POST['edit_role'] == 3 || $_POST['edit_role'] == 4  ){
			 	$supp_data="";
			 	$landing_data="";
			 	if(isset($_POST['edit_supp_id'])){
		            $supp_data = json_encode($_POST['edit_supp_id']);
		         }
		         if(isset($_POST['edit_landing_id'])){
		            $landing_data = json_encode($_POST['edit_landing_id']);
		         }

		         $sql = "DELETE FROM tb_user_supplier
								   
								 WHERE id_user = '".$_POST['edit_id_user'] ."'
								";
					    	$this->db->query($sql);

				if($supp_data !="" | $landing_data != ""){	    	

		            $sql = "INSERT INTO tb_user_supplier (id_user,supplier_data,landing_data)
								   VALUES ( '".$_POST['edit_id_user'] ."' , '".$supp_data."', '".$landing_data."' )
								";
					    	$this->db->query($sql);
					}
		        }

        	return TRUE; 
        }

    }


        return FALSE; 

    }


    public function showEditUser($id){

    	$query = $this->db->query("Select u.id_user , u.name , u.username , u.password , u.active , d.address , d.current_address , d.no_telp , d.no_hp , d.nationality , d.email , r.role_id , s.supplier_data , s.landing_data from tb_user u 
										INNER JOIN 
										 	tb_user_detail d 
											ON 
											u.id_user = '".$id."' and u.id_user = d.id_user 
										INNER JOIN 
											tb_user_role r 
											ON
											u.id_user = r.id_user
										LEFT JOIN tb_user_supplier s 
											ON 
											d.id_user = s.id_user ");

		return $query;

    }



    public function disable_user($id){

    	if($id){

			$user = $this->auth->get_data_session();
        	$id_user = $user->id_user;
        	$changed_date = date('Y-m-d h:i:s');

			$sql = "UPDATE tb_user
					   SET active = '0' , 
					     changed_by='".$id_user."', changed_date='".$changed_date."'
					 WHERE id_user = '".$id."'"; 

			$this->db->query($sql);


			return TRUE;

		}

		return FALSE;

    }


    
    public function permLists(){
    
    $query = $this->db->query(' Select * from tb_permissions order by "group" ');

        return $query;
    
    }


    public function add_roles($data=array()){


    	if ($data)
        {

        	 
        	$user = $this->auth->get_data_session();
        	$id_user_create = $user->id_user;
        	$create_date = date('Y-m-d h:i:s');
        	

        	$sql = "INSERT INTO tb_roles(
            		role_name, role_desc, create_by, create_date, status)
			    	VALUES ( '".$_POST['role_name']."', '".$_POST['role_desc']."','".$id_user_create."', '".$create_date."' , 1 );"; 
			$this->db->query($sql);

			$getid_ = $this->db->insert_id() ; 

    

    		if(isset($data['perm'])){

			$this->db->query("DELETE from tb_role_perm where role_id ='".$getid_."'");

			foreach($data['perm'] as $row){

				$sql = "INSERT INTO tb_role_perm(
					            role_id, perm_id)
					    			VALUES ('".$getid_."', '".$row."');";
					    	$this->db->query($sql);

			}


			}



			return TRUE;
			
      


    } 


        return FALSE;


    }


    public function showEditRoles($id){

    	$query = $this->db->query("select * from tb_roles where role_id = '".$id."'");

		return $query;

    }

    public function showEditRolesPerm($id){

    	$query = $this->db->query("select perm_id from tb_role_perm where role_id = '".$id."'");

		return $query;

    }

    public function edit_roles($data=array()){

    	$now = date('Y-m-d h:i:s'); 

    		if ($data)
        {


        	$user = $this->auth->get_data_session();
        	$id_user_change = $user->id_user;

       
	
			 $sql = "UPDATE tb_roles
					   SET role_name= '".$_POST['edit_role_name']."', role_desc= '".$_POST['edit_role_desc']."' , change_by ='".$id_user_change."', 
					       change_dateby='".$now."'
					 WHERE role_id = '".$_POST['edit_id_role'] ."' "; 
			$this->db->query($sql);

			if(isset($data['edit_perm'])){

			$this->db->query("DELETE from tb_role_perm where role_id ='".$_POST['edit_id_role']."'");

				foreach($data['edit_perm'] as $row){

					$sql = "INSERT INTO tb_role_perm(
						            role_id, perm_id)
						    			VALUES ('".$_POST['edit_id_role']."', '".$row."');";
						    	$this->db->query($sql);

				}


			}


       
        	return TRUE; 
        
    	}

	}


    public function disable_roles($id){

    	if($id){

			$user = $this->auth->get_data_session();
        	$id_user = $user->id_user;
        	$changed_date = date('Y-m-d h:i:s');

			$sql = "UPDATE tb_roles
					   SET status = '0' , 
					     change_by='".$id_user."', change_dateby='".$changed_date."'
					 WHERE role_id = '".$id."'"; 

			$this->db->query($sql);


			return TRUE;

		}

		return FALSE;

    }


}