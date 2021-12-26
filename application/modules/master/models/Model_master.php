<?php

class Model_master extends CI_Model{

	function __construct(){

		parent::__construct();

			date_default_timezone_set('Asia/Jakarta');
		
	}


	function get_all_supplier_active(){

		$addition="";

		$user = $this->auth->get_data_session();

   		if(count($user->list_supp) > 0){

   			$addition .=" and id_supplier in (   " ;  

   				foreach($user->list_supp as $list){

   					$addition .="'".$list."' , ";

   				}
   				$addition = substr($addition , '0' , '-2') ; 

   			$addition .=" ) "; 	

   		} 
   		
		$query = $this->db->query("Select * from master_supplier where status = '1' ".$addition." order by id_supplier");
		
		return $query;

	}

	public function countryLists(){

		$query = $this->db->query("Select * from static_country order by country_name");

		return $query;
	}

	public function provinceLists(){

		$query = $this->db->query("Select * from static_provinces order by name");

		return $query;

	}

	public function load_regencies($id){

		$query = $this->db->query("Select * from static_regencies where province_id = '".$id."' order by name");

		return $query;

	}


	public function load_districts($id){

		$query = $this->db->query("Select * from static_districts where regency_id = '".$id."' order by name");

		return $query;

	}

	public function load_villages($id){
		$query = $this->db->query("Select * from static_villages where district_id = '".$id."' order by name");

		return $query;

	}

	public function checkCodeSupplier($kode_name){
		$query = $this->db->query("Select kode_name from master_supplier where kode_name = '".$kode_name."' ");

		return $query->num_rows();

	}


	public function add_supplier($data=array()){

		if ($data)
        {

        	$this->db->select_max('id_supplier');
        	$query  = $this->db->get('master_supplier');
        	$maxId = $query->row_array(); 
        	$id_supplier = $maxId["id_supplier"] + 1;
        	$user = $this->auth->get_data_session();
        	$id_user = $user->id_user;
        	$created_date = date('Y-m-d h:i:s');


        $sql = "
        	INSERT INTO master_supplier(
            id_supplier, kode_name, nama_perusahaan, tipe_perusahaan, lokasi, address, 
            country, province, regencies, district, village, status , 
            created_by , created_date , kode_ap2hi
             )
   			 VALUES (
   			'".$id_supplier."', ".$this->db->escape(strtoupper($data['kode_name'])).", ".$this->db->escape($data['nama_perusahaan']).", ".$this->db->escape($data['tipe_perusahaan']).",  ".$this->db->escape($data['lokasi'])." ,  ".$this->db->escape($data['address'])." , 
   			 ".$this->db->escape($data['country'] ? : "").", ".$this->db->escape($data['province'] ? : "").", ".$this->db->escape($data['regencies'] ? : "" )." , ".$this->db->escape($data['district'] ? : "")." , ".$this->db->escape($data['village'] ? : "" )." , '1' , 
   			 '".$id_user."' , '".$created_date."' , ".$this->db->escape($data['kode_ap2hi'])."
            )
				"; 

			$this->db->query($sql);
			
			return  $maxId["id_supplier"] + 1 ;
        }

		return FALSE;
	}


	public function edit_supplier($data=array()){

		if ($data)
        {


        	$user = $this->auth->get_data_session();
        	$id_user = $user->id_user;
        	$changed_date = date('Y-m-d h:i:s');
        	$id_supplier = $data['edit_id_supplier'];

        	$sql = "UPDATE master_supplier
					   SET kode_name= ".$this->db->escape(strtoupper($data['edit_kode_name']))." , nama_perusahaan=".$this->db->escape($data['edit_nama_perusahaan']).", tipe_perusahaan=".$this->db->escape($data['edit_tipe_perusahaan']).", 
					       lokasi=".$this->db->escape($data['edit_lokasi']).", address = ".$this->db->escape($data['edit_address'])." , 
					       country=".$this->db->escape($data['edit_country'] ? : "").", province=".$this->db->escape($data['edit_province'] ? : "").", regencies=".$this->db->escape($data['edit_regencies'] ? : "").", district=".$this->db->escape($data['edit_district'] ? : "").", village=".$this->db->escape($data['edit_village'] ? : "").", 
					        changed_by='".$id_user."', changed_date='".$changed_date."' , kode_ap2hi = ".$this->db->escape($data['edit_kode_ap2hi'])."
					 WHERE id_supplier = '".$id_supplier."'"; 

			$this->db->query($sql);


			return TRUE;
        }

        return FALSE;
	}


