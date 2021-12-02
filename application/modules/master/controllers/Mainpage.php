<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Mainpage extends CI_Controller {


    public function __construct(){

        parent::__construct();

        $this->load->model('Model_master');

        $this->load->library('upload');

        $this->load->helper(array('form', 'url'));

        
    }

    public function globals(){

        //select
        $data = $this->global_model->general_select('master_supplier',array('id_supplier'=>'5' ),'row','','');
        
        //join
        $data = $this->global_model->general_dataselect("*",'master_vessel',array('master_supplier' => array( 'id_supplier' => '1')), array('id_vessel' => '1'), array( 'id_vessel' => 'desc'), "row");

        var_dump($data);
    }


    public function supplier(){

        $user = $this->auth->get_data_session();

        $this->auth->check_login();

        if(!$this->auth->hasPrivilege("ViewSupplier")){

            redirect('home','refresh');

        }

        $data['button_add']='<div><center>  <a type="button" class="btn btn-warning a-btn-slide-text">
                                    <span class="fa fa-plus" aria-hidden="true"></span>
                                    <span><strong>Unauthorize</strong></span>            
                                </a> </center></div>';;

        if($this->auth->hasPrivilege("AddSupplier")){ 

            $data['button_add']= '<div><center> <button type="button" class="btn btn-success a-btn-slide-text"  data-toggle="modal" data-target="#myModalSupplier" id="AddDataSupplierBtn">   <span class="fa fa-plus-square" aria-hidden="true"></span> Add New</button> </center></div>'  ; 
        
        }


        $data['url_load_table']=base_url()."master/mainpage/viewSupplierActive";

        //Add Data

        $data['countryLists'] = $this->Model_master->countryLists();

        $data['provinceLists'] = $this->Model_master->provinceLists();

        $data['select_load_regencies']=base_url()."master/mainpage/load_regencies";

        $data['select_load_districts']=base_url()."master/mainpage/load_districts";

        $data['select_load_villages']=base_url()."master/mainpage/load_villages";

        $data['url_add_supplier']=base_url()."master/mainpage/addSupplier";

        $data['url_edit_supplier']=base_url()."master/mainpage/editSupplier";

        $data['url_disable_supplier']=base_url()."master/mainpage/disable_supplier";
        
        $data['urlShowEditSupplier']=base_url()."master/mainpage/showEditSupplier";
        
        $data['select_load_regencies_edit']=base_url()."master/mainpage/load_regencies_edit";

        $data['select_load_district_edit']=base_url()."master/mainpage/load_districts_edit";

        $data['select_load_villages_edit']=base_url()."master/mainpage/load_villages_edit";

        $data['content']="master/supplier";

       $this->load->view('template-admin/template',$data);

    }

            public function load_regencies(){

                $id = $_POST['id']; 

                $results = $this->Model_master->load_regencies($id);

                echo '<option value="">Select Regencies</option>';
                
                foreach($results->result() as $res){
                    echo '<option value="'.$res->id.'">'.$res->name.'</option>'; 
                }
            }

            public function load_regencies_edit(){

                $province = $_POST['province']; 

                $regencies = $_POST['regencies'];

                $results = $this->Model_master->load_regencies($province);

                echo '<option value="">Select Regencies</option>';
                
                foreach($results->result() as $res){
                    if($res->id == $regencies){
                        echo '<option value="'.$res->id.'" selected>'.$res->name.'</option>'; 
                    }else{
                        echo '<option value="'.$res->id.'">'.$res->name.'</option>';  
                    }
                }
            }
            

            public function load_districts(){

                $id = $_POST['id']; 

                $results = $this->Model_master->load_districts($id);

                echo '<option value="">Select District</option>';
                
                foreach($results->result() as $res){
                    echo '<option value="'.$res->id.'">'.$res->name.'</option>'; 
                }

            }

            public function load_districts_edit(){

                $regencies = $_POST['regencies']; 

                $district = $_POST['district']; 

                $results = $this->Model_master->load_districts($regencies);

                echo '<option value="">Select District</option>';
                
                foreach($results->result() as $res){
                    if($district == $res->id){
                        echo '<option value="'.$res->id.'" selected>'.$res->name.'</option>'; 
                    }else{
                        echo '<option value="'.$res->id.'">'.$res->name.'</option>'; 
                    }
                }

            }

            public function load_villages(){

                $id = $_POST['id']; 

                $results = $this->Model_master->load_villages($id);

                echo '<option value="">Select Village</option>';
                
                foreach($results->result() as $res){
                    echo '<option value="'.$res->id.'">'.$res->name.'</option>'; 
                }
            }

            public function load_villages_edit(){

                $district = $_POST['district']; 

                $village = $_POST['village']; 

                $results = $this->Model_master->load_villages($district);

                echo '<option value="">Select Village</option>';
                
                foreach($results->result() as $res){
                    if($village == $res->id){
                        echo '<option value="'.$res->id.'" selected>'.$res->name.'</option>'; 
                    }else{
                        echo '<option value="'.$res->id.'">'.$res->name.'</option>'; 
                    }
                }
            }


    public function addSupplier(){


        //form validation 
        $this->form_validation->set_rules('kode_name', 'Supplier Code', 'required');
        $this->form_validation->set_rules('nama_perusahaan', 'Supplier Name', 'required');
        $this->form_validation->set_rules('tipe_perusahaan', 'Supplier Type', 'required');
        $this->form_validation->set_rules('lokasi', 'Supplier Location', 'required');
        $this->form_validation->set_rules('address', 'Supplier Address', 'required');


        //check if code name sudah pernah ada 
        $kode_name = strtoupper($this->input->post('kode_name'));
        $checkCode = $this->Model_master->checkCodeSupplier($kode_name);

        
        if ( $this->form_validation->run() && $checkCode == 0 ) {
            
            //Insert to Database 
             $saved = $this->Model_master->add_supplier($this->input->post());

            if ($saved)
            {
                 $success = true;
                 $messages =  "Successfully adding Data! ";
            }
            else
            {
                 $success = false;
                 $messages =  "Insert not working ! ";
            }

            
        }else{

            $success = false;
            $messages = 'Trouble adding Data!';
            
        }

            $validator['success'] = $success;
            $validator['messages'] = $messages;
        

        echo json_encode($validator);

    }

    public function showEditSupplier(){

        $response = array();

        $id = $_POST['id'];

        $results = $this->Model_master->showEditSupplier($id);

        $response = array(
                'success' => true, 
                'messages' => $results->result_array()
            ); 

        echo json_encode($response);
    }

    public function editSupplier(){

         //form validation 
        $this->form_validation->set_rules('edit_kode_name', 'Supplier Code', 'required');
        $this->form_validation->set_rules('edit_nama_perusahaan', 'Supplier Name', 'required');
        $this->form_validation->set_rules('edit_tipe_perusahaan', 'Supplier Type', 'required');
        $this->form_validation->set_rules('edit_lokasi', 'Supplier Location', 'required');
        $this->form_validation->set_rules('edit_address', 'Supplier Address', 'required');


        //check if code name sudah pernah ada 
        $kode_name = strtoupper($this->input->post('edit_kode_name'));
        $checkCode = $this->Model_master->checkCodeSupplier($kode_name);

        
        if ( $this->form_validation->run()  ) {
            
            //Insert to Database 
             $saved = $this->Model_master->edit_supplier($this->input->post());

            if ($saved)
            {
                 $success = true;
                 $messages =  "Successfully adding Data! ";
            }
            else
            {
                 $success = false;
                 $messages =  "Update not working ! ";
            }

            
        }else{

            $success = false;
            $messages = 'Trouble adding Data!';
            
        }

            $validator['success'] = $success;
            $validator['messages'] = $messages;
        

        echo json_encode($validator);

    }


    public function disable_supplier(){

        

        $saved = $this->Model_master->disable_supplier($_POST['id']);

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

    public function viewSupplierActive(){

         $this->auth->restrict_ajax_login_datatable();

         $query = $this->Model_master->get_all_supplier_active();

         $result = array();

         $no = 0;
        
        foreach($query->result() as $row){

                $no++;
                $system = 'AP2HI'; 
                $kode = $row->kode_name ; 
                $numbering = sprintf("%04s", $row->id_supplier);

                $action1='<a type="button" class="btn btn-warning a-btn-slide-text">
                                    <span class="fa fa-plug" aria-hidden="true"></span>
                                    <span><strong>Unauthorize</strong></span>            
                                </a>' ; 
                $action2='<a type="button" class="btn btn-warning a-btn-slide-text">
                                    <span class="fa fa-times" aria-hidden="true"></span>
                                    <span><strong>Unauthorize</strong></span>            
                                </a>' ; 

                if($this->auth->hasPrivilege("EditSupplier")){      

                    $action1 = '<a type="button" data-toggle="modal" data-target="#editSupplierModal" onclick="editData('.$row->id_supplier.')" class="btn btn-primary a-btn-slide-text">
                                    <span class="fa fa-plug" aria-hidden="true"></span>
                                    <span><strong>Edit</strong></span>            
                                </a>
                                ' ; 
                }

                if($this->auth->hasPrivilege("DeleteSupplier")){      
                    $action2 = ' <a type="button" data-toggle="modal" data-target="#disableSupplierModal" onclick="disableData('.$row->id_supplier.')" class="btn btn-danger a-btn-slide-text">
                                   <span class="fa fa-times" aria-hidden="true"></span>
                                    <span><strong>Disable</strong></span>            
                                </a>' ; 
                }

                $result['data'][]=array(

                        $no , 
                        $system.'.'.$kode.'.'.$numbering , 
                        $row->kode_ap2hi, 
                        $row->nama_perusahaan , 
                        $row->tipe_perusahaan , 
                        $row->lokasi , 
                        $action1, 
                        $action2
                
                
                ); 

        }


         echo json_encode($result);
    }






    public function vessel(){

        $this->auth->check_login();

        if(!$this->auth->hasPrivilege("ViewVessel")){

            redirect('home','refresh');

        }

        $data['button_add']='<div><center>  <a type="button" class="btn btn-warning a-btn-slide-text">
                                    <span class="fa fa-plus" aria-hidden="true"></span>
                                    <span><strong>Unauthorize</strong></span>            
                                </a> </center></div>';
        $data['button_upload']='<div class="alert alert-warning">
                                      <strong>Warning!</strong> You are not authorize to Upload Vessel.
                                    </div>';
        if($this->auth->hasPrivilege("AddVessel")){ 

            $data['button_add']= '<div><center> <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#myModalVessel" id="AddDataVesselBtn">Add New</button> </center></div>';
            
            $data['button_upload']= '<center>
                                            <div class="form-group">
                                              <input type="file" id="file" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                                              <button id="upload" class="btn btn-default">Upload</button>
                                            </div> 
                                             </center>' ; 

        }


        

        $user = $this->auth->get_data_session();

        $data['url_load_table']=base_url()."master/mainpage/viewVesselActive";

        //add data

        $data['listSupplier'] =  $this->Model_master->get_all_supplier_active();

        $data['url_add_vessel']=base_url()."master/mainpage/addVessel";

        $data['url_edit_vessel']=base_url()."master/mainpage/editVessel";

        $data['url_disable_vessel']=base_url()."master/mainpage/disableVessel";

        $data['urlShowEditVessel']=base_url()."master/mainpage/showEditVessel";

        $data['urlUploadVessels']=base_url()."master/mainpage/uploadVessels";
				
		$data['excell_vessel']= base_url()."master/mainpage/excell_vessel";

        $data['qr_vessel_all']= base_url()."master/mainpage/qr_vessel_all";
		
		$data['download_template']=base_url()."media/download/COMPANYCODE_YYYYMMDDUpload.xlsx"; 

        $data['content']="master/vessel";

        $this->load->view('template-admin/template',$data);

    }

    public function viewVesselActive(){

        $result = array();    

        $this->auth->restrict_ajax_login_datatable();

        $no = 0;

        $records = $this->Model_master->get_all_vessel_active();
    
        foreach($records->result() as $row){
            $no++;

                $edit='<a type="button" class="btn btn-warning a-btn-slide-text">
                                    <span class="fa fa-plug" aria-hidden="true"></span>
                                    <span><strong>Unauthorize</strong></span>            
                                </a>' ; 
                $delete='<a type="button" class="btn btn-warning a-btn-slide-text">
                                    <span class="fa fa-times" aria-hidden="true"></span>
                                    <span><strong>Unauthorize</strong></span>            
                                </a>' ; 

            if($this->auth->hasPrivilege("EditVessel")){                              
                     $edit = '<a type="button" data-toggle="modal" data-target="#editVesselModal" onclick="editData('.$row->id_vessel.')" class="btn btn-primary a-btn-slide-text">
                                        <span class="fa fa-plug" aria-hidden="true"></span>
                                        <span><strong>Edit</strong></span>            
                                    </a>
                                    ' ; 
            }                

            if($this->auth->hasPrivilege("DeleteVessel")){      
                $delete = '<a type="button" data-toggle="modal" data-target="#disableVesselModal" onclick="disableData('.$row->id_vessel.')" class="btn btn-danger a-btn-slide-text">
                                   <span class="fa fa-times" aria-hidden="true"></span>
                                    <span><strong>Disable</strong></span>            
                                </a>';
            }

            $numbering      = sprintf("%04s", $row->urut);      
            $supplierDatas  =  $this->Model_master->showEditSupplier($row->id_supplier);
            $supplierData   = $supplierDatas->row();
            $kode_supplier  = $supplierData->kode_name;
            $kode_kapal_ap2hi = $numbering.".".$kode_supplier.".AP2HI";
            $kode_kapal_ap2hi = '<a href="'.base_url().'/master/mainpage/vessel_detail/'.$row->id_vessel.'" target="_BLANK">'.$kode_kapal_ap2hi.'</a>';

            $result['data'][] = array(
                    $no , 
                    $kode_kapal_ap2hi,
                    $row->nama_kapal,
                    $supplierData->nama_perusahaan ,
                    $row->nama_pemilik  ,
                    $row->no_ap2hi_manual  ,
                    $row->no_seafdec  ,
                    $row->no_issf  ,
                    $row->no_kkp ,
                    $row->no_dkp  ,
                    $row->no_vic  ,
                    $row->nama_kapal_2tahun  ,
                    $row->status_kapal,
                    $row->jenis_kapal   ,
                    $row->jenis_alat    ,
                    $row->ukuran  ,
                    $row->loa   ,
                    $row->bahan    ,
                    $row->jenis_mesin_utama  , 
                    $row->kapasitas_mesin_utama ,  
                    $row->kapasitas_palka_ikan  ,  
                    $row->kapasitas_palka_umpan  , 
                    $row->vms     ,
                    $row->lainnya   ,
                    $row->irc    ,
                    $row->jumlah_pancing  ,
                    $row->jumlah_abk    ,
                    $row->nama_kapten    ,
                    $row->no_sipi    ,
                    $row->masa_berlaku_sipi  ,  
                    $row->rfmo    ,
                    $row->tahun_pembuatan_kapal ,  
                    $row->bendera   ,
                    $row->bendera_2th    ,
                    $row->pelabuhan_pangkalan   ,
                    $row->muat_singgah    ,
                    $row->copy_surat_ijin    ,
                    $row->shark_policy    ,
                    $row->terdaftar_iuu  ,
                    $row->kode_etik_pelayaran  ,
                    $edit,
                    $delete
                );

        }

        echo json_encode($result);

    }


    public function addVessel(){

        //form valiation 
        //check apakah nama kapal sudah pernah ada dalam sistem, by id supplier - nama kapal - 
        $this->form_validation->set_rules('nama_kapal', 'nama_kapal', 'required');
        $this->form_validation->set_rules('id_supplier', 'id_supplier', 'required');


        //check if code name sudah pernah ada 
        $nama_kapal = strtoupper($this->input->post('nama_kapal'));

        $checks = array('id_supplier' => $this->input->post('id_supplier') , 
                        'nama_kapal' => $nama_kapal , 
                        'status' => 'active',
                    );

        $checkCode = $this->Model_master->checkExisting('master_vessel' , $checks);

        if ( $this->form_validation->run() && $checkCode == 0 ) {
            
            //Insert to Database 
            $saved = $this->Model_master->add_vessel($this->input->post());

            if ($saved)
            {
                 $success = true;
                 $messages =  "Successfully adding Data! ";
            }
            else
            {
                 $success = false;
                 $messages =  "Insert not working ! ";
            }

            
        }else{

            $success = false;
            $messages = 'Trouble adding Data! <br> Make sure vessel name are not exsist in database ';
            
        }

            $validator['success'] = $success;
            $validator['messages'] = $messages;
        

        echo json_encode($validator);
    }

    public function showEditVessel(){

        $response = array();

        $id = $_POST['id'];

        $results = $this->Model_master->showEditVessel($id);

        $response = array(
                'success' => true, 
                'messages' => $results->result_array()
            ); 

        echo json_encode($response);


    }

    public function editVessel(){

             //form validation 
        $this->form_validation->set_rules('edit_nama_kapal', 'edit_nama_kapal', 'required');
        $this->form_validation->set_rules('edit_id_vessel', 'edit_id_vessel', 'required');


       $nama_kapal = strtoupper($this->input->post('edit_nama_kapal'));

        $checks = array('id_supplier' => $this->input->post('edit_id_vessel') , 
                        'nama_kapal' => $nama_kapal , 
                        'status' => 'active',
                    );

        $checkCode = $this->Model_master->checkExisting('master_vessel' , $checks);

        if ( $this->form_validation->run() && $checkCode == 0 ) {
            
             $saved = $this->Model_master->edit_vessel($this->input->post());

            if ($saved)
            {
                 $success = true;
                 $messages =  "Successfully adding Data! ";
            }
            else
            {
                 $success = false;
                 $messages =  "Update not working ! ";
            }

            
        }else{

            $success = false;
            $messages = 'Trouble adding Data! <br> Make sure vessel name are not exsist in database ';
            
        }

            $validator['success'] = $success;
            $validator['messages'] = $messages;
        

        echo json_encode($validator);



    }

    public function disableVessel(){

         $saved = $this->Model_master->disable_vessel($_POST['id']);

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


    public function getIdSupp($kodeName=""){

        
        $getIdSupp = $this->global_model->getIdSupp($kodeName);

         if (isset($getIdSupp)){

            return $getIdSupp->id_supplier; 
         }else{


            return 0;
         }
        

    }


    public function uploadVessels(){

        
       $validator = array();
       $status = array();
       $user = $this->auth->get_data_session();


       $this->load->model('Model_master');


        if(!empty($_FILES['file']['name'])){



            $name = preg_replace('/\s+/', '', $_FILES['file']['name'] );
            $namafile = date('Ymd_His').'_'.$name;

            //check filename 
            $checkName = explode("_",$name);

            if(count($checkName) == 2  ){

                $kodeName = $checkName[0];
                $lastName = $checkName[1];
                $kodeDate = explode(".", $lastName);
                $kodeDate = $kodeDate[0];

            //checkKode Supplier 
                $checkCode = $this->Model_master->checkCodeSupplier($kodeName);


            //check if list_supp > 0 
                $isTrueForUpload=0;
                if(count($user->list_supp) > 0){
                    //check if the supplier kode exsist
                    $idSupp =  $this->getIdSupp($kodeName); 
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
                


            //check kode date
            
                if( $kodeDate == date('Ymd') && $checkCode > 0 &&  $isTrueForUpload > 0  ){
                

                    if( move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/vessels/' . $namafile) ) {

                       $success = TRUE ;
                       $messages = 'Success Upload Namafile '.$namafile;

                       $status = $this->insertExcell($namafile , $kodeName);
                       //insert into database 

                    }else{

                       $success = FALSE ;
                       $messages = 'Error During Upload';
                    }

                 }else{

                    $success = FALSE ;
                    $messages = 'Penamaan namafile salah atau anda tidak berhak melakukan upload! <br> Mohon periksa kembali file anda! ';

                }

            }else {

                $success = FALSE ;
                $messages = 'Penamaan namafile Salah, Mohon periksa kembali penamaan namafile! ';
            }


        }else {
               $success = FALSE ;
               $messages = 'Please choose file first!';
        }
            

        $validator['success'] = $success;
        $validator['messages'] = $messages;
        $validator['status'] = $status;

        echo json_encode($validator);

    }



    public function insertExcell($namafile,$kodeNameFile){

        $notification = array();
        
        $this->load->library('excel');
        $user = $this->auth->get_data_session();
        $id_user = $user->id_user;
        
        $data = array();
        $inputFileName  = 'uploads/vessels/'.$namafile;

        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        $sheet = $objPHPExcel->getSheet(0); 
        $highestRow = $sheet->getHighestRow(); 
        $highestColumn = $sheet->getHighestColumn();

        $sheet = $objPHPExcel->getSheetByName('Registrasi-Kapal');
        $highestRow = $sheet->getHighestRow(); 
        $highestColumn = $sheet->getHighestColumn();
        $get_sheetData=$sheet->toArray(null,true,true,true);

        $Psheet = $objPHPExcel->getSheetByName('param');
        $PhighestRow = $Psheet->getHighestRow(); 
        $PhighestColumn = $Psheet->getHighestColumn();
        $pget_sheetData=$Psheet->toArray(null,true,true,true);

        $get_supplierName = $get_sheetData[4]["B"] ? : "" ;

        $suppData = $this->global_model->general_select('master_supplier',array('nama_perusahaan'=> $get_supplierName ),'row','','');
        $suppData = $suppData->row();
        $idSupplier = $suppData->id_supplier;
        $kodeNameSupp = $suppData->kode_name;
        
        if($kodeNameSupp == $kodeNameFile){

            for ($row = 9 ; $row <= $highestRow; $row++){ 
                
                $check = $this->global_model->general_select('master_vessel',array('nama_kapal'=> strtoupper( $get_sheetData[$row]["B"] ) , 'id_supplier' => $idSupplier ),'row','','');

                if($get_sheetData[$row]["B"] == ''){

                    $notification['excell'][] = array( 'notif' =>'Gagal Insert Baris '.$row.' Nama Kapal Kosong' , 'act' => 'Bad');
                }
                //CHECK FROM NAMAKAPAL && ID SUPPLIER 
                
                else if( count($check->row()) > 0  ){

                    $notification['excell'][] = array( 'notif' => 'Gagal Insert Baris '.$row.' Nama Kapal '.$get_sheetData[$row]["B"].' Sudah ada di database' , 'act' => 'Bad' );
                   

                } else {
                    
                        
                     //CHECK MAX NOMOR URUT from master vessel and supplier 
                    $maxIdVessel    = $this->db->query("Select max(id_vessel) as id_vessel from master_vessel")->row();
                    $id_vessel  = $maxIdVessel->id_vessel + 1;   

                    
                    //CHECK MAX ID MASTER VESSEL 
                    $maxUrut    = $this->db->query("Select max(urut) as urut from master_vessel where id_supplier = '".$idSupplier."'")->row();
                    $numbering  = sprintf("%04s", $maxUrut->urut + 1 );       
                    $no_ap2hi   = $numbering.".".$kodeNameSupp.".AP2HI";

                    $data['id_vessel'] = $id_vessel ;
                    $data['id_supplier'] = $idSupplier;
                    $data['namaKapal'] = strtoupper( $get_sheetData[$row]["B"] );
                    $data['urut']   = $numbering ;  
                    $data['nama_kapal'] = $get_sheetData[$row]["B"]; 
                    $data['nama_pemilik'] = $get_sheetData[$row]["C"]; 
                    $data['no_ap2hi'] = $no_ap2hi ; 
                    $data['no_ap2hi_manual'] = $get_sheetData[$row]["D"];  
                    $data['no_siup'] =  $get_sheetData[$row]["F"];  
                    $data['no_seafdec'] = $get_sheetData[$row]["G"];  
                    $data['no_issf']  =  $get_sheetData[$row]["H"]; 
                    $data['no_kkp']  =  $get_sheetData[$row]["I"]; 
                    $data['no_dkp']  =  $get_sheetData[$row]["J"]; 
                    $data['no_vic']  = $get_sheetData[$row]["K"]; 
                    $data['no_nik']  =  $get_sheetData[$row]["E"]; 
                    $data['nama_kapal_2tahun'] =  $get_sheetData[$row]["M"]; 
                    $data['status_kapal'] =  $get_sheetData[$row]["N"];  
                    $data['jenis_kapal'] =  $get_sheetData[$row]["O"];  
                    $data['jenis_alat']  =  $get_sheetData[$row]["P"];  
                    $data['ukuran'] =  $get_sheetData[$row]["Q"];  
                    $data['loa'] =  $get_sheetData[$row]["R"];  
                    $data['bahan'] =  $get_sheetData[$row]["S"];  
                    $data['jenis_mesin_utama'] = $get_sheetData[$row]["T"];  
                    $data['kapasitas_mesin_utama'] = $get_sheetData[$row]["U"]; 
                    $data['kapasitas_palka_ikan'] = $get_sheetData[$row]["V"];  
                    $data['kapasitas_palka_umpan'] =  $get_sheetData[$row]["W"]; 
                    $data['vms'] =  $get_sheetData[$row]["X"]; 
                    $data['lainnya']= $get_sheetData[$row]["Y"];  
                    $data['irc'] = $get_sheetData[$row]["Z"];  
                    $data['jumlah_pancing'] = $get_sheetData[$row]["AA"];  
                    $data['jumlah_abk'] =  $get_sheetData[$row]["AB"]; 
                    $data['nama_kapten']  =  $get_sheetData[$row]["AC"];  
                    $data['no_sipi']  =  $get_sheetData[$row]["AD"]; 
                    $data['masa_berlaku_sipi'] =  $get_sheetData[$row]["AE"]; 
                    $data['rfmo']  =  $get_sheetData[$row]["AF"]; 
                    $data['tahun_pembuatan_kapal'] =  $get_sheetData[$row]["AG"];  
                    $data['bendera']  = $get_sheetData[$row]["AI"];  
                    $data['bendera_2th']  =  $get_sheetData[$row]["AJ"];  
                    $data['pelabuhan_pangkalan'] =  $get_sheetData[$row]["AK"];  
                    $data['muat_singgah']  =  $get_sheetData[$row]["AL"]; 
                    $data['copy_surat_ijin']  =  $get_sheetData[$row]["AM"]; 
                    $data['shark_policy'] =  $get_sheetData[$row]["AN"]; 
                    $data['terdaftar_iuu']  =  $get_sheetData[$row]["AO"]; 
                    $data['kode_etik_pelayaran']  =  $get_sheetData[$row]["AP"]; 
                    $data['no_imo']  = $get_sheetData[$row]["L"];  
                    $data['lokasi_pembuatan'] =  $get_sheetData[$row]["AH"]; 
                    $data['status']  = 'active' ;
                    $data['created_by']  = $id_user;
                    $data['created_date'] = date('Y-m-d h:i:s');
                    $data['using_excell'] = 'Y';
                    $data['namafile'] = $namafile ; 
                    
                    $condition = $this->Model_master->insertUploadVessels($data);

                    if($condition == TRUE){
                        $notification['excell'][] = array( 'notif' => 'Berhasil Insert Baris '.$row.' Nama Kapal '.$data['namaKapal']  , 'act' => 'Good' );
                    }else{
                        $notification['excell'][] = array( 'notif' => 'Gagal Insert Baris '.$row.' Karena Kesalahan Database' , 'act' => 'Bad');
                    }
                }


            }
            

        }else{

              $notification['excell'][] = array( 'notif' => 'Kode Supplier tidak sama ' , 'act' => 'Bad' );
             
        }


        return $notification;
    }


    public function vessel_convert_qr($where , $id){

        $this->auth->check_login();

        $this->load->library('ciqrcode');


         $records = $this->Model_master->get_all_vessel_where($where , $id);
        

        foreach($records->result() as $row){

                $numbering      = sprintf("%04s", $row->urut);

                $supplierDatas  = $this->Model_master->showEditSupplier($row->id_supplier);
                $supplierData   = $supplierDatas->row();
                $kode_supplier  = $supplierData->kode_name;

                $kode_kapal_ap2hi = 
                $numbering.".".$kode_supplier.".AP2HI 
                <br>Vessel Name : ".$row->nama_kapal."
                <br>Address : ".$row->nama_kapal."
                <br>Owner : ".$row->nama_pemilik."
                ";


                $data_qr = base_url().'master/mainpage/vessel_detail/'.$row->id_vessel; 

                echo $img_kapal_ap2hi = $numbering."_".$kode_supplier."_AP2HI";
                echo '<br>'; 
                
                $qr['data'] = $data_qr ;

                $qr['level'] = 'H';
                $qr['size'] = 10;
                $qr['savename'] = FCPATH.'uploads/qr/'.$img_kapal_ap2hi.'.png';
                $this->ciqrcode->generate($qr);
        
        }
    }


    public function qr_vessel_all(){

        $this->auth->check_login();
    
        //$dataVessel =  $records = $this->Model_master->get_all_vessel_active_limit(30);
        $dataVessel =  $records = $this->Model_master->get_all_vessel_active_qr();

        $data['dataVessel'] = $dataVessel ; 


        //$this->load->view('page_prints_vessel_all',$data  );
        
        
        $html=$this->load->view('page_prints_vessel_all7',$data, true); 
       
        //this the the PDF filename that user will get to download
        $pdfFilePath ="AP2HI_All_Vessel_QR".time().".pdf";

        //actually, you can pass mPDF parameter on this load() function
        include_once APPPATH.'/third_party/mpdf/mpdf.php';

        $this->load->library('m_pdf');
        //load mPDF library

        $pdf = $this->m_pdf->load();

                $pdf->AddPage('L', // L - landscape, P - portrait
                        '', '', '', '',
                        6, // margin_left
                        6, // margin right
                        12, // margin top
                        12, // margin bottom
                        18, // margin header
                        12  // margin footer
                        ); 

        //generate the PDF!
        $pdf->WriteHTML($html,2);

        //offer it to user via browser download! (The PDF won't be saved on your server HDD)
        $pdf->Output($pdfFilePath, "D");
        
    }


    public function mpdf_testing(){

        //use this 
        //http://www.vesna.ru/php5/examples/ 


        $this->auth->check_login();
    
       
        $data['dataVessel'] = 'fak' ; 


        $this->load->view('m_pdftest2',$data  );
        
        
        $html=$this->load->view('m_pdftest2',$data, true); 
       
        //this the the PDF filename that user will get to download
        $pdfFilePath ="bastard.pdf";

        //actually, you can pass mPDF parameter on this load() function
        include_once APPPATH.'/third_party/mpdf/mpdf.php';

        $this->load->library('m_pdf');
        //load mPDF library

        $pdf = $this->m_pdf->load();

                $pdf->AddPage('L', // L - landscape, P - portrait
                        '', '', '', '',
                        6, // margin_left
                        6, // margin right
                        12, // margin top
                        12, // margin bottom
                        18, // margin header
                        12  // margin footer
                        ); 

        //generate the PDF!
        $pdf->WriteHTML($html,2);

        //offer it to user via browser download! (The PDF won't be saved on your server HDD)
        $pdf->Output($pdfFilePath, "D");
        
        
    }


    public function vessel_detail($id){

        
        $this->auth->check_login();

        $this->load->library('ciqrcode');

        $this->load->helper('url');

        //getCode Vessel
        $dataVessel = $this->global_model->general_select2('master_vessel',array('id_vessel'=> $id ),'row','','');

        $supplierDatas  =  $this->Model_master->showEditSupplier($dataVessel->id_supplier);
        $supplierData   = $supplierDatas->row();
        $kode_supplier  = $supplierData->kode_name;
        

        $kode_kapal_ap2hi = str_replace(".", "_", $dataVessel->no_ap2hi ); 

        $data_qr = base_url().'master/mainpage/vessel_detail/'.$dataVessel->id_vessel; 

        $img_kapal_ap2hi = $kode_kapal_ap2hi;

        $qr['data'] = $data_qr ;

        $qr['level'] = 'H';
        $qr['size'] = 10;
        $qr['savename'] = FCPATH.'uploads/qr/'.$img_kapal_ap2hi.'.png';
        $this->ciqrcode->generate($qr);


        $data['qrResult']= '<img src="'.base_url().'uploads/qr/'.$img_kapal_ap2hi.'.png" width="300" height="300" >';

        $data['content']="master/vesselDetail";

        $data['dataSupplier']=$supplierData;

        $data['dataVessel']=$dataVessel;

        $data['urlShowEditVessel']=base_url()."master/mainpage/showEditVessel";

        $data['url_edit_vessel']=base_url()."master/mainpage/editVessel";

        $this->load->view('template-admin/template',$data);

    }
	
	public function confirm_vesssel($id , $status){
        $this->auth->check_login();

        $this->Model_master->confirm_vesssel($id , $status) ; 

        redirect('master/mainpage/vessel_detail/'.$id,'refresh');
    }
	
	
	public function doPrintVessel($id){

        $this->auth->check_login();
    
        $dataVessel = $this->global_model->general_select2('master_vessel',array('id_vessel'=> $id ),'row','','');

        $numbering      = sprintf("%04s", $dataVessel->urut);

        $supplierDatas  =  $this->Model_master->showEditSupplier($dataVessel->id_supplier);
        
        $supplierData   = $supplierDatas->row();
        
        $kode_supplier  = $supplierData->kode_name;



        $data['img_kapal_ap2hi'] = $numbering."_".$kode_supplier."_AP2HI";

        $data['nama_kapal'] = $dataVessel->nama_kapal; 

        $data['ap2hi_number'] = $data['img_kapal_ap2hi']; 

        $data['dataVessel'] = $dataVessel ; 

        $data['dataSupplier']=$supplierData; 

        //$this->load->view('page_prints',$data  );
   

        

         $html=$this->load->view('page_prints',$data, true); 
       
        //this the the PDF filename that user will get to download
        $pdfFilePath ="ap2hi_Vessel_".time()."-download.pdf";

        //actually, you can pass mPDF parameter on this load() function
		include_once APPPATH.'/third_party/mpdf/mpdf.php';

        $this->load->library('m_pdf');
        //load mPDF library

        $pdf = $this->m_pdf->load();

                $pdf->AddPage('P', // L - landscape, P - portrait
                        '', '', '', '',
                        6, // margin_left
                        6, // margin right
                        12, // margin top
                        12, // margin bottom
                        18, // margin header
                        12  // margin footer
                        ); 

        //generate the PDF!
        $pdf->WriteHTML($html,2);

        //offer it to user via browser download! (The PDF won't be saved on your server HDD)
        $pdf->Output($pdfFilePath, "D");
        
         
    }


    public function excell_vessel(){ 
        $this->load->library('excel');

        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Vessel Lists AP2HI');
        //$this->excel->getActiveSheet()->setCellValue('A1', 'Nilai excelnya');
        $filename='VesselLists.xls'; 

        $data = $this->Model_master->get_all_vessel_download()->result_array();
            $this->excel->getActiveSheet()->setCellValue('A1', "nama_perusahaan"); 
            $this->excel->getActiveSheet()->setCellValue('B1', "urut"); 
            $this->excel->getActiveSheet()->setCellValue('C1', "nama_kapal"); 
            $this->excel->getActiveSheet()->setCellValue('D1',  "nama_pemilik");  
            $this->excel->getActiveSheet()->setCellValue('E1',  "no_ap2hi"); 
            $this->excel->getActiveSheet()->setCellValue('F1', "no_siup"); 
            $this->excel->getActiveSheet()->setCellValue('G1', "no_seafdec"); 
            $this->excel->getActiveSheet()->setCellValue('H1', "no_issf"); 
            $this->excel->getActiveSheet()->setCellValue('I1',  "no_kkp"); 
            $this->excel->getActiveSheet()->setCellValue('J1', "no_dkp"); 
            $this->excel->getActiveSheet()->setCellValue('K1', "no_vic"); 
            $this->excel->getActiveSheet()->setCellValue('L1', "no_nik"); 
            $this->excel->getActiveSheet()->setCellValue('M1', "nama_kapal_2tahun"); 
            $this->excel->getActiveSheet()->setCellValue('N1', "status_kapal"); 
            $this->excel->getActiveSheet()->setCellValue('O1', "jenis_kapal"); 
            $this->excel->getActiveSheet()->setCellValue('P1', "jenis_alat"); 
            $this->excel->getActiveSheet()->setCellValue('Q1', "ukuran"); 
            $this->excel->getActiveSheet()->setCellValue('R1', "loa"); 
            $this->excel->getActiveSheet()->setCellValue('S1', "bahan"); 
            $this->excel->getActiveSheet()->setCellValue('T1', "jenis_mesin_utama"); 
            $this->excel->getActiveSheet()->setCellValue('U1', "kapasitas_mesin_utama"); 
            $this->excel->getActiveSheet()->setCellValue('V1', "kapasitas_palka_ikan");  
            $this->excel->getActiveSheet()->setCellValue('W1', "kapasitas_palka_umpan"); 
            $this->excel->getActiveSheet()->setCellValue('X1', "vms");  
            $this->excel->getActiveSheet()->setCellValue('Y1', "lainnya");  
            $this->excel->getActiveSheet()->setCellValue('Z1', "irc"); 
            $this->excel->getActiveSheet()->setCellValue('AA1', "jumlah_pancing"); 
            $this->excel->getActiveSheet()->setCellValue('AB1', "jumlah_abk"); 
            $this->excel->getActiveSheet()->setCellValue('AC1', "nama_kapten"); 
            $this->excel->getActiveSheet()->setCellValue('AD1', "no_sipi"); 
            $this->excel->getActiveSheet()->setCellValue('AE1', "masa_berlaku_sipi");  
            $this->excel->getActiveSheet()->setCellValue('AF1', "rfmo"); 
            $this->excel->getActiveSheet()->setCellValue('AG1', "tahun_pembuatan_kapal");  
            $this->excel->getActiveSheet()->setCellValue('AH1', "bendera"); 
            $this->excel->getActiveSheet()->setCellValue('AI1', "bendera_2th"); 
            $this->excel->getActiveSheet()->setCellValue('AJ1', "pelabuhan_pangkalan"); 
            $this->excel->getActiveSheet()->setCellValue('AK1', "muat_singgah"); 
            $this->excel->getActiveSheet()->setCellValue('AL1', " copy_surat_ijin");  
            $this->excel->getActiveSheet()->setCellValue('AM1', "shark_policy"); 
            $this->excel->getActiveSheet()->setCellValue('AN1', "terdaftar_iuu"); 
            $this->excel->getActiveSheet()->setCellValue('AO1', "kode_etik_pelayaran");  
            $this->excel->getActiveSheet()->setCellValue('AP1', "no_imo"); 
            $this->excel->getActiveSheet()->setCellValue('AQ1', "lokasi_pembuatan"); 



        $this->excel->getActiveSheet()->fromArray($data, null, 'A2');

        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        header("Content-Type: application/vnd.ms-excel");
        header("Cache-Control: max-age=0");
        header ( "Content-Disposition: attachment; filename=".$filename."" );
        ob_end_clean();
        $objWriter->save('php://output');
  
    }


    public function excell_rumpon(){

    $this->load->library('excel');

        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Rumpon Lists AP2HI');
        //$this->excel->getActiveSheet()->setCellValue('A1', 'Nilai excelnya');
        $filename='Rumpon_lists.xls'; 

        $data = $this->Model_master->get_all_rumpon()->result_array();
            $this->excel->getActiveSheet()->setCellValue('A1', "kode_upload"); 
            $this->excel->getActiveSheet()->setCellValue('B1', "urut"); 
            $this->excel->getActiveSheet()->setCellValue('C1', "id_supplier"); 
            $this->excel->getActiveSheet()->setCellValue('D1',  "nama_perusahaan");  
            $this->excel->getActiveSheet()->setCellValue('E1',  "alamat"); 
            $this->excel->getActiveSheet()->setCellValue('F1', "no_sipr"); 
            $this->excel->getActiveSheet()->setCellValue('G1', "daerah_penangkapan");
            $this->excel->getActiveSheet()->setCellValue('H1', "daerah_usaha"); 
            $this->excel->getActiveSheet()->setCellValue('I1', "alat_tangkap");
            $this->excel->getActiveSheet()->setCellValue('J1', "posisi_rumpon");
            $this->excel->getActiveSheet()->setCellValue('K1', "bahan"); 
            
        

        $this->excel->getActiveSheet()->fromArray($data, null, 'A2');

        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        header("Content-Type: application/vnd.ms-excel");
        header("Cache-Control: max-age=0");
        header ( "Content-Disposition: attachment; filename=".$filename."" );
        ob_end_clean();
        $objWriter->save('php://output');


    }



    public function landing(){

        $user = $this->auth->get_data_session();

        $this->auth->check_login();

        if(!$this->auth->hasPrivilege("ViewLanding")){

            redirect('home','refresh');

        }

        $data['button_add']='<div><center>  <a type="button" class="btn btn-warning a-btn-slide-text">
                                   <span class="fa fa-plus" aria-hidden="true"></span>
                                   <span><strong>Unauthorize</strong></span>
                               </a> </center></div>';

         if($this->auth->hasPrivilege("AddLanding")){

              $data['button_add']= '<div><center> <button type="button" class="btn btn-success a-btn-slide-text"  data-toggle="modal" data-target="#myModalLanding" id="AddDataLandingBtn">   <span class="fa fa-plus-square" aria-hidden="true"></span> Add New</button> </center></div>'  ;

          }

          $data['countryLists'] = $this->Model_master->countryLists();

          $data['provinceLists'] = $this->Model_master->provinceLists();

          $data['select_load_regencies']=base_url()."master/mainpage/load_regencies";

          $data['select_load_districts']=base_url()."master/mainpage/load_districts";


        $data['url_load_table']=base_url()."master/mainpage/viewLandingActive";

        $data['url_add_landing']=base_url()."master/mainpage/addLanding";

        $data['url_edit_landing']=base_url()."master/mainpage/editLanding";

        $data['url_disable_landing']=base_url()."master/mainpage/disable_landing";

        $data['urlShowEditLanding']=base_url()."master/mainpage/showEditLanding";

        $data['content']="master/landing";

        $this->load->view('template-admin/template',$data);

    }


    public function viewLandingActive(){

        $this->auth->restrict_ajax_login_datatable();

        $query = $this->Model_master->get_all_landing_active();

        $result = array();

        $no = 0;

       foreach($query->result() as $row){

               $no++;

               $action1='<a type="button" class="btn btn-warning a-btn-slide-text">
                                   <span class="fa fa-plug" aria-hidden="true"></span>
                                   <span><strong>Unauthorize</strong></span>
                               </a>' ;
               $action2='<a type="button" class="btn btn-warning a-btn-slide-text">
                                   <span class="fa fa-times" aria-hidden="true"></span>
                                   <span><strong>Unauthorize</strong></span>
                               </a>' ;

               if($this->auth->hasPrivilege("EditLanding")){

                   $action1 = '<a type="button" data-toggle="modal" data-target="#editLandingModal" onclick="editData('.$row->id_landing.')" class="btn btn-primary a-btn-slide-text">
                                   <span class="fa fa-plug" aria-hidden="true"></span>
                                   <span><strong>Edit</strong></span>
                               </a>
                               ' ;
               }

               if($this->auth->hasPrivilege("DeleteSupplier")){
                   $action2 = ' <a type="button" data-toggle="modal" data-target="#disableLandingModal" onclick="disableData('.$row->id_landing.')" class="btn btn-danger a-btn-slide-text">
                                  <span class="fa fa-times" aria-hidden="true"></span>
                                   <span><strong>Disable</strong></span>
                               </a>' ;
               }

               $result['data'][]=array(

                       $no ,
                       $row->id_landing,
                       $row->nama_landing,
                       $action1,
                       $action2


               );

       }


        echo json_encode($result);



    }


    public function addLanding(){

     $this->form_validation->set_rules('province', 'Province', 'required');
     $this->form_validation->set_rules('regencies', 'Regencies', 'required');
     $this->form_validation->set_rules('district', 'District', 'required');
     $this->form_validation->set_rules('nama_landing', 'Nama Landing', 'required');

      if ( $this->form_validation->run()) {

        //Insert to Database
          $saved = $this->Model_master->add_landing($this->input->post());

            if ($saved)
          {
               $success = true;
               $messages =  "Successfully adding Data! ";
          }
          else
          {
               $success = false;
               $messages =  "Insert not working ! ";
          }

      }else{

            $success = false;
            $messages = 'Trouble adding Data!';

        }

            $validator['success'] = $success;
            $validator['messages'] = $messages;


        echo json_encode($validator);




    }

    public function showEditLanding(){

       $response = array();

       $id = $_POST['id'];

       $results = $this->Model_master->showEditLanding($id);

       $response = array(
               'success' => true,
               'messages' => $results->result_array()
           );

       echo json_encode($response);
   }

    public function editLanding(){

      $this->form_validation->set_rules('edit_id_landing', 'Landing Code', 'required');
      $this->form_validation->set_rules('edit_nama_landing', 'Landing Name', 'required');

      if ( $this->form_validation->run()  ) {

           //Insert to Database
            $saved = $this->Model_master->edit_landing( $this->input->post() );

           if ($saved)
           {
                $success = true;
                $messages =  "Successfully adding Data! ";
           }
           else
           {
                $success = false;
                $messages =  "Update not working ! ";
           }


       }else{

           $success = false;
           $messages = 'Trouble adding Data!';

       }

           $validator['success'] = $success;
           $validator['messages'] = $messages;


       echo json_encode($validator);

    }


    public function disable_landing(){

      $saved = $this->Model_master->disable_landing($_POST['id']);

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

    public function rumpon(){

        $user = $this->auth->get_data_session();

        $this->auth->check_login();

        if(!$this->auth->hasPrivilege("ViewRumpon")){

            redirect('home','refresh');

        }


        $data['button_add']='<div><center>  <a type="button" class="btn btn-warning a-btn-slide-text">
                                    <span class="fa fa-plus" aria-hidden="true"></span>
                                    <span><strong>Unauthorize</strong></span>
                                </a> </center></div>';;

        if($this->auth->hasPrivilege("AddRumpon")){

            $data['button_add']= '<div><center> <button type="button" class="btn btn-success a-btn-slide-text"  data-toggle="modal" data-target="#myModalRumpon" id="AddDataRumponBtn">   <span class="fa fa-plus-square" aria-hidden="true"></span> Add New</button> </center></div>'  ;

        }


      $data['url_load_table']=base_url()."master/mainpage/viewRumpon";

      $data['listSupplier'] =  $this->Model_master->get_all_supplier_active();

        //Add Data

      $data['url_add_rumpon']=base_url()."master/mainpage/addRumpon";

       $data['url_edit_rumpon']=base_url()."master/mainpage/editRumpon";

       $data['url_disable_rumpon']=base_url()."master/mainpage/disableRumpon";

       $data['urlShowEditRumpon']=base_url()."master/mainpage/showEditRumpon";

       $data['excell_rumpon']= base_url()."master/mainpage/excell_rumpon";

        $data['content']="master/rumpon";

        $this->load->view('template-admin/template',$data);

    }


    public function viewRumpon(){

      $this->auth->restrict_ajax_login_datatable();

        $query = $this->Model_master->get_all_rumpon();

        $result = array();

        $no = 0;

       foreach($query->result() as $row){

               $no++;


               $action1='<a type="button" class="btn btn-warning a-btn-slide-text">
                                   <span class="fa fa-plug" aria-hidden="true"></span>
                                   <span><strong>Unauthorize</strong></span>
                               </a>' ;
               $action2='<a type="button" class="btn btn-warning a-btn-slide-text">
                                   <span class="fa fa-times" aria-hidden="true"></span>
                                   <span><strong>Unauthorize</strong></span>
                               </a>' ;

               if($this->auth->hasPrivilege("EditRumpon")){

                   $action1 = '<a type="button" data-toggle="modal" data-target="#editRumponModal" onclick="editData('.$row->urut.' , '.$row->id_supplier.')" class="btn btn-primary a-btn-slide-text">
                                   <span class="fa fa-plug" aria-hidden="true"></span>
                                   <span><strong>Edit</strong></span>
                               </a>
                               ' ;
               }

               if($this->auth->hasPrivilege("DeleteRumpon")){
                   $action2 = ' <a type="button" data-toggle="modal" data-target="#disableRumponModal" onclick="disableData('.$row->urut.' , '.$row->id_supplier.')" class="btn btn-danger a-btn-slide-text">
                                  <span class="fa fa-times" aria-hidden="true"></span>
                                   <span><strong>Disable</strong></span>
                               </a>' ;
               }

               $result['data'][]=array(

                       $row->kode_upload,
                       $row->nama_perusahaan,
                       $row->alamat ,
                       $row->no_sipr ,
                       $row->daerah_penangkapan ,
                       $row->daerah_usaha,
                       $row->alat_tangkap,
                       $row->posisi_rumpon,
                       $row->bahan,
                       $action1,
                       $action2


               );

       }


        echo json_encode($result);


    }


     public function addRumpon(){

       //form validation
        $this->form_validation->set_rules('id_supplier', 'Supplier Code', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_sipr', 'No SIPR', 'required');
        $this->form_validation->set_rules('daerah_penangkapan', 'Daerah Penangkapan', 'required');
        $this->form_validation->set_rules('daerah_usaha', 'Daerah Usaha', 'required');
        $this->form_validation->set_rules('alat_tangkap', 'Alat Tangkap', 'required');
        $this->form_validation->set_rules('posisi_rumpon', 'Posisi Rumpon', 'required');
        $this->form_validation->set_rules('bahan', 'Bahan', 'required');


        if ( $this->form_validation->run()) {

          //Insert to Database
         $saved = $this->Model_master->add_rumpon($this->input->post());

        if ($saved)
        {
             $success = true;
             $messages =  "Successfully adding Data! ";
        }
        else
        {
             $success = false;
             $messages =  "Insert not working ! ";
        }


    }else{

        $success = false;
        $messages = 'Trouble adding Data!';

    }

        $validator['success'] = $success;
        $validator['messages'] = $messages;



      echo json_encode($validator);

     }


     public function showEditRumpon(){

      $response = array();

      $urut = $_POST['urut'];
      $id_supplier = $_POST['id_supplier'];


      $results = $this->Model_master->showEditRumpon($urut , $id_supplier );

      $response = array(
              'success' => true,
              'messages' => $results->result_array()
          );

      echo json_encode($response);

     }


     public function editRumpon(){

                 //form validation
          $this->form_validation->set_rules('edit_alamat', 'Supplier Code', 'required');
          $this->form_validation->set_rules('edit_no_sipr', 'No Sipr', 'required');
          $this->form_validation->set_rules('edit_daerah_penangkapan', 'Daerah Penangkapan', 'required');
          $this->form_validation->set_rules('edit_daerah_usaha', 'Daerah Usaha', 'required');
          $this->form_validation->set_rules('edit_alat_tangkap', 'Alat Tangkap', 'required');
          $this->form_validation->set_rules('edit_posisi_rumpon', 'Posisi Rumpon', 'required');
          $this->form_validation->set_rules('edit_bahan', 'Bahan', 'required');


          if ( $this->form_validation->run()  ) {

             //Insert to Database
              $saved = $this->Model_master->edit_rumpon($this->input->post());

             if ($saved)
             {
                  $success = true;
                  $messages =  "Successfully adding Data! ";
             }
             else
             {
                  $success = false;
                  $messages =  "Update not working ! ";
             }


          }else{

             $success = false;
             $messages = 'Trouble adding Data!';

          }

             $validator['success'] = $success;
             $validator['messages'] = $messages;


          echo json_encode($validator);


     }


     public function disableRumpon(){

         $saved = $this->Model_master->disable_rumpon($_POST['urut'] , $_POST['id_supplier']);

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



}