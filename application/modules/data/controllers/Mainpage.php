<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Mainpage extends CI_Controller {



    public function __construct(){

        parent::__construct();

        $this->load->model('Model_data');

        $this->load->library('upload');

        $this->load->helper(array('form', 'url'));

    }



    public function upload(){

        $this->auth->check_login();

        if(!$this->auth->hasPrivilege("ViewUpload")){

            redirect('home','refresh');

        }


        $data['button_upload']='<div class="alert alert-warning">
                                      <strong>Warning!</strong> You are not authorize to Upload Unloading Data.
                                    </div>';
        if($this->auth->hasPrivilege("AddUpload")){      

          $data['button_upload']=' <div><center> <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#myModal" >Upload Unloading Document</button> </center></div>';

        }

        
        $user = $this->auth->get_data_session();

        $data['url_uploadUnloading']=base_url()."data/mainpage/uploadUnloading";

        $data['url_uploadUnloadingExsist']=base_url()."data/mainpage/uploadUnloadingExsist";
        
        $data['content']="data/upload";

        $this->load->view('template-admin/template',$data);

    }






    public function lists(){

        $this->auth->check_login();

        if(!$this->auth->hasPrivilege("ViewList")){

            redirect('home','refresh');

        }


        $data['url_load_table'] = base_url()."data/mainpage/listUploadByUser/";

        $user = $this->auth->get_data_session();

        $data['content']="data/lists";

        $this->load->view('template-admin/template',$data);

    }


    public function listUploadByUser($year = null ){

        $this->auth->restrict_ajax_login();

        $user = $this->auth->get_data_session();

        $id_user  = $user->id_user;

        if($year == ''){
  
            $year = date('Y');
  
        }

        $query = $this->Model_data->get_all_unloading($id_user , $year);

        $result = array();

         foreach($query->result() as $row){

            $SupplierData = $this->global_model->general_select2('master_supplier',array('id_supplier'=> $row->id_supplier ),'row','nama_perusahaan','');
            $VesselData = $this->global_model->general_select2('master_vessel',array('id_vessel'=> $row->id_vessel ),'row','nama_kapal','');

              $result['data'][]=array(


                     $row->kode_upload  ,
                     $row->kode_trip ,
                     $SupplierData->nama_perusahaan ,
                     $VesselData->nama_kapal ,
                     $row->nama_kapal ,
                     $row->pelabuhan_pangkalan ,
                     $row->tipe ,
                     $row->tahun ,
                     $row->bulan ,
                     $row->tanggal_berangkat ,
                     $row->tanggal_kembali ,
                     $row->urut  ,
                     $row->total_tangkapan ,
                     $row->yft ,
                     $row->bet ,
                     $row->skj ,
                     $row->kaw ,
                     $row->bycatch ,
                     $row->loin_kotor ,
                     $row->loin_bersih ,
                     $row->jumlah_loin ,
                     $row->lainnya ,
                     $row->ikanhilang ,
                     $row->etp ,
                     $row->wpp_penangkapan ,
                     $row->jenis_solar ,
                     $row->jumlah_solar ,
                     $row->es ,
                     $row->uang_trip ,
                     $row->catch_certificate ,
                     $row->namafile ,
                     $row->total_loin ,
                     $row->pengguna ,
                     $row->date_upload ,
                     $row->rumpon 


                );


         }


          echo json_encode($result);
    
    }



    public function uploadUnloading(){

    $validator = array();
        
    $this->load->library('excel');

        if(!empty($_FILES['file']['name'])){

            $namafile = $_FILES['file']['name'];
            if( move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/unloadings/' . $namafile) ) {
                

            //check if namafile match with the tanggal bulan tahun tipe kode supplier  && check if data already submit 
               $checkNamafile = $this->checkNamafile($namafile);
            

               $success = TRUE ;
               $messages = 'Behasil melakukan upload ke directory';
               $validator['validator'] = $checkNamafile;

               if( empty($validator['validator'])  ){

                    //insert to database directly
                       $validator['statusInsert']  = $this->insertExcell($namafile);

               }else{

                    if(count($validator['validator']['excellCheck']) == 1 ){

                        if($validator['validator']['excellCheck'][0]['act'] == 'Exist'){

                            $validator['validator']['excellCheck'][0]['namafile'] = $namafile;
                        }

                    }
               }

            }
        }else {

               $success = FALSE ;
               $messages = 'Please choose file first!';
        
        }
            

        $validator['success'] = $success;
        $validator['messages'] = $messages;


        echo json_encode($validator);


    }


    public function getIdSupp($kodeName=""){

        
        $getIdSupp = $this->global_model->getIdSupp($kodeName);

         if (isset($getIdSupp)){

            return $getIdSupp->id_supplier; 

         }else{


            return 0;
         }
        

    }


    public function checkNamafile($namafile){

       $notification = array();  

       $supplierData = array();

       $user = $this->auth->get_data_session();

        $this->load->library('excel');

        $inputFileName  = 'uploads/unloadings/'.$namafile;

        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        $sheet = $objPHPExcel->getSheet(0); 

        //CHECK PENAMAAN NAMAFILE OUTSIDE 
        $checkName = explode("_",$namafile);

        $isTrueForUpload=0;
        
        if(count($checkName) == 4  ){

            $TipeName = $checkName[0];
            $OrgName = $checkName[1];
            $SupplierKode = $checkName[2];
            $kodeDate = explode(".", $checkName[3]);
            $kodeDate = $kodeDate[0];

               //check if the user allowed to upload selected supplier data
               if(count($user->list_supp) > 0){
                   
                    $idSupp =  $this->getIdSupp($SupplierKode); 

                    if($idSupp > 0 ){

                            if (in_array($idSupp, $user->list_supp )) {

                                     $isTrueForUpload=1;

                            }
                    
                    }
                
                }
                else
                {

                    $isTrueForUpload=1;
                
                }
              //check if the user allowed to upload selected supplier data

        }else{
            $notification['excellCheck'][] = array( 'notif' =>'Format Nama Salah' , 'act' => 'Bad');
        }

        $sheetUnloading = $objPHPExcel->getSheetByName('Unloading');
        $sheetDataKapal = $objPHPExcel->getSheetByName('Kapal');
        
        if(!empty($sheetUnloading) && !empty($sheetDataKapal) && count($checkName) == 4 && $isTrueForUpload > 0 ){

            $get_sheetDataUnloading=$sheetUnloading->toArray(null,true,true,true);
              
            $get_sheetDataKapal=$sheetDataKapal->toArray(null,true,true,true);
            $get_sheetDataKapal[1]["A"] ? : "" ;

            $tipe           = $get_sheetDataUnloading[6]["B"] ? : "" ;
            $supplierName   = $get_sheetDataUnloading[3]["B"] ? : "" ;
            $month          = $get_sheetDataUnloading[4]["B"] ? : "" ;
            $year           = $get_sheetDataUnloading[5]["B"] ? : "" ;

            //CHECK PENAMAAN NAMAFILE OUTSIDE VS INSIDE 
            if($tipe != "" && $supplierName != "" && $month != "" && $year !=""){
               
                $supplierData = $this->global_model->general_select2('master_supplier',array('nama_perusahaan'=> $supplierName ),'row','','');
                
                if(count($supplierData) > 0){


                $kodeName = $supplierData->kode_name;

                $monthNumber = $this->global_model->getMonth($month , 'monthToNumber'); 

                
                $date = $year.''.sprintf("%02s", $monthNumber );
                
            

                    if($TipeName != $tipe ||  $SupplierKode != $kodeName || $kodeDate != $date ){
                         

                        $notification['excellCheck'][] = array( 'notif' =>'penamaan tidak sama antara nama template dan data di excell' , 'act' => 'Bad');

                    }


                    $checkUnloading = $this->global_model->general_select2('ap2hi_boat_unload',array('id_supplier'=> $supplierData->id_supplier , 'bulan'=> $monthNumber , 'tahun' => $year ),'row','','');

                     if(count($checkUnloading) > 0){

                        $notification['excellCheck'][] = array( 'notif' =>'Data Sudah pernah Masuk ' , 'act' => 'Exist');

                     }

                }else{

                    $notification['excellCheck'][] = array( 'notif' =>'Supplier Code Tidak Ditemukan ' , 'act' => 'Bad');

                }

            }else{
                $notification['excellCheck'][] = array( 'notif' =>'File ada data yang kosong!' , 'act' => 'Bad');
            }


    }else{

    
        $notification['excellCheck'][] = array( 'notif' =>'Template format lain atau anda tidak berhak melakukan upload! !' , 'act' => 'Bad');

    }



         return $notification ;

    }


    public function insertExcell($namafile){

        $result = array(); 
        $data = array();

        $this->load->library('excel');
        $user = $this->auth->get_data_session();
        $id_user = $user->id_user;


        $inputFileName  = 'uploads/unloadings/'.$namafile;

        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        
        $sheet = $objPHPExcel->getSheetByName('Unloading');
        $highestRow = $sheet->getHighestRow(); 
        $highestColumn = $sheet->getHighestColumn();
        $get_sheetDataUnloading=$sheet->toArray(null,true,true,true);


        $tipe           = $get_sheetDataUnloading[6]["B"] ? : "" ;
        $supplierName   = $get_sheetDataUnloading[3]["B"] ? : "" ;
        $month          = $get_sheetDataUnloading[4]["B"] ? : "" ;
        $year           = $get_sheetDataUnloading[5]["B"] ? : "" ;    

        $monthNumber = $this->global_model->getMonth($month , 'monthToNumber');    
        $monthExcell = sprintf("%02s", $monthNumber );

        $supplierData = $this->global_model->general_select2('master_supplier',array('nama_perusahaan'=> $supplierName ),'row','','');
        
         

        if($tipe == 'PL'){

             $sheetUmpan = $objPHPExcel->getSheetByName('Umpan');
             $highestRowUmpan = $sheetUmpan->getHighestRow(); 
             $highestColumnUmpan = $sheetUmpan->getHighestColumn();
             $get_sheetDataUmpan=$sheetUmpan->toArray(null,true,true,true);


             $i = 1;
                 for ($row = 13; $row <= $highestRow; $row++){



                    $urut           = $get_sheetDataUnloading[$row]["A"] ? : "" ;
                    $nama_kapal     = $get_sheetDataUnloading[$row]["C"] ? : "" ;
                    $tglBerangkat   = $get_sheetDataUnloading[$row]["D"] ? : "" ;
                    $tglKembali     = $get_sheetDataUnloading[$row]["E"] ? : "" ;

                    if( $urut != "" &&  $nama_kapal != "" &&  $tglBerangkat != "" && $tglKembali ){


                        $vesselData = $this->global_model->general_select2('master_vessel',array('nama_kapal'=> strtoupper( $nama_kapal ) , 'id_supplier' => $supplierData->id_supplier ),'row','','');
                        
                        $tglBerangkat   = explode("-", $tglBerangkat);
                        $tglKembali     = explode("-", $tglKembali);

                         if( (count($vesselData) > 0) && (count($tglBerangkat) == '3' ) && (count($tglKembali) == '3' ) && ( $tglBerangkat[0] == $year) && ( $tglKembali[0] == $year) && ( $tglBerangkat[1] == $monthExcell ) /*&& ( $tglKembali[1] == $monthExcell )*/   ){

                                $kodeUpload    = $supplierData->kode_name.'_'.$year.''.$monthExcell;  
                                $kodeTrip = $kodeUpload.''.$tglBerangkat[2].'_'.$vesselData->id_vessel;   

                                  $data['kode_upload'] = $kodeUpload ; 
                                  $data['kode_trip'] = $kodeTrip ; 
                                  $data['id_supplier'] = $supplierData->id_supplier ; 
                                  $data['id_vessel'] = $vesselData->id_vessel;
                                  $data['nama_kapal'] = strtoupper($get_sheetDataUnloading[$row]["C"]) ? : "" ;
                                  $data['pelabuhan_pangkalan'] = $get_sheetDataUnloading[$row]["B"] ? : "" ;
                                  $data['tipe'] = 'PL';
                                  $data['tahun'] = $year ; 
                                  $data['bulan'] = $monthNumber ;
                                  $data['tanggal_berangkat'] = $get_sheetDataUnloading[$row]["D"] ? : "" ;
                                  $data['tanggal_kembali'] = $get_sheetDataUnloading[$row]["E"] ? : "" ;
                                  $data['urut'] = $i;
                                  $data['yft'] = $get_sheetDataUnloading[$row]["F"] ? : "0" ;
                                  $data['bet'] = $get_sheetDataUnloading[$row]["G"] ? : "0" ;
                                  $data['skj'] = $get_sheetDataUnloading[$row]["H"] ? : "0" ;
                                  $data['kaw'] = $get_sheetDataUnloading[$row]["I"] ? : "0" ;
                                  $data['bycatch'] =  $get_sheetDataUnloading[$row]["J"] ? : "0" ;
                                  $data['loin_kotor'] =  "0" ;
                                  $data['loin_bersih'] = "0" ;
                                  $data['jumlah_loin'] =  "0" ;
                                  $data['lainnya'] = "0" ;
                                  $data['ikanhilang'] = $get_sheetDataUnloading[$row]["K"] ? : "0" ;
                                  $data['etp'] = $get_sheetDataUnloading[$row]["L"] ? : "" ;
                                  $data['wpp_penangkapan'] = $get_sheetDataUnloading[$row]["M"] ? : "" ; 
                                  $data['jenis_solar'] =  "" ;
                                  $data['jumlah_solar'] = $get_sheetDataUnloading[$row]["N"] ? : "0" ;
                                  $data['es'] = $get_sheetDataUnloading[$row]["O"] ? : "0" ;
                                  $data['uang_trip'] = $get_sheetDataUnloading[$row]["P"] ? : "0" ;
                                  $data['catch_certificate'] = $get_sheetDataUnloading[$row]["Q"] ? : "0" ;
                                  $data['namafile'] = $namafile;
                                  $data['total_loin'] = "0" ;
                                  $data['pengguna'] = $id_user;
                                  $data['date_upload'] = date('Y-m-d h:i:s');
                                  $data['rumpon'] = $get_sheetDataUnloading[$row]["R"] ? : "" ;
                                  $data['total_tangkapan'] = ( $data['yft'] + $data['bet'] + $data['skj'] + $data['kaw']  + $data['bycatch']  ) -  $data['ikanhilang'] ;

                                  $insertUnloading = $this->Model_data->insertBoatUnload($data); 

                  $insertUnloadingUmpan  = FALSE; 

                                  //loop for search bait 
                                  for ($rowUmpan = 7 ; $rowUmpan <= $highestRowUmpan; $rowUmpan++){

                                    $noUrutUnloading = $get_sheetDataUmpan[$rowUmpan]["A"] ? : "0" ;
                                    $jenisUmpan = $get_sheetDataUmpan[$rowUmpan]["C"] ? : "" ;
                                    if($urut == $noUrutUnloading && $jenisUmpan !=""){
                                        

                                          $data['kode_trip'] = $kodeTrip ;
                                          $data['id_vessel'] = $vesselData->id_vessel;
                                          $data['tanggal_berangkat'] =  $get_sheetDataUmpan[$rowUmpan]["B"] ? : "" ;
                                          $data['jenis'] = $get_sheetDataUmpan[$rowUmpan]["C"] ? : "" ;
                                          $data['kondisi'] =   "" ;
                                          $data['jumlah_kg'] =  $get_sheetDataUmpan[$rowUmpan]["E"] ? : "0" ;
                                          $data['jumlah_ekor'] =  "0" ;
                                          $data['harga_beli'] =  $get_sheetDataUmpan[$rowUmpan]["F"] ? : "0" ;
                                          $data['asal'] =  $get_sheetDataUmpan[$rowUmpan]["G"] ? : "0" ;
                                          $data['daerah_penangkapan'] =  $get_sheetDataUmpan[$rowUmpan]["H"] ? : "" ;
                                          $data['jumlah_ember'] = $get_sheetDataUmpan[$rowUmpan]["D"] ? : "" ;;

                                          $insertUnloadingUmpan = $this->Model_data->insertUnloadingUmpan($data); 


                                    }

                                  }
                                   //End loop for search bait


                                    if($insertUnloading && $insertUnloadingUmpan ){
                                        $result['excellInsert'][] = array ('notif' =>'Row No '.$row.' Sukses dalam input kedalam Database!' , 'act' => 'Good');
                                        $i ++ ;  
                                    }elseif($insertUnloading && $insertUnloadingUmpan == False ){
                                       $result['excellInsert'][] = array ('notif' =>'Row No '.$row.' Warning, data berhasil input tanpa detail umpan!' , 'act' => 'Warning');
                                        $i ++ ;  
                                    }
                                    else{
                                        $result['excellInsert'][] = array ('notif' =>'Row No '.$row.' Gagal dalam input kedalam Database!' , 'act' => 'Bad');
                                        $i ++ ;  
                                    }



                         }else{

                             $result['excellInsert'][] = array ('notif' =>'Row No '.$row.' Kesalahan dalam input nama kapal atau tanggal ' , 'act' => 'Bad');

                        }



                    }else{

                         $result['excellInsert'][] = array ('notif' =>'Row No '.$row.' Tidak Lengkap' , 'act' => 'Bad');


                    }
             

            }       



        }

        else if($tipe == 'HL'){
                 $i = 1;
                 for ($row = 14; $row <= $highestRow; $row++){


                    $urut           = $get_sheetDataUnloading[$row]["A"] ? : "" ;
                    $nama_kapal     = $get_sheetDataUnloading[$row]["C"] ? : "" ;
                    $tglBerangkat   = $get_sheetDataUnloading[$row]["D"] ? : "" ;
                    $tglKembali     = $get_sheetDataUnloading[$row]["E"] ? : "" ;

                    if( $urut != "" &&  $nama_kapal != "" &&  $tglBerangkat != "" && $tglKembali ){


                        $vesselData = $this->global_model->general_select2('master_vessel',array('nama_kapal'=> strtoupper( $nama_kapal ) , 'id_supplier' => $supplierData->id_supplier ),'row','','');
                        
                        $tglBerangkat   = explode("-", $tglBerangkat);
                        $tglKembali     = explode("-", $tglKembali);

                        
                        if( (count($vesselData) > 0) && (count($tglBerangkat) == '3' ) && (count($tglKembali) == '3' ) && ( $tglBerangkat[0] == $year) && ( $tglKembali[0] == $year) && ( $tglBerangkat[1] == $monthExcell ) /*&& ( $tglKembali[1] == $monthExcell )*/   ){

                           $kodeUpload    = $supplierData->kode_name.'_'.$year.''.$monthExcell;  
                           $kodeTrip = $kodeUpload.''.$tglBerangkat[2].'_'.$vesselData->id_vessel;   

                              $data['kode_upload'] = $kodeUpload ; 
                              $data['kode_trip'] = $kodeTrip ; 
                              $data['id_supplier'] = $supplierData->id_supplier ; 
                              $data['id_vessel'] = $vesselData->id_vessel;
                              $data['nama_kapal'] = strtoupper($get_sheetDataUnloading[$row]["C"]) ? : "" ;
                              $data['pelabuhan_pangkalan'] = $get_sheetDataUnloading[$row]["B"] ? : "" ;
                              $data['tipe'] = 'HL';
                              $data['tahun'] = $year ; 
                              $data['bulan'] = $monthNumber ;
                              $data['tanggal_berangkat'] = $get_sheetDataUnloading[$row]["D"] ? : "" ;
                              $data['tanggal_kembali'] = $get_sheetDataUnloading[$row]["E"] ? : "" ;
                              $data['urut'] = $i; 
                              $data['total_tangkapan'] = $get_sheetDataUnloading[$row]["F"] ? : "0" ;
                              $data['yft'] = $get_sheetDataUnloading[$row]["G"] ? : "0" ;
                              $data['bet'] = $get_sheetDataUnloading[$row]["H"] ? : "0" ;
                              $data['skj'] = "0" ;
                              $data['kaw'] = "0" ;
                              $data['bycatch'] =  $get_sheetDataUnloading[$row]["J"] ? : "0" ;
                              $data['loin_kotor'] = $get_sheetDataUnloading[$row]["K"] ? : "0" ;
                              $data['loin_bersih'] = $get_sheetDataUnloading[$row]["L"] ? : "0" ;
                              $data['jumlah_loin'] = $get_sheetDataUnloading[$row]["M"] ? : "0" ;
                              $data['lainnya'] = $get_sheetDataUnloading[$row]["I"] ? : "0" ;
                              $data['ikanhilang'] = "0";
                              $data['etp'] = $get_sheetDataUnloading[$row]["O"] ? : "" ;
                              $data['wpp_penangkapan'] = $get_sheetDataUnloading[$row]["P"] ? : "" ; 
                              $data['jenis_solar'] = $get_sheetDataUnloading[$row]["Q"] ? : "" ;
                              $data['jumlah_solar'] = $get_sheetDataUnloading[$row]["R"] ? : "0" ;
                              $data['es'] = $get_sheetDataUnloading[$row]["S"] ? : "0" ;
                              $data['uang_trip'] = $get_sheetDataUnloading[$row]["T"] ? : "0" ;
                              $data['catch_certificate'] = "";
                              $data['namafile'] = $namafile;
                              $data['total_loin'] = $get_sheetDataUnloading[$row]["N"] ? : "0" ;
                              $data['pengguna'] = $id_user;
                              $data['date_upload'] = date('Y-m-d h:i:s');
                              $data['rumpon'] = $get_sheetDataUnloading[$row]["AB"] ? : "" ;

                              $insertUnloading = $this->Model_data->insertBoatUnload($data); 

                $insertUnloadingUmpan  = FALSE; 
                 
                              if($get_sheetDataUnloading[$row]["U"] != ""){

                                  $data['kode_trip'] = $kodeTrip ;
                                  $data['id_vessel'] = $vesselData->id_vessel;
                                  $data['tanggal_berangkat'] =  $get_sheetDataUnloading[$row]["D"] ? : "" ;
                                  $data['jenis'] = $get_sheetDataUnloading[$row]["U"] ? : "" ;
                                  $data['kondisi'] =  $get_sheetDataUnloading[$row]["V"] ? : "" ;
                                  $data['jumlah_kg'] =  $get_sheetDataUnloading[$row]["W"] ? : "0" ;
                                  $data['jumlah_ekor'] =  $get_sheetDataUnloading[$row]["X"] ? : "0" ;
                                  $data['harga_beli'] =  $get_sheetDataUnloading[$row]["Y"] ? : "0" ;
                                  $data['asal'] =  $get_sheetDataUnloading[$row]["Z"] ? : "0" ;
                                  $data['daerah_penangkapan'] =  $get_sheetDataUnloading[$row]["AA"] ? : "" ;
                                  $data['jumlah_ember'] = "0";

                                  $insertUnloadingUmpan = $this->Model_data->insertUnloadingUmpan($data); 

                                }

                                if($insertUnloading && $insertUnloadingUmpan ){
                                        $result['excellInsert'][] = array ('notif' =>'Row No '.$row.' Sukses dalam input kedalam Database!' , 'act' => 'Good');
                                        $i ++ ;  
                                    }elseif($insertUnloading && $insertUnloadingUmpan == False ){
                                       $result['excellInsert'][] = array ('notif' =>'Row No '.$row.' Warning, data berhasil input tanpa detail umpan!' , 'act' => 'Warning');
                                        $i ++ ;  
                                    }
                                    else{
                                        $result['excellInsert'][] = array ('notif' =>'Row No '.$row.' Gagal dalam input kedalam Database!' , 'act' => 'Bad');
                                        $i ++ ;  
                                    }


                        }else{

                             $result['excellInsert'][] = array ('notif' =>'Row No '.$row.' Kesalahan dalam input nama kapal atau tanggal ' , 'act' => 'Bad');

                        }
                        


                    }else{


                         $result['excellInsert'][] = array ('notif' =>'Row No '.$row.' Tidak Lengkap' , 'act' => 'Bad');

                    }   
                    

                 }



        }else {


            $result['excellInsert'][] = array ('notif' =>'Terjadi kesalahan' , 'act' => 'Bad');


        }


        return $result; 
    }



    public function uploadUnloadingExsist(){

        $result = array();

        //delete data first 
        $namafile = $_POST['namafile'];
        $checkName = explode("_",$namafile);


        if(count($checkName) == 4  ){

            $TipeName = $checkName[0];
            $OrgName = $checkName[1];
            $SupplierKode = $checkName[2];
            $kodeDate = explode(".", $checkName[3]);
            $kodeDate = $kodeDate[0];
        
            $result['statusDelete']  = $this->Model_data->deleteUnloading($SupplierKode.'_'.$kodeDate) ;

        }

        $result['statusInsert']  = $this->insertExcell($namafile);

        $result['messages'] = $_POST['namafile'];


        echo json_encode($result);

    }   




    public function samplingupload(){

       $this->auth->check_login();

        if(!$this->auth->hasPrivilege("ViewUploadSampling")){

            redirect('home','refresh');



        }

        $data['button_add']= '<div><center> <a type="button" class="btn btn-success a-btn-slide-text" href="'.base_url().'sampling/mainpage/add_trip_choice">   <span class="fa fa-plus-square" aria-hidden="true"></span> Add New</a> </center></div>'  ; 


        $user = $this->auth->get_data_session();


        $notification = array() ; 

        $status = "";

        $this->load->library('excel');

        if(!empty($_FILES['file']['name'])){

            $namafile = $_FILES['file']['name'];
            if( move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/samplings/' . $namafile) ) {
                      
                $inputFileName  = 'uploads/samplings/'.$namafile;

                //CHECK EXSISIT 
                $is_exsist = $this->Model_data->checkSamplingExsist($namafile); 

                if($is_exsist > 0 ){
                  $notification[] = "Data Sudah Pernah Diupload" ; 
                  $status = 'error'; 
                }else{
                  $notification = $this->uploadSampling_v2($inputFileName , $namafile ); 
                  if(count($notification) > 0){
                    $status = 'error'; 
                  }else{
                    $status = 'success'; 
                  }
                }

                
          } 

        }


        $data['status'] = $status; 

        $data['notification'] = $notification; 

        $data['url_samplingupload']=base_url()."data/mainpage/samplingupload";

        $data['content']="data/samplingupload";

        $this->load->view('template-admin/template',$data);


    }


    public function uploadSampling_v2($inputFileName , $namafile){

         $user = $this->auth->get_data_session();
       $id_user = $user->id_user;
       
            //INISIALISASI KALKULASI 
              $var_a='0.0193';
              $var_b='2.984';
              $var_v='1.259';
              $var_k='28.4';

            //INISIALISASI KALKULASI KECIL 
              $var_a_yft_kecil = '0.000136';
              $var_b_yft_kecil = '2.51';
              $var_a_bet_kecil = '0.000013';
              $var_b_bet_kecil = '3.12';
              $var_a_skj_kecil = '0.0000225';
              $var_b_skj_kecil = '2.97';


              $bulan_arr = array( 'Januari' , 'Februari' , 'Maret' , 'April' , 'Mei' , 'Juni' , 'Juli' , 'Agustus' , 'September' , 'Oktober' , 'November' , 'Desember') ; 

           $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);

                $sheet = $objPHPExcel->getSheetByName('1-kapal');
                $highestRow = $sheet->getHighestRow(); 
                $highestColumn = $sheet->getHighestColumn();
                $get_sheetLanding=$sheet->toArray(null,true,true,true);

                $sheet = $objPHPExcel->getSheetByName('2-umpan');
                $highestRowUmpan = $sheet->getHighestRow(); 
                $highestColumnUmpan = $sheet->getHighestColumn();
                $get_sheetUmpan=$sheet->toArray(null,true,true,true);

                $sheet = $objPHPExcel->getSheetByName('3-tangkapan lain');
                $highestRowBycatch = $sheet->getHighestRow(); 
                $highestColumnBycatch = $sheet->getHighestColumn();
                $get_sheetBycatch=$sheet->toArray(null,true,true,true);


                $sheet = $objPHPExcel->getSheetByName('4- Tuna < 10kg');
                $highestRowSmall = $sheet->getHighestRow(); 
                $highestColumnSmall = $sheet->getHighestColumn();
                $get_sheetSmall=$sheet->toArray(null,true,true,true);


                $sheet = $objPHPExcel->getSheetByName('5- Tuna > 10kg');
                $highestRowLarge = $sheet->getHighestRow(); 
                $highestColumnLarge = $sheet->getHighestColumn();
                $get_sheetLarge=$sheet->toArray(null,true,true,true);


                $sheet = $objPHPExcel->getSheetByName('6-deskripsi');
                $highestRowDesc = $sheet->getHighestRow(); 
                $highestColumnDesc = $sheet->getHighestColumn();
                $get_sheetDesc=$sheet->toArray(null,true,true,true);


                $sheet = $objPHPExcel->getSheetByName('7-etp');
                $highestRowEtp = $sheet->getHighestRow(); 
                $highestColumnEtp = $sheet->getHighestColumn();
                $get_sheetEtp=$sheet->toArray(null,true,true,true);


                $sheet = $objPHPExcel->getSheetByName('param');
                $highestRowParam = $sheet->getHighestRow(); 
                $highestColumnParam = $sheet->getHighestColumn();
                $get_sheetParam=$sheet->toArray(null,true,true,true);


                $sheet = $objPHPExcel->getSheetByName('param1');
                $highestRowParam1 = $sheet->getHighestRow(); 
                $highestColumnParam1 = $sheet->getHighestColumn();
                $get_sheetParam1 =$sheet->toArray(null,true,true,true);


                $sheet = $objPHPExcel->getSheetByName('param2');
                $highestRowParam2 = $sheet->getHighestRow(); 
                $highestColumnParam2= $sheet->getHighestColumn();
                $get_sheetParam2=$sheet->toArray(null,true,true,true);

    
                $versi = $get_sheetParam[3]["AW"] ? : "";

            
              
          //Inisialisasi Awal Start

                $tipe=  $get_sheetParam[3]["AV"] ? : "";

                $notification = array();

                $n_landing = $get_sheetLanding[5]["A"] ? : "" ;
                  if($n_landing == ''){
            
                    $notification[]='Tempat Pendaratan di form tidak boleh kosong!';
                    
                  }else{
            
                    $landingData = $this->global_model->general_select2('master_landing',array('nama_landing'=> $n_landing ),'row','id_landing','');
                    $k_landing = $landingData->id_landing; 
                  
                }

                $n_perusahaan = $get_sheetLanding[5]["D"] ? : "" ;
                  if($n_perusahaan == ''){
                      $notification[]='Perusahaan di form tidak boleh kosong!';
                    }
                  else{
                   
                    $suppData = $this->global_model->general_select2('master_supplier',array('nama_perusahaan'=> $n_perusahaan ),'row','id_supplier','');
                    $k_perusahaan = $suppData->id_supplier ; 
                  }


                $kapal = $get_sheetLanding[7]["A"] ? : "" ;
                  if($kapal == ''){
                    $notification[]='Nama Kapal di form tidak boleh kosong!';
                  }
                $kapten = $get_sheetLanding[7]["D"] ? : "" ;
                  if($kapten == ''){
                    $notification[]='Nama Kapten di form tidak boleh kosong!';
                  }
               
                $rumpon = $get_sheetLanding[7]["F"] ? : "" ;
                  if($rumpon == ''){
                    $notification[]='Rumpon di form tidak boleh kosong!';
                  }else{

                     
                      $ijek = $rumpon;
                      $find=3;
                      while ($find<=10)
                      {
                        $rumpon = $get_sheetParam[$find]["AH"] ? : "" ;  
                        if ($rumpon == $ijek)
                          {
                          $rumpon = $get_sheetParam[$find]["AG"] ? : "" ;  
                            break;
                          }
                        $find++;
                      }

                  }
                $tgl = $get_sheetLanding[9]["A"] ? : "" ;
                  if($tgl == ''){
                    $notification[]='Tanggal di form tidak boleh kosong!';
                  }else{

                    $tgl =  sprintf("%02d", $tgl);

                  }
                $bln = $get_sheetLanding[9]["B"] ? : "" ;
                  if($bln == ''){
                    $notification[]='Bulan di form tidak boleh kosong!';
                  }else{

                    $no_bulan = array_search($bln, $bulan_arr);
                    $no_bulan = $no_bulan + 1 ; 
                    $no_bulan =  sprintf("%02d", $no_bulan);
                    $bulan =  $no_bulan ; 

                  }

                $thn = $get_sheetLanding[9]["C"] ? : "" ;
                  if($thn == ''){
                    $notification[]='Tahun di form tidak boleh kosong!';
                  }
                $jam = $get_sheetLanding[9]["D"] ? : "" ;
                  if($jam == ''){
                      $notification[]='Jam di form tidak boleh kosong!';
                    } 
                $menit = $get_sheetLanding[9]["E"] ? : "" ;
                  if($menit == ''){
                    $notification[]='Menit di form tidak boleh kosong!';
                  }
                $mnamafile=$k_landing.'_'.substr($thn,2,2).$no_bulan.$tgl.'_'.$jam.$menit.".xlsx"; 
      
               
                 if ($mnamafile != $namafile) 
                  {

                    $notification[] = "Penamaan File Tidak Sama Dengan Yang Tertera Pada Data Form!"; 

                  }

            //Inisialisasi Awal Ends
      
      
      
                  $griding = array();

                                  $grid11 = $get_sheetLanding[7]["L"] ? : "" ;
                                  $grid12 = $get_sheetLanding[7]["M"] ? : "" ;
                                  $grid21 = $get_sheetLanding[8]["L"] ? : "" ;
                                  $grid22 = $get_sheetLanding[8]["M"] ? : "" ;

                                  if($grid11 == '' || $grid12 == ''){
                                     $notification[] = 'Grid tidak boleh kosong ';
                                  }else{
                                    $griding[] = $grid11." - ".$grid12; 
                                    $griding[] = $grid21." - ".$grid22; 
                                  }

                                   $teknik_cari_tuna = '';



                                $ijek = 10;
                                for($i=0; $i < 2 ; $i++){
                                  $temp =  $get_sheetLanding[$ijek+ $i ]["L"] ? : "" ;
                                  if($temp !='')
                                  $teknik_cari_tuna .= $temp.",";
                                }

                                if($rumpon == 'X' || $rumpon == 'F'){
                                  $check = strpos($teknik_cari_tuna, 'Rumpon');
                                    if( $check  === false){
                                         $teknik_cari_tuna .= 'Rumpon,';
                                      }
                                }
                                if($rumpon == 'F') {
                                  $search = explode(',' , $teknik_cari_tuna );
                                  $jumlah = count($search);
                                
                                  if($jumlah > 2 ){
                                    $notification[] = 'Anda memilih Rumpon : semua Di Rumpon (F), Maka Teknik Pencarian Lokasi Tuna Harus Pilih Rumpon Saja !'; 
                                  }
                                }
                                if($rumpon == 'N'){
                                  $check = strpos($teknik_cari_tuna, 'Rumpon');
                                  if($check!== false){
                                    $notification[] = 'Anda memilih Rumpon : Tidak Di Rumpon (N), Maka Teknik Pencarian Lokasi Tuna Jangan Pilih Rumpon !';      
                                  }
                                }


                                 //cari no kapal 
                                $checks = array('id_supplier' => $k_perusahaan , 
                                    'nama_kapal' => $kapal , 
                                    'status' => 'active',
                                );
                                $checkCode = $this->Model_data->checkExisting('master_vessel' , $checks , "numRows");
                                $no_ap2hi = "";
                                if($checkCode > 0){
                                   $dataKapal = $this->Model_data->checkExisting('master_vessel' , $checks , "row");
                                   $no_ap2hi = $dataKapal->id_vessel ; 
                                }
                
                
                
                           //------------------------------INSERT TPS_PENDARATAN----------------------------
                      
                        $data['namafile'] = $namafile ; 
                        $data['k_landing'] = $k_landing ; 
                        $data['k_perusahaan'] = $k_perusahaan ; 
                        $data['enumerator1'] =  $get_sheetLanding[5]["F"] ? : "" ;
                        $data['enumerator2'] = $get_sheetLanding[5]["H"] ? : "" ;
                        $data['nama_kapal'] = $kapal ; 
                        $data['kapten_kapal'] = $kapten; 
                        $data['gt_kapal'] = $get_sheetLanding[9]["H"] ? : "0" ;
                        $data['panjang_kapal'] = $get_sheetLanding[9]["J"] ? : "0" ;
                        $data['mesin_kapal'] = $get_sheetLanding[9]["F"] ? : "0" ;
                        $data['bahan_kapal'] = $get_sheetLanding[11]["H"] ? : "" ;
                        $data['jum_awak'] = $get_sheetLanding[13]["F"] ? : "0" ;
                        $data['no_ap2hi'] = $no_ap2hi ; 
                        $data['grid1'] = $grid11 ; 
                        $data['grid2'] = $grid12 ; 
                        $data['total_penangkapan'] =  $get_sheetLanding[7]["H"] ? : "0" ;
                        $data['est_ikanhilang'] =  $get_sheetLanding[7]["J"] ? : "0" ;
                        $data['thn_sampling'] =  $get_sheetLanding[9]["C"] ? : "" ;
                        $data['bln_sampling'] =  $bulan;
                        $data['tgl_sampling'] =  $get_sheetLanding[9]["A"] ? : "" ;
                        $data['jam_sampling'] = $get_sheetLanding[9]["D"] ? : "" ;
                        $data['mnt_sampling'] = $get_sheetLanding[9]["E"] ? : "" ;
                        $data['rumpon'] = $rumpon ; 
                        $data['teknik_cari_tuna'] = $teknik_cari_tuna ; 
                        $data['bbm'] = $get_sheetLanding[11]["J"] ? : "0" ;
                        $data['k_alattangkap'] = 'HL' ; 
                        $data['es'] = $get_sheetLanding[13]["J"] ? : "0" ;
                        $data['pengguna'] = $id_user ; 
                        $data['deskripsi'] = $get_sheetDesc[4]["A"] ? : "" ;
                        $data['lama_satuan'] = $get_sheetLanding[11]["E"] ? : "" ;
                        if($data['lama_satuan'] == 'hari'){
                          $data['lama_hari'] = $get_sheetLanding[11]["D"] ? : "0" ;
                          $data['lama_jam'] = "0" ;
                        }else if($data['lama_satuan'] == 'jam'){
                          $data['lama_jam'] = $get_sheetLanding[11]["D"] ? : "0" ;
                          $data['lama_hari'] = "0" ;
                        }
            
            if($tipe == 'HL'){
              
              $data['hl_tipe_mata_pancing'] = $get_sheetLanding[13]["L"] ? : "" ;
              $data['hl_alat_tangkap_lain'] = $get_sheetLanding[11]["G"] ? : "" ;
              $data['pl_jum_pancing'] = "0" ; 
              $data['pl_kapasitas_ember'] =  "0" ;
              $data['tipe'] = 'HL';               
            
            }
            
            if($tipe == 'PL'){
              
              $data['hl_tipe_mata_pancing'] = "" ;
              $data['hl_alat_tangkap_lain'] = $get_sheetLanding[11]["G"] ? : "" ;
              $data['pl_jum_pancing'] = $get_sheetLanding[13]["L"]; 
              $data['pl_kapasitas_ember'] = $get_sheetLanding[13]["H"];
              $data['tipe'] = 'PL'; 
              
            }
                       
                        $data['jumlah_hari_memancing'] =  $get_sheetLanding[13]["D"] ? : ""  ; 
                        $data['using_ringkasan_ikanbesar'] = "" ; 
                        $data['tgl_impor'] = date("Y-m-d") ; 
                        $data['jam_impor'] = date("H:i:s") ; 
                        
                        $data['e_pewawancara'] =  $get_sheetEtp[4]["C"] ? : "" ;
                        $data['e_umur'] = $get_sheetEtp[5]["C"] ? : "0" ;
                        $data['e_lama_tahun'] =$get_sheetEtp[6]["D"] ? : "0" ; 
                        $data['e_lama_bulan'] = $get_sheetEtp[6]["F"] ? : "0" ;
                        $data['e_jabatan'] =$get_sheetEtp[7]["D"] ? : "" ;
                        $data['e_keterangan'] =$get_sheetEtp[7]["H"] ? : "" ;
                        $data['total_bycatch'] = "0" ; 
                        $data['total_real_kecil'] = "0" ;  
                        $data['total_sampling_kecil'] = "0" ; 
                        $data['raising_factor'] = "0" ; 
                        $data['grid'] = json_encode($griding) ; 

                        $data['no_sipi'] = $get_sheetLanding[5]["L"] ? : "" ; 
                        $data['jumlah_rumpon_singgah'] = $get_sheetLanding[9]["K"] ? : "" ; 
                          $tgl = $get_sheetLanding[11]["A"] ? : "" ; 
                          $bln = $get_sheetLanding[11]["B"] ? : "" ; 
                              $no_bulan = array_search($bln, $bulan_arr);
                              $no_bulan = $no_bulan + 1 ; 
                              $no_bulan =  sprintf("%02d", $no_bulan);
                              $bln =  $no_bulan ; 
                          $thn = $get_sheetLanding[11]["C"] ? : "" ; 
                        $data['tanggal_berangkat'] = $thn.'-'.$bln.'-'.$tgl ;  
                          $tgl = $get_sheetLanding[13]["A"] ? : "" ; 
                          $bln = $get_sheetLanding[13]["B"] ? : "" ; 
                              $no_bulan = array_search($bln, $bulan_arr);
                              $no_bulan = $no_bulan + 1 ; 
                              $no_bulan =  sprintf("%02d", $no_bulan);
                              $bln =  $no_bulan ; 
                          $thn = $get_sheetLanding[13]["C"] ? : "" ; 
                        $data['tanggal_kembali'] = $thn.'-'.$bln.'-'.$tgl ;  
                        $data['jumlah_pakura'] = $get_sheetLanding[13]["H"] ? : "" ; 
                        $data['deskripsi_foto'] = $get_sheetDesc[4]["R"] ? : "" ; 
                        $data['ukuran_pancing'] = $get_sheetLanding[11]["F"] ? : "" ; 
                        

                         $this->Model_data->insertTripNew($data);
                



     /*//---------------------------INSERT TPS_UMPAN-------------------------------*/
     
     
     $x=5;
        $urut = 1;
        while($x<=11) 
        {
          $data['k_umpan'] = $get_sheetUmpan[$x]["A"] ? : ""  ;  
          if ($data['k_umpan']=="") 
          {
           break;
          }  
          $data['species'] = $get_sheetUmpan[$x]["B"] ? : ""  ;  
          $data['rumpon1'] = $get_sheetUmpan[$x]["C"] ? : ""  ;  
          $data['rumpon2'] = $get_sheetUmpan[$x]["D"] ? : ""  ;  
          $data['total'] = $get_sheetUmpan[$x]["E"] ? : "0"  ;  
          $data['estimasi'] = $get_sheetUmpan[$x]["F"] ? : "0"  ;  
          $malat = $get_sheetUmpan[$x]["G"] ? : ""  ;  
             if ($malat != "") 
              {
              $ijek = $malat;
              $find=3;
              while ($find<=50)
              {
                $malat = $get_sheetParam[$find]["AR"] ? : ""  ;   
                if ($malat == $ijek)
                {
                  $data['k_alattangkap'] = $get_sheetParam[$find]["AQ"] ? : ""  ;  
                  break;
                }
                $find++;
              }     
              }
        
      
      $data['domestic_import'] =  ""  ; 
         
         
            if($tipe=='HL'){
        $data['pl_pengadaan_umpan'] = "0" ;
        $data['pl_jum_ember'] =  '0';
        $data['hl_estimasi_ekor_umpan'] =  $get_sheetUmpan[$x]["E"] ? : ""  ; 
        
      }
      if($tipe =='PL'){
        $data['pl_pengadaan_umpan'] = "0" ;
        $data['pl_jum_ember'] =  $get_sheetUmpan[$x]["E"] ? : ""  ; 
        $data['hl_estimasi_ekor_umpan'] = "";
        
        
      }
      
            $data['urut'] = $urut ; 
            $this->Model_data->insertUmpan_v2($data);

          $x++;
          $urut++;
        }

     /*//---------------------------INSERT TPS_UMPAN-------------------------------*/

  
    /* INSERT TPS_BYCATCH */
        $x=5;
        $totalb_bycatch = 0; //TOTAL BERAT tangkapan lain
        while($x<=13) 
        {
          $no =  $get_sheetBycatch[$x]["A"] ? : ""  ;  
          if ($no=="") 
          {
          //break;
          }else{  
            $species = $get_sheetBycatch[$x]["B"] ? : ""  ; 
            if ($species != "") 
            {
            $ijek = $species;
            $kon=3;
            while ($kon<=100)
            {
              $species = $get_sheetParam[$kon]["U"] ? : ""  ;   
              if ($species == $ijek)
              {
                $data['k_species'] = $get_sheetParam[$kon]["T"] ? : ""  ;
                break;
              }
              $kon++;
            }     
            }
            $data['panjang'] = $get_sheetBycatch[$x]["C"] ? : "0"  ; 
            $data['berat'] = $get_sheetBycatch[$x]["E"] ? : "0"  ; 
      $data['kode_panjang'] = $get_sheetBycatch[$x]["D"] ? : ""  ; 
            $estimasi = $get_sheetBycatch[$x]["F"] ? : ""  ;  
            $data['estimasi'] = strtoupper(substr($estimasi,0,1));
           
            $this->Model_data->insertBycatch_v2($data);

            $totalb_bycatch = $totalb_bycatch + $data['berat'];  //jumlahkan
          }
          $x++;
        }
        /* INSERT TPS_BYCATCH */
    
    
    
     /* INSERT FOR IKAN KECIL */
    
        $awal=5; $akhir=14; $awal1=18;
        $x=$awal;
        $totalb_ikankecil = 0; //TOTAL BERAT IKAN KECIL
        
        while($x<=$akhir) 
        {
          $data['kode'] = $get_sheetSmall[$x]["B"] ? : ""  ;  
          if ($data['kode'] != "") 
          {
                
              $data['deskripsi'] = $get_sheetSmall[$x]["C"] ? : ""  ;  
              $data['berat'] = $get_sheetSmall[$x]["F"] ? : "0"  ;  

              $this->Model_data->insertRingkasan($data , "tps_ringkasan_ikankecil"); 

              $totalb_ikankecil = $totalb_ikankecil + $data['berat'] ;  //JUMLAHKAN
          }
          $x++;
        }
    
    $x=$awal1;
      $i=0; $sw=0;
      $noker = 0;
      $noikan = 1;  
      $totalsamplingikankecil = 0;
      $total_yft_kecil = 0; $total_bet_kecil = 0; $total_skj_kecil = 0;
    $tmp = "";
    
   while($x<=217) 
      {
    
    $stat = 'N';
        $noker = $get_sheetSmall[$x]["A"] ? : "0"  ;  
    $beratkeranjang = $get_sheetSmall[$x]["B"] ? : "0"  ;  
        
        
        $kode = '-';
        if($beratkeranjang != 0){
          $totalsamplingikankecil = $totalsamplingikankecil + $beratkeranjang ; 
             if($noker != $tmp){
         
         $tmp = $noker  ; 
         $data['noker'] = $noker ; 
         $data['beratkeranjang'] = $beratkeranjang ; 
         $this->Model_data->insertKeranjang($data); 
         
             }

            
      
          $stat = 'Y';
        }
        
        if($stat == 'Y'){
          $noikan = 1;
        }
      
            $k_species = $get_sheetSmall[$x]["C"] ? : ""  ;
      $berat_sample = $get_sheetSmall[$x]["D"] ? : "0"  ; 
            $panjang = $get_sheetSmall[$x]["E"] ? : "0"  ; 
      $kode_panjang = $get_sheetSmall[$x]["F"] ? : "0"  ;
      $kondisi = $get_sheetSmall[$x]["G"] ? : "0"  ;
      
          if($k_species != ''){
            
            $kalkulasi_berat = 0;
            if($k_species == 'YFT'){
              $kalkulasi_berat = $var_a_yft_kecil * (pow($panjang , $var_b_yft_kecil )) ; 
              $kalkulasi_berat = number_format($kalkulasi_berat, 2);
              
              $total_yft_kecil = $total_yft_kecil + $kalkulasi_berat ; 
              $total_yft_kecil = number_format($total_yft_kecil  , 2); 
            }
            if($k_species == 'BET'){
              $kalkulasi_berat = $var_a_bet_kecil * (pow($panjang , $var_b_bet_kecil )) ; 
              $kalkulasi_berat = number_format($kalkulasi_berat, 2);
              
              $total_bet_kecil = $total_bet_kecil + $kalkulasi_berat ; 
              $total_bet_kecil = number_format($total_bet_kecil  , 2);
            }
            if($k_species == 'SKJ'){
              $kalkulasi_berat = $var_a_skj_kecil * (pow($panjang , $var_b_skj_kecil )) ; 
              $kalkulasi_berat = number_format($kalkulasi_berat, 2);
              
              $total_skj_kecil = $total_skj_kecil + $kalkulasi_berat ; 
              $total_skj_kecil = number_format($total_skj_kecil  , 2);
            }

            $data['k_species'] = $k_species ; 
            $data['panjang'] = $panjang ; 
            $data['noikan'] = $noikan ; 
            $data['kalkulasi_berat'] = $kalkulasi_berat ; 
			$data['berat_sample'] = $berat_sample ; 
			$data['kode_panjang'] = $kode_panjang ; 
			$data['kondisi'] = $kondisi ; 
            
            $this->Model_data->insertSmall_v2($data);
          }
          
          $stat = 'N';
          $noikan++;
          $x++;
  
    }
    
     //masukkan kalkulasi ke total_ikan_kecil
          $total_kalkulasi_ikankecil = $total_yft_kecil + $total_bet_kecil + $total_skj_kecil ; 
          if($total_yft_kecil > 0){
            
            $percen_yft =   ( $total_yft_kecil / $total_kalkulasi_ikankecil ) * 100  ; 
            $summary_yft = number_format($totalb_ikankecil * ($percen_yft / 100) , 2 , '.' , '') ;
            $data['total_xxx_kecil'] = $total_yft_kecil ; 
            $data['summary_xxx'] = $summary_yft ; 
            $data['species'] = 'YFT'; 

             $this->Model_data->insertTotalIkanKecil($data);
            
          }
          if($total_bet_kecil > 0){
            $percen_bet =   ( $total_bet_kecil / $total_kalkulasi_ikankecil ) * 100  ; 
            $summary_bet = number_format($totalb_ikankecil * ($percen_bet / 100) , 2 , '.' , '') ;
            $data['total_xxx_kecil'] = $total_bet_kecil ; 
            $data['summary_xxx'] = $summary_bet ; 
            $data['species'] = 'BET'; 

            $this->Model_data->insertTotalIkanKecil($data);
          
          }
          if($total_skj_kecil > 0){
            $percen_skj =   ( $total_skj_kecil / $total_kalkulasi_ikankecil ) * 100  ; 
            $summary_skj = number_format($totalb_ikankecil * ($percen_skj / 100) , 2 , '.' , '') ;
            $data['total_xxx_kecil'] = $total_skj_kecil ; 
            $data['summary_xxx'] = $summary_skj ; 
            $data['species'] = 'SKJ'; 

            $this->Model_data->insertTotalIkanKecil($data);
           
          }
        //end INSERT FOR IKAN KECIL
    


        /* INSERT IKAN BESAR*/
    
          $awal1=19;
          $awal=5; $akhir=14;  
          $x=$awal;
          $total_ringkasanBesar = 0;
          while($x<=$akhir) 
          {
            $data['kode'] = $get_sheetLarge[$x]["B"] ? : ""  ; 
            if ( $data['kode']  != "") 
            {
  

              $data['deskripsi'] = $get_sheetLarge[$x]["C"] ? : ""  ;  
              $data['berat'] = $get_sheetLarge[$x]["H"] ? : "0"  ;  

              $this->Model_data->insertRingkasan($data , "tps_ringkasan_ikanbesar"); 

            
            $totalBeratBesar =  $data['berat'] ;
            $total_ringkasanBesar = $total_ringkasanBesar + $totalBeratBesar ;
            }
            $x++;
          } 
          
          $kalk='';
          $x=$awal1;
          $k_kapalkecil = 0;
          $totalb_ikanbesar = 0; //TOTAL BERAT IKAN BESAR
          while($x<=219) 
          {
        
           $noikan = $get_sheetLarge[$x]["A"] ? : ""  ;   
            if ($noikan == "")
              {
              break;  
              }

                $no_ikan = $noikan ; 
                $k_species = $get_sheetLarge[$x]["B"] ? : ""  ;   
                $kode = ""  ;
                $berat = $get_sheetLarge[$x]["C"] ? : "0"  ; 
                $panjang= $get_sheetLarge[$x]["D"] ? : "0"  ; 
                $k_kapalkecil = 0 ;  
                $loin1_berat = $get_sheetLarge[$x]["F"] ? : "0"  ; 
                $loin1_panjang = $get_sheetLarge[$x]["G"] ? : "0"  ;
                $valid = ""  ; 
                $insang = $get_sheetLarge[$x]["H"] ? : "-"  ;
                $isi_perut= $get_sheetLarge[$x]["I"] ? : "-"  ;
                $daging_perut= $get_sheetLarge[$x]["J"] ? : "-"  ;
				$kode_panjang= $get_sheetLarge[$x]["E"] ? : "-"  ;
                      
               $t_b = $berat ; 
               $t_p = $panjang; 
               $brt = $berat ; 
               $pjg = $panjang ; 
               $l1_b = $loin1_berat ; 
               $l1_p = $loin1_panjang ; 
               $xyz1 = $insang ; 
               $xyz2 = $isi_perut ; 
               $xyz3 = $daging_perut ; 
                $xyz1 = substr($xyz1,0,1);
                $xyz2 = substr($xyz2,0,1);
                $xyz3 = substr($xyz3,0,1);
                
              if( $t_b == '0' && $t_p != '0' ){
                  
                  $pjg=$t_p;
                  $brt=pow($pjg, $var_b)*$var_a;
                  $t_p=round($pjg);
                  $t_b=round($brt/1000);
                  $kalk='Y';
                  
              }
              else if ($t_b == '0' && $l1_p != '0' )
                {
                  $pjg=0;
                    if ($l1_p != '0')
                  {
                    $pjg=$l1_p;
                  }

                      if ($pjg != 0)
                      {
                        
                        $pjg=$var_v*$pjg+$var_k;
                        
                        $brt=pow($pjg, $var_b)*$var_a;
                        $t_p=round($pjg);
                        $t_b=round($brt/1000);
                        $kalk='Y';
                      }           
                  
                }
               
                $data['no_ikan'] = $noikan ; 
                $data['k_species'] =$k_species ;   
                $data['kode'] = $kode ;
                $data['berat'] = $t_b;  
                $data['panjang']= $t_p ;  
                $data['k_kapalkecil'] = 0 ;  
                $data['loin1_berat'] = $loin1_berat;
                $data['loin1_panjang'] = $loin1_panjang ; 
                $data['valid'] = ""  ; 
                $data['insang'] = $xyz1;
                $data['isi_perut']= $xyz2;
                $data['daging_perut']= $xyz3;
                $data['kalkulasi'] = $kalk;
				$data['kode_panjang'] = $kode_panjang;				
              

                $this->Model_data->insertLarge_v2($data);

              $x++;
            $totalb_ikanbesar = $totalb_ikanbesar + $t_b; //jumlahkan semua berat ikan besar
          }

            //tambahan conversion
            if($kalk=='Y'){
                $totalcatch = ($totalb_ikanbesar + $totalb_ikankecil + $totalb_bycatch);
                
                $data['totalcatch'] = $totalcatch ; 
                //SATU
                $this->Model_data->konversiSatu($data);

              }else{
                $using_ringkasan_ikan_besar = "";
                if($totalb_ikanbesar == 0 && $total_ringkasanBesar > 0 ){
                  $using_ringkasan_ikan_besar = " , using_ringkasan_ikanbesar = 'Y' ";
                  $totalcatch = ($total_ringkasanBesar + $totalb_ikankecil + $totalb_bycatch);
                }else{
                  $totalcatch = ($totalb_ikanbesar + $totalb_ikankecil + $totalb_bycatch);
                }
                $data['totalcatch'] = $totalcatch; 
                $data['using_ringkasan_ikan_besar'] = $using_ringkasan_ikan_besar; 
                //DUA
               $this->Model_data->konversiDua($data); 
            //end tambahan conversion
        }
            
          /*  end INSERT IKAN BESAR*/


/* ETP */
    $x=10;
    $urut=0;
    $max = $highestRowEtp ; 
      while($x<=$max) 
      {
        $kelp =  $get_sheetEtp[$x]["A"] ? : ""  ;
        if ($kelp != "") 
        {
        $urut=$urut+1;
        $sql="INSERT INTO tps_etp(interaksi, namafile, urut, k_species, jml_interaksi, jml_didaratkan, est_interaksi,";
        $sql=$sql."est_didaratkan, d_1, d_2, d_3, d_4, d_5, td_1, td_2, td_3, td_4,";
        $sql=$sql."td_5, dibuang, dimakan, dijual, diumpan, tidak_tahu, k_kelompok,"; 
        $sql=$sql."namalokal, yakin_lokal, yakin_species, lokasi_interaksi, r1, r2, r3, alat_etp, alat_lain, tangan, kapal, lainnya) VALUES (";
        $temp = $get_sheetEtp[$x]["D"] ? : ""  ; ;
        $sql=$sql."'".$temp."',";
        $sql=$sql."'".$namafile."',";
        $sql=$sql.$urut.",";
        $temp = $get_sheetEtp[$x]["S"] ? : ""  ; 
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x]["F"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x+1]["F"] ? : "0"  ;
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["G"] ? : ""  ; 
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x+1]["G"] ? : ""  ;  
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x]["I"] ? : "0"  ; 
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["J"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["K"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["L"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["M"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x+1]["I"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x+1]["J"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x+1]["K"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x+1]["L"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x+1]["M"] ? : "0"  ; 
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["N"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["O"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["P"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["Q"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["R"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["A"] ? : ""  ;  
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x+1]["O"] ? : ""  ;  
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x+1]["R"] ? : ""  ;  
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x+1]["S"] ? : ""  ;  
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x+3]["G"] ? : ""  ;  
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x+4]["D"] ? : "0"  ; 
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x+4]["E"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x+4]["F"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x+4]["J"] ? : ""  ;  
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x+4]["L"] ? : ""  ;  
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x+4]["N"] ? : ""  ;  
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x+4]["O"] ? : ""  ;  
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x+4]["P"] ? : ""  ;  
        $sql=$sql."'".$temp."')";
        
          $this->Model_data->insertEtp($sql); 

        }
        $x=$x+6;
      } 




    $notification[] = "Berhasil";
        $notification[] = "<br>Silahkan check pada link berikut <a href='".base_url()."data/mainpage/detailnamafile/".$namafile."' target='_BLANK'>".$namafile."</a>!";     
  
  
    return $notification ; 
    }


    public function uploadSampling($inputFileName , $namafile){
       
       $user = $this->auth->get_data_session();
       $id_user = $user->id_user;
       
            //INISIALISASI KALKULASI 
              $var_a='0.0193';
              $var_b='2.984';
              $var_v='1.259';
              $var_k='28.4';

            //INISIALISASI KALKULASI KECIL 
              $var_a_yft_kecil = '0.000136';
              $var_b_yft_kecil = '2.51';
              $var_a_bet_kecil = '0.000013';
              $var_b_bet_kecil = '3.12';
              $var_a_skj_kecil = '0.0000225';
              $var_b_skj_kecil = '2.97';


              $bulan_arr = array( 'Januari' , 'Februari' , 'Maret' , 'April' , 'Mei' , 'Juni' , 'Juli' , 'Agustus' , 'September' , 'Oktober' , 'November' , 'Desember') ; 

           $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);

                $sheet = $objPHPExcel->getSheetByName('1-kapal');
                $highestRow = $sheet->getHighestRow(); 
                $highestColumn = $sheet->getHighestColumn();
                $get_sheetLanding=$sheet->toArray(null,true,true,true);

                $sheet = $objPHPExcel->getSheetByName('2-umpan');
                $highestRowUmpan = $sheet->getHighestRow(); 
                $highestColumnUmpan = $sheet->getHighestColumn();
                $get_sheetUmpan=$sheet->toArray(null,true,true,true);

                $sheet = $objPHPExcel->getSheetByName('3-tangkapan lain');
                $highestRowBycatch = $sheet->getHighestRow(); 
                $highestColumnBycatch = $sheet->getHighestColumn();
                $get_sheetBycatch=$sheet->toArray(null,true,true,true);


                $sheet = $objPHPExcel->getSheetByName('4- Tuna < 10kg');
                $highestRowSmall = $sheet->getHighestRow(); 
                $highestColumnSmall = $sheet->getHighestColumn();
                $get_sheetSmall=$sheet->toArray(null,true,true,true);


                $sheet = $objPHPExcel->getSheetByName('5- Tuna > 10kg');
                $highestRowLarge = $sheet->getHighestRow(); 
                $highestColumnLarge = $sheet->getHighestColumn();
                $get_sheetLarge=$sheet->toArray(null,true,true,true);


                $sheet = $objPHPExcel->getSheetByName('6-deskripsi');
                $highestRowDesc = $sheet->getHighestRow(); 
                $highestColumnDesc = $sheet->getHighestColumn();
                $get_sheetDesc=$sheet->toArray(null,true,true,true);


                $sheet = $objPHPExcel->getSheetByName('7-etp');
                $highestRowEtp = $sheet->getHighestRow(); 
                $highestColumnEtp = $sheet->getHighestColumn();
                $get_sheetEtp=$sheet->toArray(null,true,true,true);


                $sheet = $objPHPExcel->getSheetByName('param');
                $highestRowParam = $sheet->getHighestRow(); 
                $highestColumnParam = $sheet->getHighestColumn();
                $get_sheetParam=$sheet->toArray(null,true,true,true);


                $sheet = $objPHPExcel->getSheetByName('param1');
                $highestRowParam1 = $sheet->getHighestRow(); 
                $highestColumnParam1 = $sheet->getHighestColumn();
                $get_sheetParam1 =$sheet->toArray(null,true,true,true);


                $sheet = $objPHPExcel->getSheetByName('param2');
                $highestRowParam2 = $sheet->getHighestRow(); 
                $highestColumnParam2= $sheet->getHighestColumn();
                $get_sheetParam2=$sheet->toArray(null,true,true,true);

    
                $versi = $get_sheetParam[3]["AW"] ? : "";

            
              
          //Inisialisasi Awal Start

                $tipe=  $get_sheetParam[3]["AV"] ? : "";

                $notification = array();

                $n_landing = $get_sheetLanding[5]["A"] ? : "" ;
                  if($n_landing == ''){
            
                    $notification[]='Tempat Pendaratan di form tidak boleh kosong!';
                    
                  }else{
            
                    $landingData = $this->global_model->general_select2('master_landing',array('nama_landing'=> $n_landing ),'row','id_landing','');
                    $k_landing = $landingData->id_landing; 
                  
          }

                $n_perusahaan = $get_sheetLanding[5]["D"] ? : "" ;
                  if($n_perusahaan == ''){
                      $notification[]='Perusahaan di form tidak boleh kosong!';
                    }
                  else{
                   
                    $suppData = $this->global_model->general_select2('master_supplier',array('nama_perusahaan'=> $n_perusahaan ),'row','id_supplier','');
                    $k_perusahaan = $suppData->id_supplier ; 
                  }


                $kapal = $get_sheetLanding[7]["A"] ? : "" ;
                  if($kapal == ''){
                    $notification[]='Nama Kapal di form tidak boleh kosong!';
                  }
                $kapten = $get_sheetLanding[7]["D"] ? : "" ;
                  if($kapten == ''){
                    $notification[]='Nama Kapten di form tidak boleh kosong!';
                  }
               
                $rumpon = $get_sheetLanding[7]["F"] ? : "" ;
                  if($rumpon == ''){
                    $notification[]='Rumpon di form tidak boleh kosong!';
                  }else{

                     
                      $ijek = $rumpon;
                      $find=3;
                      while ($find<=10)
                      {
                        $rumpon = $get_sheetParam[$find]["AH"] ? : "" ;  
                        if ($rumpon == $ijek)
                          {
                          $rumpon = $get_sheetParam[$find]["AG"] ? : "" ;  
                            break;
                          }
                        $find++;
                      }

                  }
                $tgl = $get_sheetLanding[9]["A"] ? : "" ;
                  if($tgl == ''){
                    $notification[]='Tanggal di form tidak boleh kosong!';
                  }else{

                    $tgl =  sprintf("%02d", $tgl);

                  }
                $bln = $get_sheetLanding[9]["B"] ? : "" ;
                  if($bln == ''){
                    $notification[]='Bulan di form tidak boleh kosong!';
                  }else{

                    $no_bulan = array_search($bln, $bulan_arr);
                    $no_bulan = $no_bulan + 1 ; 
                    $no_bulan =  sprintf("%02d", $no_bulan);
                    $bulan =  $no_bulan ; 

                  }

                $thn = $get_sheetLanding[9]["C"] ? : "" ;
                  if($thn == ''){
                    $notification[]='Tahun di form tidak boleh kosong!';
                  }
                $jam = $get_sheetLanding[9]["D"] ? : "" ;
                  if($jam == ''){
                      $notification[]='Jam di form tidak boleh kosong!';
                    } 
                $menit = $get_sheetLanding[9]["E"] ? : "" ;
                  if($menit == ''){
                    $notification[]='Menit di form tidak boleh kosong!';
                  }
                $mnamafile=$k_landing.'_'.substr($thn,2,2).$no_bulan.$tgl.'_'.$jam.$menit.".xlsx"; 
      
               
                 if ($mnamafile != $namafile) 
                  {

                    $notification[] = "Penamaan File Tidak Sama Dengan Yang Tertera Pada Data Form!"; 

                  }

            //Inisialisasi Awal Ends
            if(  count($notification) == 0 ) { 

                  if($tipe == 'HL'){

                    if($versi == '2020'){

                  $griding = array();

                                  $grid11 = $get_sheetLanding[7]["L"] ? : "" ;
                                  $grid12 = $get_sheetLanding[7]["M"] ? : "" ;
                                  $grid21 = $get_sheetLanding[8]["L"] ? : "" ;
                                  $grid22 = $get_sheetLanding[8]["M"] ? : "" ;

                                  if($grid11 == '' || $grid12 == ''){
                                     $notification[] = 'Grid tidak boleh kosong ';
                                  }else{
                                    $griding[] = $grid11." - ".$grid12; 
                                    $griding[] = $grid21." - ".$grid22; 
                                  }

                                   $teknik_cari_tuna = '';



                                $ijek = 10;
                                for($i=0; $i < 2 ; $i++){
                                  $temp =  $get_sheetLanding[$ijek+ $i ]["L"] ? : "" ;
                                  if($temp !='')
                                  $teknik_cari_tuna .= $temp.",";
                                }

                                if($rumpon == 'X' || $rumpon == 'F'){
                                  $check = strpos($teknik_cari_tuna, 'Rumpon');
                                    if( $check  === false){
                                         $teknik_cari_tuna .= 'Rumpon,';
                                      }
                                }
                                if($rumpon == 'F') {
                                  $search = explode(',' , $teknik_cari_tuna );
                                  $jumlah = count($search);
                                
                                  if($jumlah > 2 ){
                                    $notification[] = 'Anda memilih Rumpon : semua Di Rumpon (F), Maka Teknik Pencarian Lokasi Tuna Harus Pilih Rumpon Saja !'; 
                                  }
                                }
                                if($rumpon == 'N'){
                                  $check = strpos($teknik_cari_tuna, 'Rumpon');
                                  if($check!== false){
                                    $notification[] = 'Anda memilih Rumpon : Tidak Di Rumpon (N), Maka Teknik Pencarian Lokasi Tuna Jangan Pilih Rumpon !';      
                                  }
                                }


                                 //cari no kapal 
                                $checks = array('id_supplier' => $k_perusahaan , 
                                    'nama_kapal' => $kapal , 
                                    'status' => 'active',
                                );
                                $checkCode = $this->Model_data->checkExisting('master_vessel' , $checks , "numRows");
                                $no_ap2hi = "";
                                if($checkCode > 0){
                                   $dataKapal = $this->Model_data->checkExisting('master_vessel' , $checks , "row");
                                   $no_ap2hi = $dataKapal->id_vessel ; 
                                }


                                 //------------------------------INSERT TPS_PENDARATAN----------------------------
                      
                        $data['namafile'] = $namafile ; 
                        $data['k_landing'] = $k_landing ; 
                        $data['k_perusahaan'] = $k_perusahaan ; 
                        $data['enumerator1'] =  $get_sheetLanding[5]["F"] ? : "" ;
                        $data['enumerator2'] = $get_sheetLanding[5]["H"] ? : "" ;
                        $data['nama_kapal'] = $kapal ; 
                        $data['kapten_kapal'] = $kapten; 
                        $data['gt_kapal'] = $get_sheetLanding[9]["H"] ? : "0" ;
                        $data['panjang_kapal'] = $get_sheetLanding[9]["J"] ? : "0" ;
                        $data['mesin_kapal'] = $get_sheetLanding[9]["F"] ? : "0" ;
                        $data['bahan_kapal'] = $get_sheetLanding[11]["H"] ? : "" ;
                        $data['jum_awak'] = $get_sheetLanding[13]["F"] ? : "0" ;
                        $data['no_ap2hi'] = $no_ap2hi ; 
                        $data['grid1'] = $grid11 ; 
                        $data['grid2'] = $grid12 ; 
                        $data['total_penangkapan'] =  $get_sheetLanding[7]["H"] ? : "0" ;
                        $data['est_ikanhilang'] =  $get_sheetLanding[7]["J"] ? : "0" ;
                        $data['thn_sampling'] =  $get_sheetLanding[9]["C"] ? : "" ;
                        $data['bln_sampling'] =  $bulan;
                        $data['tgl_sampling'] =  $get_sheetLanding[9]["A"] ? : "" ;
                        $data['jam_sampling'] = $get_sheetLanding[9]["D"] ? : "" ;
                        $data['mnt_sampling'] = $get_sheetLanding[9]["E"] ? : "" ;
                        $data['rumpon'] = $rumpon ; 
                        $data['teknik_cari_tuna'] = $teknik_cari_tuna ; 
                        $data['bbm'] = $get_sheetLanding[11]["J"] ? : "0" ;
                        $data['k_alattangkap'] = 'HL' ; 
                        $data['es'] = $get_sheetLanding[13]["J"] ? : "0" ;
                        $data['pengguna'] = $id_user ; 
                        $data['deskripsi'] = $get_sheetDesc[4]["A"] ? : "" ;
                        $data['lama_satuan'] = $get_sheetLanding[11]["E"] ? : "" ;
                        if($data['lama_satuan'] == 'hari'){
                          $data['lama_hari'] = $get_sheetLanding[11]["D"] ? : "0" ;
                          $data['lama_jam'] = "0" ;
                        }else if($data['lama_satuan'] == 'jam'){
                          $data['lama_jam'] = $get_sheetLanding[11]["D"] ? : "0" ;
                          $data['lama_hari'] = "0" ;
                        }
                        $data['hl_tipe_mata_pancing'] = $get_sheetLanding[13]["L"] ? : "" ;
                        //$data['hl_troll'] = $get_sheetLanding[13]["J"] ? : "" ;
                        $data['hl_alat_tangkap_lain'] = $get_sheetLanding[11]["G"] ? : "" ;
                        $data['pl_jum_pancing'] = "0" ; 
                        $data['pl_kapasitas_ember'] =  "0" ; 
                        $data['jumlah_hari_memancing'] =  $get_sheetLanding[13]["D"] ? : ""  ; 
                        $data['using_ringkasan_ikanbesar'] = "" ; 
                        $data['tgl_impor'] = date("Y-m-d") ; 
                        $data['jam_impor'] = date("H:i:s") ; 
                        $data['tipe'] = 'HL'; 
                        $data['e_pewawancara'] =  $get_sheetEtp[4]["C"] ? : "" ;
                        $data['e_umur'] = $get_sheetEtp[5]["C"] ? : "0" ;
                        $data['e_lama_tahun'] =$get_sheetEtp[6]["D"] ? : "0" ; 
                        $data['e_lama_bulan'] = $get_sheetEtp[6]["F"] ? : "0" ;
                        $data['e_jabatan'] =$get_sheetEtp[7]["D"] ? : "" ;
                        $data['e_keterangan'] =$get_sheetEtp[7]["H"] ? : "" ;
                        $data['total_bycatch'] = "0" ; 
                        $data['total_real_kecil'] = "0" ;  
                        $data['total_sampling_kecil'] = "0" ; 
                        $data['raising_factor'] = "0" ; 
                        $data['grid'] = json_encode($griding) ; 

                        $data['no_sipi'] = $get_sheetLanding[5]["L"] ? : "" ; 
                        $data['jumlah_rumpon_singgah'] = $get_sheetLanding[9]["K"] ? : "" ; 
                          $tgl = $get_sheetLanding[11]["A"] ? : "" ; 
                          $bln = $get_sheetLanding[11]["B"] ? : "" ; 
                              $no_bulan = array_search($bln, $bulan_arr);
                              $no_bulan = $no_bulan + 1 ; 
                              $no_bulan =  sprintf("%02d", $no_bulan);
                              $bln =  $no_bulan ; 
                          $thn = $get_sheetLanding[11]["C"] ? : "" ; 
                        $data['tanggal_berangkat'] = $thn.'-'.$bln.'-'.$tgl ;  
                          $tgl = $get_sheetLanding[13]["A"] ? : "" ; 
                          $bln = $get_sheetLanding[13]["B"] ? : "" ; 
                              $no_bulan = array_search($bln, $bulan_arr);
                              $no_bulan = $no_bulan + 1 ; 
                              $no_bulan =  sprintf("%02d", $no_bulan);
                              $bln =  $no_bulan ; 
                          $thn = $get_sheetLanding[13]["C"] ? : "" ; 
                        $data['tanggal_kembali'] = $thn.'-'.$bln.'-'.$tgl ;  
                        $data['jumlah_pakura'] = $get_sheetLanding[13]["H"] ? : "" ; 
                        $data['deskripsi_foto'] = $get_sheetDesc[4]["R"] ? : "" ; 
                        $data['ukuran_pancing'] = $get_sheetLanding[11]["F"] ? : "" ; 
                        

                         $this->Model_data->insertTripNew($data);

                    }else{

                                  $griding = array();
                                  $grid11 = $get_sheetLanding[5]["J"] ? : "" ;
                                  $grid12 = $get_sheetLanding[5]["K"] ? : "" ;
                                  $grid21 = $get_sheetLanding[6]["J"] ? : "" ;
                                  $grid22 = $get_sheetLanding[6]["K"] ? : "" ;
                                  $grid31 = $get_sheetLanding[7]["J"] ? : "" ;
                                  $grid32 = $get_sheetLanding[7]["K"] ? : "" ;
                                  if($grid11 == '' || $grid12 == ''){
                                     $notification[] = 'Grid tidak boleh kosong ';
                                  }else{
                                    $griding[] = $grid11." - ".$grid12; 
                                    $griding[] = $grid21." - ".$grid22; 
                                    $griding[] = $grid31." - ".$grid32; 
                                  }

                                
                                $teknik_cari_tuna = '';
                                $ijek = 9;
                                for($i=0; $i < 3 ; $i++){
                                  $temp =  $get_sheetLanding[$ijek+ $i ]["J"] ? : "" ;
                                  if($temp !='')
                                  $teknik_cari_tuna .= $temp.",";
                                }

                                if($rumpon == 'X' || $rumpon == 'F'){
                                  $check = strpos($teknik_cari_tuna, 'Rumpon');
                                    if( $check  === false){
                                         $teknik_cari_tuna .= 'Rumpon,';
                                      }
                                }
                                if($rumpon == 'F') {
                                  $search = explode(',' , $teknik_cari_tuna );
                                  $jumlah = count($search);
                                
                                  if($jumlah > 2 ){
                                    $notification[] = 'Anda memilih Rumpon : semua Di Rumpon (F), Maka Teknik Pencarian Lokasi Tuna Harus Pilih Rumpon Saja !'; 
                                  }
                                }
                                if($rumpon == 'N'){
                                  $check = strpos($teknik_cari_tuna, 'Rumpon');
                                  if($check!== false){
                                    $notification[] = 'Anda memilih Rumpon : Tidak Di Rumpon (N), Maka Teknik Pencarian Lokasi Tuna Jangan Pilih Rumpon !';      
                                  }
                                }

                                //cari no kapal 
                                $checks = array('id_supplier' => $k_perusahaan , 
                                    'nama_kapal' => $kapal , 
                                    'status' => 'active',
                                );
                                $checkCode = $this->Model_data->checkExisting('master_vessel' , $checks , "numRows");
                                $no_ap2hi = "";
                                if($checkCode > 0){
                                   $dataKapal = $this->Model_data->checkExisting('master_vessel' , $checks , "row");
                                   $no_ap2hi = $dataKapal->id_vessel ; 

                                }

                  //------------------------------INSERT TPS_PENDARATAN----------------------------
                      
                        $data['namafile'] = $namafile ; 
                        $data['k_landing'] = $k_landing ; 
                        $data['k_perusahaan'] = $k_perusahaan ; 
                        $data['enumerator1'] =  $get_sheetLanding[5]["F"] ? : "" ;
                        $data['enumerator2'] = $get_sheetLanding[5]["H"] ? : "" ;
                        $data['nama_kapal'] = $kapal ; 
                        $data['kapten_kapal'] = $kapten; 
                        $data['gt_kapal'] = $get_sheetLanding[11]["A"] ? : "0" ;
                        $data['panjang_kapal'] = $get_sheetLanding[11]["C"] ? : "0" ;
                        $data['mesin_kapal'] = $get_sheetLanding[11]["D"] ? : "0" ;
                        $data['bahan_kapal'] = $get_sheetLanding[13]["H"] ? : "" ;
                        $data['jum_awak'] = $get_sheetLanding[13]["E"] ? : "0" ;
                        $data['no_ap2hi'] = $no_ap2hi ; 
                        $data['grid1'] = $grid11 ; 
                        $data['grid2'] = $grid12 ; 
                        $data['total_penangkapan'] =  $get_sheetLanding[7]["H"] ? : "0" ;
                        $data['est_ikanhilang'] =  $get_sheetLanding[7]["I"] ? : "0" ;
                        $data['thn_sampling'] =  $get_sheetLanding[9]["C"] ? : "" ;
                        $data['bln_sampling'] =  $bulan;
                        $data['tgl_sampling'] =  $get_sheetLanding[9]["A"] ? : "" ;
                        $data['jam_sampling'] = $get_sheetLanding[9]["D"] ? : "" ;
                        $data['mnt_sampling'] = $get_sheetLanding[9]["E"] ? : "" ;
                        $data['rumpon'] = $rumpon ; 
                        $data['teknik_cari_tuna'] = $teknik_cari_tuna ; 
                        $data['bbm'] = $get_sheetLanding[9]["H"] ? : "0" ;
                        $data['k_alattangkap'] = 'HL' ; 
                        $data['es'] = $get_sheetLanding[11]["H"] ? : "0" ;
                        $data['pengguna'] = $id_user ; 
                        $data['deskripsi'] = $get_sheetDesc[4]["A"] ? : "" ;
                        $data['lama_satuan'] = $get_sheetLanding[9]["G"] ? : "" ;
                        if($data['lama_satuan'] == 'hari'){
                          $data['lama_hari'] = $get_sheetLanding[9]["F"] ? : "0" ;
                          $data['lama_jam'] = "0" ;
                        }else if($data['lama_satuan'] == 'jam'){
                          $data['lama_jam'] = $get_sheetLanding[9]["F"] ? : "0" ;
                          $data['lama_hari'] = "0" ;
                        }
                        $data['hl_tipe_mata_pancing'] = $get_sheetLanding[13]["A"] ? : "" ;
                        $data['hl_troll'] = $get_sheetLanding[13]["J"] ? : "" ;
                        $data['hl_alat_tangkap_lain'] = $get_sheetLanding[13]["K"] ? : "" ;
                        $data['pl_jum_pancing'] = "0" ; 
                        $data['pl_kapasitas_ember'] =  "0" ; 
                        $data['jumlah_hari_memancing'] =  $get_sheetLanding[11]["F"] ? : ""  ; 
                        $data['using_ringkasan_ikanbesar'] = "" ; 
                        $data['tgl_impor'] = date("Y-m-d") ; 
                        $data['jam_impor'] = date("H:i:s") ; 
                        $data['tipe'] = 'HL'; 
                        $data['e_pewawancara'] =  $get_sheetEtp[4]["C"] ? : "" ;
                        $data['e_umur'] = $get_sheetEtp[5]["C"] ? : "0" ;
                        $data['e_lama_tahun'] =$get_sheetEtp[6]["D"] ? : "0" ; 
                        $data['e_lama_bulan'] = $get_sheetEtp[6]["F"] ? : "0" ;
                        $data['e_jabatan'] =$get_sheetEtp[7]["D"] ? : "" ;
                        $data['e_keterangan'] =$get_sheetEtp[7]["H"] ? : "" ;
                        $data['total_bycatch'] = "0" ; 
                        $data['total_real_kecil'] = "0" ;  
                        $data['total_sampling_kecil'] = "0" ; 
                        $data['raising_factor'] = "0" ; 
                        $data['grid'] = json_encode($griding) ; 

                        $this->Model_data->insertTrip($data);


                    }

                      
              
          //END INSERT TPS_PENDARATAN


         //---------------------------INSERT TPS_KAPALKECIL-------------------------------
        
        $x=16;
        while($x<=35) 
        {
          $data['no'] =  $get_sheetLanding[$x]["A"] ? : ""  ;  
          if ($data['no']=="") 
          {
              break;
          }  
          $data['nama'] =$get_sheetLanding[$x]["B"] ? : ""  ;   
          $data['total_penangkapan'] = $get_sheetLanding[$x]["D"] ? : "0"  ;  
          $data['est_ikanhilang'] = $get_sheetLanding[$x]["E"] ? : "0"  ;  
          $data['lama'] = $get_sheetLanding[$x]["F"] ? : "0"  ;  
          $data['lama_satuan'] = $get_sheetLanding[$x]["G"] ? : ""  ;  
          $data['bbm'] = $get_sheetLanding[$x]["H"] ? : "0"  ;  
          $data['mesin'] = $get_sheetLanding[$x]["J"] ? : "0"  ;  
            $this->Model_data->insertKapalKecil($data);

          $x++;
        }  
        
        //END INSERT TPS_KAPALKECIL



        /*//---------------------------INSERT TPS_UMPAN-------------------------------*/
        $x=5;
        $urut = 1;
        while($x<=11) 
        {
          $data['k_umpan'] = $get_sheetUmpan[$x]["A"] ? : ""  ;  
          if ($data['k_umpan']=="") 
          {
           break;
          }  
          $data['species'] = $get_sheetUmpan[$x]["B"] ? : ""  ;  
          $data['rumpon1'] = $get_sheetUmpan[$x]["C"] ? : ""  ;  
          $data['rumpon2'] = $get_sheetUmpan[$x]["D"] ? : ""  ;  
          $data['total'] = $get_sheetUmpan[$x]["E"] ? : "0"  ;  
          $data['estimasi'] = $get_sheetUmpan[$x]["F"] ? : "0"  ;  
          $malat = $get_sheetUmpan[$x]["G"] ? : ""  ;  
             if ($malat != "") 
              {
              $ijek = $malat;
              $find=3;
              while ($find<=50)
              {
                $malat = $get_sheetParam[$find]["AR"] ? : ""  ;   
                if ($malat == $ijek)
                {
                  $data['k_alattangkap'] = $get_sheetParam[$find]["AQ"] ? : ""  ;  
                  break;
                }
                $find++;
              }     
              }
         $domestic_import =  $get_sheetUmpan[$x]["H"] ? : ""  ;  
             if ($domestic_import != "") 
              {
              $ijek = $domestic_import;
              $find=3;
              while ($find<=10)
              {
                $domestic_import = $get_sheetParam[$find]["AJ"] ? : ""  ;  
                if ($domestic_import == $ijek)
                {
                  $data['domestic_import'] = $get_sheetParam[$find]["AI"] ? : ""  ; 
                  break;
                }
                $find++;
              }     
              }
         
            $data['pl_pengadaan_umpan'] = ""; 
            $data['pl_jum_ember'] = "0";  
            $data['urut'] = $urut ; 
            $this->Model_data->insertUmpan($data);

          $x++;
          $urut++;
        }
        //End INSERT TPS_UMPAN
        

      /* INSERT TPS_BYCATCH */
        $x=5;
        $totalb_bycatch = 0; //TOTAL BERAT tangkapan lain
        while($x<=13) 
        {
          $no =  $get_sheetBycatch[$x]["A"] ? : ""  ;  
          if ($no=="") 
          {
          //break;
          }else{  
            $species = $get_sheetBycatch[$x]["B"] ? : ""  ; 
            if ($species != "") 
            {
            $ijek = $species;
            $kon=3;
            while ($kon<=100)
            {
              $species = $get_sheetParam[$kon]["U"] ? : ""  ;   
              if ($species == $ijek)
              {
                $data['k_species'] = $get_sheetParam[$kon]["T"] ? : ""  ;
                break;
              }
              $kon++;
            }     
            }
            $data['jumlah'] = $get_sheetBycatch[$x]["C"] ? : "0"  ; 
            $data['berat'] = $get_sheetBycatch[$x]["D"] ? : "0"  ; 
            $estimasi = $get_sheetBycatch[$x]["E"] ? : ""  ;  
            $data['estimasi'] = strtoupper(substr($estimasi,0,1));
           
            $this->Model_data->insertBycatch($data);

            $totalb_bycatch = $totalb_bycatch + $data['berat'];  //jumlahkan
          }
          $x++;
        }
        /* INSERT TPS_BYCATCH */


      /* INSERT FOR IKAN KECIL */
    
        $awal=5; $akhir=14; $awal1=18;
        $x=$awal;
        $totalb_ikankecil = 0; //TOTAL BERAT IKAN KECIL
        
        while($x<=$akhir) 
        {
          $data['kode'] = $get_sheetSmall[$x]["B"] ? : ""  ;  
          if ($data['kode'] != "") 
          {
                
              $data['deskripsi'] = $get_sheetSmall[$x]["C"] ? : ""  ;  
              $data['berat'] = $get_sheetSmall[$x]["F"] ? : "0"  ;  

              $this->Model_data->insertRingkasan($data , "tps_ringkasan_ikankecil"); 

              $totalb_ikankecil = $totalb_ikankecil + $data['berat'] ;  //JUMLAHKAN
          }
          $x++;
        }
        

      $x=$awal1;
      $i=0; $sw=0;
      $noker = 0;
      $noikan = 1;  
      $totalsamplingikankecil = 0;
      $total_yft_kecil = 0; $total_bet_kecil = 0; $total_skj_kecil = 0;
      while($x<=217) 
      {
        $stat = 'N';
        $beratkeranjang = $get_sheetSmall[$x]["A"] ? : "0"  ;  
        
        
        $kode = '-';
        if($beratkeranjang != 0){
          $totalsamplingikankecil = $totalsamplingikankecil + $beratkeranjang ; 
             if($noker == 0){
               $noker = $noker + 1; 
             }else if($noker == 1){
               $noker = $noker + 4 ; 
             }else{
               $noker = $noker + 5 ;
             }

             $data['noker'] = $noker ; 
             $data['beratkeranjang'] = $beratkeranjang ; 
             $this->Model_data->insertKeranjang($data); 
      
          $stat = 'Y';
        }
        
        if($stat == 'Y'){
          $noikan = 1;
        }
      
            $k_species = $get_sheetSmall[$x]["B"] ? : ""  ;   
            $panjang = $get_sheetSmall[$x]["E"] ? : "0"  ;   
      
          if($k_species != ''){
            
            $kalkulasi_berat = 0;
            if($k_species == 'YFT'){
              $kalkulasi_berat = $var_a_yft_kecil * (pow($panjang , $var_b_yft_kecil )) ; 
              $kalkulasi_berat = number_format($kalkulasi_berat, 2);
              
              $total_yft_kecil = $total_yft_kecil + $kalkulasi_berat ; 
              $total_yft_kecil = number_format($total_yft_kecil  , 2); 
            }
            if($k_species == 'BET'){
              $kalkulasi_berat = $var_a_bet_kecil * (pow($panjang , $var_b_bet_kecil )) ; 
              $kalkulasi_berat = number_format($kalkulasi_berat, 2);
              
              $total_bet_kecil = $total_bet_kecil + $kalkulasi_berat ; 
              $total_bet_kecil = number_format($total_bet_kecil  , 2);
            }
            if($k_species == 'SKJ'){
              $kalkulasi_berat = $var_a_skj_kecil * (pow($panjang , $var_b_skj_kecil )) ; 
              $kalkulasi_berat = number_format($kalkulasi_berat, 2);
              
              $total_skj_kecil = $total_skj_kecil + $kalkulasi_berat ; 
              $total_skj_kecil = number_format($total_skj_kecil  , 2);
            }

            $data['k_species'] = $k_species ; 
            $data['panjang'] = $panjang ; 
            $data['noikan'] = $noikan ; 
            $data['kalkulasi_berat'] = $kalkulasi_berat ; 
            
            $this->Model_data->insertSmall($data);
          }
          
          $stat = 'N';
          $noikan++;
          $x++;

        }
    
        //masukkan kalkulasi ke total_ikan_kecil
          $total_kalkulasi_ikankecil = $total_yft_kecil + $total_bet_kecil + $total_skj_kecil ; 
          if($total_yft_kecil > 0){
            
            $percen_yft =   ( $total_yft_kecil / $total_kalkulasi_ikankecil ) * 100  ; 
            $summary_yft = number_format($totalb_ikankecil * ($percen_yft / 100) , 2 , '.' , '') ;
            $data['total_xxx_kecil'] = $total_yft_kecil ; 
            $data['summary_xxx'] = $summary_yft ; 
            $data['species'] = 'YFT'; 

             $this->Model_data->insertTotalIkanKecil($data);
            
          }
          if($total_bet_kecil > 0){
            $percen_bet =   ( $total_bet_kecil / $total_kalkulasi_ikankecil ) * 100  ; 
            $summary_bet = number_format($totalb_ikankecil * ($percen_bet / 100) , 2 , '.' , '') ;
            $data['total_xxx_kecil'] = $total_bet_kecil ; 
            $data['summary_xxx'] = $summary_bet ; 
            $data['species'] = 'BET'; 

            $this->Model_data->insertTotalIkanKecil($data);
          
          }
          if($total_skj_kecil > 0){
            $percen_skj =   ( $total_skj_kecil / $total_kalkulasi_ikankecil ) * 100  ; 
            $summary_skj = number_format($totalb_ikankecil * ($percen_skj / 100) , 2 , '.' , '') ;
            $data['total_xxx_kecil'] = $total_skj_kecil ; 
            $data['summary_xxx'] = $summary_skj ; 
            $data['species'] = 'SKJ'; 

            $this->Model_data->insertTotalIkanKecil($data);
           
          }
        //end INSERT FOR IKAN KECIL


        /* INSERT IKAN BESAR*/
    
          $awal1=19;
          $awal=5; $akhir=14;  
          $x=$awal;
          $total_ringkasanBesar = 0;
          while($x<=$akhir) 
          {
            $data['kode'] = $get_sheetLarge[$x]["B"] ? : ""  ; 
            if ( $data['kode']  != "") 
            {
  

              $data['deskripsi'] = $get_sheetLarge[$x]["D"] ? : ""  ;  
              $data['berat'] = $get_sheetLarge[$x]["I"] ? : "0"  ;  

              $this->Model_data->insertRingkasan($data , "tps_ringkasan_ikanbesar"); 

            
            $totalBeratBesar =  $data['berat'] ;
            $total_ringkasanBesar = $total_ringkasanBesar + $totalBeratBesar ;
            }
            $x++;
          } 
          
          $kalk='';
          $x=$awal1;
          $k_kapalkecil = 0;
          $totalb_ikanbesar = 0; //TOTAL BERAT IKAN BESAR
          while($x<=219) 
          {
        
           $noikan = $get_sheetLarge[$x]["A"] ? : ""  ;   
            if ($noikan == "")
              {
              break;  
              }

                $no_ikan = $noikan ; 
                $k_species = $get_sheetLarge[$x]["C"] ? : ""  ;   
                $kode = $get_sheetLarge[$x]["D"] ? : ""  ;
                $berat = $get_sheetLarge[$x]["E"] ? : "0"  ; 
                $panjang= $get_sheetLarge[$x]["F"] ? : "0"  ; 
                $k_kapalkecil = 0 ;  
                $loin1_berat = $get_sheetLarge[$x]["G"] ? : "0"  ; 
                $loin1_panjang = $get_sheetLarge[$x]["H"] ? : "0"  ;
                $valid = ""  ; 
                $insang = $get_sheetLarge[$x]["I"] ? : "-"  ;
                $isi_perut= $get_sheetLarge[$x]["J"] ? : "-"  ;
                $daging_perut= $get_sheetLarge[$x]["K"] ? : "-"  ;
                      
               $t_b = $berat ; 
               $t_p = $panjang; 
               $brt = $berat ; 
               $pjg = $panjang ; 
               $l1_b = $loin1_berat ; 
               $l1_p = $loin1_panjang ; 
               $xyz1 = $insang ; 
               $xyz2 = $isi_perut ; 
               $xyz3 = $daging_perut ; 
                $xyz1 = substr($xyz1,0,1);
                $xyz2 = substr($xyz2,0,1);
                $xyz3 = substr($xyz3,0,1);
                
              if( $t_b == '0' && $t_p != '0' ){
                  
                  $pjg=$t_p;
                  $brt=pow($pjg, $var_b)*$var_a;
                  $t_p=round($pjg);
                  $t_b=round($brt/1000);
                  $kalk='Y';
                  
              }
              else if ($t_b == '0' && $l1_p != '0' )
                {
                  $pjg=0;
                    if ($l1_p != '0')
                  {
                    $pjg=$l1_p;
                  }

                      if ($pjg != 0)
                      {
                        
                        $pjg=$var_v*$pjg+$var_k;
                        
                        $brt=pow($pjg, $var_b)*$var_a;
                        $t_p=round($pjg);
                        $t_b=round($brt/1000);
                        $kalk='Y';
                      }           
                  
                }
               
                $data['no_ikan'] = $noikan ; 
                $data['k_species'] =$k_species ;   
                $data['kode'] = $kode ;
                $data['berat'] = $t_b;  
                $data['panjang']= $t_p ;  
                $data['k_kapalkecil'] = 0 ;  
                $data['loin1_berat'] = $loin1_berat;
                $data['loin1_panjang'] = $loin1_panjang ; 
                $data['valid'] = ""  ; 
                $data['insang'] = $xyz1;
                $data['isi_perut']= $xyz2;
                $data['daging_perut']= $xyz3;
                $data['kalkulasi'] = $kalk; 
              

                $this->Model_data->insertLarge($data);

              $x++;
            $totalb_ikanbesar = $totalb_ikanbesar + $t_b; //jumlahkan semua berat ikan besar
          }

            //tambahan conversion
            if($kalk=='Y'){
                $totalcatch = ($totalb_ikanbesar + $totalb_ikankecil + $totalb_bycatch);
                
                $data['totalcatch'] = $totalcatch ; 
                //SATU
                $this->Model_data->konversiSatu($data);

              }else{
                $using_ringkasan_ikan_besar = "";
                if($totalb_ikanbesar == 0 && $total_ringkasanBesar > 0 ){
                  $using_ringkasan_ikan_besar = " , using_ringkasan_ikanbesar = 'Y' ";
                  $totalcatch = ($total_ringkasanBesar + $totalb_ikankecil + $totalb_bycatch);
                }else{
                  $totalcatch = ($totalb_ikanbesar + $totalb_ikankecil + $totalb_bycatch);
                }
                $data['totalcatch'] = $totalcatch; 
                $data['using_ringkasan_ikan_besar'] = $using_ringkasan_ikan_besar; 
                //DUA
               $this->Model_data->konversiDua($data); 
            //end tambahan conversion
        }
            
          /*  end INSERT IKAN BESAR*/
          
          /* Raising Factor */
                $raising_factor = 0;
                    if($totalb_ikankecil != 0 && $totalsamplingikankecil != 0){
                          $raising_factor  = $totalb_ikankecil / $totalsamplingikankecil ; 
                          $raising_factor =  number_format($raising_factor,2);  
                    }
                  $data['totalb_bycatch'] = $totalb_bycatch ; 
                  $data['totalb_ikankecil'] = $totalb_ikankecil ; 
                  $data['totalsamplingikankecil'] = $totalsamplingikankecil ; 
                  $data['raising_factor'] = $raising_factor ; 
                //TIGA
                $this->Model_data->konversiTiga($data);
          /* End Raising Factor */



    /* ETP */
    $x=10;
    $urut=0;
    $max = $highestRowEtp ; 
      while($x<=$max) 
      {
        $kelp =  $get_sheetEtp[$x]["A"] ? : ""  ;
        if ($kelp != "") 
        {
        $urut=$urut+1;
        $sql="INSERT INTO tps_etp(interaksi, namafile, urut, k_species, jml_interaksi, jml_didaratkan, est_interaksi,";
        $sql=$sql."est_didaratkan, d_1, d_2, d_3, d_4, d_5, td_1, td_2, td_3, td_4,";
        $sql=$sql."td_5, dibuang, dimakan, dijual, diumpan, tidak_tahu, k_kelompok,"; 
        $sql=$sql."namalokal, yakin_lokal, yakin_species, lokasi_interaksi, r1, r2, r3, alat_etp, alat_lain, tangan, kapal, lainnya) VALUES (";
        $temp = $get_sheetEtp[$x]["D"] ? : ""  ; ;
        $sql=$sql."'".$temp."',";
        $sql=$sql."'".$namafile."',";
        $sql=$sql.$urut.",";
        $temp = $get_sheetEtp[$x]["S"] ? : ""  ; 
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x]["F"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x+1]["F"] ? : "0"  ;
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["G"] ? : ""  ; 
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x+1]["G"] ? : ""  ;  
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x]["I"] ? : "0"  ; 
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["J"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["K"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["L"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["M"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x+1]["I"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x+1]["J"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x+1]["K"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x+1]["L"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x+1]["M"] ? : "0"  ; 
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["N"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["O"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["P"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["Q"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["R"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["A"] ? : ""  ;  
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x+1]["O"] ? : ""  ;  
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x+1]["R"] ? : ""  ;  
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x+1]["S"] ? : ""  ;  
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x+3]["G"] ? : ""  ;  
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x+4]["D"] ? : "0"  ; 
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x+4]["E"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x+4]["F"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x+4]["J"] ? : ""  ;  
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x+4]["L"] ? : ""  ;  
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x+4]["N"] ? : ""  ;  
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x+4]["O"] ? : ""  ;  
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x+4]["P"] ? : ""  ;  
        $sql=$sql."'".$temp."')";
        

          $this->Model_data->insertEtp($sql); 

        }
        $x=$x+6;
      } 



         $notification[] = "Berhasil";
         $notification[] = "<br>Silahkan check pada link berikut <a href='".base_url()."data/mainpage/detailnamafile/".$namafile."' target='_BLANK'>".$namafile."</a>!";     
  







                  }

                  elseif($tipe == 'PL') {


                       if($versi == '2019'){

                           $griding = array();

                                  $grid11 = $get_sheetLanding[7]["L"] ? : "" ;
                                  $grid12 = $get_sheetLanding[7]["M"] ? : "" ;
                                  $grid21 = $get_sheetLanding[8]["L"] ? : "" ;
                                  $grid22 = $get_sheetLanding[8]["M"] ? : "" ;

                                  if($grid11 == '' || $grid12 == ''){
                                     $notification[] = 'Grid tidak boleh kosong ';
                                  }else{
                                    $griding[] = $grid11." - ".$grid12; 
                                    $griding[] = $grid21." - ".$grid22; 
                                  }

                                   $teknik_cari_tuna = '';



                                $ijek = 10;
                                for($i=0; $i < 2 ; $i++){
                                  $temp =  $get_sheetLanding[$ijek+ $i ]["L"] ? : "" ;
                                  if($temp !='')
                                  $teknik_cari_tuna .= $temp.",";
                                }

                                if($rumpon == 'X' || $rumpon == 'F'){
                                  $check = strpos($teknik_cari_tuna, 'Rumpon');
                                    if( $check  === false){
                                         $teknik_cari_tuna .= 'Rumpon,';
                                      }
                                }
                                if($rumpon == 'F') {
                                  $search = explode(',' , $teknik_cari_tuna );
                                  $jumlah = count($search);
                                
                                  if($jumlah > 2 ){
                                    $notification[] = 'Anda memilih Rumpon : semua Di Rumpon (F), Maka Teknik Pencarian Lokasi Tuna Harus Pilih Rumpon Saja !'; 
                                  }
                                }
                                if($rumpon == 'N'){
                                  $check = strpos($teknik_cari_tuna, 'Rumpon');
                                  if($check!== false){
                                    $notification[] = 'Anda memilih Rumpon : Tidak Di Rumpon (N), Maka Teknik Pencarian Lokasi Tuna Jangan Pilih Rumpon !';      
                                  }
                                }


                                 //cari no kapal 
                                $checks = array('id_supplier' => $k_perusahaan , 
                                    'nama_kapal' => $kapal , 
                                    'status' => 'active',
                                );
                                $checkCode = $this->Model_data->checkExisting('master_vessel' , $checks , "numRows");
                                $no_ap2hi = "";
                                if($checkCode > 0){
                                   $dataKapal = $this->Model_data->checkExisting('master_vessel' , $checks , "row");
                                   $no_ap2hi = $dataKapal->id_vessel ; 
                                }


                                 //------------------------------INSERT TPS_PENDARATAN----------------------------
                      
                        $data['namafile'] = $namafile ; 
                        $data['k_landing'] = $k_landing ; 
                        $data['k_perusahaan'] = $k_perusahaan ; 
                        $data['enumerator1'] =  $get_sheetLanding[5]["F"] ? : "" ;
                        $data['enumerator2'] = $get_sheetLanding[5]["H"] ? : "" ;
                        $data['nama_kapal'] = $kapal ; 
                        $data['kapten_kapal'] = $kapten; 
                        $data['gt_kapal'] = $get_sheetLanding[9]["H"] ? : "0" ;
                        $data['panjang_kapal'] = $get_sheetLanding[9]["J"] ? : "0" ;
                        $data['mesin_kapal'] = $get_sheetLanding[9]["F"] ? : "0" ;
                        $data['bahan_kapal'] = $get_sheetLanding[11]["H"] ? : "" ;
                        $data['jum_awak'] = $get_sheetLanding[13]["F"] ? : "0" ;
                        $data['no_ap2hi'] = $no_ap2hi ; 
                        $data['grid1'] = $grid11 ; 
                        $data['grid2'] = $grid12 ; 
                        $data['total_penangkapan'] =  $get_sheetLanding[7]["H"] ? : "0" ;
                        $data['est_ikanhilang'] =  $get_sheetLanding[7]["J"] ? : "0" ;
                        $data['thn_sampling'] =  $get_sheetLanding[9]["C"] ? : "" ;
                        $data['bln_sampling'] =  $bulan;
                        $data['tgl_sampling'] =  $get_sheetLanding[9]["A"] ? : "" ;
                        $data['jam_sampling'] = $get_sheetLanding[9]["D"] ? : "" ;
                        $data['mnt_sampling'] = $get_sheetLanding[9]["E"] ? : "" ;
                        $data['rumpon'] = $rumpon ; 
                        $data['teknik_cari_tuna'] = $teknik_cari_tuna ; 
                        $data['bbm'] = $get_sheetLanding[11]["J"] ? : "0" ;
                        $data['k_alattangkap'] = 'HL' ; 
                        $data['es'] = $get_sheetLanding[13]["J"] ? : "0" ;
                        $data['pengguna'] = $id_user ; 
                        $data['deskripsi'] = $get_sheetDesc[4]["A"] ? : "" ;
                        $data['lama_satuan'] = $get_sheetLanding[11]["E"] ? : "" ;
                        if($data['lama_satuan'] == 'hari'){
                          $data['lama_hari'] = $get_sheetLanding[11]["D"] ? : "0" ;
                          $data['lama_jam'] = "0" ;
                        }else if($data['lama_satuan'] == 'jam'){
                          $data['lama_jam'] = $get_sheetLanding[11]["D"] ? : "0" ;
                          $data['lama_hari'] = "0" ;
                        }
                        $data['hl_tipe_mata_pancing'] = $get_sheetLanding[13]["L"] ? : "" ;
                        //$data['hl_troll'] = $get_sheetLanding[13]["J"] ? : "" ;
                        $data['hl_alat_tangkap_lain'] = $get_sheetLanding[11]["G"] ? : "" ;
                        $data['pl_jum_pancing'] = $get_sheetLanding[13]["L"];
                        $data['pl_kapasitas_ember'] =  $get_sheetLanding[13]["H"];
                        $data['jumlah_hari_memancing'] =  $get_sheetLanding[13]["D"] ? : ""  ; 
                        $data['using_ringkasan_ikanbesar'] = "" ; 
                        $data['tgl_impor'] = date("Y-m-d") ; 
                        $data['jam_impor'] = date("H:i:s") ; 
                        $data['tipe'] = 'PL'; 
                        $data['e_pewawancara'] =  $get_sheetEtp[4]["C"] ? : "" ;
                        $data['e_umur'] = $get_sheetEtp[5]["C"] ? : "0" ;
                        $data['e_lama_tahun'] =$get_sheetEtp[6]["D"] ? : "0" ; 
                        $data['e_lama_bulan'] = $get_sheetEtp[6]["F"] ? : "0" ;
                        $data['e_jabatan'] =$get_sheetEtp[7]["D"] ? : "" ;
                        $data['e_keterangan'] =$get_sheetEtp[7]["H"] ? : "" ;
                        $data['total_bycatch'] = "0" ; 
                        $data['total_real_kecil'] = "0" ;  
                        $data['total_sampling_kecil'] = "0" ; 
                        $data['raising_factor'] = "0" ; 
                        $data['grid'] = json_encode($griding) ; 

                        $data['no_sipi'] = $get_sheetLanding[5]["L"] ? : "" ; 
                        $data['jumlah_rumpon_singgah'] = $get_sheetLanding[9]["K"] ? : "" ; 
                          $tgl = $get_sheetLanding[11]["A"] ? : "" ; 
                          $bln = $get_sheetLanding[11]["B"] ? : "" ; 
                              $no_bulan = array_search($bln, $bulan_arr);
                              $no_bulan = $no_bulan + 1 ; 
                              $no_bulan =  sprintf("%02d", $no_bulan);
                              $bln =  $no_bulan ; 
                          $thn = $get_sheetLanding[11]["C"] ? : "" ; 
                        $data['tanggal_berangkat'] = $thn.'-'.$bln.'-'.$tgl ;  
                          $tgl = $get_sheetLanding[13]["A"] ? : "" ; 
                          $bln = $get_sheetLanding[13]["B"] ? : "" ; 
                              $no_bulan = array_search($bln, $bulan_arr);
                              $no_bulan = $no_bulan + 1 ; 
                              $no_bulan =  sprintf("%02d", $no_bulan);
                              $bln =  $no_bulan ; 
                          $thn = $get_sheetLanding[13]["C"] ? : "" ; 
                        $data['tanggal_kembali'] = $thn.'-'.$bln.'-'.$tgl ;  
                        $data['jumlah_pakura'] = $get_sheetLanding[13]["H"] ? : "" ; 
                        $data['deskripsi_foto'] = $get_sheetDesc[4]["R"] ? : "" ; 
                        $data['ukuran_pancing'] = $get_sheetLanding[11]["F"] ? : "" ; 
                        

                         $this->Model_data->insertTripNew($data);

                       }else{


                             $griding = array();
                              $grid11 = $get_sheetLanding[5]["J"] ? : "" ;
                              $grid12 = $get_sheetLanding[5]["K"] ? : "" ;
                              $grid21 = $get_sheetLanding[6]["J"] ? : "" ;
                              $grid22 = $get_sheetLanding[6]["K"] ? : "" ;
                              $grid31 = $get_sheetLanding[7]["J"] ? : "" ;
                              $grid32 = $get_sheetLanding[7]["K"] ? : "" ;
                              if($grid11 == '' || $grid12 == ''){
                                 $notification[] = 'Grid tidak boleh kosong ';
                              }else{
                                $griding[] = $grid11." - ".$grid12; 
                                $griding[] = $grid21." - ".$grid22; 
                                $griding[] = $grid31." - ".$grid32; 
                              }

                            
                            $teknik_cari_tuna = '';
                            $ijek = 9;
                            for($i=0; $i < 5 ; $i++){
                              $temp =  $get_sheetLanding[$ijek+ $i ]["J"] ? : "" ;
                              if($temp !='')
                              $teknik_cari_tuna .= $temp.",";
                            }

                            if($rumpon == 'X' || $rumpon == 'F'){
                              $check = strpos($teknik_cari_tuna, 'Rumpon');
                                if( $check  === false){
                                     $teknik_cari_tuna .= 'Rumpon,';
                                  }
                            }
                            if($rumpon == 'F') {
                              $search = explode(',' , $teknik_cari_tuna );
                              $jumlah = count($search);
                            
                              if($jumlah > 2 ){
                                $notification[] = 'Anda memilih Rumpon : semua Di Rumpon (F), Maka Teknik Pencarian Lokasi Tuna Harus Pilih Rumpon Saja !'; 
                              }
                            }
                            if($rumpon == 'N'){
                              $check = strpos($teknik_cari_tuna, 'Rumpon');
                              if($check!== false){
                                $notification[] = 'Anda memilih Rumpon : Tidak Di Rumpon (N), Maka Teknik Pencarian Lokasi Tuna Jangan Pilih Rumpon !';      
                              }
                            }

                            //cari no kapal 
                            $checks = array('id_supplier' => $k_perusahaan , 
                                'nama_kapal' => $kapal , 
                                'status' => 'active',
                            );
                            $checkCode = $this->Model_data->checkExisting('master_vessel' , $checks , "numRows");
                            $no_ap2hi = "";
                            if($checkCode > 0){
                               $dataKapal = $this->Model_data->checkExisting('master_vessel' , $checks , "row");
                               $no_ap2hi = $dataKapal->id_vessel ; 

                            }

              //------------------------------INSERT TPS_PENDARATAN----------------------------
                  
                    $data['namafile'] = $namafile ; 
                    $data['k_landing'] = $k_landing ; 
                    $data['k_perusahaan'] = $k_perusahaan ; 
                    $data['enumerator1'] =  $get_sheetLanding[5]["F"] ? : "" ;
                    $data['enumerator2'] = $get_sheetLanding[5]["H"] ? : "" ;
                    $data['nama_kapal'] = $kapal ; 
                    $data['kapten_kapal'] = $kapten; 
                    $data['gt_kapal'] = $get_sheetLanding[11]["A"] ? : "0" ;
                    $data['panjang_kapal'] = $get_sheetLanding[11]["C"] ? : "0" ;
                    $data['mesin_kapal'] = $get_sheetLanding[11]["D"] ? : "0" ;
                    $data['bahan_kapal'] = $get_sheetLanding[13]["H"] ? : "" ;
                    $data['jum_awak'] = $get_sheetLanding[13]["A"] ? : "0" ;
                    $data['no_ap2hi'] = $no_ap2hi ; 
                    $data['grid1'] = $grid11 ; 
                    $data['grid2'] = $grid12 ; 
                    $data['total_penangkapan'] =  $get_sheetLanding[7]["H"] ? : "0" ;
                    $data['est_ikanhilang'] =  $get_sheetLanding[7]["I"] ? : "0" ;
                    $data['thn_sampling'] =  $get_sheetLanding[9]["C"] ? : "" ;
                    $data['bln_sampling'] =  $bulan;
                    $data['tgl_sampling'] =  $get_sheetLanding[9]["A"] ? : "" ;
                    $data['jam_sampling'] = $get_sheetLanding[9]["D"] ? : "" ;
                    $data['mnt_sampling'] = $get_sheetLanding[9]["E"] ? : "" ;
                    $data['rumpon'] = $rumpon ; 
                    $data['teknik_cari_tuna'] = $teknik_cari_tuna ; 
                    $data['bbm'] = $get_sheetLanding[9]["H"] ? : "0" ;
                    $data['k_alattangkap'] = 'PL';

                    $data['es'] = $get_sheetLanding[11]["H"] ? : "0" ;
                    $data['pengguna'] = $id_user ; 
                    $data['deskripsi'] = $get_sheetDesc[4]["A"] ? : "" ;
                    $data['lama_satuan'] = $get_sheetLanding[9]["G"] ? : "" ;
                    if($data['lama_satuan'] == 'hari'){
            $data['lama_hari'] = $get_sheetLanding[9]["F"] ? : "0" ;
            $data['lama_jam'] = "0" ;
          }else if($data['lama_satuan'] == 'jam'){
            $data['lama_jam'] = $get_sheetLanding[9]["F"] ? : "0" ;
            $data['lama_hari'] = "0" ;
          }
                    $data['hl_tipe_mata_pancing'] = "" ;
                    $data['hl_troll'] ="" ;
                    $data['hl_alat_tangkap_lain'] = "" ;
                    $data['pl_jum_pancing'] = $get_sheetLanding[13]["D"] ? : "" ; 
                    $data['pl_kapasitas_ember'] = $get_sheetLanding[13]["F"] ? : "0" ; 
                    $data['jumlah_hari_memancing'] =  $get_sheetLanding[11]["I"] ? : ""  ; 
                    $data['using_ringkasan_ikanbesar'] = "" ; 
                    $data['tgl_impor'] = date("Y-m-d") ; 
                    $data['jam_impor'] = date("H:i:s") ; 
                    $data['tipe'] = 'PL'; 
                    $data['e_pewawancara'] =  $get_sheetEtp[4]["C"] ? : "" ;
                    $data['e_umur'] = $get_sheetEtp[5]["C"] ? : "0" ;
                    $data['e_lama_tahun'] =$get_sheetEtp[6]["D"] ? : "0" ; 
                    $data['e_lama_bulan'] = $get_sheetEtp[6]["F"] ? : "0" ;
                    $data['e_jabatan'] =$get_sheetEtp[7]["D"] ? : "" ;
                    $data['e_keterangan'] =$get_sheetEtp[7]["H"] ? : "" ;
                    $data['total_bycatch'] = "0" ; 
                    $data['total_real_kecil'] = "0" ;  
                    $data['total_sampling_kecil'] = "0" ; 
                    $data['raising_factor'] = "0" ; 
                    $data['grid'] = json_encode($griding) ; 

                    $this->Model_data->insertTrip($data);
                      
                  //END INSERT TPS_PENDARATAN


                       }





                      //---------------------------INSERT TPS_KAPALKECIL-------------------------------
        
        $x=16;
        while($x<=35) 
        {
          $data['no'] =  $get_sheetLanding[$x]["A"] ? : ""  ;  
          if ($data['no']=="") 
          {
              break;
          }  
          $data['nama'] =$get_sheetLanding[$x]["B"] ? : ""  ;   
          $data['total_penangkapan'] = $get_sheetLanding[$x]["D"] ? : "0"  ;  
          $data['est_ikanhilang'] = $get_sheetLanding[$x]["E"] ? : "0"  ;  
          $data['lama'] = $get_sheetLanding[$x]["F"] ? : "0"  ;  
          $data['lama_satuan'] = $get_sheetLanding[$x]["G"] ? : ""  ;  
          $data['bbm'] = $get_sheetLanding[$x]["H"] ? : "0"  ;  
          $data['mesin'] = $get_sheetLanding[$x]["J"] ? : "0"  ;  
            $this->Model_data->insertKapalKecil($data);

          $x++;
        }  
        
        //END INSERT TPS_KAPALKECIL



        /*//---------------------------INSERT TPS_UMPAN-------------------------------*/
        $x=5;
        $urut = 1;
        while($x<=11) 
        {
          $data['k_umpan'] = $get_sheetUmpan[$x]["A"] ? : ""  ;  
          if ($data['k_umpan']=="") 
          {
           break;
          }  
          $data['species'] = $get_sheetUmpan[$x]["B"] ? : ""  ;  
          $data['rumpon1'] = $get_sheetUmpan[$x]["C"] ? : ""  ;  
          $data['rumpon2'] = $get_sheetUmpan[$x]["D"] ? : ""  ;  
          $data['total'] = "0"  ;  
          $data['estimasi'] = $get_sheetUmpan[$x]["F"] ? : "0"  ;  
          $malat = $get_sheetUmpan[$x]["G"] ? : ""  ;  
             if ($malat != "") 
              {
              $ijek = $malat;
              $find=3;
              while ($find<=50)
              {
                $malat = $get_sheetParam[$find]["AR"] ? : ""  ;   
                if ($malat == $ijek)
                {
                  $data['k_alattangkap'] = $get_sheetParam[$find]["AQ"] ? : ""  ;  
                  break;
                }
                $find++;
              }     
              }
         $domestic_import =  $get_sheetUmpan[$x]["H"] ? : ""  ;  
             if ($domestic_import != "") 
              {
              $ijek = $domestic_import;
              $find=3;
              while ($find<=10)
              {
                $domestic_import = $get_sheetParam[$find]["AJ"] ? : ""  ;  
                if ($domestic_import == $ijek)
                {
                  $data['domestic_import'] = $get_sheetParam[$find]["AI"] ? : ""  ; 
                  break;
                }
                $find++;
              }     
              }
         
            $data['pl_pengadaan_umpan'] = "0" ;
            $data['pl_jum_ember'] =  $get_sheetUmpan[$x]["E"] ? : ""  ; 
            $data['urut'] = $urut ; 
            $this->Model_data->insertUmpan($data);

          $x++;
          $urut++;
        }
        //End INSERT TPS_UMPAN
        

      /* INSERT TPS_BYCATCH */
        $x=5;
        $totalb_bycatch = 0; //TOTAL BERAT tangkapan lain
        while($x<=11) 
        {
          $no =  $get_sheetBycatch[$x]["A"] ? : ""  ;  
          if ($no=="") 
          {
          //break;
          }else{  
            $species = $get_sheetBycatch[$x]["B"] ? : ""  ; 
            if ($species != "") 
            {
            $ijek = $species;
            $kon=3;
            while ($kon<=100)
            {
              $species = $get_sheetParam[$kon]["U"] ? : ""  ;   
              if ($species == $ijek)
              {
                $data['k_species'] = $get_sheetParam[$kon]["T"] ? : ""  ;
                break;
              }
              $kon++;
            }     
            }
            $data['jumlah'] = $get_sheetBycatch[$x]["C"] ? : "0"  ; 
            $data['berat'] = $get_sheetBycatch[$x]["D"] ? : "0"  ; 
            $estimasi = $get_sheetBycatch[$x]["E"] ? : ""  ;  
            $data['estimasi'] = strtoupper(substr($estimasi,0,1));
           
            $this->Model_data->insertBycatch($data);

            $totalb_bycatch = $totalb_bycatch + $data['berat'];  //jumlahkan
          }
          $x++;
        }
        /* INSERT TPS_BYCATCH */



      /* INSERT FOR IKAN KECIL */
    
        $awal=5; $akhir=14; $awal1=18;
        $x=$awal;
        $totalb_ikankecil = 0; //TOTAL BERAT IKAN KECIL
        
        while($x<=$akhir) 
        {
          $data['kode'] = $get_sheetSmall[$x]["B"] ? : ""  ;  
          if ($data['kode'] != "") 
          {
                
              $data['deskripsi'] = $get_sheetSmall[$x]["C"] ? : ""  ;  
              $data['berat'] = $get_sheetSmall[$x]["F"] ? : "0"  ;  

              $this->Model_data->insertRingkasan($data , "tps_ringkasan_ikankecil"); 

              $totalb_ikankecil = $totalb_ikankecil + $data['berat'] ;  //JUMLAHKAN
          }
          $x++;
        }
        

      $x=$awal1;
      $i=0; $sw=0;
      $noker = 0;
      $noikan = 1;  
      $totalsamplingikankecil = 0;
      $total_yft_kecil = 0; $total_bet_kecil = 0; $total_skj_kecil = 0;
      while($x<=217) 
      {
        $stat = 'N';
        $beratkeranjang = $get_sheetSmall[$x]["A"] ? : "0"  ;  
        
        
        $kode = '-';
        if($beratkeranjang != 0){
          $totalsamplingikankecil = $totalsamplingikankecil + $beratkeranjang ; 
             if($noker == 0){
               $noker = $noker + 1; 
             }else if($noker == 1){
               $noker = $noker + 4 ; 
             }else{
               $noker = $noker + 5 ;
             }

             $data['noker'] = $noker ; 
             $data['beratkeranjang'] = $beratkeranjang ; 
             $this->Model_data->insertKeranjang($data); 
      
          $stat = 'Y';
        }
        
        if($stat == 'Y'){
          $noikan = 1;
        }
      
            $k_species = $get_sheetSmall[$x]["B"] ? : ""  ;   
            $panjang = $get_sheetSmall[$x]["E"] ? : ""  ;   
      
          if($k_species != ''){
            
            $kalkulasi_berat = 0;
            if($k_species == 'YFT'){
              $kalkulasi_berat = $var_a_yft_kecil * (pow($panjang , $var_b_yft_kecil )) ; 
              $kalkulasi_berat = number_format($kalkulasi_berat, 2);
              
              $total_yft_kecil = $total_yft_kecil + $kalkulasi_berat ; 
              $total_yft_kecil = number_format($total_yft_kecil  , 2); 
            }
            if($k_species == 'BET'){
              $kalkulasi_berat = $var_a_bet_kecil * (pow($panjang , $var_b_bet_kecil )) ; 
              $kalkulasi_berat = number_format($kalkulasi_berat, 2);
              
              $total_bet_kecil = $total_bet_kecil + $kalkulasi_berat ; 
              $total_bet_kecil = number_format($total_bet_kecil  , 2);
            }
            if($k_species == 'SKJ'){
              $kalkulasi_berat = $var_a_skj_kecil * (pow($panjang , $var_b_skj_kecil )) ; 
              $kalkulasi_berat = number_format($kalkulasi_berat, 2);
              
              $total_skj_kecil = $total_skj_kecil + $kalkulasi_berat ; 
              $total_skj_kecil = number_format($total_skj_kecil  , 2);
            }

            $data['k_species'] = $k_species ; 
            $data['panjang'] = $panjang ; 
            $data['noikan'] = $noikan ; 
            $data['kalkulasi_berat'] = $kalkulasi_berat ; 
            
            $this->Model_data->insertSmall($data);
          }
          
          $stat = 'N';
          $noikan++;
          $x++;

        }
    
        //masukkan kalkulasi ke total_ikan_kecil
          $total_kalkulasi_ikankecil = $total_yft_kecil + $total_bet_kecil + $total_skj_kecil ; 
          if($total_yft_kecil > 0){
            
            $percen_yft =   ( $total_yft_kecil / $total_kalkulasi_ikankecil ) * 100  ; 
            $summary_yft = number_format($totalb_ikankecil * ($percen_yft / 100) , 2 , '.' , '') ;
            $data['total_xxx_kecil'] = $total_yft_kecil ; 
            $data['summary_xxx'] = $summary_yft ; 
            $data['species'] = 'YFT'; 

             $this->Model_data->insertTotalIkanKecil($data);
            
          }
          if($total_bet_kecil > 0){
            $percen_bet =   ( $total_bet_kecil / $total_kalkulasi_ikankecil ) * 100  ; 
            $summary_bet = number_format($totalb_ikankecil * ($percen_bet / 100) , 2 , '.' , '') ;
            $data['total_xxx_kecil'] = $total_bet_kecil ; 
            $data['summary_xxx'] = $summary_bet ; 
            $data['species'] = 'BET'; 

            $this->Model_data->insertTotalIkanKecil($data);
          
          }
          if($total_skj_kecil > 0){
            $percen_skj =   ( $total_skj_kecil / $total_kalkulasi_ikankecil ) * 100  ; 
            $summary_skj = number_format($totalb_ikankecil * ($percen_skj / 100) , 2 , '.' , '') ;
            $data['total_xxx_kecil'] = $total_skj_kecil ; 
            $data['summary_xxx'] = $summary_skj ; 
            $data['species'] = 'SKJ'; 

            $this->Model_data->insertTotalIkanKecil($data);
           
          }
        //end INSERT FOR IKAN KECIL


        /* INSERT IKAN BESAR*/
    
          $awal1=19;
          $awal=5; $akhir=14;  
          $x=$awal;
          $total_ringkasanBesar = 0;
          while($x<=$akhir) 
          {
            $data['kode'] = $get_sheetLarge[$x]["B"] ? : ""  ; 
            if ( $data['kode']  != "") 
            {
  

              $data['deskripsi'] = $get_sheetLarge[$x]["D"] ? : ""  ;  
              $data['berat'] = $get_sheetLarge[$x]["H"] ? : "0"  ;  

              $this->Model_data->insertRingkasan($data , "tps_ringkasan_ikanbesar"); 

            
            $totalBeratBesar =  $data['berat'] ;
            $total_ringkasanBesar = $total_ringkasanBesar + $totalBeratBesar ;
            }
            $x++;
          } 
          
          $kalk='';
          $x=$awal1;
          $k_kapalkecil = 0;
          $totalb_ikanbesar = 0; //TOTAL BERAT IKAN BESAR
          while($x<=219) 
          {
        
           $noikan = $get_sheetLarge[$x]["A"] ? : ""  ;   
            if ($noikan == "")
              {
              break;  
              }

                $no_ikan = $noikan ; 
                $k_species = $get_sheetLarge[$x]["B"] ? : ""  ;   
                $kode = $get_sheetLarge[$x]["D"] ? : ""  ;
                $berat = $get_sheetLarge[$x]["E"] ? : "0"  ; 
                $panjang= $get_sheetLarge[$x]["F"] ? : "0"  ; 
                $k_kapalkecil = 0 ;  
                $loin1_berat = $get_sheetLarge[$x]["G"] ? : "0"  ; 
                $loin1_panjang = $get_sheetLarge[$x]["H"] ? : "0"  ;
                $valid = ""  ; 
                $insang = $get_sheetLarge[$x]["I"] ? : "-"  ;
                $isi_perut= $get_sheetLarge[$x]["J"] ? : "-"  ;
                $daging_perut=  "-"  ;
                      
               $t_b = $berat ; 
               $t_p = $panjang; 
               $brt = $berat ; 
               $pjg = $panjang ; 
               $l1_b = $loin1_berat ; 
               $l1_p = $loin1_panjang ; 
               $xyz1 = $insang ; 
               $xyz2 = $isi_perut ; 
               $xyz3 = $daging_perut ; 
                $xyz1 = substr($xyz1,0,1);
                $xyz2 = substr($xyz2,0,1);
                $xyz3 = substr($xyz3,0,1);
                
              if( $t_b == '0' && $t_p != '0' ){
                  
                  $pjg=$t_p;
                  $brt=pow($pjg, $var_b)*$var_a;
                  $t_p=round($pjg);
                  $t_b=round($brt/1000);
                  $kalk='Y';
                  
              }
              else if ($t_b == '0' && $l1_p != '0' )
                {
                  $pjg=0;
                    if ($l1_p != '0')
                  {
                    $pjg=$l1_p;
                  }

                      if ($pjg != 0)
                      {
                        
                        $pjg=$var_v*$pjg+$var_k;
                        
                        $brt=pow($pjg, $var_b)*$var_a;
                        $t_p=round($pjg);
                        $t_b=round($brt/1000);
                        $kalk='Y';
                      }           
                  
                }
               
                $data['no_ikan'] = $noikan ; 
                $data['k_species'] =$k_species ;   
                $data['kode'] = $kode ;
                $data['berat'] = $t_b;  
                $data['panjang']= $t_p ;  
                $data['k_kapalkecil'] = 0 ;  
                $data['loin1_berat'] = $loin1_berat;
                $data['loin1_panjang'] = $loin1_panjang ; 
                $data['valid'] = ""  ; 
                $data['insang'] = $xyz1;
                $data['isi_perut']= $xyz2;
                $data['daging_perut']= "";
                $data['kalkulasi'] = $kalk; 
              

                $this->Model_data->insertLarge($data);

              $x++;
            $totalb_ikanbesar = $totalb_ikanbesar + $t_b; //jumlahkan semua berat ikan besar
          }

            //tambahan conversion
            if($kalk=='Y'){
                $totalcatch = ($totalb_ikanbesar + $totalb_ikankecil + $totalb_bycatch);
                
                $data['totalcatch'] = $totalcatch ; 
                //SATU
                $this->Model_data->konversiSatu($data);

              }else{
                $using_ringkasan_ikan_besar = "";
                if($totalb_ikanbesar == 0 && $total_ringkasanBesar > 0 ){
                  $using_ringkasan_ikan_besar = " , using_ringkasan_ikanbesar = 'Y' ";
                  $totalcatch = ($total_ringkasanBesar + $totalb_ikankecil + $totalb_bycatch);
                }else{
                  $totalcatch = ($totalb_ikanbesar + $totalb_ikankecil + $totalb_bycatch);
                }
                $data['totalcatch'] = $totalcatch; 
                $data['using_ringkasan_ikan_besar'] = $using_ringkasan_ikan_besar; 
                //DUA
               $this->Model_data->konversiDua($data); 
            //end tambahan conversion
        }
            
          /*  end INSERT IKAN BESAR*/
          
          /* Raising Factor */
                $raising_factor = 0;
                    if($totalb_ikankecil != 0 && $totalsamplingikankecil != 0){
                          $raising_factor  = $totalb_ikankecil / $totalsamplingikankecil ; 
                          $raising_factor =  number_format($raising_factor,2);  
                    }
                  $data['totalb_bycatch'] = $totalb_bycatch ; 
                  $data['totalb_ikankecil'] = $totalb_ikankecil ; 
                  $data['totalsamplingikankecil'] = $totalsamplingikankecil ; 
                  $data['raising_factor'] = $raising_factor ; 
                //TIGA
                $this->Model_data->konversiTiga($data);
          /* End Raising Factor */



    /* ETP */
    $x=10;
    $urut=0;
    $max = $highestRowEtp ; 
      while($x<=$max) 
      {
        $kelp =  $get_sheetEtp[$x]["A"] ? : ""  ;
        if ($kelp != "") 
        {
        $urut=$urut+1;
        $sql="INSERT INTO tps_etp(interaksi, namafile, urut, k_species, jml_interaksi, jml_didaratkan, est_interaksi,";
        $sql=$sql."est_didaratkan, d_1, d_2, d_3, d_4, d_5, td_1, td_2, td_3, td_4,";
        $sql=$sql."td_5, dibuang, dimakan, dijual, diumpan, tidak_tahu, k_kelompok,"; 
        $sql=$sql."namalokal, yakin_lokal, yakin_species, lokasi_interaksi, r1, r2, r3, alat_etp, alat_lain, tangan, kapal, lainnya) VALUES (";
        $temp = $get_sheetEtp[$x]["D"] ? : ""  ; ;
        $sql=$sql."'".$temp."',";
        $sql=$sql."'".$namafile."',";
        $sql=$sql.$urut.",";
        $temp = $get_sheetEtp[$x]["S"] ? : ""  ; 
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x]["F"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x+1]["F"] ? : "0"  ;
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["G"] ? : ""  ; 
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x+1]["G"] ? : ""  ;  
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x]["I"] ? : "0"  ; 
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["J"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["K"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["L"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["M"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x+1]["I"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x+1]["J"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x+1]["K"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x+1]["L"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x+1]["M"] ? : "0"  ; 
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["N"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["O"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["P"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["Q"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["R"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x]["A"] ? : ""  ;  
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x+1]["O"] ? : ""  ;  
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x+1]["R"] ? : ""  ;  
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x+1]["S"] ? : ""  ;  
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x+3]["G"] ? : ""  ;  
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x+4]["D"] ? : "0"  ; 
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x+4]["E"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x+4]["F"] ? : "0"  ;  
        $sql=$sql.$temp.",";
        $temp = $get_sheetEtp[$x+4]["J"] ? : ""  ;  
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x+4]["L"] ? : ""  ;  
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x+4]["N"] ? : ""  ;  
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x+4]["O"] ? : ""  ;  
        $sql=$sql."'".$temp."',";
        $temp = $get_sheetEtp[$x+4]["P"] ? : ""  ;  
        $sql=$sql."'".$temp."')";
        
          $this->Model_data->insertEtp($sql); 

        }
        $x=$x+6;
      } 


         $notification[] = "Berhasil";
         $notification[] = "<br>Silahkan check pada link berikut <a href='".base_url()."data/mainpage/detailnamafile/".$namafile."' target='_BLANK'>".$namafile."</a>!";     
  







                  }else{

                    $notification[] = "Template Error !";

                  }


          }


          return $notification ; 


    }




    public function samplinglists($k_tpi = null, $tahun = null , $bulan = null , $tgl = null ){


      $this->auth->check_login();

        if(!$this->auth->hasPrivilege("ViewOverview")){

            redirect('home','refresh');

        }

        $user = $this->auth->get_data_session();

        $data['content']="data/samplinglists";

        $data['tgl'] = $tgl ; 

        $data['bulan'] = $bulan ; 

        $data['tahun'] = $tahun ; 

        $data['k_tpi'] = $k_tpi ; 

        $this->load->view('template-admin/template',$data);
    

    }



    public function samplinglists_supplier($k_perusahaan = null, $tahun = null , $bulan = null , $tgl = null ){

      $this->auth->check_login();

        if(!$this->auth->hasPrivilege("ViewOverview")){

            redirect('home','refresh');

        }

        $user = $this->auth->get_data_session();

        $data['content']="data/samplinglists_supplier";

        $data['tgl'] = $tgl ; 

        $data['bulan'] = $bulan ; 

        $data['tahun'] = $tahun ; 

        $data['k_perusahaan'] = $k_perusahaan ; 

        $this->load->view('template-admin/template',$data);
    


    }


    public function samplinglists_tgl($k_tpi = null, $tahun = null , $bulan = null , $tgl = null){


      $this->auth->check_login();


       if(!$this->auth->hasPrivilege("ViewOverview")){

            redirect('home','refresh');

        }

        $user = $this->auth->get_data_session();

        $data['content']="data/samplinglists_tgl";

        $data['tgl'] = $tgl ; 

        $data['bulan'] = $bulan ; 

        $data['tahun'] = $tahun ; 

        $data['k_tpi'] = $k_tpi ; 

        $this->load->view('template-admin/template',$data);



    }

    public function samplinglists_supplier_tgl($k_perusahaan = null, $tahun = null , $bulan = null , $tgl = null){

      $this->auth->check_login();


       if(!$this->auth->hasPrivilege("ViewOverview")){

            redirect('home','refresh');

        }

        $user = $this->auth->get_data_session();

        $data['content']="data/samplinglists_supplier_tgl";

        $data['tgl'] = $tgl ; 

        $data['bulan'] = $bulan ; 

        $data['tahun'] = $tahun ; 

        $data['k_perusahaan'] = $k_perusahaan ; 

        $this->load->view('template-admin/template',$data);

    }


     public function detailnamafile($namafile){



        $this->auth->check_login();


         if(!$this->auth->hasPrivilege("ViewOverview")){

              redirect('home','refresh');

          }

           $user = $this->auth->get_data_session();

           $data['namafile'] = $namafile ; 

           $data['content']="data/detailnamafile";

          $this->load->view('template-admin/template',$data);

    }


    public function detailikankecil($namafile , $nomor , $k_kapalkecil , $kode , $berat   ){


      $data['mnamafile'] = $namafile ; 
      $data['mnomor'] = $nomor ; 
      $data['mkode'] = $kode ; 
      $data['mberat'] = $berat ; 
      $data['mk_kapalkecil'] = $k_kapalkecil ; 


      $data['content']="data/detailikankecil";

      $this->load->view('template-admin/template',$data);


    }



    public function rumponupload(){


       $this->auth->check_login();

        if(!$this->auth->hasPrivilege("ViewUploadRumpon")){

            redirect('home','refresh');

        }

        $user = $this->auth->get_data_session();


        $notification = array() ; 

        $status = "";

        $this->load->library('excel');

        if(!empty($_FILES['file']['name'])){

            $namafile = $_FILES['file']['name'];
            $get_name = explode(".",$namafile) ; 
            $kode_upload = date('Ymd').'_'.date('His').'.'.$get_name[1]; 
            if( move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/rumpons/' . $kode_upload) ) {
               
                $inputFileName  = 'uploads/rumpons/'.$kode_upload;


                $notification = $this->uploadRumpon( $inputFileName , $kode_upload ); 
                  if(count($notification) > 0){
                    $status = 'error'; 
                  }else{
                    $status = 'success'; 
                  }
                
          } 

        }


        $data['status'] = $status; 

        $data['notification'] = $notification; 

        $data['url_rumponupload']=base_url()."data/mainpage/rumponupload";

        $data['content']="data/rumponupload";

        $this->load->view('template-admin/template',$data);



    }


    public function uploadRumpon($inputFileName , $namafile){

       $user = $this->auth->get_data_session();
       $id_user = $user->id_user;

       $bulan_arr = array( 'Januari' , 'Februari' , 'Maret' , 'April' , 'Mei' , 'Juni' , 'Juli' , 'Agustus' , 'September' , 'Oktober' , 'November' , 'Desember') ; 
    
       $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);

                $sheet = $objPHPExcel->getSheetByName('form');
                $highestRow = $sheet->getHighestRow(); 
                $highestColumn = $sheet->getHighestColumn();
                $get_sheetRumpon=$sheet->toArray(null,true,true,true);

                 $notification = array();
                  $i = 1;
                  for ($row = 5; $row <= $highestRow; $row++){
                    $no = $get_sheetRumpon[$row]["A"] ? : "" ;
                    if( $no != '') {

                            $supplierName           = $get_sheetRumpon[$row]["B"] ? : "" ;
                            $supplierData = $this->global_model->general_select2('master_supplier',array('nama_perusahaan'=> $supplierName ),'row','','');

                            if( !empty($supplierData) ){
                             $data['kode_upload']             = $namafile ; 
                             $data['urutan']                  = $i ;
                             $data['id_supplier']             = $supplierData->id_supplier ;
                             $data['alamat']                  = $get_sheetRumpon[$row]["C"] ? : "" ;
                             $data['no_sipr']                 = $get_sheetRumpon[$row]["D"] ? : "" ;
                             $data['daerah_penangkapan']      = $get_sheetRumpon[$row]["E"] ? : "" ;
                             $data['daerah_usaha']            = $get_sheetRumpon[$row]["F"] ? : "" ;
                             $data['alat_tangkap']            = $get_sheetRumpon[$row]["G"] ? : "" ;
                             $data['posisi_rumpon']           = $get_sheetRumpon[$row]["H"] ? : "" ;
                             $data['bahan']                   = $get_sheetRumpon[$row]["I"] ? : "" ;
                             $data['nama_kapal']              = $get_sheetRumpon[$row]["J"] ? : "" ;

                             $insertRumpon = $this->Model_data->insertRumpon($data); 

                             if($insertRumpon == FALSE){
                                $notification[] = 'Gagal insert nomor urut '.$i ; 
                             }


                            }else{

                                $notification[] = 'Gagal insert nomor urut '.$i ; 

                            }

                            $i++;
                     }
                  }
                

                 return $notification ; 
    
    }


    public function rumponlists(){

      $this->auth->check_login();

        if(!$this->auth->hasPrivilege("ViewListRumpon")){

            redirect('home','refresh');

        }

        $user = $this->auth->get_data_session();

        $data['url_load_table'] = base_url()."data/mainpage/listUploadRumpon/";
 
        $data['content']="data/rumponlists";

        $this->load->view('template-admin/template',$data);
    

    }


     public function listUploadRumpon(){


       $this->auth->restrict_ajax_login();

       $user = $this->auth->get_data_session();

       $id_user  = $user->id_user;


        $query = $this->Model_data->get_all_rumpon();

        $result = array();

          foreach($query->result() as $row){

            $SupplierData = $this->global_model->general_select2('master_supplier',array('id_supplier'=> $row->id_supplier ),'row','nama_perusahaan','');
          
              $result['data'][]=array(


                     $row->kode_upload  ,
                     $row->urutan ,
                     $SupplierData->nama_perusahaan ,
                     $row->alamat ,
                     $row->no_sipr ,
                     $row->daerah_penangkapan ,
                     $row->daerah_usaha ,
                     $row->alat_tangkap ,
                     $row->posisi_rumpon ,
                     $row->bahan ,
                     $row->nama_kapal  ,
                    

                );


         }


          echo json_encode($result);

     }


     function count_total_tangkapan(){

        $query = $this->Model_data->count_total_tangkapan();

     }



     function samplingperusahaan( $k_tpi = null, $tahun = null , $bulan = null , $tgl = null ){


      $this->auth->check_login();

        if(!$this->auth->hasPrivilege("ViewOverview")){

            redirect('home','refresh');

        }

        $data['user'] = $this->auth->get_data_session();

        $data['content']="data/samplinglists_perusahaan_page";

        $data['tgl'] = $tgl ; 

        $data['bulan'] = $bulan ; 

        $data['tahun'] = $tahun ; 

        $data['k_tpi'] = $k_tpi ; 

        $this->load->view('template-admin/template',$data);
    


     }


     function sampling_data_user(){

      $user = $this->auth->get_data_session();

      

          $data['content']="data/sampling_data_user";



          $this->load->view('template-admin/template',$data);
    



     }


     public function update_upload_user(){


        $user = $this->auth->get_data_session();

        $id_user = $user->id_user;

    
        $this->auth->check_login();

        //$data['url_load_table']=base_url()."data/mainpage/viewUploadedUserWaktu/2018/5/2";


        $data['url_disable_list']=base_url()."data/mainpage/disable_list/";
            
          
        if (isset($_POST['bulan']) || isset($_POST['tahun'])){
          
            $tahun =  $_POST['tahun'] ; 

            $bulan =  $_POST['bulan'] ; 
            
            //$data['url_load_table']=base_url()."data/mainpage/viewUploadedUserWaktu/2018/5/2";
            $data['url_load_table']=base_url()."data/mainpage/viewUploadedUserWaktu/".$tahun."/".$bulan."/".$id_user;


        }


        if (isset($_POST['namafile'])){
          
            $namafile =  $_POST['namafile'] ; 

            $data['url_load_table']=base_url()."data/mainpage/viewUploadedUserNamafile/".$namafile."/".$id_user;


        }

        $data['content']="data/viewUploadedUser";


        $this->load->view('template-admin/template',$data);
    



    

     }

     public function viewUploadedUserNamafile($namafile=null ,$pengguna = null  ){


         $this->auth->restrict_ajax_login_datatable();

         $query = $this->Model_data->get_all_uploaded_namafile($namafile , $pengguna);

         $result = array();

         $no = 0;
        
        foreach($query->result() as $row){

                $no++;
     
  
                    $action1 = '<a type="button" data-toggle="modal" data-target="#disableListModal" onclick="disableData(\''.$row->namafile.'\')" class="btn btn-danger a-btn-slide-text">
                                   <span class="fa fa-times" aria-hidden="true"></span>
                                    <span><strong>Disable</strong></span>            
                                </a>'; 


                    $namafile = '<a href="'.base_url()."/data/mainpage/detailnamafile/".$row->namafile.'" target="_blank">'.$row->namafile.'</a>'; 
                
                

                $result['data'][]=array(

                        $no , 
                        $row->k_landing, 
                        $namafile,
                        $row->thn_sampling , 
                        $row->bln_sampling , 
                        $row->tgl_sampling , 
                        $row->nama_kapal , 
                        $row->kapten_kapal , 
                        $action1 
                
                
                ); 

        }


         echo json_encode($result);

     }



     public  function viewUploadedUserWaktu($tahun=null , $bulan=null , $pengguna = null){



         $this->auth->restrict_ajax_login_datatable();

         $query = $this->Model_data->get_all_uploaded_user($tahun , $bulan , $pengguna);

         $result = array();

         $no = 0;
        
        foreach($query->result() as $row){

                $no++;
     
  
                    $action1 = '<a type="button" data-toggle="modal" data-target="#disableListModal" onclick="disableData(\''.$row->namafile.'\')" class="btn btn-danger a-btn-slide-text">
                                   <span class="fa fa-times" aria-hidden="true"></span>
                                    <span><strong>Disable</strong></span>            
                                </a>'; 


                    $namafile = '<a href="'.base_url()."/data/mainpage/detailnamafile/".$row->namafile.'" target="_blank">'.$row->namafile.'</a>'; 
                

                $result['data'][]=array(

                        $no , 
                        $row->k_landing, 
                        $namafile,
                        $row->thn_sampling , 
                        $row->bln_sampling , 
                        $row->tgl_sampling , 
                        $row->nama_kapal , 
                        $row->kapten_kapal , 
                        $action1 
                
                
                ); 

        }


         echo json_encode($result);

      
     }


     


    public function disable_list(){

        
        $saved = $this->Model_data->disable_list($_POST['id']);

            if ($saved)
            {
                 $success = true;
                 $messages =  "Successfully disable Data! ";
            }
            else
            {
                 $success = false;
                 $messages =  "disable not working ! ";
            }
        
        $validator['success'] = $success;
        $validator['messages'] = $messages;

        echo json_encode($validator);


    }



