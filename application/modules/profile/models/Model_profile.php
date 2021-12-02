<?php

class Model_profile extends CI_Model{

	function __construct(){

		parent::__construct();

			date_default_timezone_set('Asia/Jakarta');
		
	}


	public function countryLists(){


		$query = $this->db->query("Select * from static_country order by country_name");

		return $query;


	}


	public function getUserDetail($id_user){



		$query = $this->db->query("

			SELECT  
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
					  FROM tb_user , tb_user_detail where tb_user.id_user = tb_user_detail.id_user and tb_user.id_user = '".$id_user."';


			");
		
		return $query;


	}


	public function updateUser(){

			$id_user =  $this->input->post('id_user'); 
			$email = $this->input->post('email'); 
			$username = $this->input->post('username'); 
			$password = $this->input->post('password'); 
			$name = $this->input->post('name'); 
			$address = $this->input->post('address'); 
			$current_address = $this->input->post('current_address'); 
			$no_telp = $this->input->post('no_telp'); 
			$no_hp = $this->input->post('no_hp'); 
			$nationality = $this->input->post('nationality');



		if($password == ""){

	
		


					$sql = "UPDATE tb_user_detail
						   SET name=".$this->db->escape($name)." ,  address=".$this->db->escape($address)." , current_address=".$this->db->escape($current_address)." , 
						        no_telp=".$this->db->escape($no_telp)." , no_hp=".$this->db->escape($no_hp)." , nationality=".$this->db->escape($nationality)." , email=".$this->db->escape($email)." 
						 WHERE id_user = '".$id_user."'";

					$updated = $this->db->query($sql);

					if($sql){

						return TRUE;
					}

			


		}else{

			$password = md5($password);

			$sql = "UPDATE tb_user
					   SET  password = ".$this->db->escape($password)."
					 WHERE id_user = '".$id_user."';
					";
			$updated = $this->db->query($sql);

			if($updated){


					$sql = "UPDATE tb_user_detail
						   SET name=".$this->db->escape($name)." ,  address=".$this->db->escape($address)." , current_address=".$this->db->escape($current_address)." , 
						        no_telp=".$this->db->escape($no_telp)." , no_hp=".$this->db->escape($no_hp)." , nationality=".$this->db->escape($nationality)." , email=".$this->db->escape($email)." 
						 WHERE id_user = '".$id_user."'";

					$updated = $this->db->query($sql);

					if($sql){

						return TRUE;
					}

			}

		}


	}



}