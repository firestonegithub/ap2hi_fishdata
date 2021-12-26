<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Home2 extends CI_Controller {



	function __construct(){

		parent::__construct();

		$this->load->model('Model_home2');

		$this->load->model('master/model_master' ,'Model_master');

		$this->n_lengthFreq = 0;

		$this->n_weightFreq = 0;

	
	}


	public function index(){

		$this->auth->check_login();


		$data['record_suppliers'] = $this->Model_master->get_all_supplier_active();

        $data['record_landings'] =  $this->Model_master->get_all_landing_active();



		$data['url_lengthFreq']=  $this->lengthFreq();

		$data['url_lengthFreq_dinamic']=base_url()."home/home2/lengthFreq_dinamic";

		$data['n_lengthFreq']=  $this->n_lengthFreq;



		$data['url_weightFreq']=  $this->weightFreq();

		$data['url_weightFreq_dinamic']=base_url()."home/home2/weightFreq";


		//catchComp
		$data['url_catchComp']=  $this->catchComp();

		$data['url_catchComp_dinamic']=  base_url()."home/home2/catchComp";


		$data['url_baitComp']=  $this->baitComp();

		$data['url_baitComp_dinamic']=  base_url()."home/home2/baitComp";


		$data['baitAndCatch']=  $this->baitAndCatch();

		$data['url_baitAndCatch_dinamic']=  base_url()."home/home2/baitAndCatch";


		$data['url_search_details']=base_url()."home/home2/";


		       $data['post']['tipe_gear'] = isset( $_POST['tipe_gear6'] ) ? $_POST['tipe_gear6']  : "" ; 
        
		       $data['post']['tahun']  = isset($_POST['tahun6']) ? $_POST['tahun6'] : "";

		       $data['post']['bulan']  = isset($_POST['bulan6']) ? $_POST['bulan6'] : "";

		       $data['post']['tanggal']  = isset($_POST['tanggal6']) ? $_POST['tanggal6'] : ""; 

		       $data['post']['k_landing'] = isset($_POST['k_landing6']) ? $_POST['k_landing6'] : "";

		       $data['post']['k_perusahaan'] = isset($_POST['k_perusahaan6']) ? $_POST['k_perusahaan6'] : ""; 



		$data['speciesDetails'] =  $this->Model_home2->speciesDetails( $data['post']['tipe_gear'],$data['post']['tahun'], $data['post']['bulan'] , $data['post']['tanggal'] , $data['post']['k_landing']  , $data['post']['k_perusahaan'] );


		$data['baitDetails'] =  $this->Model_home2->baitDetails( $data['post']['tipe_gear'],$data['post']['tahun'], $data['post']['bulan'] , $data['post']['tanggal'] , $data['post']['k_landing']  , $data['post']['k_perusahaan']  );


		$data['etpDetails'] =  $this->Model_home2->etpDetails(  $data['post']['tipe_gear'],$data['post']['tahun'], $data['post']['bulan'] , $data['post']['tanggal'] , $data['post']['k_landing']  , $data['post']['k_perusahaan']  );


		$data['tripDetails'] =  base_url()."home/home2/tripDetails"; 

		$data['tripDetailsSearch'] =  base_url()."home/home2/tripDetailsSearch"; 


		$data['content'] = 'home/home2';

		$this->load->view('template-admin/template',  $data + $_POST );

	
	}


	public function tripDetails(){


		$query = $this->Model_home2->tripDetails();

		foreach($query->result() as $row){

    		 $result['data'][] = array(

    		 	$row->namafile ,       
    		 	$row->nama_kapal,
		        $row->gt_kapal,
		        $row->bbm ,
		        $row->es ,
		        $row->lama_hari

    		 	  );

    	}

    	echo json_encode($result);

	}



	public function tripDetailsSearch(){




	   $tipe_gear = isset( $_POST['tipe_gear'] ) ? $_POST['tipe_gear']  : "" ; 

       $tahun  = isset($_POST['tahun']) ? $_POST['tahun'] : "";

       $bulan  = isset($_POST['bulan']) ? $_POST['bulan'] : "";

       $tanggal  = isset($_POST['tanggal']) ? $_POST['tanggal'] : ""; 

       $k_landing = isset($_POST['k_landing']) ? $_POST['k_landing'] : ""; 

       $k_perusahaan = isset($_POST['k_perusahaan']) ? $_POST['k_perusahaan'] : ""; 

		


		$query = $this->Model_home2->tripDetails2($tipe_gear,$tahun,$bulan,$tanggal,$k_landing , $k_perusahaan);



		foreach($query->result() as $row){

    		 $result['data'][] = array(

    		 	$row->namafile ,       
    		 	$row->nama_kapal,
		        $row->gt_kapal,
		        $row->bbm ,
		        $row->es ,
		        $row->lama_hari

    		 	  );

    	}

    	echo json_encode($result);

	}


	public function lengthFreq(){

		$this->auth->restrict_ajax_login_datatable();

		$arrayRes = array();

		$results1 = $this->Model_home2->lengthFreqBesar(); 

		$results2 = $this->Model_home2->lengthFreqKecil(); 

		$getMaxIkanBesar = $this->Model_home2->getMaxValue('tps_ikanbesar', 'panjang');

		$getMaxIkanKecil = $this->Model_home2->getMaxValue('tps_ikankecil', 'panjang');



		if( $getMaxIkanKecil->max >  $getMaxIkanBesar->max){

			$maxPanjang = $getMaxIkanKecil->max;

		} else{

			$maxPanjang = $getMaxIkanBesar->max;

		}

		for($i=0;$i<= $maxPanjang+4 ; $i++){

			if ( $i % 5 == 0 ) {

				$kelipatan = $i;

			}
		}

	

		$result_merger = array_merge($results1->result(), $results2->result() );


		
		foreach($results1->result() as $row ) {

			 //echo $row->k_species;
			
		   
		}

		$n_lengthFreq = 0;

		for($i=0;$i<= $kelipatan ; $i++){


			if ( $i % 5 == 0 ) {

				$j=0;

				foreach($result_merger as $row ) {

					if( $row->panjang >= $i-5 && $row->panjang <= $i){

						$j=$j+$row->count;

						$n_lengthFreq = $n_lengthFreq + $row->count;

					}

					

				}

				$arrayRes[$i] = $j;

				
			}


			

		}

		
		$this->n_lengthFreq = $n_lengthFreq;

		unset($arrayRes[0]);
		//loop i=0 ; i = max ' i+5' 
			//loop result 1 dan 2 
				//jika panjang berada diantara i-5 dan i + 5 maka jumlah tambah berdasarkan count 
		

		return $arrayRes;

	}


	public function lengthFreq_dinamic(){

		$response = array();

		$title = "";

        
       $tipe_gear = isset( $_POST['tipe_gear'] ) ? $_POST['tipe_gear']  : "" ; 
        
       $species  = isset($_POST['species']) ? $_POST['species'] : "";

       $tahun  = isset($_POST['tahun']) ? $_POST['tahun'] : "";

       $bulan  = isset($_POST['bulan']) ? $_POST['bulan'] : "";

       $tanggal  = isset($_POST['tanggal']) ? $_POST['tanggal'] : ""; 

       $k_landing = isset($_POST['k_landing']) ? $_POST['k_landing'] : ""; 

       $k_perusahaan = isset($_POST['k_perusahaan']) ? $_POST['k_perusahaan'] : ""; 


       /* START  */

        $results1 = $this->Model_home2->lengthFreqBesar($tipe_gear,$species,$tahun,$bulan,$tanggal,$k_landing , $k_perusahaan); 

		$results2 = $this->Model_home2->lengthFreqKecil($tipe_gear,$species,$tahun,$bulan,$tanggal,$k_landing , $k_perusahaan); 

		$getMaxIkanBesar = $this->Model_home2->getMaxValue('tps_ikanbesar', 'panjang');

		$getMaxIkanKecil = $this->Model_home2->getMaxValue('tps_ikankecil', 'panjang');



		if( $getMaxIkanKecil->max >  $getMaxIkanBesar->max){

			$maxPanjang = $getMaxIkanKecil->max;

		} else{

			$maxPanjang = $getMaxIkanBesar->max;

		}

		for($i=0;$i<= $maxPanjang+4 ; $i++){

			if ( $i % 5 == 0 ) {

				$kelipatan = $i;

			}
		}

	

		$result_merger = array_merge($results1->result(), $results2->result() );



		$n_lengthFreq = 0;
		
		for($i=0;$i<= $kelipatan ; $i++){


			if ( $i % 5 == 0 ) {

				$j=0;

				foreach($result_merger as $row ) {

					if( $row->panjang >= $i-5 && $row->panjang <= $i){

						$j=$j+$row->count;

						$n_lengthFreq = $n_lengthFreq + $row->count;

					}

					

				}

				//$arrayRes[$i] = $j;
				$arrayRes['label'][] = $i;
				$arrayRes['data'][] = $j;

				
			}


			

		}


		$title .= $tipe_gear." - ".$species.", n= ".$n_lengthFreq ;

		if($tahun !=""){$title .= " Thn=".$tahun;}

		if($bulan !=""){$title .= " Bln=".$bulan;}

		if($tanggal !=""){$title .= " Tgl=".$tanggal;}

		if($k_landing !=""){$title .= " landing=".$k_landing;}

		if($k_perusahaan !=""){$title .= " supp=".$k_perusahaan;}



       /* END */

   
   	   //$arrayRes['label']  = array(30,40);

   	   // $arrayRes['data']  =	array(300,400);

       $dataPoints =  $arrayRes;

       $response =  array(
       					'dataPoints' => $dataPoints ,
       					'title' => $title,
                        'success' => 'true', 
                        'messages' => 'Data Didapatkan !'
                    );

		 echo json_encode($response,JSON_NUMERIC_CHECK); 

	}



	public function weightFreq(){

		$this->auth->restrict_ajax_login_datatable();

		$arrayRes = array();

		$title = "";

	   $tipe_gear = isset( $_POST['tipe_gear'] ) ? $_POST['tipe_gear']  : "" ; 
        
       $species  = isset($_POST['species']) ? $_POST['species'] : ""; 

       $tahun  = isset($_POST['tahun']) ? $_POST['tahun'] : "";

       $bulan  = isset($_POST['bulan']) ? $_POST['bulan'] : "";

       $tanggal  = isset($_POST['tanggal']) ? $_POST['tanggal'] : ""; 

       $k_landing = isset($_POST['k_landing']) ? $_POST['k_landing'] : ""; 

       $k_perusahaan = isset($_POST['k_perusahaan']) ? $_POST['k_perusahaan'] : ""; 

		$results1 = $this->Model_home2->weightFreq('tps_ikanbesar', $tipe_gear, $species,$tahun,$bulan,$tanggal,$k_landing , $k_perusahaan); 

		$results2 = $this->Model_home2->weightFreq('tps_ikankecil', $tipe_gear, $species,$tahun,$bulan,$tanggal,$k_landing , $k_perusahaan); 

		$getMaxIkanBesar = $this->Model_home2->getMaxValue('tps_ikanbesar', 'berat');

		$getMaxIkanKecil = $this->Model_home2->getMaxValue('tps_ikankecil', 'kalkulasi_berat');



		if( $getMaxIkanKecil->max >  $getMaxIkanBesar->max){

			$maxBerat = $getMaxIkanKecil->max;

		} else{

			$maxBerat = $getMaxIkanBesar->max;

		}

		for($i=0;$i<= $maxBerat+4 ; $i++){

			if ( $i % 5 == 0 ) {

				$kelipatan = $i;

			}
		}

	

		$result_merger = array_merge($results1->result(), $results2->result() );

		$n_weightFreq = 0;

		for($i=0;$i<= $kelipatan ; $i++){


			if ( $i % 5 == 0 ) {

				$j=0;

				foreach($result_merger as $row ) {

					if( $row->est_kg >= $i-5 && $row->est_kg <= $i){

						$j=$j+$row->count;

						$n_weightFreq = $n_weightFreq + $row->count;

					}

					

				}

				$arrayRes[$i] = $j;

				$arrayResults['label'][] = $i;
				$arrayResults['data'][] = $j;

				
			}


			

		}

		
		$this->n_weightFreq = $n_weightFreq;

		unset($arrayRes[0]);


		$title .= $tipe_gear." - ".$species.", n= ".$n_weightFreq ;

		if($tahun !=""){$title .= " Thn=".$tahun;}

		if($bulan !=""){$title .= " Bln=".$bulan;}

		if($tanggal !=""){$title .= " Tgl=".$tanggal;}

		if($k_landing !=""){$title .= " landing=".$k_landing;}
		
		if($k_perusahaan !=""){$title .= " supp=".$k_perusahaan;}


		if($tipe_gear != "" && $species != ""){


		 $dataPoints =  $arrayResults;

         $response =  array(
       					'dataPoints' => $dataPoints ,
       					'title' => $title,
                        'success' => 'true', 
                        'messages' => 'Data Didapatkan !'
                    );

		 echo json_encode($response,JSON_NUMERIC_CHECK); 


		}else{


			return $arrayRes;


		}

		

	}



	public function catchComp(){

		$this->auth->restrict_ajax_login_datatable();

		$title = "";

	   $tipe_gear = isset( $_POST['tipe_gear'] ) ? $_POST['tipe_gear']  : "" ; 

	   $tahun  = isset($_POST['tahun']) ? $_POST['tahun'] : "";

       $bulan  = isset($_POST['bulan']) ? $_POST['bulan'] : "";

       $tanggal  = isset($_POST['tanggal']) ? $_POST['tanggal'] : ""; 

       $k_landing = isset($_POST['k_landing']) ? $_POST['k_landing'] : ""; 

       $k_perusahaan = isset($_POST['k_perusahaan']) ? $_POST['k_perusahaan'] : ""; 
        

		$arrayRes = array();

		$results1 = $this->Model_home2->catchComp('tps_ikanbesar', $tipe_gear ,$tahun,$bulan,$tanggal,$k_landing , $k_perusahaan); 

		$results2 = $this->Model_home2->catchComp('tps_ikankecil', $tipe_gear,$tahun,$bulan,$tanggal,$k_landing , $k_perusahaan ); 
		
		$results3 = $this->Model_home2->catchComp('tps_bycatch', $tipe_gear,$tahun,$bulan,$tanggal,$k_landing , $k_perusahaan ); 


	

	

		$result_merger = array_merge($results1->result(), $results2->result(), $results3->result() );

		$arrayRes = array();

		foreach($result_merger as $row ) {

			if($row->k_species == ""){
				$row->k_species = 'UN';
			}

			if (array_key_exists($row->k_species,$arrayRes)) {

					$arrayRes[ $row->k_species ] = $arrayRes[ $row->k_species ] + $row->est_kg ;

			}else{
				$arrayRes[ $row->k_species ] = $row->est_kg ;

			}


			

			
		}


		$title .= $tipe_gear ;

		if($tahun !=""){$title .= " Thn=".$tahun;}

		if($bulan !=""){$title .= " Bln=".$bulan;}

		if($tanggal !=""){$title .= " Tgl=".$tanggal;}

		if($k_landing !=""){$title .= " landing=".$k_landing;}
		
		if($k_perusahaan !=""){$title .= " supp=".$k_perusahaan;}





		if($tipe_gear != ""  ){


			foreach($arrayRes as $key=>$value ) { 

				$arrayResults['label'][] = $key ;
				$arrayResults['data'][] = $value;


			}

		 $dataPoints =  $arrayResults;

         $response =  array(
       					'dataPoints' => $dataPoints ,
       					'title' => $title ,
                        'success' => 'true', 
                        'messages' => 'Data Didapatkan !'
                    );

		 echo json_encode($response,JSON_NUMERIC_CHECK); 


		}else{


			return $arrayRes;


		}
		

	}


	public function baitComp(){

	   $this->auth->restrict_ajax_login_datatable();


	   $title = "";

	   $tipe_gear = isset( $_POST['tipe_gear'] ) ? $_POST['tipe_gear']  : "" ; 

	   $tahun  = isset($_POST['tahun']) ? $_POST['tahun'] : "";

       $bulan  = isset($_POST['bulan']) ? $_POST['bulan'] : "";

       $tanggal  = isset($_POST['tanggal']) ? $_POST['tanggal'] : ""; 

       $k_landing = isset($_POST['k_landing']) ? $_POST['k_landing'] : ""; 

       $k_perusahaan = isset($_POST['k_perusahaan']) ? $_POST['k_perusahaan'] : ""; 
        

		$arrayRes = array();

		$results = $this->Model_home2->baitComp( $tipe_gear , $tahun , $bulan , $tanggal , $k_landing , $k_perusahaan ); 


		$arrayRes = array();
		
		$i=0;

		foreach($results->result() as $row ) {

			if($row->species == ""){
				$row->species = 'UN';
			}

					$arrayRes[ $i ]['species_name'] = $row->species ;
					
					$arrayRes[ $i ]['berat'] = $row->kg ;


				$i++;
			
		}


		$title .= $tipe_gear." " ;

		if($tahun !=""){$title .= " Thn=".$tahun;}

		if($bulan !=""){$title .= " Bln=".$bulan;}

		if($tanggal !=""){$title .= " Tgl=".$tanggal;}

		if($k_landing !=""){$title .= " landing=".$k_landing;}
		
		if($k_perusahaan !=""){$title .= " supp=".$k_perusahaan;}

		$arrayResults = array();

		if($tipe_gear != ""  ){


			foreach($arrayRes as $loop ) { 

				$arrayResults['label'][] = $loop['species_name'] ;
				$arrayResults['data'][] = $loop['berat'];


			}

		 $dataPoints =  $arrayResults;

         $response =  array(
       					'dataPoints' => $dataPoints ,
       					'title' => $title ,
                        'success' => 'true', 
                        'messages' => 'Data Didapatkan !'
                    );

		 echo json_encode($response,JSON_NUMERIC_CHECK); 


		}else{


			return $arrayRes;


		}



		

	}



	public function baitAndCatch(){

		$this->auth->restrict_ajax_login_datatable();

	  	$tipe_gear = isset( $_POST['tipe_gear'] ) ? $_POST['tipe_gear']  : "" ; 

	   $tahun  = isset($_POST['tahun']) ? $_POST['tahun'] : "";

       $bulan  = isset($_POST['bulan']) ? $_POST['bulan'] : "";

       $tanggal  = isset($_POST['tanggal']) ? $_POST['tanggal'] : ""; 

       $k_landing = isset($_POST['k_landing']) ? $_POST['k_landing'] : ""; 

       $k_perusahaan = isset($_POST['k_perusahaan']) ? $_POST['k_perusahaan'] : "";

       $title = "";

		$arrayRes = array();

		$results = $this->Model_home2->baitAndCatch("tps_pendaratan" , $tipe_gear,$tahun,$bulan,$tanggal,$k_landing , $k_perusahaan); 
		
			$total_penangkapan = $results->total_kg;
		
		$results = $this->Model_home2->baitAndCatch("tps_umpan" , $tipe_gear,$tahun,$bulan,$tanggal,$k_landing , $k_perusahaan); 
		
			$total_umpan = $results->total_kg;
			
		
		$total_all = $total_penangkapan + $total_umpan ; 
		
		$percentage_a = $total_penangkapan/$total_all * 100 ;
		
		$percentage_b = $total_umpan/$total_all * 100 ;


		$arrayRes = array();
		
		$arrayRes[ 0 ]['label'] = "Total Catch" ;
					
		$arrayRes[ 0 ]['berat'] = round($percentage_a) ;
		
		$arrayRes[ 1 ]['label'] = "Total Bait" ;
					
		$arrayRes[ 1 ]['berat'] = round($percentage_b) ;

		$title .= $tipe_gear  ;

		if($tahun !=""){$title .= " Thn=".$tahun;}

		if($bulan !=""){$title .= " Bln=".$bulan;}

		if($tanggal !=""){$title .= " Tgl=".$tanggal;}

		if($k_landing !=""){$title .= " landing=".$k_landing;}
		
		if($k_perusahaan !=""){$title .= " supp=".$k_perusahaan;}


		if($tipe_gear != ""  ){


			

				$arrayResults['label'][0] = "Total Catch" ;
				$arrayResults['data'][0] = round($percentage_a) ;

				$arrayResults['label'][1] = "Total Bait";
				$arrayResults['data'][1] = round($percentage_b) ;


			

		 $dataPoints =  $arrayResults;

         $response =  array(
       					'dataPoints' => $dataPoints ,
       					'title' => $title ,
                        'success' => 'true', 
                        'messages' => 'Data Didapatkan !'
                    );

		 echo json_encode($response,JSON_NUMERIC_CHECK); 



		}else{

			return $arrayRes;

		}
		
		

	}





}