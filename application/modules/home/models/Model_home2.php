<?php

class Model_home2 extends CI_Model{



	
	function __construct(){

		parent::__construct();

		$this->load->database();

		date_default_timezone_set('Asia/Jakarta');

		$user_acces =  $this->auth->get_data_session();



	}


	public function lengthFreqKecil($tipe_gear=null,$species=null,$tahun=null,$bulan=null,$tanggal=null,$k_landing=null, $k_perusahaan=null){

		$additional = "";

		if($tipe_gear != NULL && $species != NULL){

			$additional .= " AND p.tipe = '".$tipe_gear."' and k_species = '".$species."' ";

		}

		if( $tahun != NULL ){

			$additional .= " AND p.thn_sampling = '".$tahun."' ";
		}

		if( $bulan != NULL ){

			$additional .= " AND p.bln_sampling = '".$bulan."' ";
		}

		if( $tanggal != NULL ){

			$additional .= " AND p.tgl_sampling = '".$tanggal."' ";
		}


		if( $k_landing != NULL ){

			$additional .= " AND p.k_landing = '".$k_landing."' ";
		}

		if( $k_perusahaan != NULL ){

			$additional .= " AND p.k_perusahaan = '".$k_perusahaan."' ";
		}



			$query = $this->db->query("
						SELECT  k_species, panjang ,count(s.namafile)  FROM tps_pendaratan p, tps_ikankecil s where p.namafile = s.namafile ".$additional."  group by 1,2 order by 1 , 2;
		");



		return $query;

	}


	public function lengthFreqBesar($tipe_gear=null,$species=null,$tahun=null,$bulan=null,$tanggal=null,$k_landing=null, $k_perusahaan=null){

		$additional = "";

		if($tipe_gear != NULL && $species != NULL){

			$additional .= " AND p.tipe = '".$tipe_gear."' and k_species = '".$species."' ";

		}


		if( $tahun != NULL ){

			$additional .= " AND p.thn_sampling = '".$tahun."' ";
		}

		if( $bulan != NULL ){

			$additional .= " AND p.bln_sampling = '".$bulan."' ";
		}

		if( $tanggal != NULL ){

			$additional .= " AND p.tgl_sampling = '".$tanggal."' ";
		}


		if( $k_landing != NULL ){

			$additional .= " AND p.k_landing = '".$k_landing."' ";
		}

		if( $k_perusahaan != NULL ){

			$additional .= " AND p.k_perusahaan = '".$k_perusahaan."' ";
		}


			$query = $this->db->query("
						SELECT  k_species, panjang ,count(s.namafile)  FROM tps_pendaratan p, tps_ikanbesar s where p.namafile = s.namafile ".$additional." group by 1,2 order by 1 , 2;
		");


		return $query;

	}


	 public function getMaxValue($table, $unit){

        $result = $this->db->query("Select max(".$unit.") as max from ".$table." ; ")->row();

        return $result;


    }



    public function weightFreq($tipe_species=null, $tipe_gear=null,$species=null,$tahun=null,$bulan=null,$tanggal=null,$k_landing=null, $k_perusahaan=null){

    	$additional = "";

		if($tipe_gear != NULL && $species != NULL){

			$additional .= " AND p.tipe = '".$tipe_gear."' and k_species = '".$species."' ";

		}

		if( $tahun != NULL ){

			$additional .= " AND p.thn_sampling = '".$tahun."' ";
		}

		if( $bulan != NULL ){

			$additional .= " AND p.bln_sampling = '".$bulan."' ";
		}

		if( $tanggal != NULL ){

			$additional .= " AND p.tgl_sampling = '".$tanggal."' ";
		}


		if( $k_landing != NULL ){

			$additional .= " AND p.k_landing = '".$k_landing."' ";
		}

		if( $k_perusahaan != NULL ){

			$additional .= " AND p.k_perusahaan = '".$k_perusahaan."' ";
		}

		if($tipe_species == 'tps_ikankecil'){

			$query = $this->db->query("
				SELECT  k_species,   kalkulasi_berat as est_kg, count(s.namafile) from tps_pendaratan p, tps_ikankecil s where p.namafile = s.namafile and p.namafile = s.namafile ".$additional." group by 1 , 2 order by 1 , 2 ;");
		}


		if($tipe_species == 'tps_ikanbesar'){

			$query = $this->db->query("
				SELECT  k_species,   berat as est_kg , count(s.namafile) from tps_pendaratan p, tps_ikanbesar s where p.namafile = s.namafile and p.namafile = s.namafile ".$additional." group by 1 , 2 order by 1 , 2 ;");

		}

			


		return $query;

    }


  public function catchComp($tipe_species=null, $tipe_gear=null,$tahun=null,$bulan=null,$tanggal=null,$k_landing=null, $k_perusahaan=null ){

    	$additional = "";

		if($tipe_gear != NULL ){

			$additional .= " AND p.tipe = '".$tipe_gear."'  ";

		}

		if( $tahun != NULL ){

			$additional .= " AND p.thn_sampling = '".$tahun."' ";
		}

		if( $bulan != NULL ){

			$additional .= " AND p.bln_sampling = '".$bulan."' ";
		}

		if( $tanggal != NULL ){

			$additional .= " AND p.tgl_sampling = '".$tanggal."' ";
		}


		if( $k_landing != NULL ){

			$additional .= " AND p.k_landing = '".$k_landing."' ";
		}

		if( $k_perusahaan != NULL ){

			$additional .= " AND p.k_perusahaan = '".$k_perusahaan."' ";
		}

		if($tipe_species == 'tps_ikankecil'){

			$query = $this->db->query("
				SELECT k_species,  round(sum(kalkulasi_berat)) as est_kg, count(s.namafile) from tps_pendaratan p, tps_ikankecil s where p.namafile = s.namafile and p.namafile = s.namafile ".$additional." group by 1   order by 1   ;");
		}


		if($tipe_species == 'tps_ikanbesar'){

			$query = $this->db->query("
				SELECT  k_species, round(sum(berat)) as est_kg , count(s.namafile) from tps_pendaratan p, tps_ikanbesar s where p.namafile = s.namafile and p.namafile = s.namafile ".$additional." group by 1   order by 1  ;");

		}
		
		
		if($tipe_species == 'tps_bycatch'){
			
			$query = $this->db->query("
				SELECT  k_species, round(sum( berat)) as est_kg , count(s.namafile) from tps_pendaratan p, tps_bycatch s where p.namafile = s.namafile and p.namafile = s.namafile ".$additional." group by 1   order by 1  ;");
				
		}

			


		return $query;

    }


  
    public function baitComp(  $tipe_gear=null , $tahun=null , $bulan=null , $tanggal=null , $k_landing=null , $k_perusahaan=null ){

    	$additional = "";

		if($tipe_gear != NULL ){

			$additional .= " AND p.tipe = '".$tipe_gear."'  ";

		}

		if( $tahun != NULL ){

			$additional .= " AND p.thn_sampling = '".$tahun."' ";
		}

		if( $bulan != NULL ){

			$additional .= " AND p.bln_sampling = '".$bulan."' ";
		}

		if( $tanggal != NULL ){

			$additional .= " AND p.tgl_sampling = '".$tanggal."' ";
		}


		if( $k_landing != NULL ){

			$additional .= " AND p.k_landing = '".$k_landing."' ";
		}

		if( $k_perusahaan != NULL ){

			$additional .= " AND p.k_perusahaan = '".$k_perusahaan."' ";
		}

	

			$query = $this->db->query("
				SELECT species,  round(sum(estimasi)) as kg , count(s.namafile) from tps_pendaratan p, tps_umpan s where p.namafile = s.namafile and p.namafile = s.namafile ".$additional." group by 1   order by 1   ;");
		
		



		return $query;

    }


public function baitAndCatch($tipe_data=null , $tipe_gear=null , $tahun=null,$bulan=null,$tanggal=null,$k_landing=null, $k_perusahaan=null){

	$additional = "";

		if($tipe_gear != NULL ){

			$additional .= " and  p.tipe = '".$tipe_gear."'  ";

		}


		if( $tahun != NULL ){

			$additional .= " AND p.thn_sampling = '".$tahun."' ";
		}

		if( $bulan != NULL ){

			$additional .= " AND p.bln_sampling = '".$bulan."' ";
		}

		if( $tanggal != NULL ){

			$additional .= " AND p.tgl_sampling = '".$tanggal."' ";
		}


		if( $k_landing != NULL ){

			$additional .= " AND p.k_landing = '".$k_landing."' ";
		}

		if( $k_perusahaan != NULL ){

			$additional .= " AND p.k_perusahaan = '".$k_perusahaan."' ";
		}


		if($tipe_data == 'tps_pendaratan'){

			$query = $this->db->query("
				SELECT round(sum(total_penangkapan)) as total_kg from tps_pendaratan p where 1=1 ".$additional." ;")->row();
		}


		if($tipe_data == 'tps_umpan'){

			$query = $this->db->query("
				SELECT  count(s.estimasi) as total_kg from tps_pendaratan p, tps_umpan s where p.namafile = s.namafile and p.namafile = s.namafile ".$additional."  ;")->row();

		}
		
		
		

		return $query;

    }


    public function speciesDetails($tipe_gear=null,$tahun=null,$bulan=null,$tanggal=null,$k_landing=null, $k_perusahaan=null){

    	$additional = "";

    	if($tipe_gear != NULL ){

			$additional .= " AND p.tipe = '".$tipe_gear."' ";

		}

		if( $tahun != NULL ){

			$additional .= " AND p.thn_sampling = '".$tahun."' ";
		}

		if( $bulan != NULL ){

			$additional .= " AND p.bln_sampling = '".$bulan."' ";
		}

		if( $tanggal != NULL ){

			$additional .= " AND p.tgl_sampling = '".$tanggal."' ";
		}


		if( $k_landing != NULL ){

			$additional .= " AND p.k_landing = '".$k_landing."' ";
		}

		if( $k_perusahaan != NULL ){

			$additional .= " AND p.k_perusahaan = '".$k_perusahaan."' ";
		}

    	$query = $this->db->query("
				SELECT  k_species,   sum(kalkulasi_berat) as est_kg  from tps_pendaratan p, tps_ikankecil s where p.namafile = s.namafile and p.namafile = s.namafile ".$additional."  group by 1   order by 1   ;") ;


    	$query2 = $this->db->query("
				SELECT  k_species,   sum(berat) as est_kg   from tps_pendaratan p, tps_ikanbesar s where p.namafile = s.namafile and p.namafile = s.namafile ".$additional." group by 1  order by 1   ;") ;


    	$query3 = $this->db->query("
				SELECT  k_species, round(sum( berat)) as est_kg   from tps_pendaratan p, tps_bycatch s where p.namafile = s.namafile and p.namafile = s.namafile ".$additional." group by 1   order by 1  ;");





 		$result_merger = array_merge($query->result() , $query2->result() , $query3->result()) ; 

 		$arrayRes = array();

 		$total_kg = 0;

 		foreach($result_merger as $row ) {

			if($row->k_species == ""){
				$row->k_species = 'UN';
			}

			if (array_key_exists($row->k_species,$arrayRes)) {

					$arrayRes[ $row->k_species ] = $arrayRes[ $row->k_species ] + $row->est_kg ;

			}else{
				$arrayRes[ $row->k_species ] = $row->est_kg ;

			}


			$total_kg = $total_kg + $row->est_kg; 
			

			
		}


 		return $arrayRes; 

    }


    public function baitDetails($tipe_gear=null,$tahun=null,$bulan=null,$tanggal=null,$k_landing=null, $k_perusahaan=null){

    	$additional = "";

    	if($tipe_gear != NULL ){

			$additional .= " AND p.tipe = '".$tipe_gear."' ";

		}

		if( $tahun != NULL ){

			$additional .= " AND p.thn_sampling = '".$tahun."' ";
		}

		if( $bulan != NULL ){

			$additional .= " AND p.bln_sampling = '".$bulan."' ";
		}

		if( $tanggal != NULL ){

			$additional .= " AND p.tgl_sampling = '".$tanggal."' ";
		}


		if( $k_landing != NULL ){

			$additional .= " AND p.k_landing = '".$k_landing."' ";
		}

		if( $k_perusahaan != NULL ){

			$additional .= " AND p.k_perusahaan = '".$k_perusahaan."' ";
		}


    	$query = $this->db->query("
				SELECT species,  round(sum(estimasi)) as kg , count(s.namafile) from tps_pendaratan p, tps_umpan s where p.namafile = s.namafile and p.namafile = s.namafile ".$additional."  group by 1   order by 1   ;") ;


    	return $query;

    }


    public function etpDetails($tipe_gear=null,$tahun=null,$bulan=null,$tanggal=null,$k_landing=null, $k_perusahaan=null){

    	$additional = "";

    	if($tipe_gear != NULL ){

			$additional .= " AND p.tipe = '".$tipe_gear."' ";

		}

		if( $tahun != NULL ){

			$additional .= " AND p.thn_sampling = '".$tahun."' ";
		}

		if( $bulan != NULL ){

			$additional .= " AND p.bln_sampling = '".$bulan."' ";
		}

		if( $tanggal != NULL ){

			$additional .= " AND p.tgl_sampling = '".$tanggal."' ";
		}


		if( $k_landing != NULL ){

			$additional .= " AND p.k_landing = '".$k_landing."' ";
		}

		if( $k_perusahaan != NULL ){

			$additional .= " AND p.k_perusahaan = '".$k_perusahaan."' ";
		}


    	$query = $this->db->query("
				SELECT  s.k_kelompok  ,  count(s.namafile) as jumlah FROM tps_pendaratan p, tps_etp s
				 where p.namafile = s.namafile and k_kelompok not in ( '1','8' , '1') and UPPER(interaksi) =  'YA' ".$additional."
				  group by 1 
				  order by 1 ;  ;") ;


    	return $query;

    }


    public function tripDetails(){

    	$query = $this->db->query("
				  SELECT namafile,  nama_kapal,  gt_kapal, bbm, es, lama_hari   FROM tps_pendaratan where 1=1  order by namafile ;") ;




    	return $query;

    }


    public function tripDetails2($tipe_gear = null,$tahun=null,$bulan=null,$tanggal=null,$k_landing=null, $k_perusahaan=null){


    	$additional = "";

    	if($tipe_gear != NULL ){

			$additional .= " AND p.tipe = '".$tipe_gear."' ";

		}

		if( $tahun != NULL ){

			$additional .= " AND p.thn_sampling = '".$tahun."' ";
		}

		if( $bulan != NULL ){

			$additional .= " AND p.bln_sampling = '".$bulan."' ";
		}

		if( $tanggal != NULL ){

			$additional .= " AND p.tgl_sampling = '".$tanggal."' ";
		}


		if( $k_landing != NULL ){

			$additional .= " AND p.k_landing = '".$k_landing."' ";
		}

		if( $k_perusahaan != NULL ){

			$additional .= " AND p.k_perusahaan = '".$k_perusahaan."' ";
		}

    	$query = $this->db->query("
				  SELECT namafile,  nama_kapal,  gt_kapal, bbm, es, lama_hari   FROM tps_pendaratan p where 1=1 ".$additional."  order by p.namafile;") ;




    	return $query;


    }

}

?>