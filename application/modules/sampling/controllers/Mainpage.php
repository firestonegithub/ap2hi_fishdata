<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Mainpage extends CI_Controller {


    public function __construct(){

        parent::__construct();

        $this->load->model('Model_sampling');

        $this->load->model('master/model_master' ,'Model_master');

        $this->load->model('data/model_data' ,'Model_data');

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


    public function link_forms($kode_trip){

        $data['link_form1'] = base_url().'trip/trip_update/'.$kode_trip; 


        $checkForm2 = $this->Model_sampling->checkExsisting("tps_umpan", array('namafile' => $kode_trip) , 'namafile'); 
        if($checkForm2 > 0 ){
            $data['link_form2'] = base_url().'sampling/mainpage/form2/'.$kode_trip ; 
        }else{
            $data['link_form2'] = base_url().'sampling/mainpage/form2_add/'.$kode_trip ;
        }

        $checkForm3 = $this->Model_sampling->checkExsisting("tps_bycatch", array('namafile' => $kode_trip) , 'namafile'); 
        if($checkForm3 > 0 ){
            $data['link_form3'] = base_url().'sampling/mainpage/form3/'.$kode_trip ; 
        }else{
            $data['link_form3'] = base_url().'sampling/mainpage/form3_add/'.$kode_trip ;
        }


        $checkForm4 = $this->Model_sampling->checkExsisting("tps_ringkasan_ikankecil", array('namafile' => $kode_trip) , 'namafile'); 
        if($checkForm4 > 0 ){
            $data['link_form4'] = base_url().'sampling/mainpage/form4/'.$kode_trip; 
        }else{
            $data['link_form4'] = base_url().'sampling/mainpage/form4_add/'.$kode_trip;
        }


        $checkForm5 = $this->Model_sampling->checkExsisting("tps_ringkasan_ikanbesar", array('namafile' => $kode_trip) , 'namafile'); 
        if($checkForm5 > 0 ){
            $data['link_form5'] =base_url().'sampling/mainpage/form5/'.$kode_trip ; 
        }else{
            $data['link_form5'] = base_url().'sampling/mainpage/form5_add/'.$kode_trip ;
        }


        $data['link_form6'] = base_url().'sampling/mainpage/form6_update/'.$kode_trip;


        $data['link_form7'] = base_url().'sampling/mainpage/form7_update/'.$kode_trip ;
        

        return $data ; 

    }



    public function samplingapproved(){

        $this->auth->check_login();

        if(!$this->auth->hasPrivilege("ViewApprove")){

            redirect('home/no_access','refresh');

        }

        $data['button_add']='<div><center>  <a type="button" class="btn btn-warning a-btn-slide-text" >
                                    <span class="fa fa-plus" aria-hidden="true"></span>
                                    <span><strong>Unauthorize</strong></span>            
                                </a> </center></div>';;

        if($this->auth->hasPrivilege("AddApprove")){ 

            $data['button_add']= '<div><center> <a type="button" class="btn btn-success a-btn-slide-text" href="'.base_url().'sampling/mainpage/add_trip_choice">   <span class="fa fa-plus-square" aria-hidden="true"></span> Add New</a> </center></div>'  ; 
        
        }



        $data['EditApprove'] = $this->auth->hasPrivilege("EditApprove") ; 

        $data['DeleteApprove']  = $this->auth->hasPrivilege("DeleteApprove") ; 


        $user = $this->auth->get_data_session();


        $data['record'] = $this->Model_sampling->get_all_trip_active();

        //$data['url_load_table']=base_url()."sampling/mainpage/viewApprovalTrip";


        $data['content']="sampling/samplingapproved";

        $this->load->view('template-admin/template',$data);


    }

    public function viewApprovalTrip(){


        $this->auth->restrict_ajax_login_datatable();

         $query = $this->Model_sampling->get_all_trip_active();

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

                if($this->auth->hasPrivilege("EditApprove")){      

                    $action1 = '<a type="button" href="'.base_url().'/sampling/mainpage/trip_detail/'.$row->namafile.'" class="btn btn-primary a-btn-slide-text">
                                    <span class="fa fa-plug" aria-hidden="true"></span>
                                    <span><strong>Edit</strong></span>            
                                </a>
                                ' ; 
                }

                if($this->auth->hasPrivilege("DeleteApprove")){   
                    $areyousure = "''are you''";   
                    $action2 = ' <a type="button" href="'.base_url().'/sampling/mainpage/trip_disable/'.$row->namafile.'" class="btn btn-danger a-btn-slide-text" onclick="return confirm('.$areyousure.');"> 
                                   <span class="fa fa-times" aria-hidden="true"></span>
                                    <span><strong>Disable</strong></span>            
                                </a>' ; 
                }

                $result['data'][]=array(

                        $no , 
                        $row->namafile,
                        $row->nama_landing,
                        $row->nama_perusahaan,   
                        $row->thn_sampling."-".$row->bln_sampling."-".$row->tgl_sampling, 
                        $row->enumerator1, 
                        $row->enumerator2, 
                        $row->nama_kapal , 
                        $row->kapten_kapal , 
                        $row->gt_kapal , 
                        $row->tipe, 
                        $action1, 
                        $action2
                
                
                ); 

        }


         echo json_encode($result);

    }


    public function samplingdraft(){

         $this->auth->check_login();

    

        if(!$this->auth->hasPrivilege("ViewDraft")){

            redirect('home/no_access','refresh');

        }


        $data['button_add']='<div><center>  <a type="button" class="btn btn-warning a-btn-slide-text">
                                    <span class="fa fa-plus" aria-hidden="true"></span>
                                    <span><strong>Unauthorize</strong></span>            
                                </a> </center></div>';;

        if($this->auth->hasPrivilege("AddSupplier")){ 

              $data['button_add']= '<div><center> <a type="button" class="btn btn-success a-btn-slide-text" href="'.base_url().'sampling/mainpage/add_trip_choice">   <span class="fa fa-plus-square" aria-hidden="true"></span> Add New</a> </center></div>'  ; 
        
        }


        $user = $this->auth->get_data_session();


        $data['url_load_table']=base_url()."sampling/mainpage/viewApprovalDraft";

        $data['record'] = $this->Model_sampling->get_all_trip_draft();

        $data['EditDraft'] = $this->auth->hasPrivilege("EditDraft") ; 

        $data['DeleteDraft']  = $this->auth->hasPrivilege("DeleteDraft") ; 


        $data['content']="sampling/samplingdraft";

        $this->load->view('template-admin/template',$data);




    }


    public function viewApprovalDraft(){


        $this->auth->restrict_ajax_login_datatable();

         $query = $this->Model_sampling->get_all_trip_draft();

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

                if($this->auth->hasPrivilege("EditDraft")){      
                    $action1 = '<a type="button" href="'.base_url().'/sampling/mainpage/trip_detail/'.$row->namafile.'" class="btn btn-primary a-btn-slide-text">
                                    <span class="fa fa-plug" aria-hidden="true"></span>
                                    <span><strong>Edit</strong></span>            
                                </a>
                                ' ; 
                }

                if($this->auth->hasPrivilege("DeleteDraft")){      
                    $action2 = ' <a type="button" href="'.base_url().'/sampling/mainpage/trip_disable/'.$row->namafile.'" class="btn btn-danger a-btn-slide-text" onclick="myFunction()">
                                   <span class="fa fa-times" aria-hidden="true"></span>
                                    <span><strong>Disable</strong></span>            
                                </a>' ; 
                }

                $result['data'][]=array(

                        $no , 
                        $row->namafile,
                        $row->nama_landing,
                        $row->nama_perusahaan,   
                        $row->thn_sampling."-".$row->bln_sampling."-".$row->tgl_sampling, 
                        $row->enumerator1, 
                        $row->enumerator2, 
                        $row->nama_kapal , 
                        $row->kapten_kapal , 
                        $row->gt_kapal , 
                        $row->tipe, 
                        $action1, 
                        $action2
                
                
                ); 

        }


         echo json_encode($result);

    }



    public function add_trip_choice(){

        $user = $this->auth->get_data_session();

        $data['content']="sampling/add_trip_choice";

        $this->load->view('template-admin/template',$data);

    }


    public function add_new_trip($tipe){

        $this->auth->check_login();

        $user = $this->auth->get_data_session();

        $data['tipe']=strtoupper($tipe);

        $data['record_suppliers'] = $this->Model_master->get_all_supplier_active();

        $data['record_landings'] =  $this->Model_master->get_all_landing_active();

        $data['load_vessel_from_id_supplier']=base_url()."sampling/mainpage/load_vessel_from_id_supplier";
    
        $data['select_vessel_from_id_supplier']=base_url()."sampling/mainpage/select_vessel_from_id_supplier";

        $data['grid_1'] = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");

        $data['teknik_cari_tuna_drop'] = array("Lumba-lumba","Ikan","Burung","Rumpon","FishFinder/Sonar","Lain-lain");

        $data['bahan_kapal_drop'] = array("Kayu","Fiber","Campuran Kayu - Fiber","Besi","Lain-lain");

        $data['notification'] = [];

        $notification = [];


        if (isset($_POST['submit'])){

            $this->form_validation->set_rules('k_landing', 'Landing Code', 'required');

            $this->form_validation->set_rules('k_perusahaan', 'Supplier Code', 'required');

            $this->form_validation->set_rules('nama_kapal', 'Nama Kapal', 'required');

            if ( $this->form_validation->run() == TRUE  ) {


                $data['post'] = $_POST; 

                if($_POST['id_vessel'] != ''){

                     $data['vesselData'] =  $this->Model_master->master_vessel_update($_POST['id_vessel'])->row_array();  
                }


                $k_landing      = $_POST['k_landing'] ;
                $sampling_date  = strtotime( $_POST['sampling_date']);
                $sampling_date  =  date("Ymd",$sampling_date);
                $sampling_date  = substr($sampling_date, 2);
                $sampling_time  = str_replace(":","", $_POST['sampling_time']);

                $namafile = $k_landing."_".$sampling_date."_".$sampling_time;
                $is_exsist = $this->Model_data->checkSamplingExsist($namafile); 

                if($is_exsist > 0 ){
                  $notification[] = "Data Sudah Pernah Diupload" ; 
                  $status = 'error'; 
                }

                $dataset = $this->input->post();

                $dataset['namafile'] = $namafile;

                $this->Model_sampling->add_new_trip($dataset);


                $this->global_model->sent_email_easy($namafile);


                $data['notification'] = $notification; 

                
                
                //redirect('sampling/mainpage/samplingdraft');

                redirect('sampling/mainpage/trip_detail/'.$dataset['namafile']);


            }else{

                $data['post'] = $_POST; 

                $data['vesselData'] =  $this->Model_master->master_vessel_update($_POST['id_vessel'] ?: "0")->row_array();  

                $data['content']="sampling/add_new_trip";

                $this->load->view('template-admin/template',$data);

              }
                
        }else{

            //if not submitted data
            $data['content']="sampling/add_new_trip";

            $this->load->view('template-admin/template',$data);


        }    

        
   


    }


    public function load_vessel_from_id_supplier(){

                $id = $_POST['id']; 

                $results = $this->Model_master->load_vessel_from_id_supplier($id);

                echo '<option value="">Select Vessel</option>';
                
                foreach($results->result() as $res){
                    echo '<option value="'.$res->id_vessel.'">'.$res->nama_kapal.'</option>'; 
                }
    }


    public function select_vessel_from_id_supplier(){

        $response = array();

        $id = $_POST['id'];

        $results = $this->Model_master->master_vessel_update($id);

        $response = array(
                'success' => true, 
                'messages' => $results->result_array()
            ); 

        echo json_encode($response);

    }

    public function cancel_approve($namafile){

         if(!$this->auth->hasPrivilege("ApprovingDraft")){

            redirect('home/no_access','refresh');

        }
        

        $this->Model_sampling->trip_approve($namafile,'2');


        redirect('sampling/mainpage/samplingdraft/');

    }

    public function approve($namafile){

        if(!$this->auth->hasPrivilege("ApprovingDraft")){

            redirect('home/no_access','refresh');

        }

        $this->Model_sampling->trip_approve($namafile,'1');


        redirect('sampling/mainpage/samplingapproved/');

    }



    public function trip_detail($namafile){

         $this->auth->check_login();

        if(!$this->auth->hasPrivilege("DetailApprove")){

            redirect('home/no_access','refresh');

        }


        $data = $this->link_forms($namafile);

        $data['namafile'] = $namafile ; 

        $data['record_suppliers'] = $this->Model_master->get_all_supplier_active();

        $data['record_landings'] =  $this->Model_master->get_all_landing_active();

        $data['load_vessel_from_id_supplier']=base_url()."sampling/mainpage/load_vessel_from_id_supplier";
    
        $data['select_vessel_from_id_supplier']=base_url()."sampling/mainpage/select_vessel_from_id_supplier";

        $data['grid_1'] = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");

        $data['teknik_cari_tuna_drop'] = array("Lumba-lumba","Ikan","Burung","Rumpon","FishFinder/Sonar","Lain-lain");

        $data['bahan_kapal_drop'] = array("Kayu","Fiber","Campuran Kayu - Fiber","Besi","Lain-lain");

        $data['notification'] = [];

        $notification = [];

        $data['tripDetail'] = $this->Model_sampling->general_select("tps_pendaratan", array('namafile' => $namafile), "", "")->row_array(); 

        $data['sampling_date'] = $data['tripDetail']['thn_sampling']."-".sprintf("%02d", $data['tripDetail']['bln_sampling'])."-".sprintf("%02d",$data['tripDetail']['tgl_sampling']);

        $data['tripDetail']['jam_sampling'] = sprintf("%02d", $data['tripDetail']['jam_sampling']);

        $data['tripDetail']['mnt_sampling'] = sprintf("%02d", $data['tripDetail']['mnt_sampling']);

        $data['sampling_time'] = $data['tripDetail']['jam_sampling'].":".$data['tripDetail']['mnt_sampling'].":"."00";

        if($data['tripDetail']['lama_satuan'] == 'hari'){

            $data['lama_trip'] = $data['tripDetail']['lama_hari'] ;

        }else{

             $data['lama_trip'] = $data['tripDetail']['lama_jam'] ;

        }

        $explode_var = explode(",", $data['tripDetail']['teknik_cari_tuna']) ;

        //var_dump(count($explode_var));

        if(is_array($explode_var) > 1){

           
                 $data['tripDetail']['teknik_cari_tuna1'] = $explode_var[0];
                 $data['tripDetail']['teknik_cari_tuna2'] = $explode_var[1];

            

        }

        $array_grid =  json_decode($data['tripDetail']['grid'] );

        if(is_array($array_grid)){

            $i=0;
            foreach($array_grid as $item) {

                $explode_var = explode(" - ", $item) ;

                if($i==0){

                     $data['tripDetail']['grid11'] = $explode_var[0];
                     $data['tripDetail']['grid12'] = $explode_var[1];

                }

                if($i==1){

                     $data['tripDetail']['grid21'] = $explode_var[0];
                     $data['tripDetail']['grid22'] = $explode_var[1];

                }
                
                $i++;

            }
        }


        $data['tipe'] = $data['tripDetail']['tipe'];

        if (isset($_POST['submit'])){

                $data['post'] = $_POST; 

        
                $data = $this->input->post();

                $data['namafile'] = $namafile;

                $this->Model_sampling->update_trip_utama($data);


                $data['notification'] = $notification; 

                
                
                redirect('sampling/mainpage/trip_detail/'.$namafile);
                
        }else{

            $data['content']="sampling/update_trip_utama";

            $this->load->view('template-admin/template',$data);

        }

        
      





    } 



    public function trip_disable($namafile){


        $this->Model_sampling->trip_disable($namafile);


        redirect('sampling/mainpage/samplingdraft');


    }    



    public function form2($namafile){


        $data = $this->link_forms($namafile);

        $data['namafile'] = $namafile; 

        $data['page_name'] = 'Umpan' ; 

        $data['page_name_detail'] = 'Form 2 Umpan' ; 

        $data['record'] = $this->Model_sampling->general_select("tps_umpan", array('namafile' => $namafile), "", "");

        $data['content']="sampling/form2/list";

        $this->load->view('template-admin/template',$data);


    }

    public function form2_add($namafile){

        $data['namafile'] = $namafile; 

        $data['page_name'] = 'Umpan' ; 

        $data['page_name_detail'] = 'Add Umpan' ; 

        $data['trip_info'] = $this->Model_sampling->general_select("tps_pendaratan", array('namafile' => $namafile), "", "")->row_array();

        $data['grid_1'] = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");

        if($data['trip_info']['tipe']=='HL'){

            $data['k_umpan'] = array("A","B","C","D","E","F","G");  

            $data['species'] = array("Chiroteuthis imperator",
                                    "Chiroteuthis picteti",
                                    "Idiotheuthis cordiformis",
                                    "Loligo pickfordi",
                                    "Loliolus affinis",
                                    "Loliolus hardwickei",
                                    "Loligo chinesnis",
                                    "Uroteuthis duvaucelii",
                                    "Pterygioteuthis giardia",
                                    "Sepioteuthis lessoniana",
                                    "Sthenoteuthis oualaniensis",
                                    "Thysanoteuthis rhombus",
                                    "Uroteuthis bartschi",
                                    "Uroteuthis sibogae",
                                    "Uroteuthis singhalensis",
                                    "Uroteuthis edulis",
                                    "Abralia andamanica",
                                    "Abralia renschi",
                                    "Pholodoteuthis boschmai",
                                    "Enoploteuthis reticulata",
                                    "Galiteuthis pacifica",
                                    "Taonius belone",
                                    "Cheilopogon abei",
                                    "Cheilopogon arcticeps",
                                    "Cheilpogon antoncichi",
                                    "Cheilopogon atrisignis",
                                    "Cheilopogon intermedius",
                                    "Cheilopogon katoptron",
                                    "Cheilopogon unicolor",
                                    "Cypselurus hexazona",
                                    "Cypselurus oligolepis",
                                    "Cypselurus opisthopus",
                                    "Cypselurus poecilopterus",
                                    "Hirundichthys albimaculatus",
                                    "Hirundichthys oxycephalus",
                                    "Parexocoetus brachypterus",
                                    "Euthynnus affinis",
                                    "Auxis rochei",
                                    "Selar crumenophthalmus",
                                    "Decapterus russelli",
                                    "Decapterus macrosoma",
                                    "Decapterus kurroides",
                                    "Decapterus macarellus",
                                    "Selaroides letolepis",
                                    "Sardinella gibbosa",
                                    "Sardinella lemuru",
                                    "Rastrelliger kanagurta",
                                    "Rastrelliger brachysoma",
                                    "Other"
                                    );  

        }else{

            $data['k_umpan'] = array("T","U","V","W","X","Y","Z");

            $data['species'] = array("Encrasicholina heteroloba",
                                    "Encrasicholina devisi",
                                    "Encrasicholina punctifer",
                                    "Spratelloides gracilis",
                                    "Spratelloides delicatulus",
                                    "Sardinella fimbriata",
                                    "Sardinella gibbosa",
                                    "Amblygaster sirm",
                                    "Sardinella lemuru",
                                    "Decapterus macrosoma",
                                    "Decapterus kurroides",
                                    "Decapterus macarellus",
                                    "Rastrelliger kanagurta",
                                    "Rastrelliger brachysoma",
                                    "Gymnocaesio gymnoptera",
                                    "Dipterygonotus balteatu",
                                    "Thryssa baelama",
                                    "Herklotsichthys quadrimaculatus",
                                    "Selar crumenophthalmus",
                                    "Selaroides leptolepis",
                                    "Hypoatherina temmincki",
                                    "Other");

        }


         $data['k_alattangkap'] = array("Handline",
                                    "Bagan Tancap Beli di Pasar",
                                    "Serokan",
                                    "Kapal Bagang",
                                    "Bagan Perahu",
                                    "Purratu",
                                    "Buah",
                                    "Serokan dan Handline",
                                    "Jaring",
                                    "Serok",
                                    "Bagan Apung",
                                    "Purse Seine",
                                    "Lambayang" );


         

        if (isset($_POST['submit'])){


            $this->form_validation->set_rules('namafile', 'namafile required', 'required');

            $this->form_validation->set_rules('k_umpan', 'Kategory Umpan required', 'required');

            $this->form_validation->set_rules('species', 'Jenis Species required', 'required');

            if( $this->form_validation->run() == TRUE  ) {

                $this->Model_sampling->form2_add($this->input->post());

                redirect('sampling/mainpage/form2/'.$namafile);


              }else{

                $data['post'] = $_POST;
        
               
                $data['content']="sampling/form2/add";

                $this->load->view('template-admin/template',$data);


              }


        }else{

        
            
            $data['content']="sampling/form2/add";

            $this->load->view('template-admin/template',$data);

    

        }

    }



    public function form2_update($namafile,$urut){

        $data['namafile'] = $namafile; 

        $data['urut'] = $urut ; 

        $data['page_name'] = 'Umpan' ; 

        $data['page_name_detail'] = 'Add Umpan' ; 

        $data['trip_info'] = $this->Model_sampling->general_select("tps_pendaratan", array('namafile' => $namafile), "", "")->row_array();

        $data['post'] = $this->Model_sampling->general_select("tps_umpan", array('namafile' => $namafile , 'urut' => $urut) , "", "")->row_array();

        $data['post']['grid1'] = $data['post']['rumpon1'];

        $data['post']['grid2'] = $data['post']['rumpon2'];

        $data['grid_1'] = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");

        if($data['trip_info']['tipe']=='HL'){

            $data['k_umpan'] = array("A","B","C","D","E","F","G");  

            $data['species'] = array("Chiroteuthis imperator",
                                    "Chiroteuthis picteti",
                                    "Idiotheuthis cordiformis",
                                    "Loligo pickfordi",
                                    "Loliolus affinis",
                                    "Loliolus hardwickei",
                                    "Loligo chinesnis",
                                    "Uroteuthis duvaucelii",
                                    "Pterygioteuthis giardia",
                                    "Sepioteuthis lessoniana",
                                    "Sthenoteuthis oualaniensis",
                                    "Thysanoteuthis rhombus",
                                    "Uroteuthis bartschi",
                                    "Uroteuthis sibogae",
                                    "Uroteuthis singhalensis",
                                    "Uroteuthis edulis",
                                    "Abralia andamanica",
                                    "Abralia renschi",
                                    "Pholodoteuthis boschmai",
                                    "Enoploteuthis reticulata",
                                    "Galiteuthis pacifica",
                                    "Taonius belone",
                                    "Cheilopogon abei",
                                    "Cheilopogon arcticeps",
                                    "Cheilpogon antoncichi",
                                    "Cheilopogon atrisignis",
                                    "Cheilopogon intermedius",
                                    "Cheilopogon katoptron",
                                    "Cheilopogon unicolor",
                                    "Cypselurus hexazona",
                                    "Cypselurus oligolepis",
                                    "Cypselurus opisthopus",
                                    "Cypselurus poecilopterus",
                                    "Hirundichthys albimaculatus",
                                    "Hirundichthys oxycephalus",
                                    "Parexocoetus brachypterus",
                                    "Euthynnus affinis",
                                    "Auxis rochei",
                                    "Selar crumenophthalmus",
                                    "Decapterus russelli",
                                    "Decapterus macrosoma",
                                    "Decapterus kurroides",
                                    "Decapterus macarellus",
                                    "Selaroides letolepis",
                                    "Sardinella gibbosa",
                                    "Sardinella lemuru",
                                    "Rastrelliger kanagurta",
                                    "Rastrelliger brachysoma",
                                    "Other"
                                    );  

        }else{

            $data['k_umpan'] = array("T","U","V","W","X","Y","Z");

            $data['species'] = array("Encrasicholina heteroloba",
                                    "Encrasicholina devisi",
                                    "Encrasicholina punctifer",
                                    "Spratelloides gracilis",
                                    "Spratelloides delicatulus",
                                    "Sardinella fimbriata",
                                    "Sardinella gibbosa",
                                    "Amblygaster sirm",
                                    "Sardinella lemuru",
                                    "Decapterus macrosoma",
                                    "Decapterus kurroides",
                                    "Decapterus macarellus",
                                    "Rastrelliger kanagurta",
                                    "Rastrelliger brachysoma",
                                    "Gymnocaesio gymnoptera",
                                    "Dipterygonotus balteatu",
                                    "Thryssa baelama",
                                    "Herklotsichthys quadrimaculatus",
                                    "Selar crumenophthalmus",
                                    "Selaroides leptolepis",
                                    "Hypoatherina temmincki",
                                    "Other");

        }


        $data['k_alattangkap'] = array("Handline",
                                    "Bagan Tancap Beli di Pasar",
                                    "Serokan",
                                    "Kapal Bagang",
                                    "Bagan Perahu",
                                    "Purratu",
                                    "Buah",
                                    "Serokan dan Handline",
                                    "Jaring",
                                    "Serok",
                                    "Bagan Apung",
                                    "Purse Seine",
                                    "Lambayang" );



        if (isset($_POST['submit'])){


            $this->form_validation->set_rules('namafile', 'namafile required', 'required');

            $this->form_validation->set_rules('k_umpan', 'Kategory Umpan required', 'required');

            $this->form_validation->set_rules('species', 'Jenis Species required', 'required');

            if( $this->form_validation->run() == TRUE  ) {

                $this->Model_sampling->form2_update($this->input->post());

                redirect('sampling/mainpage/form2/'.$namafile);


              }else{

        
                $data['post'] = $_POST;

                $data['content']="sampling/form2/update";

                $this->load->view('template-admin/template',$data);


              }


        }else{

            $data['content']="sampling/form2/update";

            $this->load->view('template-admin/template',$data);

        }

    }



    public function form2_delete($namafile , $urut){


        $this->Model_sampling->form2_delete($namafile , $urut);

        redirect('sampling/mainpage/form2/'.$namafile);

    }








    public function form3($namafile){


        $data = $this->link_forms($namafile);

        $data['namafile'] = $namafile; 

        $data['page_name'] = 'Bycatch' ; 

        $data['page_name_detail'] = 'Form 3 Bycatch' ; 

        $data['record'] = $this->Model_sampling->general_select("tps_bycatch", array('namafile' => $namafile), "", "");

        $data['content']="sampling/form3/list";

        $this->load->view('template-admin/template',$data);


    }



     public function form3_add($namafile){

        $data['namafile'] = $namafile; 

        $data['page_name'] = 'Bycatch' ; 

        $data['page_name_detail'] = 'Add Bycatch' ; 

        $data['trip_info'] = $this->Model_sampling->general_select("tps_pendaratan", array('namafile' => $namafile), "", "")->row_array();



        $data['k_species'] = array(

            "BLM" => "Black Marlin",
            "BUM" => "Blue Marlin",
            "SFA" => "Ikan Layar (Sail Fish)",
            "RRU" => "Ikan Salam (Rainbow Runner)",
            "DCC" => "Layang (Shortfin Scad)",
            "DOL" => "Mahi-Mahi (Dolphin Fish)",
            "SSP" => "Shortbill Spearfish",
            "MLS" => "Striped Marlin",
            "SWO" => "Swordfish",
            "BLT" => "Tongkol Bullet (Bullet Tuna)",
            "KAW" => "Tongkol Komo (Mackerel Tuna)",
            "WAH" => "Wahoo",
            "DCK" => "Redtail scad",
            "MSD" => "Mackerel scad",
            "COM" => "Tenggiri (Spanish mackerel)",
            "CXS" => "Bigeye trevally",
            "FRI" => "Frigate tuna",
            "GBA" => "Great barracuda",
            "NXI" => "Giant Trevally",
            "LOB" => "Tripletail",
            "MNT" => "Manta rays",
            "NGB" => "Lemon shark",
            "CCK" => "Pondicherry shark",
            "OCS" => "Oceanic whitetip shark",
            "OMZ" => "Squids nei",
            "ONI" => "Red-toothed triggerfish (Pogot)",
            "PTH" => "Pelagic thresher",
            "SMA" => "Shortfin mako",
            "LOT" => "Longtail tuna",
            "DOT" => "Dogtooth Tuna",
            "BIS" => "Selar crumenophthalmus",
            "TRE" => "Caranx Sp (Bubara)",
            "UN" => "Tidak Teridentifikasi"


        );

      

        if (isset($_POST['submit'])){


            $this->form_validation->set_rules('namafile', 'namafile required', 'required');

            $this->form_validation->set_rules('k_species', 'k_species required', 'required');

            if( $this->form_validation->run() == TRUE  ) {

                $this->Model_sampling->form3_add($this->input->post());

                redirect('sampling/mainpage/form3/'.$namafile);


              }else{

                $data['post'] = $_POST;
        
               
                $data['content']="sampling/form3/add";

                $this->load->view('template-admin/template',$data);


              }


        }else{

        
            
            $data['content']="sampling/form3/add";

            $this->load->view('template-admin/template',$data);

    

        }

    }


     public function form3_update($namafile,$kode_species){

        $data['namafile'] = $namafile; 

        $data['kode_species'] = $kode_species ; 

        $data['page_name'] = 'Bycatch' ; 

        $data['page_name_detail'] = 'Add Bycatch' ; 

        $data['trip_info'] = $this->Model_sampling->general_select("tps_pendaratan", array('namafile' => $namafile), "", "")->row_array();

        $data['post'] = $this->Model_sampling->general_select("tps_bycatch", array('namafile' => $namafile , 'k_species' => $kode_species) , "", "")->row_array();

        $data['array_species'] = array(

            "BLM" => "Black Marlin",
            "BUM" => "Blue Marlin",
            "SFA" => "Ikan Layar (Sail Fish)",
            "RRU" => "Ikan Salam (Rainbow Runner)",
            "DCC" => "Layang (Shortfin Scad)",
            "DOL" => "Mahi-Mahi (Dolphin Fish)",
            "SSP" => "Shortbill Spearfish",
            "MLS" => "Striped Marlin",
            "SWO" => "Swordfish",
            "BLT" => "Tongkol Bullet (Bullet Tuna)",
            "KAW" => "Tongkol Komo (Mackerel Tuna)",
            "WAH" => "Wahoo",
            "DCK" => "Redtail scad",
            "MSD" => "Mackerel scad",
            "COM" => "Tenggiri (Spanish mackerel)",
            "CXS" => "Bigeye trevally",
            "FRI" => "Frigate tuna",
            "GBA" => "Great barracuda",
            "NXI" => "Giant Trevally",
            "LOB" => "Tripletail",
            "MNT" => "Manta rays",
            "NGB" => "Lemon shark",
            "CCK" => "Pondicherry shark",
            "OCS" => "Oceanic whitetip shark",
            "OMZ" => "Squids nei",
            "ONI" => "Red-toothed triggerfish (Pogot)",
            "PTH" => "Pelagic thresher",
            "SMA" => "Shortfin mako",
            "LOT" => "Longtail tuna",
            "DOT" => "Dogtooth Tuna",
            "BIS" => "Selar crumenophthalmus",
            "TRE" => "Caranx Sp (Bubara)",
            "UN" => "Tidak Teridentifikasi"


        );

        



        if (isset($_POST['submit'])){


            $this->form_validation->set_rules('namafile', 'namafile required', 'required');

            $this->form_validation->set_rules('k_species', 'k_species required', 'required');

            if( $this->form_validation->run() == TRUE  ) {

                $this->Model_sampling->form3_update($this->input->post());

                redirect('sampling/mainpage/form3/'.$namafile);


              }else{

        
                $data['post'] = $_POST;

                $data['content']="sampling/form3/update";

                $this->load->view('template-admin/template',$data);


              }


        }else{

            $data['content']="sampling/form3/update";

            $this->load->view('template-admin/template',$data);

        }

    }



    public function form3_delete($namafile , $k_species){


        $this->Model_sampling->form3_delete($namafile , $k_species);

        redirect('sampling/mainpage/form3/'.$namafile);

    }


    ############### Form 4 ###########################

    public function form4($namafile){

        $this->auth->check_login();

        $data = $this->link_forms($namafile);

        $data['namafile'] = $namafile; 

        $data['page_name'] = 'Ringkasan Ikan Kecil' ; 

        $data['page_name_detail'] = 'Form 4 Ringkasan Ikan Kecil' ; 

        $data['record'] = $this->Model_sampling->general_select("tps_ringkasan_ikankecil", array('namafile' => $namafile), "", "");


        $data['page_name1'] = 'Ikan Kecil' ; 

        $data['page_name_detail1'] = 'Form 4 Ikan Kecil' ; 

        $data['table1'] = 'Detail Ikan Kecil'; 

        $data['button_add']= '<div><center> <button type="button" class="btn btn-success a-btn-slide-text"  data-toggle="modal" data-target="#myModalTable1" id="AddDataTable1Btn">   <span class="fa fa-plus-square" aria-hidden="true"></span> Add New</button> </center></div>'  ;

        $data['url_load_table']=base_url()."sampling/mainpage/view_detail_ikan_kecil/".$namafile;

        $data['url_show_table']=base_url()."sampling/mainpage/view_update_detail_ikan_kecil/";

        $data['url_add_table1']=base_url()."sampling/mainpage/add_detail_ikan_kecil";

        $data['url_update_table1']=base_url()."sampling/mainpage/update_detail_ikan_kecil";

        $data['url_delete_table1']=base_url()."sampling/mainpage/delete_detail_ikan_kecil";


        $data['content']="sampling/form4/list";

        $this->load->view('template-admin/template',$data);


    }


    public function view_detail_ikan_kecil($namafile ){

        $query = $this->Model_sampling->general_select("tps_ikankecil", array('namafile' => $namafile ) , "", ""); 

        $result = array();

        $no = 0;
        
        foreach($query->result() as $row){


            $namafile_remove_xlsx = str_replace(".", "-", $row->namafile); 


                  $action1 = '<a type="button" data-toggle="modal" data-target="#editTable1Modal" onclick="editData(\'' .$namafile_remove_xlsx.'\' , '.$row->nomor.', '.$row->no_ikan.')" class="btn btn-primary a-btn-slide-text">
                                    <span class="fa fa-plug" aria-hidden="true"></span>
                                    <span><strong>Update</strong></span>            
                                </a>
                                ' ; 
                 $action2 = ' <a type="button" data-toggle="modal" data-target="#disableTable1Modal" onclick="disableData(\'' .$namafile_remove_xlsx.'\'  , '.$row->nomor.', '.$row->no_ikan.')" class="btn btn-danger a-btn-slide-text">
                                   <span class="fa fa-times" aria-hidden="true"></span>
                                    <span><strong>Delete</strong></span>            
                                </a>' ;
           

         

                $result['data'][]=array(

                        $row->nomor, 
                        $row->berat_keranjang, 
                        $row->k_species , 
                        $row->berat_sample , 
                        $row->panjang,
                        $row->kode_panjang,
                        $row->kondisi,
                        $action1, 
                        $action2
                
                
                ); 

        }


         echo json_encode($result);



    }



    public function form4_add($namafile){

        $data['namafile'] = $namafile; 

        $data['page_name'] = 'Ringkasan' ; 

        $data['page_name'] = 'Ringkasan Ikan Kecil' ; 

        $data['page_name_detail'] = 'Form 4 Ringkasan Ikan Kecil' ; 

        $data['trip_info'] = $this->Model_sampling->general_select("tps_pendaratan", array('namafile' => $namafile), "", "")->row_array();


        if (isset($_POST['submit'])){


            $this->form_validation->set_rules('namafile', 'namafile required', 'required');

            $this->form_validation->set_rules('kode', 'kode required', 'required');

            $this->form_validation->set_rules('berat', 'berat required', 'required');


            

            if( $this->form_validation->run() == TRUE  ) {

                $this->Model_sampling->form4_add($this->input->post());

                redirect('sampling/mainpage/form4/'.$namafile);


              }else{

                $data['post'] = $_POST;
        
               
                $data['content']="sampling/form4/add";

                $this->load->view('template-admin/template',$data);


              }


        }else{

        
            
            $data['content']="sampling/form4/add";

            $this->load->view('template-admin/template',$data);

    

        }

    }


      public function form4_update($namafile,$kode_species){

        $data['namafile'] = $namafile; 

        $data['kode_species'] = $kode_species ; 

        $data['page_name'] = 'Ringkasan' ; 

        $data['page_name_detail'] = 'Update Ringkasan Kecil' ; 

        $data['trip_info'] = $this->Model_sampling->general_select("tps_pendaratan", array('namafile' => $namafile), "", "")->row_array();

        $data['post'] = $this->Model_sampling->general_select("tps_ringkasan_ikankecil", array('namafile' => $namafile , 'kode' => $kode_species) , "", "")->row_array();



        if (isset($_POST['submit'])){


            $this->form_validation->set_rules('namafile', 'namafile required', 'required');
            
            $this->form_validation->set_rules('kode_species', 'kode required', 'required');

            $this->form_validation->set_rules('kode', 'kode required', 'required');

            $this->form_validation->set_rules('berat', 'berat required', 'required');

            if( $this->form_validation->run() == TRUE  ) {

                $this->Model_sampling->form4_update($this->input->post());

                redirect('sampling/mainpage/form4/'.$namafile);


              }else{

        
                $data['post'] = $_POST;

                $data['content']="sampling/form4/update";

                $this->load->view('template-admin/template',$data);


              }


        }else{

            $data['content']="sampling/form4/update";

            $this->load->view('template-admin/template',$data);

        }

    }


    public function form4_delete($namafile , $k_species){


        $this->Model_sampling->form4_delete($namafile , $k_species);

        redirect('sampling/mainpage/form4/'.$namafile);

    }


    public function add_detail_ikan_kecil(){

               //form validation 
        $this->form_validation->set_rules('namafile', 'namafile', 'required');

        $this->form_validation->set_rules('nomor', 'nomor', 'required');

        $this->form_validation->set_rules('berat_keranjang', 'berat_keranjang', 'required');

        $this->form_validation->set_rules('fao', 'fao', 'required');
   

        
        if ( $this->form_validation->run()  ) {


            //Insert to Database 

            $data = $this->input->post() ; 

        
                //Insert to Database 
                 $saved = $this->Model_sampling->add_detail_ikan_kecil($data);

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
            $messages = 'Trouble adding Data! Pastikan Kode species terisi';
            
        }

            $validator['success'] = $success;
            $validator['messages'] = $messages;
        

        echo json_encode($validator);


    }


    public function view_update_detail_ikan_kecil(){



        $response = array();

        $namafile =  $_POST['namafile'];

        $nomor =  $_POST['nomor'];

        $no_ikan =  $_POST['no_ikan'];

        $namafile_remove_xlsx = str_replace("-", ".", $namafile); 

        $results = $this->Model_sampling->general_select("tps_ikankecil", array('namafile' => $namafile_remove_xlsx , 'nomor' => $nomor , 'no_ikan' => $no_ikan ) , "", ""); 


        $response = array(

                'success' => true, 

                'messages' => $results->result_array()
            ); 

        echo json_encode($response);


    }

    public function update_detail_ikan_kecil(){

        $this->form_validation->set_rules('edit_namafile', 'edit_namafile ', 'required');
        $this->form_validation->set_rules('edit_nomor', 'edit_nomor ', 'required');
        $this->form_validation->set_rules('edit_no_ikan', 'edit_no_ikan ', 'required');
        $this->form_validation->set_rules('edit_fao', 'edit_fao', 'required');
        
        if ( $this->form_validation->run()  ) {

            $data = $this->input->post() ; 

            $saved = $this->Model_sampling->update_detail_ikan_kecil($data);

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
            $messages = 'Trouble adding Data! Pastikan data terisi!';
            
        }

            $validator['success'] = $success;
            $validator['messages'] = $messages;
        

        echo json_encode($validator);



    }


    public function delete_detail_ikan_kecil(){


        $response = array();

        $namafile =  $_POST['namafile'];

        $nomor =  $_POST['nomor'];

        $no_ikan = $_POST['no_ikan'];

        $namafile_remove_xlsx = str_replace("-", ".", $namafile); 

        $saved = $this->Model_sampling->delete_detail_ikan_kecil($namafile_remove_xlsx , $nomor , $no_ikan);

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

    ############### End Form 4 ###########################




    ############### Form 5 ###########################



    public function form5($namafile){

         $this->auth->check_login();

        $data = $this->link_forms($namafile);

        $data['namafile'] = $namafile; 

        $data['page_name'] = 'Ringkasan Ikan Besar' ; 

        $data['page_name_detail'] = 'Form 5 Ringkasan Ikan Besar' ; 

        $data['record'] = $this->Model_sampling->general_select("tps_ringkasan_ikanbesar", array('namafile' => $namafile), "", "");


        $data['page_name1'] = 'Ikan Besar' ; 

        $data['page_name_detail1'] = 'Form 5 Ikan Besar' ; 

        $data['table1'] = 'Detail Ikan Besar'; 

        $data['button_add']= '<div><center> <button type="button" class="btn btn-success a-btn-slide-text"  data-toggle="modal" data-target="#myModalTable1" id="AddDataTable1Btn">   <span class="fa fa-plus-square" aria-hidden="true"></span> Add New</button> </center></div>'  ;

        $data['url_load_table']=base_url()."sampling/mainpage/view_detail_ikan_besar/".$namafile;

        $data['url_show_table']=base_url()."sampling/mainpage/view_update_detail_ikan_besar/";

        $data['url_add_table1']=base_url()."sampling/mainpage/add_detail_ikan_besar";

        $data['url_update_table1']=base_url()."sampling/mainpage/update_detail_ikan_besar";

        $data['url_delete_table1']=base_url()."sampling/mainpage/delete_detail_ikan_besar";


        $data['content']="sampling/form5/list";

        $this->load->view('template-admin/template',$data);


    }

    public function form5_add($namafile){

        $data['namafile'] = $namafile; 

        $data['page_name'] = 'Ringkasan' ; 

        $data['page_name'] = 'Ringkasan Ikan Besar' ; 

        $data['page_name_detail'] = 'Form 5 Ringkasan Ikan Besar' ; 

        $data['trip_info'] = $this->Model_sampling->general_select("tps_pendaratan", array('namafile' => $namafile), "", "")->row_array();


        if (isset($_POST['submit'])){


            $this->form_validation->set_rules('namafile', 'namafile required', 'required');

            $this->form_validation->set_rules('kode', 'kode required', 'required');

            $this->form_validation->set_rules('berat', 'berat required', 'required');

            if( $this->form_validation->run() == TRUE  ) {

                $this->Model_sampling->form5_add($this->input->post());

                redirect('sampling/mainpage/form5/'.$namafile);


              }else{

                $data['post'] = $_POST;
        
               
                $data['content']="sampling/form5/add";

                $this->load->view('template-admin/template',$data);


              }


        }else{

        
            
            $data['content']="sampling/form5/add";

            $this->load->view('template-admin/template',$data);

    

        }

    }


    public function form5_update($namafile,$kode_species){

        $data['namafile'] = $namafile; 

        $data['kode_species'] = $kode_species ; 

        $data['page_name'] = 'Ringkasan' ; 

        $data['page_name_detail'] = 'Update Ringkasan Besar' ; 

        $data['trip_info'] = $this->Model_sampling->general_select("tps_pendaratan", array('namafile' => $namafile), "", "")->row_array();

        $data['post'] = $this->Model_sampling->general_select("tps_ringkasan_ikanbesar", array('namafile' => $namafile , 'kode' => $kode_species) , "", "")->row_array();



        if (isset($_POST['submit'])){


            $this->form_validation->set_rules('namafile', 'namafile required', 'required');

            $this->form_validation->set_rules('kode', 'kode required', 'required');

            $this->form_validation->set_rules('berat', 'berat required', 'required');

            if( $this->form_validation->run() == TRUE  ) {

                $this->Model_sampling->form5_update($this->input->post());

                redirect('sampling/mainpage/form5/'.$namafile);


              }else{

        
                $data['post'] = $_POST;

                $data['content']="sampling/form5/update";

                $this->load->view('template-admin/template',$data);


              }


        }else{

            $data['content']="sampling/form5/update";

            $this->load->view('template-admin/template',$data);

        }

    }


    public function form5_delete($namafile , $k_species){


        $this->Model_sampling->form5_delete($namafile , $k_species);

        redirect('sampling/mainpage/form5/'.$namafile);

    }



    public function view_detail_ikan_besar($namafile ){

        $query = $this->Model_sampling->general_select("tps_ikanbesar", array('namafile' => $namafile ) , "", ""); 

        $result = array();

        $no = 0;
        
        foreach($query->result() as $row){
            $no++;

            $namafile_remove_xlsx = str_replace(".", "-", $row->namafile); 


                  $action1 = '<a type="button" data-toggle="modal" data-target="#editTable1Modal" onclick="editData(\'' .$namafile_remove_xlsx.'\' , '.$row->no_ikan.')" class="btn btn-primary a-btn-slide-text">
                                    <span class="fa fa-plug" aria-hidden="true"></span>
                                    <span><strong>Edit</strong></span>            
                                </a>
                                ' ; 
                 $action2 = ' <a type="button" data-toggle="modal" data-target="#disableTable1Modal" onclick="disableData(\'' .$namafile_remove_xlsx.'\'  , '.$row->no_ikan.')" class="btn btn-danger a-btn-slide-text">
                                   <span class="fa fa-times" aria-hidden="true"></span>
                                    <span><strong>Delete</strong></span>            
                                </a>' ;
           

                $result['data'][]=array(
                        $no,
                        $row->k_species, 
                        $row->berat, 
                        $row->panjang , 
                        $row->kode_panjang,
                        $row->loin1_berat , 
                        $row->loin1_panjang ,
                        $row->insang,
                        $row->isi_perut,
                        $row->daging_perut,
                        $action1, 
                        $action2
                
                
                ); 

        }


         echo json_encode($result);



    }


    public function add_detail_ikan_besar(){

               //form validation 
        $this->form_validation->set_rules('namafile', 'namafile', 'required');
   

        
        if ( $this->form_validation->run()  ) {


            //Insert to Database 

            $data = $this->input->post() ; 

        
                //Insert to Database 
                 $saved = $this->Model_sampling->add_detail_ikan_besar($data);

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
            $messages = 'Trouble adding Data! Pastikan Kode species terisi';
            
        }

            $validator['success'] = $success;
            $validator['messages'] = $messages;
        

        echo json_encode($validator);


    }



      public function view_update_detail_ikan_besar(){



        $response = array();

        $namafile =  $_POST['namafile'];

        $no_ikan =  $_POST['no_ikan'];

        $namafile_remove_xlsx = str_replace("-", ".", $namafile); 

        $results = $this->Model_sampling->general_select("tps_ikanbesar", array('namafile' => $namafile_remove_xlsx , 'no_ikan' => $no_ikan ) , "", ""); 


        $response = array(

                'success' => true, 

                'messages' => $results->result_array()
            ); 

        echo json_encode($response);


    }

    public function update_detail_ikan_besar(){

        $this->form_validation->set_rules('edit_namafile', 'edit_namafile ', 'required');
        $this->form_validation->set_rules('edit_no_ikan', 'edit_no_ikan ', 'required');
    
    

        
        if ( $this->form_validation->run()  ) {

            $data = $this->input->post() ; 

            $saved = $this->Model_sampling->update_detail_ikan_besar($data);

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
            $messages = 'Trouble adding Data! Pastikan data terisi!';
            
        }

            $validator['success'] = $success;
            $validator['messages'] = $messages;
        

        echo json_encode($validator);



    }


    public function delete_detail_ikan_besar(){


        $response = array();

        $namafile =   $_POST['namafile'];

        $no_ikan = $_POST['no_ikan'];

        $namafile_remove_xlsx = str_replace("-", ".", $namafile); 

        $saved = $this->Model_sampling->delete_detail_ikan_besar($namafile_remove_xlsx , $no_ikan);

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



    ############### End Form 5 ###########################




    ############### Form 6 ###########################

    public function form6_update($namafile){


        $namafile;

        $data['page_name'] = 'Deskripsi' ; 

        $data['page_name_detail'] = 'Update Deskripsi' ; 

        $data['namafile'] = $namafile ; 

        $data['post'] = $this->Model_sampling->general_select("tps_pendaratan", array('namafile' => $namafile), "", "")->row_array();; 

        if (isset($_POST['submit'])){


            $this->form_validation->set_rules('namafile', 'namafile required', 'required');

            if( $this->form_validation->run() == TRUE  ) {

                $this->Model_sampling->update_form6($this->input->post());

                redirect('sampling/mainpage/form6_update/'.$namafile);


              }else{

                $data['post'] = $_POST;

                $data['content']="sampling/form6/update";

                $this->load->view('template-admin/template',$data);

              }


        }else{

        
              

                $data['content']="sampling/form6/update";

                $this->load->view('template-admin/template',$data);
    

        }
        



    }

    ############### End Form 6 ###########################


    ############### Form 7 ###########################


    public function form7_update($namafile){


        $namafile;

        $data['page_name'] = 'ETP' ; 

        $data['page_name_detail'] = 'Update ETP' ; 

        $data['namafile'] = $namafile ; 

        $data['post'] = $this->Model_sampling->general_select("tps_pendaratan", array('namafile' => $namafile), "", "")->row_array();

        $data['page_name1'] = 'Form ETP' ; 

        $data['page_name_detail1'] = 'Form ETP Detail' ; 

        $data['table1'] = 'Detail ETP'; 


        $data['button_add']= '<div><center> <button type="button" class="btn btn-success a-btn-slide-text"  data-toggle="modal" data-target="#myModalTable1" id="AddDataTable1Btn">   <span class="fa fa-plus-square" aria-hidden="true"></span> Add New</button> </center></div>'  ;

        $data['url_load_table']=base_url()."sampling/mainpage/view_detail_etp/".$namafile;

        $data['url_show_table']=base_url()."sampling/mainpage/view_update_detail_etp/";

        $data['url_add_table1']=base_url()."sampling/mainpage/add_detail_etp";

        $data['url_update_table1']=base_url()."sampling/mainpage/update_detail_etp";

        $data['url_delete_table1']=base_url()."sampling/mainpage/delete_detail_etp";



        if (isset($_POST['submit'])){

            $this->form_validation->set_rules('namafile', 'namafile required', 'required');

            if( $this->form_validation->run() == TRUE  ) {

                $this->Model_sampling->update_form7($this->input->post());

                redirect('sampling/mainpage/form7_update/'.$namafile);


              }else{

                $data['post'] = $_POST;

                $data['content']="sampling/form7/update";

                $this->load->view('template-admin/template',$data);

              }


        }else{

 
                $data['content']="sampling/form7/update";

                $this->load->view('template-admin/template',$data);
    

        }
        



    }


     public function view_detail_etp($namafile ){

        $query = $this->Model_sampling->general_select("tps_etp", array('namafile' => $namafile ) , "", ""); 

        $result = array();

        $no = 0;
        
        foreach($query->result() as $row){

            $no++;

            $namafile_remove_xlsx = str_replace(".", "-", $row->namafile); 


                  $action1 = '<a type="button" data-toggle="modal" data-target="#editTable1Modal" onclick="editData(\'' .$namafile_remove_xlsx.'\' , '.$row->urut.')" class="btn btn-primary a-btn-slide-text">
                                    <span class="fa fa-plug" aria-hidden="true"></span>
                                    <span><strong>Update</strong></span>            
                                </a>
                                ' ; 
                 $action2 = ' <a type="button" data-toggle="modal" data-target="#disableTable1Modal" onclick="disableData(\'' .$namafile_remove_xlsx.'\'  , '.$row->urut.')" class="btn btn-danger a-btn-slide-text">
                                   <span class="fa fa-times" aria-hidden="true"></span>
                                    <span><strong>Delete</strong></span>            
                                </a>' ;
           

         

                $result['data'][]=array(
                        $no,
                        $row->urut, 
                        $row->k_species, 
                        $row->jml_interaksi , 
                        $row->jml_didaratkan , 
                        $row->est_interaksi,
                        $row->est_didaratkan,
                        $action1, 
                        $action2
                
                
                ); 

        }


         echo json_encode($result);



    }


    public function view_update_detail_etp(){

        $response = array();

        $namafile =  $_POST['namafile'];

        $urut =  $_POST['urut'];

        $namafile_remove_xlsx = str_replace("-", ".", $namafile); 

        $results = $this->Model_sampling->general_select("tps_etp", array('namafile' => $namafile_remove_xlsx , 'urut' => $urut ) , "", ""); 


        $response = array(

                'success' => true, 

                'messages' => $results->result_array()
            ); 

        echo json_encode($response);


    }


    public function add_detail_etp(){

               //form validation 
        $this->form_validation->set_rules('namafile', 'namafile', 'required');
   

        
        if ( $this->form_validation->run()  ) {


            //Insert to Database 

            $data = $this->input->post() ; 

        
                //Insert to Database 
                 $saved = $this->Model_sampling->add_detail_etp($data);

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
            $messages = 'Trouble adding Data! Pastikan Kode species terisi';
            
        }

            $validator['success'] = $success;
            $validator['messages'] = $messages;
        

        echo json_encode($validator);



    }


     public function update_detail_etp(){

        $this->form_validation->set_rules('edit_namafile', 'edit_namafile ', 'required');
        $this->form_validation->set_rules('edit_urut', 'edit_urut ', 'required');    

        
        if ( $this->form_validation->run()  ) {

            $data = $this->input->post() ; 

            $saved = $this->Model_sampling->update_detail_etp($data);

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
            $messages = 'Trouble adding Data! Pastikan data terisi!';
            
        }

            $validator['success'] = $success;
            $validator['messages'] = $messages;
        

        echo json_encode($validator);



    }

    public function delete_detail_etp(){


        $response = array();

        $namafile =  $_POST['namafile'];

        $urut =  $_POST['urut'];

        $namafile_remove_xlsx = str_replace("-", ".", $namafile); 

        $saved = $this->Model_sampling->delete_detail_etp($namafile_remove_xlsx , $urut);

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




     ############### End Form 7 ###########################

}