public function download_extract(){


$this->load->library('excel');

ob_end_clean();
    //observerform_trip
  
    $objWorkSheet = $this->excel->createSheet(0); 

      $objWorkSheet->setCellValue('A1', 'namafile') ; 
      $objWorkSheet->setCellValue('B1', 'nama_landing') ; 
      $objWorkSheet->setCellValue('C1', 'nama_perusahaan ') ; 
      $objWorkSheet->setCellValue('D1', 'enumerator1 ') ; 
      $objWorkSheet->setCellValue('E1', 'enumerator2 ') ; 
      $objWorkSheet->setCellValue('F1', 'nama_kapal') ;  
      $objWorkSheet->setCellValue('G1', 'kapten_kapal') ;  
      $objWorkSheet->setCellValue('H1', 'gt_kapal') ;  
      $objWorkSheet->setCellValue('I1', 'panjang_kapal') ;  
      $objWorkSheet->setCellValue('J1', 'mesin_kapal') ;  
      $objWorkSheet->setCellValue('K1', 'bahan_kapal') ;  
      $objWorkSheet->setCellValue('L1', 'jum_awak ') ; 
      $objWorkSheet->setCellValue('M1', 'no_ap2hi') ;  
      $objWorkSheet->setCellValue('N1', 'grid1') ;  
      $objWorkSheet->setCellValue('O1', 'grid2') ;  
      $objWorkSheet->setCellValue('P1', 'total_penangkapan') ;  
      $objWorkSheet->setCellValue('Q1', 'est_ikanhilang') ; 
      $objWorkSheet->setCellValue('R1', 'thn_sampling ') ; 
      $objWorkSheet->setCellValue('S1', 'bln_sampling') ;  
      $objWorkSheet->setCellValue('T1', 'tgl_sampling') ;  
      $objWorkSheet->setCellValue('U1', ' jam_sampling') ; 
      $objWorkSheet->setCellValue('V1', 'mnt_sampling') ;  
      $objWorkSheet->setCellValue('W1', 'rumpon') ;  
      $objWorkSheet->setCellValue('X1', 'teknik_cari_tuna ') ; 
      $objWorkSheet->setCellValue('Y1', 'bbm') ;  
      $objWorkSheet->setCellValue('Z1', 'k_alattangkap ') ; 
      $objWorkSheet->setCellValue('AA1', 'es ') ; 
      $objWorkSheet->setCellValue('AB1', 'pengguna ') ; 
      $objWorkSheet->setCellValue('AC1', 'deskripsi ') ; 
      $objWorkSheet->setCellValue('AD1', 'lama_satuan ') ; 
      $objWorkSheet->setCellValue('AE1', 'lama_jam ') ; 
      $objWorkSheet->setCellValue('AF1', 'lama_hari ') ; 
      $objWorkSheet->setCellValue('AG1', 'hl_tipe_mata_pancing') ; 
      $objWorkSheet->setCellValue('AH1', 'hl_troll') ; 
      $objWorkSheet->setCellValue('AI1', 'hl_alat_tangkap_lain') ; 
      $objWorkSheet->setCellValue('AJ1', 'pl_jum_pancing/jumlah_joran') ; 
      $objWorkSheet->setCellValue('AK1', 'pl_kapasitas_ember') ; 
      $objWorkSheet->setCellValue('AL1', 'jumlah_hari_memancing') ; 
      $objWorkSheet->setCellValue('AM1', 'using_ringkasan_ikanbesar') ; 
      $objWorkSheet->setCellValue('AN1', 'tgl_impor') ; 
      $objWorkSheet->setCellValue('AO1', ' jam_impor') ; 
      $objWorkSheet->setCellValue('AP1', ' tipe ') ; 
      $objWorkSheet->setCellValue('AQ1', ' e_pewawancara') ; 
      $objWorkSheet->setCellValue('AR1', ' e_umur') ; 
      $objWorkSheet->setCellValue('AS1', ' e_lama_tahun ') ; 
      $objWorkSheet->setCellValue('AT1', 'e_lama_bulan') ; 
      $objWorkSheet->setCellValue('AU1', ' e_jabatan') ; 
      $objWorkSheet->setCellValue('AV1', ' e_keterangan') ; 
      $objWorkSheet->setCellValue('AW1', 'grid') ; 
      $objWorkSheet->setCellValue('AX1', 'no_sipi') ;   
      $objWorkSheet->setCellValue('AY1', 'jumlah_rumpon_singgah') ; 
      $objWorkSheet->setCellValue('AZ1', 'tanggal_berangkat') ; 
      $objWorkSheet->setCellValue('BA1', 'tanggal_kembali') ;   
      $objWorkSheet->setCellValue('BB1', 'jumlah_pakura') ;   
      $objWorkSheet->setCellValue('BC1', 'ukuran_pancing') ; 



     $result = $this->Model_data->extract_pendaratan()->result_array();

    $objWorkSheet->fromArray($result, null, 'A2');
    
     $objWorkSheet->setTitle("1-Trip Info ".date('Ymd'));



    $objWorkSheet = $this->excel->createSheet(1); 

    $objWorkSheet->setCellValue('A1', 'Namafile') ; 
    $objWorkSheet->setCellValue('B1', 'no_urut') ; 
    $objWorkSheet->setCellValue('C1', 'total_penangkapan') ; 
    $objWorkSheet->setCellValue('D1', 'est_ikanhilang') ;  
    $objWorkSheet->setCellValue('E1', 'lama') ;  
    $objWorkSheet->setCellValue('F1', 'lama_satuan') ;  
    $objWorkSheet->setCellValue('G1', 'bbm') ;  
    $objWorkSheet->setCellValue('H1', 'mesin') ;  
    $objWorkSheet->setCellValue('I1', 'nama') ;  

   $result = $this->db->query("SELECT * FROM tps_kapalkecil  order by namafile ;")->result_array();

    $objWorkSheet->fromArray($result, null, 'A2');

    $objWorkSheet->setTitle("2- Informasi Kapal Kecil ");









    $objWorkSheet = $this->excel->createSheet(2); 

    $objWorkSheet->setCellValue('A1', 'namafile character') ;
    $objWorkSheet->setCellValue('B1', 'k_umpan character') ; 
    $objWorkSheet->setCellValue('C1', 'urut') ; 
    $objWorkSheet->setCellValue('D1', 'species') ; 
    $objWorkSheet->setCellValue('E1', 'rumpon1') ; 
    $objWorkSheet->setCellValue('F1', 'rumpon2') ; 
    $objWorkSheet->setCellValue('G1', 'total') ;
    $objWorkSheet->setCellValue('H1', 'estimasi') ; 
    $objWorkSheet->setCellValue('I1', 'k_alattangkap') ;
    $objWorkSheet->setCellValue('J1', 'pl_pengadaan_umpan') ; 
    $objWorkSheet->setCellValue('K1', 'pl_jum_ember') ; 
    $objWorkSheet->setCellValue('L1', 'domestic_import') ; 

   $result = $this->db->query("SELECT * FROM tps_umpan order by namafile ;")->result_array();

    $objWorkSheet->fromArray($result, null, 'A2');

    $objWorkSheet->setTitle("3- Informasi Umpan");








    $objWorkSheet = $this->excel->createSheet(3); 

    $objWorkSheet->setCellValue('A1', 'namafile');
    $objWorkSheet->setCellValue('B1', 'k_species'); 
    $objWorkSheet->setCellValue('C1', 'jumlah'); 
    $objWorkSheet->setCellValue('D1', 'berat'); 
    $objWorkSheet->setCellValue('E1', 'estimasi'); 

   $result = $this->db->query("SELECT * from tps_bycatch order by namafile ")->result_array();

    $objWorkSheet->fromArray($result, null, 'A2');

    $objWorkSheet->setTitle("4- Tangkapan lain");









    $objWorkSheet = $this->excel->createSheet(4); 

    $objWorkSheet->setCellValue('A1', 'namafile'); 
    $objWorkSheet->setCellValue('B1', 'kode'); 
    $objWorkSheet->setCellValue('C1', 'deskripsi');
    $objWorkSheet->setCellValue('D1', 'berat');

   $result = $this->db->query("SELECT * from tps_ringkasan_ikankecil order by namafile ")->result_array();

    $objWorkSheet->fromArray($result, null, 'A2');

    $objWorkSheet->setTitle("5- Ringkasan small");








    $objWorkSheet = $this->excel->createSheet(5); 
    $objWorkSheet->setCellValue('A1', 'namafile ');
    $objWorkSheet->setCellValue('B1', 'nomor');
    $objWorkSheet->setCellValue('C1', 'no_ikan'); 
    $objWorkSheet->setCellValue('D1', 'k_species'); 
    $objWorkSheet->setCellValue('E1', 'panjang'); 
  

    $result = $this->db->query("SELECT namafile , nomor , no_ikan , k_species , panjang from tps_ikankecil order by namafile ")->result_array();

    $objWorkSheet->fromArray($result, null, 'A2');

    $objWorkSheet->setTitle("6- Small");







    $objWorkSheet = $this->excel->createSheet(6); 
    
    $objWorkSheet->setCellValue('A1','namafile');
    $objWorkSheet->setCellValue('B1','kode');
    $objWorkSheet->setCellValue('C1','deskripsi');
    $objWorkSheet->setCellValue('D1','berat');
  

    $result = $this->db->query("SELECT * from tps_ringkasan_ikanbesar  order by namafile ")->result_array();

    $objWorkSheet->fromArray($result, null, 'A2');

    $objWorkSheet->setTitle("7- Ringkasan large");



    $objWorkSheet = $this->excel->createSheet(7); 

    $objWorkSheet->setCellValue('A1', 'namafile');
    $objWorkSheet->setCellValue('B1', 'no_ikan');
    $objWorkSheet->setCellValue('C1', 'k_species');
    $objWorkSheet->setCellValue('D1', 'kode'); 
    $objWorkSheet->setCellValue('E1', 'berat');
    $objWorkSheet->setCellValue('F1', 'panjang'); 
    $objWorkSheet->setCellValue('G1', 'k_kapalkecil');
    $objWorkSheet->setCellValue('H1', 'loin1_berat'); 
    $objWorkSheet->setCellValue('I1', 'loin1_panjang'); 
    $objWorkSheet->setCellValue('J1', 'karkas_berat'); 
    $objWorkSheet->setCellValue('K1', 'karkas_panjang');
    $objWorkSheet->setCellValue('L1', 'insang');  
    $objWorkSheet->setCellValue('M1', 'isi_perut');  
    $objWorkSheet->setCellValue('N1', 'daging_perut');  

   $result = $this->db->query("SELECT  namafile ,no_ikan,    k_species,    kode ,    berat ,    panjang ,    k_kapalkecil,    loin1_berat ,    loin1_panjang ,    karkas_berat ,    karkas_panjang,    insang  ,    isi_perut  ,daging_perut   from tps_ikanbesar order by namafile ")->result_array();

    $objWorkSheet->fromArray($result, null, 'A2');

    $objWorkSheet->setTitle("8- Large");




    $objWorkSheet = $this->excel->createSheet(8); 

       $objWorkSheet->setCellValue('A1', 'namafile') ;  
       $objWorkSheet->setCellValue('B1', 'urut'); 
       $objWorkSheet->setCellValue('C1', 'k_species');
       $objWorkSheet->setCellValue('D1', 'jml_interaksi'); 
       $objWorkSheet->setCellValue('E1', 'jml_didaratkan'); 
       $objWorkSheet->setCellValue('F1', 'est_interaksi');
       $objWorkSheet->setCellValue('G1', 'est_didaratkan');
       $objWorkSheet->setCellValue('H1', 'd_1'); 
       $objWorkSheet->setCellValue('I1', 'd_2'); 
       $objWorkSheet->setCellValue('J1', 'd_3'); 
       $objWorkSheet->setCellValue('K1', 'd_4'); 
       $objWorkSheet->setCellValue('L1', 'd_5'); 
       $objWorkSheet->setCellValue('M1', 'td_1'); 
       $objWorkSheet->setCellValue('N1', 'td_2'); 
       $objWorkSheet->setCellValue('O1', 'td_3'); 
       $objWorkSheet->setCellValue('P1', 'td_4'); 
       $objWorkSheet->setCellValue('Q1', 'td_5');
       $objWorkSheet->setCellValue('R1', 'dibuang'); 
       $objWorkSheet->setCellValue('S1', 'dimakan'); 
       $objWorkSheet->setCellValue('T1', 'dijual');
       $objWorkSheet->setCellValue('U1', 'diumpan'); 
       $objWorkSheet->setCellValue('V1', 'tidak_tahu'); 
       $objWorkSheet->setCellValue('W1', 'k_kelompok'); 
       $objWorkSheet->setCellValue('X1', 'namalokal'); 
       $objWorkSheet->setCellValue('Y1', 'yakin_lokal'); 
       $objWorkSheet->setCellValue('Z1', 'yakin_species'); 
       $objWorkSheet->setCellValue('AA1', 'lokasi_interaksi'); 
       $objWorkSheet->setCellValue('AB1', 'r1 ');
       $objWorkSheet->setCellValue('AC1', 'r2'); 
       $objWorkSheet->setCellValue('AD1', 'r3'); 
       $objWorkSheet->setCellValue('AE1', 'alat_etp'); 
       $objWorkSheet->setCellValue('AF1', 'alat_lain'); 
       $objWorkSheet->setCellValue('AG1', 'tangan'); 
       $objWorkSheet->setCellValue('AH1', 'kapal'); 
       $objWorkSheet->setCellValue('AI1', 'lainnya');
       $objWorkSheet->setCellValue('AJ1', 'interaksi');

   $result = $this->db->query("SELECT  *  from tps_etp order by namafile , urut , k_species")->result_array();

    $objWorkSheet->fromArray($result, null, 'A2');

    $objWorkSheet->setTitle("9- ETP");


$filename='Data_Extract.xls'; //save our workbook as this file name
     
        header('Content-Type: application/vnd.ms-excel'); //mime type
     
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
     
        header('Cache-Control: max-age=0'); //no cache
              
    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
     
        //force user to download the Excel file without writing it to server's HD
    $objWriter->save('php://output');
ob_end_clean();
    }


    public function download_extract_unloading(){

    $this->load->library('excel');

    ob_end_clean();
    //observerform_trip
  
    $objWorkSheet = $this->excel->createSheet(0); 

  
      $objWorkSheet->setCellValue('A1', 'kode_upload') ;  
      $objWorkSheet->setCellValue('B1', 'kode_trip') ;   
      $objWorkSheet->setCellValue('C1', 'nama_perusahaan') ;  
      $objWorkSheet->setCellValue('D1', 'id_vessel') ;   
      $objWorkSheet->setCellValue('E1', 'nama_kapal') ;   
      $objWorkSheet->setCellValue('F1', 'pelabuhan_pangkalan') ;   
      $objWorkSheet->setCellValue('G1', 'tipe') ;  
      $objWorkSheet->setCellValue('H1', 'tahun') ;   
      $objWorkSheet->setCellValue('I1', 'bulan') ;   
      $objWorkSheet->setCellValue('J1', 'tanggal_berangkat') ;   
      $objWorkSheet->setCellValue('K1', 'tanggal_kembali') ;   
      $objWorkSheet->setCellValue('L1', 'urut') ;   
      $objWorkSheet->setCellValue('M1', 'total_tangkapan') ;   
      $objWorkSheet->setCellValue('N1', 'yft') ;   
      $objWorkSheet->setCellValue('O1', 'bet') ;   
      $objWorkSheet->setCellValue('P1', 'skj') ;   
      $objWorkSheet->setCellValue('Q1', 'kaw') ;   
      $objWorkSheet->setCellValue('R1', 'bycatch') ;   
      $objWorkSheet->setCellValue('S1', 'loin_kotor') ;   
      $objWorkSheet->setCellValue('T1', 'loin_bersih') ;   
      $objWorkSheet->setCellValue('U1', 'jumlah_loin') ;   
      $objWorkSheet->setCellValue('V1', 'lainnya') ;   
      $objWorkSheet->setCellValue('W1', 'ikanhilang') ;   
      $objWorkSheet->setCellValue('X1', 'etp') ;   
      $objWorkSheet->setCellValue('Y1', 'wpp_penangkapan') ;   
      $objWorkSheet->setCellValue('Z1', 'jenis_solar') ;   
      $objWorkSheet->setCellValue('AA1', 'jumlah_solar') ;   
      $objWorkSheet->setCellValue('AB1', 'es') ;   
      $objWorkSheet->setCellValue('AC1', 'uang_trip') ;   
      $objWorkSheet->setCellValue('AD1', 'catch_certificate') ;   
      $objWorkSheet->setCellValue('AE1', 'namafile') ;   
      $objWorkSheet->setCellValue('AF1', 'total_loin') ;   
      $objWorkSheet->setCellValue('AG1', 'pengguna') ;   
      $objWorkSheet->setCellValue('AH1', 'date_upload') ;   
      $objWorkSheet->setCellValue('AI1', 'rumpon') ;  
      

    $result = $this->db->query("
      SELECT kode_upload, kode_trip, nama_perusahaan , u.id_vessel, u.nama_kapal, u.pelabuhan_pangkalan, 
       tipe, tahun, bulan, tanggal_berangkat, tanggal_kembali, u.urut, 
       total_tangkapan, yft, bet, skj, kaw, bycatch, loin_kotor, loin_bersih, 
       jumlah_loin, u.lainnya, ikanhilang, etp, wpp_penangkapan, jenis_solar, 
       jumlah_solar, es, uang_trip, catch_certificate, u.namafile, total_loin, 
       pengguna, date_upload, rumpon
          FROM ap2hi_boat_unload u , master_vessel v , master_supplier s
          where 
          u.id_supplier = s.id_supplier and
          u.id_supplier = v.id_vessel
          order by namafile , u.urut
  ;

     ")->result_array();

    $objWorkSheet->fromArray($result, null, 'A2');

    $objWorkSheet->setTitle("1- Unloading");






    $objWorkSheet = $this->excel->createSheet(1); 

  
    $objWorkSheet->setCellValue('A1', 'kode_trip') ;  
    $objWorkSheet->setCellValue('B1', 'id_vessel') ;   
    $objWorkSheet->setCellValue('C1', 'tanggal_berangkat') ;   
    $objWorkSheet->setCellValue('D1', 'jenis') ;   
    $objWorkSheet->setCellValue('E1', 'kondisi') ;  
    $objWorkSheet->setCellValue('F1', 'jumlah_kg') ;   
    $objWorkSheet->setCellValue('G1', 'jumlah_ekor') ;   
    $objWorkSheet->setCellValue('H1', 'harga_beli') ;  
    $objWorkSheet->setCellValue('I1', 'asal') ;   
    $objWorkSheet->setCellValue('J1', 'daerah_penangkapan') ;   
    $objWorkSheet->setCellValue('K1', 'jumlah_ember') ;   
     

      $result = $this->db->query("

        SELECT *
          FROM ap2hi_boat_umpan order by kode_trip;

     
  ;

     ")->result_array();

    $objWorkSheet->fromArray($result, null, 'A2');

    $objWorkSheet->setTitle("2- Umpan");





    $objWorkSheet = $this->excel->createSheet(2); 

  

    $objWorkSheet->setCellValue('A1', 'kode_upload') ;
    $objWorkSheet->setCellValue('A1', 'urutan') ;
    $objWorkSheet->setCellValue('A1', 'id_supplier') ;
    $objWorkSheet->setCellValue('A1', 'alamat') ; 
    $objWorkSheet->setCellValue('A1', 'no_sipr') ; 
    $objWorkSheet->setCellValue('A1', 'daerah_penangkapan') ; 
    $objWorkSheet->setCellValue('A1', 'daerah_usaha') ;
    $objWorkSheet->setCellValue('A1', 'alat_tangkap') ; 
    $objWorkSheet->setCellValue('A1', 'posisi_rumpon') ; 
    $objWorkSheet->setCellValue('A1', 'bahan') ; 
    $objWorkSheet->setCellValue('A1', 'nama_kapal') ;
     

      $result = $this->db->query("

       SELECT *
          FROM ap2hi_rumpon order by kode_upload , urutan;
 ;

     ")->result_array();

    $objWorkSheet->fromArray($result, null, 'A2');

    $objWorkSheet->setTitle("3- Rumpon");


$filename="unloadings_".date('Ymd').".xls"; //save our workbook as this file name
     
        header('Content-Type: application/vnd.ms-excel'); //mime type
     
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
     
        header('Cache-Control: max-age=0'); //no cache
              
    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 

    //force user to download the Excel file without writing it to server's HD
    $objWriter->save('php://output');

    ob_end_clean();

    }



public function update_tanggal_sampling_all(){


  $result = $this->Model_data->getAllTrip()->result();

  $no = 1;
  foreach($result as $res){


    $data['namafile'] = $res->namafile;

    $data['tanggal_sampling'] = $res->thn_sampling."-".sprintf("%02d",$res->bln_sampling)."-".sprintf("%02d",$res->tgl_sampling);

    $this->Model_data->update_tanggal_sampling_all($data);




    echo $no." ";
    echo $res->namafile;
    echo " ";
    echo $data['tanggal_sampling'];

    echo '<br>';




    $no++;
  }


}    



}