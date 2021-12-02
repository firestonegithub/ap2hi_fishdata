<?php

class Model_data extends CI_Model{

	function __construct(){

		parent::__construct();

			date_default_timezone_set('Asia/Jakarta');
		
	}


	public function checkExisting($table , $checks , $data_show){
		$where_ = ""; 

		foreach($checks as $key=>$value){

			$where_ .= " AND ".$key." = '".$value."' ";

		}

		$where_ = ($where_ != ""?"(".substr($where_, 4).")":"(1=1)");

		$query = $this->db->query("Select * from ".$table." WHERE (1=1)
            AND ".$where_ );
		
		 if ($data_show=="row") {
            return $query->row();   
        }
        elseif ($data_show=="result"){
            return $query->result();   
        }else if($data_show=="numRows"){
        	return $query->num_rows(); 
        }else{
            return $query->result();   
        }


	}



	public function insertBoatUnload($data=array()){

		if ($data)
        {

				$sql = "INSERT INTO ap2hi_boat_unload(
			            kode_upload, kode_trip, id_supplier, id_vessel, nama_kapal, pelabuhan_pangkalan, 
			            tipe, tahun, bulan, tanggal_berangkat, tanggal_kembali, urut, 
			            total_tangkapan, yft, bet, skj, kaw, bycatch, loin_kotor, loin_bersih, 
			            jumlah_loin, lainnya, ikanhilang, etp, wpp_penangkapan, jenis_solar, 
			            jumlah_solar, es, uang_trip, catch_certificate, namafile, total_loin, 
			            pengguna, date_upload , rumpon)
			    VALUES (".$this->db->escape($data['kode_upload']).", ".$this->db->escape($data['kode_trip']).", ".$this->db->escape($data['id_supplier']).", ".$this->db->escape($data['id_vessel']).", ".$this->db->escape(strtoupper($data['nama_kapal'])).", ".$this->db->escape($data['pelabuhan_pangkalan']).", 
			            ".$this->db->escape($data['tipe'])." , ".$this->db->escape($data['tahun']).", ".$this->db->escape($data['bulan'])." , ".$this->db->escape($data['tanggal_berangkat'])." , ".$this->db->escape($data['tanggal_kembali'])." , ".$this->db->escape($data['urut'])." , 
			            ".$this->db->escape($data['total_tangkapan']).", ".$this->db->escape($data['yft']).",".$this->db->escape($data['bet'])." , ".$this->db->escape($data['skj']).", ".$this->db->escape($data['kaw'])." , ".$this->db->escape($data['bycatch'])." , ".$this->db->escape($data['loin_kotor'])." , ".$this->db->escape($data['loin_bersih'])." , 
			            ".$this->db->escape($data['jumlah_loin'])." , ".$this->db->escape($data['lainnya'])." , ".$this->db->escape($data['ikanhilang'])." , ".$this->db->escape($data['etp'])." , ".$this->db->escape($data['wpp_penangkapan'])." , ".$this->db->escape($data['jenis_solar'])." , 
			            ".$this->db->escape($data['jumlah_solar'])." , ".$this->db->escape($data['es'])." , ".$this->db->escape($data['uang_trip'])." , ".$this->db->escape($data['catch_certificate'])." , ".$this->db->escape($data['namafile'])." , ".$this->db->escape($data['total_loin'])." , 
			            ".$this->db->escape($data['pengguna'])." , ".$this->db->escape($data['date_upload'])." , ".$this->db->escape($data['rumpon'])."  )";
		
			
			$saved = $this->db->query($sql);



			if($saved){
				return TRUE;
			}
			

		}


		return FALSE; 
	}



	public function insertUnloadingUmpan($data=array()){
		if ($data)
        {


        	$sql = "INSERT INTO ap2hi_boat_umpan(
		            kode_trip, id_vessel, tanggal_berangkat, jenis, kondisi, jumlah_kg, 
		            jumlah_ekor, harga_beli, asal, daerah_penangkapan, jumlah_ember)
					    VALUES (".$this->db->escape($data['kode_trip'])." ,  ".$this->db->escape($data['id_vessel'])." , ".$this->db->escape($data['tanggal_berangkat'])." , ".$this->db->escape($data['jenis'])." , ".$this->db->escape($data['kondisi'])."  , ".$this->db->escape($data['jumlah_kg'])." , 
		            ".$this->db->escape($data['jumlah_ekor'])." , ".$this->db->escape($data['harga_beli'])."  , ".$this->db->escape($data['asal'])." , ".$this->db->escape($data['daerah_penangkapan'])." , ".$this->db->escape($data['jumlah_ember'])." )";

			
			$saved = $this->db->query($sql);



			if($saved){
				return TRUE;
			}
			
			

        }


