<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Home extends CI_Controller {



	function __construct(){

		parent::__construct();

		$this->load->model('Model_home');

	
	}



    public function tes(){

	echo 'hai';
	}


	public function no_access(){

		$data['content'] = 'home/no_access';

		$this->load->view('template-admin/template',  $data);


	}

	public function index(){

		$this->auth->check_login();

		$countSupplierActive = $this->Model_home->count_all_supplier_active();

		$countVesselActive = $this->Model_home->count_all_vessel_active();

		$countUnloading = $this->Model_home->count_all_unloading();

		$data['url_supllier'] = base_url()."master/mainpage/supplier";

		$data['url_vessel'] = base_url()."master/mainpage/vessel";

		$data['url_unloading'] = base_url()."statistic/mainpage/overview";

		$data['url_graph'] = base_url()."statistic/mainpage/graph";


		$data['countSupplierActive'] = $countSupplierActive->row();

		$data['countVesselActive'] = $countVesselActive->row();;

		$data['countUnloading'] = $countUnloading->row();
		
		$data['data_graph1_val'] = $this->Model_home->data_graph1_val();

		$data['url_data_graph1'] = $this->dataGraph1();

		$data['url_data_graph2'] = $this->dataGraph2();

		$data['url_data_graph3'] = $this->dataGraph3();

		$data['url_data_graph4'] = $this->dataGraph4();

		$data['url_data_graph5']=  $this->dataGraph5();

		$data['url_data_graph6']=  $this->dataGraph6();

		$data['url_data_graph7']=  $this->dataGraph7();

		$data['url_data_graph8']=  $this->dataGraph8();

		$data['url_data_graph9']=  $this->dataGraph9();

		$data['url_data_graph10']=  $this->dataGraph10();

		$data['url_data_graph11']=  $this->dataGraph11();

		$data['url_data_graph12']=  $this->dataGraph12();

		$data['url_data_graph13']=  $this->dataGraph13();

		$data['url_data_graph14']=  $this->dataGraph14();

		$data['url_data_graph15']=  $this->dataGraph15();

		$data['url_data_graph16']=  $this->dataGraph16();

		$data['url_data_graph17']=  $this->dataGraph17();

		//$data['url_data_graph18']=  $this->dataGraph18(); //Users Logs 

		$data['url_load_table'] = base_url()."home/viewSupplierActive";

		$data['content'] = 'home/home';

		$this->load->view('template-admin/template',  $data);
	}


	public function dataGraph1(){

		$this->auth->restrict_ajax_login_datatable();

		$arrayRes = array();

		$results = $this->Model_home->unloadingThisYear(); 


		foreach($results->result() as $row){

			$bulan = $this->global_model->getMonth( $row->bulan , "numberToMonth");

			$arrayRes[$bulan] =  $row->total_tangkapan; 

		}

		//$arrayRes =  array("January" => "1000", "February" => "1200");

		//var_dump($arrayRes);

		return $arrayRes;

	}


	public function dataGraph2(){

		$this->auth->restrict_ajax_login_datatable();

		$arrayRes = array();

		$results = $this->Model_home->unloadingThisYearBySupp(); 


		foreach($results->result() as $row){

			$arrayRes[$row->kode_name] =  $row->total_tangkapan; 

		}

		
		//var_dump($arrayRes);

		return $arrayRes;

	}


	public function dataGraph3(){

		$this->auth->restrict_ajax_login_datatable();

		$arrayRes = array();

		$results = $this->Model_home->getVesselCount(); 


		foreach($results->result() as $row){

			$arrayRes[$row->kode_name] =  $row->total_vessel; 

		}

		
		//var_dump($arrayRes);

		return $arrayRes;

	}

	public function dataGraph4(){

		$this->auth->restrict_ajax_login_datatable();

		$arrayRes = array();

		$results = $this->Model_home->getTipePerusahaanCount(); 


		foreach($results->result() as $row){

			$arrayRes[$row->tipe_perusahaan] =  $row->total_supplier; 

		}

		
		//var_dump($arrayRes);

		return $arrayRes;


	}


	public function dataGraph5(){

		$this->auth->restrict_ajax_login_datatable();

		$results = $this->Model_home->catchCompSql();

            $result = $results->row(); 

            $yft = isset($result->total_yft) ? $result->total_yft :  '0';
            $bet = isset($result->total_bet) ? $result->total_bet :  '0';
            $skj = isset($result->total_skj) ? $result->total_skj :  '0';
            $bycatch  =  isset($result->total_bycatch) ? $result->total_bycatch :  '0';
            $ikanhilang =  isset($result->total_ikanhilang) ? $result->total_ikanhilang :  '0';

            $arrayRes = array(); 

            if($yft != "0"){
                $arrayRes["YFT"] =  $yft;
            }
            if($bet != "0"){
                $arrayRes["BET"] =   $bet;
            }
            if($skj != "0"){
                $arrayRes["SKJ"] =   $skj;
            }
            if($bycatch != "0"){
                 $arrayRes["Bycatch"] =  $bycatch;
            }
            if($ikanhilang != "0"){
                $arrayRes["Hilang"] =   $ikanhilang ;
            }

      
            return $arrayRes;


	}


	public function dataGraph6(){

		$this->auth->restrict_ajax_login_datatable();

		 $arrayRes = array(); 

		 $results1 = $this->Model_home->totalCatchPerMonth();

		 $results2 = $this->Model_home->totalTripPerMonth();

		 $nilai = $results1->result();

		 $nilai2 = $results2->result();


		 for($i=0; $i<12;$i++){

			 if(!empty($nilai[$i]->bulan)){

			 		$arrayRes["totalCatchPerMonth"][$i]  =  $nilai[$i]->total_tangkapan;

			 }else{
			 		$arrayRes["totalCatchPerMonth"][$i]  =  0;
			 }

		}


		for($i=0; $i<12;$i++){

			 if(!empty($nilai2[$i]->bulan)){

			 		$arrayRes["totalTripPerMonth"][$i]  =  $nilai2[$i]->total_trip;

			 }else{
			 		$arrayRes["totalTripPerMonth"][$i]  =  0;
			 }

		}
      

		 return $arrayRes;

	}

	public function dataGraph7(){

		$this->auth->restrict_ajax_login_datatable();

		$arrayRes = array(); 

		$results = $this->Model_home->totalTangkapanPerYear();

		
		foreach($results->result() as $row){

			$arrayRes[$row->tahun] =  round($row->total_tangkapan); 

		}

		return $arrayRes  ; 

	}


	public function dataGraph8(){

		$this->auth->restrict_ajax_login_datatable();

		$arrayRes = array(); 

		$results = $this->Model_home->komposisiTangkapanPerYear();

		
		foreach($results->result() as $row){

			$arrayRes[$row->tahun] =  array(
												'total_tangkapan' => $row->total_tangkapan  , 
												 'total_yft' => $row->total_yft ,  
												 'total_bet' => $row->total_bet , 
												 'total_skj' => $row->total_skj ,  
												 'total_bycatch' => $row->total_bycatch  , 
												 'total_ikanhilang' => $row->total_ikanhilang  
											) ; 

		}
		


		return $arrayRes  ; 


	}


	public function dataGraph9(){

		$this->auth->restrict_ajax_login_datatable();

		 $arrayRes = array(); 


		 $result = $this->Model_home->distinct_catch_year(); 

		 foreach($result->result() as $row){



		 		$tahun = $row->tahun ; 


		 		 $results1 = $this->Model_home->totalCatchPerMonth($tahun);

				 $results2 = $this->Model_home->totalTripPerMonth($tahun);

				 $nilai = $results1->result();

				 $nilai2 = $results2->result();


				  for($i=0; $i<12;$i++){

					 if(!empty($nilai[$i]->bulan)){

					 		$arrayRes["totalCatchPerMonth"][$tahun][$i]  =  $nilai[$i]->total_tangkapan;

					 }else{
					 		$arrayRes["totalCatchPerMonth"][$tahun][$i]  =  0;
					 }

				}


				for($i=0; $i<12;$i++){

					 if(!empty($nilai2[$i]->bulan)){

					 		$arrayRes["totalTripPerMonth"][$tahun][$i]  =  $nilai2[$i]->total_trip;

					 }else{
					 		$arrayRes["totalTripPerMonth"][$tahun][$i]  =  0;
					 }

				}



		 }


		
      

		 return $arrayRes;


	}


	public function dataGraph10(){


		// //x : tahun , y : jumlah , line : tipe HL / PL tipe kapal 
  
  		$this->auth->restrict_ajax_login_datatable();

		$arrayRes = array(); 

		$results = $this->Model_home->distinctTipeKapal();

		
		foreach($results->result() as $row){

			$arrayRes[$row->jenis_alat] =  round($row->total_vessel); 

		}

		return $arrayRes  ; 



	}


	public function dataGraph11(){

		$this->auth->restrict_ajax_login_datatable();

		$arrayRes = array(); 

		$results = $this->Model_home->distinctTipeTangkapan();

		foreach($results->result() as $row){



			if($row->tipe == 'PL'){

				$arrayRes[$row->tahun]['PL'] = $row->total_tangkapan ; 

			}

			if($row->tipe == 'HL'){

				$arrayRes[$row->tahun]['HL'] = $row->total_tangkapan ; 


			}


			if(empty( $arrayRes[$row->tahun]['HL'])){

				$arrayRes[$row->tahun]['HL'] =  0; 
			}
			if(empty($arrayRes[$row->tahun]['PL'])){

				$arrayRes[$row->tahun]['PL'] = 0 ; 
			
			}


		}


		return $arrayRes  ; 



	}


	public function dataGraph12(){


		$this->auth->restrict_ajax_login_datatable();

		$arrayRes = array(); 

		$results = $this->Model_home->distinctUmpan();

		foreach($results->result() as $row){


			$arrayRes[$row->tahun] = array(

									'total_umpan' => $row->total_umpan , 
									'total_tangkapan' => $row->total_tangkapan , 

				) ; 



		}

		return $arrayRes  ; 


	}



	public function dataGraph13(){

		$this->auth->restrict_ajax_login_datatable();

		 $query = $this->Model_home->get_all_recent_unloading();

	     return $query ; 

	}


	public function dataGraph14(){

		$this->auth->restrict_ajax_login_datatable();

		 $query = $this->Model_home->get_all_recent_sampling();

	     return $query ; 

	}


	public function dataGraph15(){

		$this->auth->restrict_ajax_login_datatable();

		$query = $this->Model_home->get_cpue();

		return $query ; 

	}

	public function dataGraph16(){

		$this->auth->restrict_ajax_login_datatable();

		$query = $this->Model_home->get_fuel();

		return $query ; 

	}


	public function dataGraph17(){

		$this->auth->restrict_ajax_login_datatable();

		$query = $this->Model_home->get_all_recent_vessels();

		return $query ; 


	}


	

	public function viewSupplierActive(){


		 $this->auth->restrict_ajax_login_datatable();

         $query = $this->Model_home->get_all_supplier_active();

         $result = array();

         $no = 0;
        
        foreach($query->result() as $row){

                $no++;
                $system = 'AP2HI'; 
                $kode = $row->kode_name ; 
                $numbering = sprintf("%04s", $row->id_supplier);

          

                $result['data'][]=array(

                        $no , 
                        $system.'.'.$kode.'.'.$numbering , 
                        $row->nama_perusahaan , 
                        $row->tipe_perusahaan , 
                        $row->lokasi 
                
                
                ); 

        }


         echo json_encode($result);
	}


}