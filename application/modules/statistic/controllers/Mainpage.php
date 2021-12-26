<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Mainpage extends CI_Controller {



    public function __construct(){

        parent::__construct();

        $this->load->model('Model_statistic');


    }



    public function overview(){

        $this->auth->check_login();

        if(!$this->auth->hasPrivilege("ViewOverview")){

            redirect('home','refresh');

        }

        $user = $this->auth->get_data_session();


        $data['results'] = $this->Model_statistic->allSummaryUnloading();

        $data['content']="statistic/overview";

        $this->load->view('template-admin/template',$data);

        //$this->load->view('statistic/overview',$data);

    }


    public function graph(){

        $this->auth->check_login();

        if(!$this->auth->hasPrivilege("ViewGraph")){

            redirect('home','refresh');

        }

        $user = $this->auth->get_data_session();

        $data['role_active'] = $user->role_active ; 

        $data['listsSupplier'] = $this->Model_statistic->listsSupplierUnloading(); 

        $data['listsTahun'] = $this->Model_statistic->listsTahunUnloading();

        $data['url_get_graph']=base_url()."statistic/mainpage/getGraph";

        $data['content']="statistic/graph";

        $this->load->view('template-admin/template',$data);

    }


    public function getGraph(){
        $response = array();

        
        $kode_perusahaan = isset( $_POST['kode_perusahaan'] ) ? $_POST['kode_perusahaan']  : '1' ; 
        $tahun  = isset($_POST['tahun']) ? $_POST['tahun'] : ""; 
        $tipe = isset($_POST['tipe']) ? $_POST['tipe'] : "" ;
        

        /*
        $kode_perusahaan = '1' ; 
        $tahun  = '2017'; 
        $tipe = 'catchMonth';
        */

      
         if($tipe == 'catchComp') {

                $SupplierData = $this->global_model->general_select2('master_supplier',array('id_supplier'=> $kode_perusahaan ),'row','nama_perusahaan','');
                $getNamaPerusahaan = $SupplierData->nama_perusahaan;



            $results = $this->Model_statistic->catchCompSql($kode_perusahaan , $tahun);

            $result = $results->row(); 

            $yft = isset($result->total_yft) ? $result->total_yft :  '0';
            $bet = isset($result->total_bet) ? $result->total_bet :  '0';
            $skj = isset($result->total_skj) ? $result->total_skj :  '0';
            $bycatch  =  isset($result->total_bycatch) ? $result->total_bycatch :  '0';
            $ikanhilang =  isset($result->total_ikanhilang) ? $result->total_ikanhilang :  '0';

            $arrayRes = array(); 

            if($yft != "0"){
                $arrayRes[] =  array("y" => $yft, "name" => "YFT", "exploded" => true);
            }
            if($bet != "0"){
                $arrayRes[] =   array("y" => $bet, "name" => "BET");
            }
            if($skj != "0"){
                $arrayRes[] =  array("y" => $skj, "name" => "SKJ");
            }
            if($bycatch != "0"){
                 $arrayRes[] =  array("y" => $bycatch, "name" => "Bycatch");
            }
            if($ikanhilang != "0"){
                $arrayRes[] =  array("y" => $ikanhilang, "name" => "Hilang");
            }

            $dataPoints =  $arrayRes;

            if(!empty($result)){
    
                    $response = array(
                        'success' => 'true', 
                        'nama_perusahaan' =>$getNamaPerusahaan , 
                        'tahun' => $tahun , 
                        'dataPoints' => $dataPoints , 
                        'values' => $kode_perusahaan.' '.$tahun.' '.$tipe , 
                        'messages' => 'Data Didapatkan !'
                    );
            }else{
                    
                    $response = array(
                        'success' => 'false', 
                        'nama_perusahaan' =>$getNamaPerusahaan , 
                        'tahun' => $tahun , 
                        'dataPoints' => $dataPoints , 
                        'values' => $kode_perusahaan.' '.$tahun.' '.$tipe , 
                        'messages' => 'Data tidak ada didatabase !'
                    );
            }

        }



        if($tipe == 'catchMonth') {

                $SupplierData = $this->global_model->general_select2('master_supplier',array('id_supplier'=> $kode_perusahaan ),'row','nama_perusahaan','');
                $getNamaPerusahaan = $SupplierData->nama_perusahaan;

            $arrayRes = array(); 

            $results = $this->Model_statistic->catchCompMonthSql($kode_perusahaan , $tahun);
         
            $bulanArray  = array ( "1" => "Jan"  ,
                           "2" => "Feb" , 
                           "3" => "Mar" , 
                           "4" => "Apr" , 
                           "5" => "May" , 
                           "6" => "Jun" , 
                           "7" => "Jul" , 
                           "8" => "Aug" , 
                           "9" => "Sept" , 
                           "10" => "Oct" , 
                           "11" => "Nov" ,
                           "12" => "Dec"  
                            ); 

            foreach($results->result() as $res) {

                $bulan = $res->bulan; 
                $nama_bulan = $bulanArray[$bulan]; 
                
                $yft = isset($res->total_yft) ? $res->total_yft :  0;
                $bet = isset($res->total_bet) ? $res->total_bet :  0;
                $skj = isset($res->total_skj) ? $res->total_skj :  0;
                $bycatch  =  isset($res->total_bycatch) ? $res->total_bycatch :  0;
                $ikanhilang =  isset($res->total_ikanhilang) ? $res->total_ikanhilang :  0;
            
                $arrayRes['YFT'][] = array("y" => $yft, "label" => $nama_bulan);
                $arrayRes['BET'][] = array("y" => $bet, "label" => $nama_bulan);
                $arrayRes['SKJ'][]  = array("y" => $skj, "label" => $nama_bulan);
                $arrayRes['HILANG'][] = array("y" => $bycatch, "label" => $nama_bulan);
                $arrayRes['BYCATCH'][]  = array("y" => $ikanhilang, "label" => $nama_bulan);

            }


             $dataPoints =  $arrayRes;

             $countRow =  count($results->row());

             if( $countRow > 0 ){
                    $response = array(
                        'success' => 'true', 
                        'nama_perusahaan' =>$getNamaPerusahaan , 
                        'tahun' => $tahun , 
                        'dataPoints' => $dataPoints ,
                        'values' => $kode_perusahaan.' '.$tahun.' '.$tipe , 
                        'messages' => 'Data Didapatkan !'
                    );
                }else{
                    $response = array(
                        'success' => 'false', 
                        'nama_perusahaan' =>$getNamaPerusahaan , 
                        'tahun' => $tahun , 
                        'dataPoints' => $dataPoints ,
                        'values' => $kode_perusahaan.' '.$tahun.' '.$tipe , 
                        'messages' => 'Data Tidak ada di Database !'
                    );
                    
                }

        }


        if($tipe == 'hlpl') {

            $arrayRes = array(); 
            $arrayAwal = array(); 

            $results = $this->Model_statistic->hlpl();
              
                for($i = 2010; $i<= 2018 ; $i++){

                           $arrayAwal['HL'][$i] = array("y" => 0, "label" => $i );
                           $arrayAwal['PL'][$i] = array("y" => 0, "label" => $i );
                }


                        foreach($results->result() as $res) {

                             $tahun = $res->tahun ; 
                             $total = $res->total;


                             if($res->tipe ==  'HL'){

                                    $arrayAwal['HL'][$tahun] = array("y" => $total, "label" => $tahun );
                                    

                                }else if( $res->tipe == 'PL') {

                                    $arrayAwal['PL'][$tahun]= array("y" => $total, "label" => $tahun  );
                                   

                                }
                        }


                        foreach ($arrayAwal['HL'] as $resz){

                                     $arrayRes['HL'][]= array("y" => $resz['y'], "label" => $resz['label'] );
                                

                        }

                        foreach ($arrayAwal['PL'] as $resz){
                             
                                     $arrayRes['PL'][]= array("y" => $resz['y'], "label" => $resz['label'] );
                                    

                        }



                

                 

            $dataPoints =  $arrayRes;


            $response = array(
                        'success' => 'true', 
                        'dataPoints' => $dataPoints ,
                        'messages' => 'Data Didapatkan !'
                    );

        }


    if($tipe == 'totalall'){

        $arrayRes = array(); 
        
        $results = $this->Model_statistic->catchCompMonthSqlAll( $tahun );


         foreach($results->result() as $res) {


                $yft = isset($res->total_yft) ? $res->total_yft :  0;
                $bet = isset($res->total_bet) ? $res->total_bet :  0;
                $skj = isset($res->total_skj) ? $res->total_skj :  0;
                $bycatch  =  isset($res->total_bycatch) ? $res->total_bycatch :  0;
                $ikanhilang =  isset($res->total_ikanhilang) ? $res->total_ikanhilang :  0;

                $arrayRes[] = array("y" => $yft, "label" => 'YFT');
                $arrayRes[] = array("y" => $bet, "label" => 'BET');
                $arrayRes[] = array("y" => $skj, "label" => 'SKJ');
                $arrayRes[]= array("y" => $bycatch, "label" => 'Hilang');
                $arrayRes[]  = array("y" => $ikanhilang, "label" => 'Bycatch');

        }

        $dataPoints =  $arrayRes;

             $response = array(
                        'tahun' => $tahun , 
                        'dataPoints' => $dataPoints ,
                        'success' => 'true', 
                        'messages' => 'Data Didapatkan !'
                    );
      
    }


     if($tipe == 'totalallbar'){


        $arrayRes = array(); 

        $results = $this->Model_statistic->totalallbar();
        

         foreach($results->result() as $res) {

                $yft = isset($res->total_yft) ? $res->total_yft :  0;
                $bet = isset($res->total_bet) ? $res->total_bet :  0;
                $skj = isset($res->total_skj) ? $res->total_skj :  0;
                $bycatch  =  isset($res->total_bycatch) ? $res->total_bycatch :  0;
                $ikanhilang =  isset($res->total_ikanhilang) ? $res->total_ikanhilang :  0;
            
                $arrayRes['YFT'][] = array("y" => $yft, "label" => $res->tahun);
                $arrayRes['BET'][] = array("y" => $bet, "label" => $res->tahun);
                $arrayRes['SKJ'][]  = array("y" => $skj, "label" => $res->tahun);
                $arrayRes['HILANG'][] = array("y" => $bycatch, "label" =>$res->tahun);
                $arrayRes['BYCATCH'][]  = array("y" => $ikanhilang, "label" => $res->tahun);

            }


        $dataPoints =  $arrayRes;

        $response = array(
                        'dataPoints' => $dataPoints ,
                        'success' => 'true', 
                        'messages' => 'Data Didapatkan !'
                    );
     }


     if($tipe == 'vessel'){

        $arrayRes = array(); 

        $results = $this->Model_statistic->vessel();
        
        foreach($results->result() as $res) {
             $arrayRes[] = array("y" => $res->total, "label" => $res->jenis_alat);
        }

        $dataPoints =  $arrayRes;


        $response = array(
                        'dataPoints' => $dataPoints ,
                        'success' => 'true', 
                        'messages' => 'Data Didapatkan !'
                    );
     }


      


        echo json_encode($response,JSON_NUMERIC_CHECK); 
    }





}