        FALSE;

	}


	public function deleteUnloading($kodeUpload){


		if ($kodeUpload)
        {


        	$sql = "DELETE FROM ap2hi_boat_unload
					WHERE  kode_upload = '".$kodeUpload."'";

			
			$saved = $this->db->query($sql);



			if($saved){
				return TRUE;
			}
			
			

        }


        FALSE;


	}



	public function get_all_unloading($id_user , $year){

		$user = $this->auth->get_data_session();


		$addition1 = "";
		$addition2 = "";

		if($user->role_active != "Administrator"){
			//$addition1 .=" and pengguna = '".$id_user."' "; 
		}


		if(count($user->list_supp) > 0){

   			$addition2 .=" and id_supplier in (   " ;  

   				foreach($user->list_supp as $list){

   					$addition2 .="'".$list."' , ";

   				}
   				$addition2 = substr($addition2 , '0' , '-2') ; 

   			$addition2 .=" ) "; 	

   		} 

		$query = $this->db->query("

			
			SELECT *  FROM ap2hi_boat_unload where tahun = '".$year."' ".$addition1." ".$addition2." order by id_supplier , tahun , bulan , id_vessel , urut;


			");
		
		return $query;


	}



public function checkSamplingExsist($namafile){


		$query = $this->db->query("

			SELECT namafile  FROM tps_pendaratan where namafile = '".$namafile."';

			");

		return $query->num_rows();

	}



	public function insertTrip($data=array()){

		if ($data)
        {

				$sql = "INSERT INTO tps_pendaratan(
            namafile, k_landing, k_perusahaan, enumerator1, enumerator2, 
            nama_kapal, kapten_kapal, gt_kapal, panjang_kapal, mesin_kapal, 
            bahan_kapal, jum_awak, no_ap2hi, grid1, grid2, total_penangkapan, 
            est_ikanhilang, thn_sampling, bln_sampling, tgl_sampling, jam_sampling, 
            mnt_sampling, rumpon, teknik_cari_tuna, bbm, k_alattangkap, es, 
            pengguna, deskripsi, lama_satuan, lama_jam, lama_hari, hl_tipe_mata_pancing, 
            hl_troll, hl_alat_tangkap_lain, pl_jum_pancing, pl_kapasitas_ember, 
            jumlah_hari_memancing, using_ringkasan_ikanbesar, tgl_impor, 
            jam_impor, tipe, e_pewawancara, e_umur, e_lama_tahun, e_lama_bulan, 
            e_jabatan, e_keterangan, total_bycatch, total_real_kecil, total_sampling_kecil, 
            raising_factor, grid)
    VALUES ( ".$this->db->escape($data['namafile'])." , 
    		".$this->db->escape($data['k_landing'])." , ".$this->db->escape($data['k_perusahaan'])." , ".$this->db->escape($data['enumerator1'])." , ".$this->db->escape($data['enumerator2'])." , 
            ".$this->db->escape($data['nama_kapal'])." ,".$this->db->escape($data['kapten_kapal'])." , ".$this->db->escape($data['gt_kapal'])." , ".$this->db->escape($data['panjang_kapal'])." , ".$this->db->escape($data['mesin_kapal'])." , 
            ".$this->db->escape($data['bahan_kapal'])." , ".$this->db->escape($data['jum_awak'])."  , ".$this->db->escape($data['no_ap2hi'])." , ".$this->db->escape($data['grid1'])." , ".$this->db->escape($data['grid2'])." , ".$this->db->escape($data['total_penangkapan'])." , 
            ".$this->db->escape($data['est_ikanhilang'])." , ".$this->db->escape($data['thn_sampling'])." , ".$this->db->escape($data['bln_sampling'])." , ".$this->db->escape($data['tgl_sampling'])." , ".$this->db->escape($data['jam_sampling'])." , 
            ".$this->db->escape($data['mnt_sampling'])." , ".$this->db->escape($data['rumpon'])." , ".$this->db->escape($data['teknik_cari_tuna'])." , ".$this->db->escape($data['bbm'])." , ".$this->db->escape($data['k_alattangkap'])." , ".$this->db->escape($data['es'])." , 
            ".$this->db->escape($data['pengguna'])." , ".$this->db->escape($data['deskripsi'])." , ".$this->db->escape($data['lama_satuan'])." , ".$this->db->escape($data['lama_jam'])." , ".$this->db->escape($data['lama_hari'])." , ".$this->db->escape($data['hl_tipe_mata_pancing'])." , 
            ".$this->db->escape($data['hl_troll'])." , ".$this->db->escape($data['hl_alat_tangkap_lain'])." , ".$this->db->escape($data['pl_jum_pancing'])." , ".$this->db->escape($data['pl_kapasitas_ember'])." , 
            ".$this->db->escape($data['jumlah_hari_memancing'])." , ".$this->db->escape($data['using_ringkasan_ikanbesar'])." , ".$this->db->escape($data['tgl_impor'])." , 
            ".$this->db->escape($data['jam_impor'])." , ".$this->db->escape($data['tipe'])."  , ".$this->db->escape($data['e_pewawancara'])." , ".$this->db->escape($data['e_umur'])." , ".$this->db->escape($data['e_lama_tahun'])." , ".$this->db->escape($data['e_lama_bulan'])." , 
            ".$this->db->escape($data['e_jabatan'])." , ".$this->db->escape($data['e_keterangan'])." , ".$this->db->escape($data['total_bycatch'])." , ".$this->db->escape($data['total_real_kecil'])." , ".$this->db->escape($data['total_sampling_kecil'])." , 
            ".$this->db->escape($data['raising_factor'])." , ".$this->db->escape($data['grid'])." )";
		
			
			$saved = $this->db->query($sql);



			if($saved){
				return TRUE;
			}
			

		}


		return FALSE; 
	}


	public function insertTripNew($data=array()){

		if ($data)
        {

				$sql = "INSERT INTO tps_pendaratan(
            namafile, k_landing, k_perusahaan, enumerator1, enumerator2, 
            nama_kapal, kapten_kapal, gt_kapal, panjang_kapal, mesin_kapal, 
            bahan_kapal, jum_awak, no_ap2hi, grid1, grid2, total_penangkapan, 
            est_ikanhilang, thn_sampling, bln_sampling, tgl_sampling, jam_sampling, 
            mnt_sampling, rumpon, teknik_cari_tuna, bbm, k_alattangkap, es, 
            pengguna, deskripsi, lama_satuan, lama_jam, lama_hari, hl_tipe_mata_pancing, 
            hl_alat_tangkap_lain, pl_jum_pancing, pl_kapasitas_ember, 
            jumlah_hari_memancing, using_ringkasan_ikanbesar, tgl_impor, 
            jam_impor, tipe, e_pewawancara, e_umur, e_lama_tahun, e_lama_bulan, 
            e_jabatan, e_keterangan, total_bycatch, total_real_kecil, total_sampling_kecil, 
            raising_factor, grid , 
            no_sipi , jumlah_rumpon_singgah , tanggal_berangkat , tanggal_kembali, jumlah_pakura ,deskripsi_foto , ukuran_pancing, status_trip 
            )
    VALUES ( ".$this->db->escape($data['namafile'])." , 
    		".$this->db->escape($data['k_landing'])." , ".$this->db->escape($data['k_perusahaan'])." , ".$this->db->escape($data['enumerator1'])." , ".$this->db->escape($data['enumerator2'])." , 
            ".$this->db->escape($data['nama_kapal'])." ,".$this->db->escape($data['kapten_kapal'])." , ".$this->db->escape($data['gt_kapal'])." , ".$this->db->escape($data['panjang_kapal'])." , ".$this->db->escape($data['mesin_kapal'])." , 
            ".$this->db->escape($data['bahan_kapal'])." , ".$this->db->escape($data['jum_awak'])."  , ".$this->db->escape($data['no_ap2hi'])." , ".$this->db->escape($data['grid1'])." , ".$this->db->escape($data['grid2'])." , ".$this->db->escape($data['total_penangkapan'])." , 
            ".$this->db->escape($data['est_ikanhilang'])." , ".$this->db->escape($data['thn_sampling'])." , ".$this->db->escape($data['bln_sampling'])." , ".$this->db->escape($data['tgl_sampling'])." , ".$this->db->escape($data['jam_sampling'])." , 
            ".$this->db->escape($data['mnt_sampling'])." , ".$this->db->escape($data['rumpon'])." , ".$this->db->escape($data['teknik_cari_tuna'])." , ".$this->db->escape($data['bbm'])." , ".$this->db->escape($data['k_alattangkap'])." , ".$this->db->escape($data['es'])." , 
            ".$this->db->escape($data['pengguna'])." , ".$this->db->escape($data['deskripsi'])." , ".$this->db->escape($data['lama_satuan'])." , ".$this->db->escape($data['lama_jam'])." , ".$this->db->escape($data['lama_hari'])." , ".$this->db->escape($data['hl_tipe_mata_pancing'])." , 
            ".$this->db->escape($data['hl_alat_tangkap_lain'])." , ".$this->db->escape($data['pl_jum_pancing'])." , ".$this->db->escape($data['pl_kapasitas_ember'])." , ".$this->db->escape($data['jumlah_hari_memancing'])." , ".$this->db->escape($data['using_ringkasan_ikanbesar'])." , ".$this->db->escape($data['tgl_impor'])." , 
            ".$this->db->escape($data['jam_impor'])." , ".$this->db->escape($data['tipe'])."  , ".$this->db->escape($data['e_pewawancara'])." , ".$this->db->escape($data['e_umur'])." , ".$this->db->escape($data['e_lama_tahun'])." , ".$this->db->escape($data['e_lama_bulan'])." , 
            ".$this->db->escape($data['e_jabatan'])." , ".$this->db->escape($data['e_keterangan'])." , ".$this->db->escape($data['total_bycatch'])." , ".$this->db->escape($data['total_real_kecil'])." , ".$this->db->escape($data['total_sampling_kecil'])." , 
            ".$this->db->escape($data['raising_factor'])." , ".$this->db->escape($data['grid'])." ,  ".$this->db->escape($data['no_sipi'])." , ".$this->db->escape($data['jumlah_rumpon_singgah'])." , ".$this->db->escape($data['tanggal_berangkat'])." , ".$this->db->escape($data['tanggal_kembali'])." , ".$this->db->escape($data['jumlah_pakura'])." , ".$this->db->escape($data['deskripsi_foto'])." , ".$this->db->escape($data['ukuran_pancing']).", '2'  )";
		
			
			$saved = $this->db->query($sql);



			if($saved){
				return TRUE;
			}
			

		}


		return FALSE; 


	}

	public function insertKapalKecil($data=array()){

		if ($data)
        {

				$sql = "
					    INSERT INTO tps_kapalkecil(
					            namafile, no_urut, total_penangkapan, est_ikanhilang, lama, lama_satuan, 
					            bbm, mesin, nama)
					    VALUES (".$this->db->escape($data['namafile']).", ".$this->db->escape($data['no'])." , ".$this->db->escape($data['total_penangkapan'])." , ".$this->db->escape($data['est_ikanhilang'])." , ".$this->db->escape($data['lama'])." , ".$this->db->escape($data['lama_satuan'])." , 
					            ".$this->db->escape($data['bbm'])." , ".$this->db->escape($data['mesin'])." , ".$this->db->escape($data['nama'])."  ) ";
		
			
			$saved = $this->db->query($sql);

			if($saved){
				return TRUE;
			}
			

		}


		return FALSE; 


	}


	public function insertUmpan($data=array()){
		  
     if ($data)
        {

				$sql = "
					      INSERT INTO tps_umpan(
				            namafile, k_umpan, urut, species, rumpon1, rumpon2, total, estimasi, 
				            k_alattangkap, pl_pengadaan_umpan, pl_jum_ember, domestic_import)
				            VALUES
				            ( ".$this->db->escape($data['namafile'])." , ".$this->db->escape($data['k_umpan'])." , ".$this->db->escape($data['urut'])." , ".$this->db->escape($data['species'])." , ".$this->db->escape($data['rumpon1'])." , ".$this->db->escape($data['rumpon2'])." , ".$this->db->escape($data['total'])." , ".$this->db->escape($data['estimasi'])." , 
				            ".$this->db->escape($data['k_alattangkap'])." , ".$this->db->escape($data['pl_pengadaan_umpan'])." , ".$this->db->escape($data['pl_jum_ember'])." , ".$this->db->escape($data['domestic_import'])." ); ";
		
			
			$saved = $this->db->query($sql);

			if($saved){
				return TRUE;
			}
			

		}


		return FALSE; 



	}


		public function insertUmpan_v2($data=array()){
		  
     if ($data)
        {

				$sql = "
					      INSERT INTO tps_umpan(
				            namafile, k_umpan, urut, species, rumpon1, rumpon2, total, estimasi, 
				            k_alattangkap, pl_pengadaan_umpan, pl_jum_ember, domestic_import, hl_estimasi_ekor_umpan)
				            VALUES
				            ( ".$this->db->escape($data['namafile'])." , ".$this->db->escape($data['k_umpan'])." , ".$this->db->escape($data['urut'])." , ".$this->db->escape($data['species'])." , ".$this->db->escape($data['rumpon1'])." , ".$this->db->escape($data['rumpon2'])." , ".$this->db->escape($data['total'])." , ".$this->db->escape($data['estimasi'])." , 
				            ".$this->db->escape($data['k_alattangkap'])." , ".$this->db->escape($data['pl_pengadaan_umpan'])." , ".$this->db->escape($data['pl_jum_ember'])." , ".$this->db->escape($data['domestic_import'])." , ".$this->db->escape($data['hl_estimasi_ekor_umpan'])." ); ";
		
			
			$saved = $this->db->query($sql);

			if($saved){
				return TRUE;
			}
			

		}


		return FALSE; 



	}


	public function insertBycatch($data=array()){

		if ($data)
        {

				$sql = "
					      INSERT INTO tps_bycatch(
            					namafile, k_species, jumlah, berat, estimasi)
   							 VALUES (".$this->db->escape($data['namafile']).", ".$this->db->escape($data['k_species'])." , ".$this->db->escape($data['jumlah'])." , ".$this->db->escape($data['berat'])." , ".$this->db->escape($data['estimasi'])." );";
		
			
			$saved = $this->db->query($sql);

			if($saved){
				return TRUE;
			}
			
		}


		return FALSE; 




	}


		public function insertBycatch_v2($data=array()){

		if ($data)
        {

				$sql = "
					      INSERT INTO tps_bycatch(
            					namafile, k_species, panjang, berat, estimasi,kode_panjang)
   							 VALUES (".$this->db->escape($data['namafile']).", ".$this->db->escape($data['k_species'])." , ".$this->db->escape($data['panjang'])." , ".$this->db->escape($data['berat'])." , ".$this->db->escape($data['estimasi'])." , ".$this->db->escape($data['kode_panjang'])." );";
		
			
			$saved = $this->db->query($sql);

			if($saved){
				return TRUE;
			}
			
		}


		return FALSE; 




	}




	public function insertRingkasan($data=array() , $tabel){

		if ($data)
        {

				$sql = "
						INSERT INTO ".$tabel." (
				                namafile, kode,   deskripsi ,  berat)
				                  VALUES (".$this->db->escape($data['namafile']).", ".$this->db->escape($data['kode'])." , ".$this->db->escape($data['deskripsi'])."  , ".$this->db->escape($data['berat'])."  );
					      ";
		
			
			$saved = $this->db->query($sql);

			if($saved){
				return TRUE;
			}
			
		}

		return FALSE; 

	}

	            	 

	public function insertKeranjang($data=array() ){

		if ($data)
        {

				$sql = "
						INSERT INTO tps_keranjang(
					            namafile, nomor, kode, berat, k_kapalkecil)
					            VALUES (".$this->db->escape($data['namafile']).", ".$this->db->escape($data['noker'])." , '-', ".$this->db->escape($data['beratkeranjang']).", '0');
					      ";
		
			
			$saved = $this->db->query($sql);

			if($saved){
				return TRUE;
			}
			
		}

		return FALSE; 

	}



	public function insertSmall($data=array() ){

		if ($data)
        {

				$sql = "
						INSERT INTO tps_ikankecil(
			            namafile, nomor, no_ikan, k_species, panjang, k_kapalkecil, 
			            kalkulasi_berat)
			              VALUES (".$this->db->escape($data['namafile'])." , ".$this->db->escape($data['noker'])." , ".$this->db->escape($data['noikan'])." , ".$this->db->escape($data['k_species'])." , ".$this->db->escape($data['panjang'])." , '0', 
			            ".$this->db->escape($data['kalkulasi_berat'])."  )  ";
		
			
			$saved = $this->db->query($sql);

			if($saved){
				return TRUE;
			}
			
		}

		return FALSE; 

	} 


	public function insertSmall_v2($data=array() ){

		if ($data)
        {

				$sql = "
						INSERT INTO tps_ikankecil(
			            namafile, nomor, no_ikan, k_species, panjang, k_kapalkecil, 
			            kalkulasi_berat, berat_sample , kode_panjang , kondisi )
			              VALUES (".$this->db->escape($data['namafile'])." , ".$this->db->escape($data['noker'])." , ".$this->db->escape($data['noikan'])." , ".$this->db->escape($data['k_species'])." , ".$this->db->escape($data['panjang'])." , '0', 
			            ".$this->db->escape($data['kalkulasi_berat'])." , ".$this->db->escape($data['berat_sample'])." , ".$this->db->escape($data['kode_panjang'])." , ".$this->db->escape($data['kondisi'])."  )  ";
		
			
			$saved = $this->db->query($sql);

			if($saved){
				return TRUE;
			}
			
		}

		return FALSE; 

	}


	public function insertTotalIkanKecil($data){

		if ($data)
        {

				$sql = "
						INSERT INTO tps_total_ikankecil( namafile, k_species, total_berat , total_berat_all )
		 						VALUES (".$this->db->escape($data['namafile'])." , ".$this->db->escape($data['species'])."  , ".$this->db->escape($data['total_xxx_kecil'])." ,  ".$this->db->escape($data['summary_xxx'])." ) ";
		
			
			$saved = $this->db->query($sql);

			if($saved){
				return TRUE;
			}
			
		}

		return FALSE; 

	
	}



	public function insertLarge($data){

		if ($data)
        {

				$sql = "
              INSERT INTO tps_ikanbesar(
					                namafile, 
					                no_ikan,
					                k_species, 
					                kode, 
					                berat, 
					                panjang, 
					                k_kapalkecil, 
					                loin1_berat, 
					                loin1_panjang, 
					                valid, 
					                insang, 
					                isi_perut,
					                daging_perut,
					                 kalkulasi )
                VALUES (
                ".$this->db->escape($data['namafile']).", 
                ".$this->db->escape($data['no_ikan'])." ,
                ".$this->db->escape($data['k_species'])." , 
                ".$this->db->escape($data['kode'])." , 
                ".$this->db->escape($data['berat']).", 
                ".$this->db->escape($data['panjang'])." ,  
                ".$this->db->escape($data['k_kapalkecil'])." , 
                ".$this->db->escape($data['loin1_berat'])." , 
                ".$this->db->escape($data['loin1_panjang'])." , 
                ".$this->db->escape($data['valid'])." , 
                ".$this->db->escape($data['insang'])." , 
                ".$this->db->escape($data['isi_perut'])." ,
                ".$this->db->escape($data['daging_perut'])." ,
                 ".$this->db->escape($data['kalkulasi'])." );

						";
		
			
			$saved = $this->db->query($sql);

			if($saved){
				return TRUE;
			}
			
		}

		return FALSE; 

	
	}

	public function insertLarge_v2($data){

		if ($data)
        {

				$sql = "
              INSERT INTO tps_ikanbesar(
					                namafile, 
					                no_ikan,
					                k_species, 
					                kode, 
					                berat, 
					                panjang, 
					                k_kapalkecil, 
					                loin1_berat, 
					                loin1_panjang, 
					                valid, 
					                insang, 
					                isi_perut,
					                daging_perut,
					                 kalkulasi, 
					                 kode_panjang )
                VALUES (
                ".$this->db->escape($data['namafile']).", 
                ".$this->db->escape($data['no_ikan'])." ,
                ".$this->db->escape($data['k_species'])." , 
                ".$this->db->escape($data['kode'])." , 
                ".$this->db->escape($data['berat']).", 
                ".$this->db->escape($data['panjang'])." ,  
                ".$this->db->escape($data['k_kapalkecil'])." , 
                ".$this->db->escape($data['loin1_berat'])." , 
                ".$this->db->escape($data['loin1_panjang'])." , 
                ".$this->db->escape($data['valid'])." , 
                ".$this->db->escape($data['insang'])." , 
                ".$this->db->escape($data['isi_perut'])." ,
                ".$this->db->escape($data['daging_perut'])." ,
                ".$this->db->escape($data['kalkulasi']).",
                ".$this->db->escape($data['kode_panjang'])." );

						";
		
			
			$saved = $this->db->query($sql);

			if($saved){
				return TRUE;
			}
			
		}

		return FALSE; 

	
	}	



	public function konversiSatu($data){

		if ($data)
        {

				$sql = "
              				UPDATE tps_pendaratan SET total_penangkapan=".$data['totalcatch']." WHERE namafile= '".$data['namafile']."'

						";
		
			
			$saved = $this->db->query($sql);

			if($saved){
				return TRUE;
			}
			
		}

		return FALSE; 

	
	}


		public function konversiDua($data){

		if ($data)
        {

				$sql = "

						UPDATE tps_pendaratan SET total_penangkapan=".$data['totalcatch']." ".$data['using_ringkasan_ikan_besar']." WHERE namafile= '".$data['namafile']."'
              
						";
		
			
			$saved = $this->db->query($sql);

			if($saved){
				return TRUE;
			}
			
		}

		return FALSE; 

	
	}


		public function konversiTiga($data){

		if ($data)
        {

				$sql = "
              
              			UPDATE tps_pendaratan SET total_bycatch=".$data['totalb_bycatch']." , total_real_kecil=".$data['totalb_ikankecil']." , total_sampling_kecil=".$data['totalsamplingikankecil']." , raising_factor=".$data['raising_factor']." WHERE namafile= '".$data['namafile']."'

						";
		
			
			$saved = $this->db->query($sql);

			if($saved){
				return TRUE;
			}
			
		}

		return FALSE; 

	
	}


	public function insertEtp($sql){


		if ($sql)
        {
			
			$saved = $this->db->query($sql);

			if($saved){
				return TRUE;
			}
			
		}

		return FALSE; 

	}



