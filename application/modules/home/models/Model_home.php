<?php

class Model_home extends CI_Model{



	
	function __construct(){

		parent::__construct();

		$this->load->database();

		date_default_timezone_set('Asia/Jakarta');

		$user_acces =  $this->auth->get_data_session();



	}


	function additionQuery($from = ""){

		$addition="";

		$user = $this->auth->get_data_session();

   		if(count($user->list_supp) > 0){

   			$addition .=" and ".$from."id_supplier in (   " ;  

   				foreach($user->list_supp as $list){

   					$addition .="'".$list."' , ";

   				}
   				$addition = substr($addition , '0' , '-2') ; 

   			$addition .=" ) "; 	

   		} 

   		return $addition ; 
	}


	function whereQuery($from = ""){

		$addition="";

		$user = $this->auth->get_data_session();

   		if(count($user->list_supp) > 0){

   			$addition .=" where ".$from."id_supplier in (   " ;  

   				foreach($user->list_supp as $list){

   					$addition .="'".$list."' , ";

   				}
   				$addition = substr($addition , '0' , '-2') ; 

   			$addition .=" ) "; 	

   		} 

   		return $addition ; 
	}




	function count_all_supplier_active(){

		
		$query = $this->db->query("Select count(id_supplier) as jumlah from master_supplier where status = '1' ");
		
		return $query;

	}


	public function count_all_vessel_active(){

		
		$query = $this->db->query("Select count(id_vessel) as jumlah from master_vessel where status = 'active'");
		
		return $query;

	}


	public function count_all_unloading(){

		
		$query = $this->db->query("Select count(kode_upload) as jumlah from ap2hi_boat_unload ");
		
		return $query;

	}

	public function get_all_supplier_active(){

		$query = $this->db->query("Select * from master_supplier where status = '1' ".$this->additionQuery()." order by id_supplier");
				
		return $query;

	}

