<?php

class Model_statistic extends CI_Model{

	function __construct(){

		parent::__construct();

			date_default_timezone_set('Asia/Jakarta');
		
	}


	public function allSummaryUnloading(){

		$addition="";

		$user = $this->auth->get_data_session();

   		if(count($user->list_supp) > 0){

   			$addition .=" and master_supplier.id_supplier in (   " ;  

   				foreach($user->list_supp as $list){

   					$addition .="'".$list."' , ";

   				}
   				$addition = substr($addition , '0' , '-2') ; 

   			$addition .=" ) "; 	

   		} 
   		


		$query = $this->db->query("SELECT master_supplier.id_supplier , nama_perusahaan , tahun , tipe , 
							count(master_supplier.id_supplier) as jumlah_trip , 
							sum(jumlah_solar) as total_jumlah_solar ,
							sum(es) as total_es , 
							sum(total_tangkapan) as total_tangkapan ,  
							sum(yft) as total_yft ,
							sum(bet) as total_bet ,
							sum(skj) as total_skj ,
							sum(kaw) as total_kaw ,
							sum(bycatch) as total_bycatch ,
							sum(loin_kotor) as total_loin_kotor ,
							sum(loin_bersih) as total_loin_bersih ,
							sum(jumlah_loin) as total_jumlah_loin ,
							sum(total_loin) as total_all_loin , 
							sum(ikanhilang) as total_ikanhilang 
							  FROM ap2hi_boat_unload , master_supplier
							  where ap2hi_boat_unload.id_supplier  = master_supplier.id_supplier
							  ".$addition."
							  group by master_supplier.id_supplier , nama_perusahaan , tahun ,tipe  order by master_supplier.id_supplier , tahun ,tipe 
							   ;
							");
		
		return $query;



	}


	public function getCount($id_supplier){


		$query = $this->db->query("
				select count(distinct(tahun , tipe)) as hasil from ap2hi_boat_unload  where id_supplier  = '".$id_supplier."'
			");


		return $query;
	}


	public function listsSupplierUnloading(){


		$addition="";

		$user = $this->auth->get_data_session();

   		if(count($user->list_supp) > 0){

   			$addition .=" and master_supplier.id_supplier in (   " ;  

   				foreach($user->list_supp as $list){

   					$addition .="'".$list."' , ";

   				}
   				$addition = substr($addition , '0' , '-2') ; 

   			$addition .=" ) "; 	

   		} 

		$query = $this->db->query("
				
				SELECT master_supplier.id_supplier , nama_perusahaan 
					  FROM ap2hi_boat_unload , master_supplier
					  where ap2hi_boat_unload.id_supplier  = master_supplier.id_supplier ".$addition."
					  group by master_supplier.id_supplier , nama_perusahaan   order by master_supplier.id_supplier 
					   
				");


		return $query;

	}


	public function listsTahunUnloading(){


		$query = $this->db->query("
				select distinct(tahun) as tahun from ap2hi_boat_unload order by tahun
			");


		return $query;

	}


	public function catchCompSql($kode_perusahaan , $tahun){


		$query = $this->db->query("
						select  master_supplier.id_supplier  , nama_perusahaan ,  tahun , sum(total_tangkapan) as total_tangkapan ,  sum(yft) as total_yft , sum(bet) as total_bet , sum(skj) as total_skj , sum(bycatch) as total_bycatch , sum(ikanhilang) as total_ikanhilang 
					from ap2hi_boat_unload , master_supplier 
					where ap2hi_boat_unload.id_supplier = master_supplier.id_supplier
					and tahun = '".$tahun."' and master_supplier.id_supplier = '".$kode_perusahaan."'
					group by master_supplier.id_supplier , nama_perusahaan , tahun order by master_supplier.id_supplier , tahun
		");


		return $query;

	}

	public function catchCompMonthSql($kode_perusahaan , $tahun){


		$query = $this->db->query("
						select  master_supplier.id_supplier  , nama_perusahaan ,  tahun , bulan , sum(total_tangkapan) as total_tangkapan ,  sum(yft) as total_yft , sum(bet) as total_bet , sum(skj) as total_skj , sum(bycatch) as total_bycatch , sum(ikanhilang) as total_ikanhilang 
					from ap2hi_boat_unload , master_supplier 
					where ap2hi_boat_unload.id_supplier = master_supplier.id_supplier
					and tahun = '".$tahun."' and master_supplier.id_supplier = '".$kode_perusahaan."'
					group by master_supplier.id_supplier , nama_perusahaan , tahun , bulan order by master_supplier.id_supplier , tahun , bulan
		");


		return $query;

	}


	public function hlpl(){

			$query = $this->db->query("
						select sum(total_tangkapan)  as total, tahun , tipe from ap2hi_boat_unload group by tahun , tipe order by  tipe , tahun 
					");


		return $query;

	}

	public function catchCompMonthSqlAll( $tahun){


		$query = $this->db->query("
						select    tahun , sum(total_tangkapan) as total_tangkapan ,  sum(yft) as total_yft , sum(bet) as total_bet , sum(skj) as total_skj , sum(bycatch) as total_bycatch , sum(ikanhilang) as total_ikanhilang 
					from ap2hi_boat_unload 
					where tahun = '".$tahun."' 
					group by  tahun order by  tahun 
		");


		return $query;

	}


	public function totalallbar(){

		$query = $this->db->query("
					select tahun , sum(total_tangkapan) as total_tangkapan ,  sum(yft) as total_yft , sum(bet) as total_bet , sum(skj) as total_skj , sum(bycatch) as total_bycatch , sum(ikanhilang) as total_ikanhilang 
					from ap2hi_boat_unload
					group by tahun order by  tahun 
		");


		return $query;


	}

	public function vessel(){

		

		$query = $this->db->query("
					select jenis_alat  , count(nama_kapal) as total  from master_vessel where status = 'active' group by jenis_alat

		");


		return $query;



	}


}