public function insertRumpon($data){


	if ($data)
        {

				$sql = "

					
						INSERT INTO ap2hi_rumpon(
									            kode_upload, urutan, id_supplier, alamat, no_sipr, daerah_penangkapan, 
									            daerah_usaha, alat_tangkap, posisi_rumpon, bahan, nama_kapal)
									    VALUES (".$this->db->escape($data['kode_upload']).", ".$this->db->escape($data['urutan']).", ".$this->db->escape($data['id_supplier'])." , ".$this->db->escape($data['alamat'])." , ".$this->db->escape($data['no_sipr'])." , ".$this->db->escape($data['daerah_penangkapan'])." , 
									            ".$this->db->escape($data['daerah_usaha'])." , ".$this->db->escape($data['alat_tangkap'])." , ".$this->db->escape($data['posisi_rumpon'])." , ".$this->db->escape($data['bahan'])." , ".$this->db->escape($data['nama_kapal'])." );

						";
		
			
			$saved = $this->db->query($sql);

			if($saved){
				return TRUE;
			}
			
		}

		return FALSE; 



	}


	public function get_all_rumpon(){

		$user = $this->auth->get_data_session();


		$query = $this->db->query("

			
			SELECT *  FROM ap2hi_rumpon  order by kode_upload , urutan ;


			");
		
		return $query;
	}


	public function count_total_tangkapan(){

		$query = $this->db->query("

			SELECT *  FROM ap2hi_boat_unload where tipe = 'PL' order by kode_upload , kode_trip   ;

			");

		foreach($query->result() as $row){

				$total_tangkapan = ( $row->yft + $row->bet + $row->skj + $row->kaw  ) - $row->ikanhilang ; 

				$sql = " UPDATE ap2hi_boat_unload set total_tangkapan = '".$total_tangkapan."' where kode_upload = '".$row->kode_upload."' and kode_trip = '".$row->kode_trip."'";

				$this->db->query($sql); 

		}
		//select * from ap2hi_boat_unload where PL 
        //LOOP
          //counting ( yft + bet + skj + kaw ) - ikan hilang 
          //get total 
          //update where 



	}


	public function get_all_uploaded_namafile($namafile , $pengguna){

		$user = $this->auth->get_data_session();


		$where_=""; 

		$i=0;

		if($namafile!=""){

			if($i>0){

				$where_.=" AND ";

			}

			$where_.=" namafile = '".$namafile."' "; 

			$i++;
		}



		$addition1 = "";
		$addition2 = "";

		if($user->role_active != "Administrator"){
			

					if($pengguna!=""){

						if($i>0){

							$where_.=" AND ";

						}

						$where_.=" pengguna = '".$pengguna."' "; 


						$i++;

					}


		}

		 

		return $query = $this->db->query("SELECT *  FROM tps_pendaratan where ".$where_." order by namafile ;");

	}





	public function get_all_uploaded_user($tahun , $bulan , $pengguna){

		$user = $this->auth->get_data_session();

		$where_=""; 

		$i=0;

		if($tahun!=""){

			if($i>0){

				$where_.=" AND ";

			}

			$where_.=" thn_sampling = '".$tahun."' "; 

			$i++;
		}

		if($bulan!=""){

			if($i>0){

				$where_.=" AND ";

			}

			$where_.=" bln_sampling = '".$bulan."' "; 


			$i++;

		}

		if($user->role_active != "Administrator"){

				if($pengguna!=""){

					if($i>0){

						$where_.=" AND ";

					}

					$where_.=" pengguna = '".$pengguna."' "; 


					$i++;

				}

		}

		 

		return $query = $this->db->query("SELECT *  FROM tps_pendaratan where ".$where_." order by namafile ;");

	}


	public function disable_list($namafile){

		if($namafile){

			$sql = "DELETE from tps_pendaratan

					 WHERE namafile = '".$namafile."'"
					 ; 

			$this->db->query($sql);


			return TRUE;

		}

		return FALSE;

	}

	public function extract_pendaratan(){

		$user = $this->auth->get_data_session();


		$query = $this->db->query("

			
			SELECT p.namafile, nama_landing, nama_perusahaan, enumerator1, enumerator2, 
       nama_kapal, kapten_kapal, gt_kapal, panjang_kapal, mesin_kapal, 
       bahan_kapal, jum_awak, no_ap2hi, grid1, grid2, total_penangkapan, 
       est_ikanhilang, thn_sampling, bln_sampling, tgl_sampling, jam_sampling, 
       mnt_sampling, rumpon, teknik_cari_tuna, bbm, k_alattangkap, es, 
       pengguna, deskripsi, lama_satuan, lama_jam, lama_hari, hl_tipe_mata_pancing, 
       hl_troll, hl_alat_tangkap_lain, pl_jum_pancing, pl_kapasitas_ember, 
       jumlah_hari_memancing, using_ringkasan_ikanbesar, tgl_impor, 
       jam_impor, tipe, e_pewawancara, e_umur, e_lama_tahun, e_lama_bulan, 
       e_jabatan, e_keterangan, grid , no_sipi , jumlah_rumpon_singgah , tanggal_berangkat , tanggal_kembali , jumlah_pakura , ukuran_pancing
 		 FROM tps_pendaratan p ,  master_landing l , master_supplier s where p.k_landing = l.id_landing and p.k_perusahaan = s.id_supplier;



			");
		
		return $query;
	}



	
	public function getAllTrip(){

		$query = $this->db->query("

			SELECT namafile, tgl_sampling, bln_sampling , thn_sampling  FROM tps_pendaratan order by namafile;

			");

		
		return $query;

	}


	public function update_tanggal_sampling_all($data){

		if ($data)
        {

   

				$sql = "

				update tps_pendaratan set tanggal_sampling = ".$this->db->escape($data['tanggal_sampling'])." where namafile = ".$this->db->escape($data['namafile']).";";
		
			
			$saved = $this->db->query($sql);

			if($saved){
				return TRUE;
			}
			
		}

		return FALSE; 

	
	}




}