	public function  get_all_recent_unloading(){


			$query = $this->db->query("SELECT kode_upload , kode_trip , tanggal_kembali , 						nama_perusahaan
  							FROM ap2hi_boat_unload , master_supplier where 1=1 and ap2hi_boat_unload.id_supplier = master_supplier.id_supplier ".$this->additionQuery('master_supplier.')." order by tanggal_kembali desc limit 20;
					");
				
		return $query;

	}



	public function get_all_recent_sampling(){


		$query = $this->db->query("SELECT namafile,  nama_perusahaan, total_penangkapan, 					tgl_impor
  							FROM tps_pendaratan , master_supplier where 1=1 and tps_pendaratan.k_perusahaan = master_supplier.id_supplier ".$this->additionQuery('master_supplier.')."  order by tgl_impor desc limit 20 ;
					");
				
		return $query;


	}


	public function get_cpue(){


		$query = $this->db->query("

				SELECT 
					bulan , 
					sum(total_tangkapan) as  total_tangkapan , 
					sum(jumlah_solar) as jumlah_solar 
					FROM ap2hi_boat_unload where 1=1 and tahun='".date('Y')."'
					".$this->additionQuery()."
					 group by bulan order by bulan;


					");
				
		return $query;



	}


	public function get_fuel(){


		$query = $this->db->query("

				SELECT 
					bulan , 
					sum(jumlah_solar) as jumlah_solar 
					FROM ap2hi_boat_unload where 1=1 and tahun='".date('Y')."'
					".$this->additionQuery()."
					 group by bulan order by bulan;


					");
				
		return $query;



	}


	public function get_all_recent_vessels(){


		$query = $this->db->query("

				SELECT nama_perusahaan, nama_kapal , no_ap2hi , master_vessel.created_date
						  FROM master_vessel, master_supplier  where 1=1 and master_vessel.id_supplier = master_supplier.id_supplier ".$this->additionQuery('master_supplier.')." order by master_vessel.created_date desc limit 10;

					");
				
		return $query;

	}


	public function unloadingThisYear(){

		$year = date('Y'); 


		$user_acces ; 


		$query = $this->db->query("SELECT bulan , sum(total_tangkapan) as total_tangkapan
		  FROM ap2hi_boat_unload where tahun = '".$year."' ".$this->additionQuery('ap2hi_boat_unload.')." group by bulan order by bulan");

	
		return $query;

	}

	public function unloadingThisYearBySupp(){

		$year = date('Y');


		$query = $this->db->query("SELECT master_supplier.id_supplier , kode_name  , sum(total_tangkapan) as total_tangkapan
					  FROM ap2hi_boat_unload ,master_supplier  where 
					  master_supplier.id_supplier  = ap2hi_boat_unload.id_supplier and 
					  tahun = '".$year."' ".$this->additionQuery('ap2hi_boat_unload.')." group by master_supplier.id_supplier , kode_name  order by master_supplier.id_supplier");

	
		return $query;

	}
 
	public function data_graph1_val(){


		$year = date('Y'); 

		$val = array(); 


		$query = $this->db->query("SELECT  sum(total_tangkapan) as total_tangkapan
			  FROM ap2hi_boat_unload where tahun = '".$year."'")->row_array();

		$query2 = $this->db->query(" SELECT count(distinct(id_supplier)) as total_supplier
			  FROM ap2hi_boat_unload where tahun = '".$year."'")->row_array();

		
		$val['total_catch'] = $query['total_tangkapan'] ;
		$val['total_supplier'] = $query2['total_supplier'] ; 

		//$query = $this->db->query("SELECT FROM ");

	
		return $val ; 
	}


	public function getVesselCount(){

		$query= $this->db->query("SELECT master_supplier.id_supplier , kode_name  , count(id_vessel) as total_vessel
					  FROM master_vessel  ,master_supplier  where 
					  master_vessel.id_supplier  = master_supplier.id_supplier 
					  and master_vessel.status = 'active' ".$this->additionQuery('master_supplier.')."
					  group by master_supplier.id_supplier , kode_name  order by master_supplier.id_supplier");

	
		return $query;

	}


	public function getTipePerusahaanCount(){

		$query= $this->db->query("SELECT tipe_perusahaan , count(id_supplier) as total_supplier 
					  FROM master_supplier WHERE status = '1' ".$this->additionQuery('master_supplier.')."
					  group by tipe_perusahaan order by tipe_perusahaan

			");

	
		return $query;

	}


	public function catchCompSql(){

		$year = date('Y'); 

		$query = $this->db->query("
						select  tahun , sum(total_tangkapan) as total_tangkapan ,  sum(yft) as total_yft , sum(bet) as total_bet , sum(skj) as total_skj , sum(bycatch) as total_bycatch , sum(ikanhilang) as total_ikanhilang 
					from ap2hi_boat_unload , master_supplier 
					where ap2hi_boat_unload.id_supplier = master_supplier.id_supplier
					and tahun = '".$year."' 
					".$this->additionQuery('master_supplier.')."
					group by  tahun order by  tahun
		");


		return $query;



	}



	public function distinct_catch_year(){


		$query = $this->db->query("
						select  distinct(tahun) from ap2hi_boat_unload ".$this->whereQuery('ap2hi_boat_unload.')." group by  tahun order by tahun
						");


		return $query;

	}


	public function totalCatchPerMonth($year = null){

		if($year == '' || $year == null){

				$year = date('Y'); 

		}



		$query = $this->db->query("
						select sum(total_tangkapan) as total_tangkapan , bulan from ap2hi_boat_unload where tahun =  '".$year."' ".$this->additionQuery('ap2hi_boat_unload.')." group by bulan order by bulan
		");


		return $query;

	}


	public function totalTripPerMonth($year = null){

		if($year == '' || $year == null){

				$year = date('Y'); 

		}




		$query = $this->db->query("
						select count(kode_trip) as total_trip , bulan from ap2hi_boat_unload where tahun = '".$year."' ".$this->additionQuery('ap2hi_boat_unload.')." group by bulan order by bulan
		");


		return $query;

	}


	public function totalTangkapanPerYear(){

			$query = $this->db->query("
						SELECT distinct(tahun) as tahun , sum(total_tangkapan) as total_tangkapan FROM ap2hi_boat_unload ".$this->whereQuery('ap2hi_boat_unload.')." group by tahun order by tahun
		");


		return $query;

	}


	public function komposisiTangkapanPerYear(){


		$query = $this->db->query("select  tahun , sum(total_tangkapan) as total_tangkapan ,  sum(yft) as total_yft , sum(bet) as total_bet , sum(skj) as total_skj , sum(bycatch) as total_bycatch , sum(ikanhilang) as total_ikanhilang 
					from ap2hi_boat_unload ".$this->whereQuery('ap2hi_boat_unload.')."
					group by  tahun order by tahun");



		return $query ; 	 

	}


	public function distinctTipeKapal(){

			$query = $this->db->query("
						SELECT distinct(jenis_alat) as jenis_alat , count(id_vessel) as total_vessel FROM master_vessel  ".$this->whereQuery('master_vessel.')." group by jenis_alat order by jenis_alat
		");


		return $query;

	}


	public function distinctTipeTangkapan(){

		$query = $this->db->query("
						SELECT tahun, sum(total_tangkapan) as total_tangkapan , tipe 
  									FROM ap2hi_boat_unload  ".$this->whereQuery('ap2hi_boat_unload.')." group by tahun, tipe order by tahun ;

		");


		return $query;

	}


	public function distinctUmpan(){

		if($this->whereQuery('ap2hi_boat_unload.') != ""){
			
				$query = $this->db->query("
						SELECT tahun , sum(jumlah_kg) as total_umpan, sum(total_tangkapan) as total_tangkapan
  						FROM ap2hi_boat_umpan , ap2hi_boat_unload ".$this->whereQuery('ap2hi_boat_unload.')." and ap2hi_boat_umpan.kode_trip = ap2hi_boat_unload.kode_trip group by tahun order by tahun ;


						");
			
			
		}else{
			
		
				$query = $this->db->query("
						SELECT tahun , sum(jumlah_kg) as total_umpan, sum(total_tangkapan) as total_tangkapan
  						FROM ap2hi_boat_umpan , ap2hi_boat_unload where ap2hi_boat_umpan.kode_trip = ap2hi_boat_unload.kode_trip group by tahun order by tahun ;


						");
			
		}

		

		return $query;

	}
	
}

?>