	public function disable_supplier($id_supplier){

		if($id_supplier){

			$user = $this->auth->get_data_session();
        	$id_user = $user->id_user;
        	$changed_date = date('Y-m-d h:i:s');

			$sql = "UPDATE master_supplier
					   SET status = '0' , 
					     changed_by='".$id_user."', changed_date='".$changed_date."'
					 WHERE id_supplier = '".$id_supplier."'"; 

			$this->db->query($sql);


			return TRUE;

		}

		return FALSE;

	}

	public function showEditSupplier($id){

		$query = $this->db->query("Select * from master_supplier where id_supplier = '".$id."'");

		return $query;
	}


	public function get_all_vessel_active(){


		$addition="";

		$user = $this->auth->get_data_session();

   		if(count($user->list_supp) > 0){

   			$addition .=" and id_supplier in (   " ;  

   				foreach($user->list_supp as $list){

   					$addition .="'".$list."' , ";

   				}
   				$addition = substr($addition , '0' , '-2') ; 

   			$addition .=" ) "; 	

   		} 

		
		$query = $this->db->query("Select * from master_vessel where status = 'active' ".$addition." order by id_vessel");
		
		return $query;

	}


	public function get_all_vessel_active_qr(){


		$addition="";

		$user = $this->auth->get_data_session();

   		if(count($user->list_supp) > 0){

   			$addition .=" and id_supplier in (   " ;  

   				foreach($user->list_supp as $list){

   					$addition .="'".$list."' , ";

   				}
   				$addition = substr($addition , '0' , '-2') ; 

   			$addition .=" ) "; 	

   		} 

		
		$query = $this->db->query("Select no_ap2hi , nama_kapal from master_vessel where status = 'active' ".$addition." order by id_vessel");
		
		return $query;

	}

	public function get_all_vessel_active_limit($limit){


		$addition="";

		$user = $this->auth->get_data_session();

   		if(count($user->list_supp) > 0){

   			$addition .=" and id_supplier in (   " ;  

   				foreach($user->list_supp as $list){

   					$addition .="'".$list."' , ";

   				}
   				$addition = substr($addition , '0' , '-2') ; 

   			$addition .=" ) "; 	

   		} 

		
		$query = $this->db->query("Select * from master_vessel where status = 'active' ".$addition." order by id_vessel LIMIT ".$limit." ");
		
		return $query;

	}


	public function get_all_vessel_where($where , $value){

		$query = $this->db->query("Select * from master_vessel where status = 'active' and  $where = '".$value."' order by id_vessel");
		
		return $query;

	}

	public function get_all_vessel_download(){

		$query = $this->db->query("SELECT nama_perusahaan , urut, nama_kapal, nama_pemilik, no_ap2hi_manual, 
								       no_siup, no_seafdec, no_issf, no_kkp, no_dkp, no_vic, no_nik, 
								       nama_kapal_2tahun, status_kapal, jenis_kapal, jenis_alat, ukuran, 
								       loa, bahan, jenis_mesin_utama, kapasitas_mesin_utama, kapasitas_palka_ikan, 
								       kapasitas_palka_umpan, vms, lainnya, irc, jumlah_pancing, jumlah_abk, 
								       nama_kapten, no_sipi, masa_berlaku_sipi, rfmo, tahun_pembuatan_kapal, 
								       bendera, bendera_2th, pelabuhan_pangkalan, muat_singgah, copy_surat_ijin, 
								       shark_policy, terdaftar_iuu, kode_etik_pelayaran, no_imo, lokasi_pembuatan
								  		FROM master_vessel , master_supplier where master_vessel.status = 'active' 
								 			and master_supplier.id_supplier = master_vessel.id_supplier
								   			order by master_vessel.id_supplier , urut   ") ; 


		return $query;

	}

	public function checkExisting($table , $checks){
		$where_ = ""; 

		foreach($checks as $key=>$value){

			$where_ .= " AND ".$key." = '".$value."' ";

		}

		$where_ = ($where_ != ""?"(".substr($where_, 4).")":"(1=1)");

		$query = $this->db->query("Select * from ".$table." WHERE (1=1)
            AND ".$where_ );
		
		return $query->num_rows();


	}


	public function add_vessel($data=array()){

		if ($data)
        {

        	$this->db->select_max('id_vessel');
        	$query  = $this->db->get('master_vessel');
        	$maxId = $query->row_array(); 
        	$id_vessel = $maxId["id_vessel"] + 1;
        	$user = $this->auth->get_data_session();
        	$id_user = $user->id_user;
        	$created_date = date('Y-m-d h:i:s');

        	//select max urut where id supplier =  
        	$supplierDatas  =  $this->showEditSupplier($data['id_supplier']);
            $supplierData   = $supplierDatas->row();
            $maxUrut = $this->db->query("Select max(urut) as urut from master_vessel where id_supplier = '".$data['id_supplier']."'")->row();
            $numbering      = sprintf("%04s", $maxUrut->urut + 1 );       
        	$no_ap2hi = $numbering.".".$supplierData->kode_name.".AP2HI";

         $sql = "
        	INSERT INTO master_vessel(
            id_vessel, id_supplier, urut, nama_kapal, nama_pemilik, no_ap2hi, 
            no_siup, no_seafdec, no_issf, no_kkp, no_dkp, no_vic, no_nik, 
            nama_kapal_2tahun, status_kapal, jenis_kapal, jenis_alat, ukuran, 
            loa, bahan, jenis_mesin_utama, kapasitas_mesin_utama, kapasitas_palka_ikan, 
            kapasitas_palka_umpan, vms, lainnya, irc, jumlah_pancing, jumlah_abk, 
            nama_kapten, no_sipi, masa_berlaku_sipi, rfmo, tahun_pembuatan_kapal, 
            bendera, bendera_2th, pelabuhan_pangkalan, muat_singgah, copy_surat_ijin, 
            shark_policy, terdaftar_iuu, kode_etik_pelayaran, no_imo, lokasi_pembuatan, 
            status, created_by, created_date , no_ap2hi_manual)
    VALUES (".$this->db->escape($id_vessel)."  , 
    		".$this->db->escape($data['id_supplier'])." ,
    		".$this->db->escape($numbering)." , 
    		".$this->db->escape(strtoupper($data['nama_kapal'])).", 
    		".$this->db->escape($data['nama_pemilik'])."  , 
    		".$this->db->escape($no_ap2hi)." , 
            ".$this->db->escape($data['no_siup'])."  ,
            ".$this->db->escape($data['no_seafdec'])."  ,
            ".$this->db->escape($data['no_issf'])."   , 
            ".$this->db->escape($data['no_kkp'])."   , 
            ".$this->db->escape($data['no_dkp'])."   , 
            ".$this->db->escape($data['no_vic'])."   , 
            ".$this->db->escape($data['no_nik'])." , 
            ".$this->db->escape($data['nama_kapal_2tahun'])." ,
            ".$this->db->escape($data['status_kapal'])." , 
            ".$this->db->escape($data['jenis_kapal'])." ,
            ".$this->db->escape($data['jenis_alat'])."  ,
            ".$this->db->escape($data['ukuran'])."   , 
            ".$this->db->escape($data['loa'])." ,
            ".$this->db->escape($data['bahan'])." ,
            ".$this->db->escape($data['jenis_mesin_utama'])." ,
            ".$this->db->escape($data['kapasitas_mesin_utama'])." , 
            ".$this->db->escape($data['kapasitas_palka_ikan'])." , 
            ".$this->db->escape($data['kapasitas_palka_umpan'])." , 
            ".$this->db->escape($data['vms'])." ,
            ".$this->db->escape($data['lainnya'])." ,
            ".$this->db->escape($data['irc'])." ,
            ".$this->db->escape($data['jumlah_pancing'])." ,
            ".$this->db->escape($data['jumlah_abk'])." , 
            ".$this->db->escape($data['nama_kapten'])." ,
            ".$this->db->escape($data['no_sipi'])."  , 
            ".$this->db->escape($data['masa_berlaku_sipi'])."  ,
            ".$this->db->escape($data['rfmo'])."   ,
            ".$this->db->escape($data['tahun_pembuatan_kapal'])."    , 
            ".$this->db->escape($data['bendera'])." , 
            ".$this->db->escape($data['bendera_2th'])." , 
            ".$this->db->escape($data['pelabuhan_pangkalan'])." ,
            ".$this->db->escape($data['muat_singgah'])."  ,
            ".$this->db->escape($data['copy_surat_ijin'])."   , 
            ".$this->db->escape($data['shark_policy'])." , 
            ".$this->db->escape($data['terdaftar_iuu'])." , 
            ".$this->db->escape($data['kode_etik_pelayaran'])." ,
            ".$this->db->escape($data['no_imo'])."  , 
            ".$this->db->escape($data['lokasi_pembuatan'])."  , 
            ".$this->db->escape('active')." , 
            ".$this->db->escape($id_user)." , 
            ".$this->db->escape($created_date)." , 
            ".$this->db->escape($data['no_ap2hi_manual'])." 
             );

				"; 

			$this->db->query($sql) ;

			/* create individual QR  */
			$this->load->library('ciqrcode');
			
			$data_qr = base_url().'master/mainpage/vessel_detail/'.$id_vessel; 

			$img_no_ap2hi = str_replace(".", "_", $no_ap2hi ); 

			$qr['data'] = $data_qr ;
	        $qr['level'] = 'H';
	        $qr['size'] = 10;
	        $qr['savename'] = FCPATH.'uploads/qr/'.$img_no_ap2hi.'.png';
	        $this->ciqrcode->generate($qr);

			return TRUE;
        }

		return FALSE;
	}



	public function insertUploadVessels($data = array()){

		if ($data)
        {

        	 $sql = "
		        	INSERT INTO master_vessel(
		            id_vessel, id_supplier, urut, nama_kapal, nama_pemilik, no_ap2hi, 
		            no_siup, no_seafdec, no_issf, no_kkp, no_dkp, no_vic, no_nik, 
		            nama_kapal_2tahun, status_kapal, jenis_kapal, jenis_alat, ukuran, 
		            loa, bahan, jenis_mesin_utama, kapasitas_mesin_utama, kapasitas_palka_ikan, 
		            kapasitas_palka_umpan, vms, lainnya, irc, jumlah_pancing, jumlah_abk, 
		            nama_kapten, no_sipi, masa_berlaku_sipi, rfmo, tahun_pembuatan_kapal, 
		            bendera, bendera_2th, pelabuhan_pangkalan, muat_singgah, copy_surat_ijin, 
		            shark_policy, terdaftar_iuu, kode_etik_pelayaran, no_imo, lokasi_pembuatan, 
		            status, created_by, created_date , using_excell , namafile , upload_date , no_ap2hi_manual)
		    VALUES (".$this->db->escape($data['id_vessel'])."  , 
		    		".$this->db->escape($data['id_supplier'])." ,
		    		".$this->db->escape($data['urut'])." , 
		    		".$this->db->escape(strtoupper($data['nama_kapal'])).", 
		    		".$this->db->escape($data['nama_pemilik'])."  , 
		    		".$this->db->escape($data['no_ap2hi'])." , 
		            ".$this->db->escape($data['no_siup'])."  ,
		            ".$this->db->escape($data['no_seafdec'])."  ,
		            ".$this->db->escape($data['no_issf'])."   , 
		            ".$this->db->escape($data['no_kkp'])."   , 
		            ".$this->db->escape($data['no_dkp'])."   , 
		            ".$this->db->escape($data['no_vic'])."   , 
		            ".$this->db->escape($data['no_nik'])." , 
		            ".$this->db->escape($data['nama_kapal_2tahun'])." ,
		            ".$this->db->escape($data['status_kapal'])." , 
		            ".$this->db->escape($data['jenis_kapal'])." ,
		            ".$this->db->escape($data['jenis_alat'])."  ,
		            ".$this->db->escape($data['ukuran'])."   , 
		            ".$this->db->escape($data['loa'])." ,
		            ".$this->db->escape($data['bahan'])." ,
		            ".$this->db->escape($data['jenis_mesin_utama'])." ,
		            ".$this->db->escape($data['kapasitas_mesin_utama'])." , 
		            ".$this->db->escape($data['kapasitas_palka_ikan'])." , 
		            ".$this->db->escape($data['kapasitas_palka_umpan'])." , 
		            ".$this->db->escape($data['vms'])." ,
		            ".$this->db->escape($data['lainnya'])." ,
		            ".$this->db->escape($data['irc'])." ,
		            ".$this->db->escape($data['jumlah_pancing'])." ,
		            ".$this->db->escape($data['jumlah_abk'])." , 
		            ".$this->db->escape($data['nama_kapten'])." ,
		            ".$this->db->escape($data['no_sipi'])."  , 
		            ".$this->db->escape($data['masa_berlaku_sipi'])."  ,
		            ".$this->db->escape($data['rfmo'])."   ,
		            ".$this->db->escape($data['tahun_pembuatan_kapal'])."    , 
		            ".$this->db->escape($data['bendera'])." , 
		            ".$this->db->escape($data['bendera_2th'])." , 
		            ".$this->db->escape($data['pelabuhan_pangkalan'])." ,
		            ".$this->db->escape($data['muat_singgah'])."  ,
		            ".$this->db->escape($data['copy_surat_ijin'])."   , 
		            ".$this->db->escape($data['shark_policy'])." , 
		            ".$this->db->escape($data['terdaftar_iuu'])." , 
		            ".$this->db->escape($data['kode_etik_pelayaran'])." ,
		            ".$this->db->escape($data['no_imo'])."  , 
		            ".$this->db->escape($data['lokasi_pembuatan'])."  , 
		            ".$this->db->escape($data['status'])." , 
		            ".$this->db->escape($data['created_by'])." , 
		            ".$this->db->escape($data['created_date'])." , 
		            ".$this->db->escape($data['using_excell'])." ,
		            ".$this->db->escape($data['namafile'])." , 
		            ".$this->db->escape($data['created_date'])." , 
		            ".$this->db->escape($data['no_ap2hi_manual'])."
		              );

						"; 

					/* create individual QR  */
			$this->load->library('ciqrcode');

			$urut = +$data['urut']; 
			
			$data_qr = base_url().'master/mainpage/vessel_detail/'.$data['id_vessel']; 

			$img_no_ap2hi = str_replace(".", "_", $data['no_ap2hi'] ); 

			$qr['data'] = $data_qr ;
	        $qr['level'] = 'H';
	        $qr['size'] = 10;
	        $qr['savename'] = FCPATH.'uploads/qr/'.$img_no_ap2hi.'.png';
	        $this->ciqrcode->generate($qr);
					

					return $this->db->query($sql) ;
        }

	}



	public function showEditVessel($id){

		$query = $this->db->query("Select * from master_vessel where id_vessel = '".$id."' and status = 'active' ");

		return $query;
	}

	public function edit_vessel($data=array()){

		if ($data)
        {


        	$user = $this->auth->get_data_session();
        	$id_user = $user->id_user;
        	$changed_date = date('Y-m-d h:i:s');
        	$id_vessel = $data['edit_id_vessel'];

        	$sql = "UPDATE master_vessel
					   SET 
					    nama_kapal=".$this->db->escape(strtoupper($data['edit_nama_kapal'])).", 
					    nama_pemilik=".$this->db->escape($data['edit_nama_pemilik'])." ,  
					    no_siup=".$this->db->escape($data['edit_no_siup'])." , 
					    no_seafdec=".$this->db->escape($data['edit_no_seafdec']).",  
					    no_issf=".$this->db->escape($data['edit_no_issf'])." ,  
					    no_kkp=".$this->db->escape($data['edit_no_kkp'])." ,  
					    no_dkp=".$this->db->escape($data['edit_no_dkp'])." ,  
					    no_vic=".$this->db->escape($data['edit_no_vic'])." ,  
					    no_nik=".$this->db->escape($data['edit_no_nik'])." , 
					    nama_kapal_2tahun=".$this->db->escape($data['edit_nama_kapal_2tahun']).", 
					    status_kapal=".$this->db->escape($data['edit_status_kapal']).", 
					    jenis_kapal=".$this->db->escape($data['edit_jenis_kapal']).", 
					    jenis_alat=".$this->db->escape($data['edit_jenis_alat']).", 
					    ukuran=".$this->db->escape($data['edit_ukuran']).", 
					    loa=".$this->db->escape($data['edit_loa']).", 
					    bahan=".$this->db->escape($data['edit_bahan']).", 
					    jenis_mesin_utama=".$this->db->escape($data['edit_jenis_mesin_utama']).", 
					    kapasitas_mesin_utama=".$this->db->escape($data['edit_kapasitas_mesin_utama']).", 
					    kapasitas_palka_ikan=".$this->db->escape($data['edit_kapasitas_palka_ikan']).", 
					    kapasitas_palka_umpan=".$this->db->escape($data['edit_kapasitas_palka_umpan']).", 
					    vms=".$this->db->escape($data['edit_vms']).", 
					    lainnya=".$this->db->escape($data['edit_lainnya']).", 
					    irc=".$this->db->escape($data['edit_irc']).", 
					    jumlah_pancing=".$this->db->escape($data['edit_jumlah_pancing']).", 
					    jumlah_abk=".$this->db->escape($data['edit_jumlah_abk']).", 
					    nama_kapten=".$this->db->escape($data['edit_nama_kapten']).", 
					    no_sipi=".$this->db->escape($data['edit_no_sipi']).", 
					    masa_berlaku_sipi=".$this->db->escape($data['edit_masa_berlaku_sipi']).", 
					    rfmo=".$this->db->escape($data['edit_rfmo']).", 
					    tahun_pembuatan_kapal=".$this->db->escape($data['edit_tahun_pembuatan_kapal']).", 
					    bendera=".$this->db->escape($data['edit_bendera']).", 
					    bendera_2th=".$this->db->escape($data['edit_bendera_2th']).", 
					    pelabuhan_pangkalan=".$this->db->escape($data['edit_pelabuhan_pangkalan']).", 
					    muat_singgah=".$this->db->escape($data['edit_muat_singgah']).", 
					    copy_surat_ijin=".$this->db->escape($data['edit_copy_surat_ijin']).", 
					    shark_policy=".$this->db->escape($data['edit_shark_policy']).", 
					    terdaftar_iuu=".$this->db->escape($data['edit_terdaftar_iuu']).", 
					    kode_etik_pelayaran=".$this->db->escape($data['edit_kode_etik_pelayaran']).", 
					    no_imo=".$this->db->escape($data['edit_no_imo']).", 
					    lokasi_pembuatan=".$this->db->escape($data['edit_lokasi_pembuatan']).", 
					    changed_by=".$this->db->escape($id_user).", 
					    changed_date=".$this->db->escape($changed_date).", 
					    no_ap2hi_manual=".$this->db->escape($data['edit_no_ap2hi_manual'])."
					 WHERE id_vessel = '".$id_vessel."' ";

			$this->db->query($sql);


			return TRUE;
        }

        return FALSE;

    }


    public function disable_vessel($id_vessel) {

    	if($id_vessel){

			$user = $this->auth->get_data_session();
        	$id_user = $user->id_user;
        	$changed_date = date('Y-m-d h:i:s');

			$sql = "UPDATE master_vessel
					   SET status = 'deactivate' , 
					     changed_by='".$id_user."', changed_date='".$changed_date."'
					 WHERE id_vessel = '".$id_vessel."'"; 

			$this->db->query($sql);


			return TRUE;

		}

		return FALSE;

    }


		public function get_all_rumpon(){

			$query = $this->db->query("Select r.kode_upload , r.urut ,  r.id_supplier , s.nama_perusahaan ,  r.alamat , r.no_sipr , r.daerah_penangkapan , r.daerah_usaha , r.alat_tangkap ,r.posisi_rumpon , r.bahan from master_rumpon r , master_supplier s where r.id_supplier = s.id_supplier and r.status = '1' order by r.id_supplier , r.urut , r.kode_upload ");

			return $query;

		}

		public function add_rumpon($data=array()){

			if ($data)
        {

					//get max urutan where id_supplier in rumpon
						$maxUrut = $this->db->query("Select max(urut) as urut from master_rumpon where id_supplier = '".$data['id_supplier']."'")->row();

						$supplierDatas  =  $this->showEditSupplier($data['id_supplier']);
            $supplierData   = $supplierDatas->row();

						$urut = $maxUrut->urut + 1 ;
						$numbering      = sprintf("%04s", $urut );
						$kode_upload = $numbering.".".$supplierData->kode_name.".RUMPON";

						$user = $this->auth->get_data_session();
        		$id_user = $user->id_user;

						$created_date = date('Y-m-d h:i:s');

						 $sql = "
											 INSERT INTO master_rumpon(
												 kode_upload, urut, id_supplier, alamat, no_sipr, daerah_penangkapan,
	 											daerah_usaha, alat_tangkap, posisi_rumpon, bahan, status, created_by,
	 											created_date
												)
											VALUES (
											'".$kode_upload."', '".$urut."',  ".$this->db->escape(strtoupper($data['id_supplier']))." , ".$this->db->escape($data['alamat'])." ,  ".$this->db->escape($data['no_sipr'])." , ".$this->db->escape($data['daerah_penangkapan']).",
											 ".$this->db->escape($data['daerah_usaha']).", ".$this->db->escape($data['alat_tangkap']).", ".$this->db->escape($data['posisi_rumpon']).", ".$this->db->escape($data['bahan']).", '1', '".$id_user."',
											 '".$created_date."'
											);
																					" ;



						$this->db->query($sql);

						return  TRUE;
				}

				return FALSE;

		}


		public function showEditRumpon($urut , $id_supplier){

			$query = $this->db->query("Select * from master_rumpon where urut = '".$urut."' and id_supplier = '".$id_supplier."'");

			return $query;
		}


		public function edit_rumpon($data=array()){

			if ($data)
					{


						$user = $this->auth->get_data_session();
						$id_user = $user->id_user;
						$changed_date = date('Y-m-d h:i:s');
						$id_supplier = $data['edit_id_supplier'];
						$urut = $data['edit_urut'];

						$sql = "UPDATE master_rumpon
									   SET alamat=".$this->db->escape(strtoupper($data['edit_alamat'])).", no_sipr= ".$this->db->escape(strtoupper($data['edit_no_sipr'])).", daerah_penangkapan= ".$this->db->escape(strtoupper($data['edit_daerah_penangkapan'])).",
									       daerah_usaha=".$this->db->escape(strtoupper($data['edit_daerah_usaha'])).", alat_tangkap=".$this->db->escape(strtoupper($data['edit_alat_tangkap'])).", posisi_rumpon=".$this->db->escape(strtoupper($data['edit_posisi_rumpon'])).", bahan=".$this->db->escape(strtoupper($data['edit_bahan']))."	,
									       changed_by='".$id_user."', changed_date='".$changed_date."'

									 WHERE urut = '".$urut."' and id_supplier = '".$id_supplier."' ;
									" ;

									$this->db->query($sql);


				return TRUE;
					}

					return FALSE;

		}


		public function disable_rumpon($urut , $id_supplier ){

			if($id_supplier){

				$user = $this->auth->get_data_session();
						$id_user = $user->id_user;
						$changed_date = date('Y-m-d h:i:s');

				$sql = "UPDATE master_rumpon
							 SET status = '0' ,
								 changed_by='".$id_user."', changed_date='".$changed_date."'
						 WHERE id_supplier = '".$id_supplier."' and urut = '".$urut."' ";

				$this->db->query($sql);


				return TRUE;

			}

			return FALSE;

		}


		public function get_all_landing_active(){


			$query = $this->db->query("Select * from master_landing where status = '1' ");

			return $query;


		}


		public function add_landing($data=array()){


			if ($data)
        {

					//get max urutan where id_supplier in rumpon
						$maxUrut = $this->db->query("Select count(id_landing) as jumlah from master_landing where id_landing LIKE '".$data['regencies']."%'")->row();

						$urut = $maxUrut->jumlah + 1 ;
						$numbering      = sprintf("%02s", $urut );
						$id_landing = $data['regencies']."".$numbering ;


						 $sql = "
											 INSERT INTO master_landing(
								            id_landing, nama_landing, status
														)
											VALUES (
											'".$id_landing."',  ".$this->db->escape(strtoupper($data['nama_landing']))." , '1'
											);
																					" ;



						$this->db->query($sql);

						return  TRUE;
				}

				return FALSE;


		}

		public function  showEditLanding($id){

			$query = $this->db->query("Select * from master_landing where id_landing = '".$id."'");

			return $query;


		}


		public function edit_landing($data=array()){

			if ($data)
					{


						$id_landing = $data['edit_id_landing'];
						$sql = "UPDATE master_landing
							 SET nama_landing= ".$this->db->escape( $data['edit_nama_landing']  )."
											 WHERE id_landing = '".$id_landing."'";

				$this->db->query($sql);


				return TRUE;
					}

					return FALSE;

		}


		public function disable_landing($id){

			if($id){

				$sql = "UPDATE master_landing
						   SET status = '0'
						 WHERE id_landing = '".$id."'";

				$this->db->query($sql);


				return TRUE;

		}

	}
	
	
	public function confirm_vesssel($id , $status){

		if($id){

			$user = $this->auth->get_data_session();
        	$id_user = $user->id_user;
        	$changed_date = date('Y-m-d h:i:s');

        	if($status == 'Confirm'){
				$sql = "UPDATE master_vessel
							   SET confirm = 'Confirm' ,
							     changed_by='".$id_user."', changed_date='".$changed_date."'
							 WHERE id_vessel  = '".$id."'";
			}else {

				$sql = "UPDATE master_vessel
							   SET confirm = 'UnConfirm' ,
							     changed_by='".$id_user."', changed_date='".$changed_date."'
							 WHERE id_vessel  = '".$id."'";

			}
			$this->db->query($sql);



			return TRUE;

		}

		return FALSE;

	}


    public function load_vessel_from_id_supplier($id){

        $query = $this->db->query("Select id_vessel , nama_kapal from master_vessel where id_supplier = '".$id."' and status = 'active'");

        return $query;

    }


    function master_vessel_update($id){


        return $this->db->query("SELECT * FROM master_vessel where id_vessel='".$id."'");


   }









}

?>