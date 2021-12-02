<?php

class Model_sampling extends CI_Model{

	function __construct(){

		parent::__construct();

			date_default_timezone_set('Asia/Jakarta');
		
	}


	public function get_all_trip_active(){

        $user = $this->auth->get_data_session();

        $addition1= "";

        $addition2= "";

        if(count($user->list_landing) > 0){

        $addition1 = " and p.k_landing in ( ";

                foreach($user->list_landing as $list){

                                $addition1 .="'".$list."' , ";


                            }

            $addition1 = substr($addition1 , '0' , '-2') ;    

            $addition1 .=" ) ";              

            $addition1 = $addition1." ".$addition1;

           }



        if(count($user->list_supp) > 0){

            $addition2 = " and p.k_perusahaan in ( ";

            foreach($user->list_supp as $list){
                                                            
                   $kode = $list; 
                   $addition2 .="'".$kode."' , ";


            }

           $addition2 = substr($addition2 , '0' , '-2') ;    

           $addition2 .=" ) ";              

           $addition2 = $addition2." ".$addition2;

        } 


		$query = $this->db->query("SELECT namafile, nama_landing , nama_perusahaan , thn_sampling , bln_sampling , tgl_sampling ,  enumerator1, enumerator2, 
		       nama_kapal, kapten_kapal, gt_kapal, tipe
		  FROM tps_pendaratan p,master_landing l, master_supplier s
		  where p.k_landing = l.id_landing and p.k_perusahaan = s.id_supplier 
          ".$addition1." ".$addition2."
		  and status_trip = '1'
		  order by namafile ;");

		return $query;

	}


	public function get_all_trip_draft(){
        
         $user = $this->auth->get_data_session();

         $addition1= "";

        $addition2= "";

        if(count($user->list_landing) > 0){

        $addition1 = " and p.k_landing in ( ";

                foreach($user->list_landing as $list){

                                $addition1 .="'".$list."' , ";


                            }

            $addition1 = substr($addition1 , '0' , '-2') ;    

            $addition1 .=" ) ";              

            $addition1 = $addition1." ".$addition1;

           }



        if(count($user->list_supp) > 0){

            $addition2 = " and p.k_perusahaan in ( ";

            foreach($user->list_supp as $list){
                                                            
                   $kode = $list; 
                   $addition2 .="'".$kode."' , ";


            }

           $addition2 = substr($addition2 , '0' , '-2') ;    

           $addition2 .=" ) ";              

           $addition2 = $addition2." ".$addition2;

        } 


		$query = $this->db->query("SELECT namafile, nama_landing , nama_perusahaan , thn_sampling , bln_sampling , tgl_sampling ,  enumerator1, enumerator2, 
		       nama_kapal, kapten_kapal, gt_kapal, tipe
		  FROM tps_pendaratan p,master_landing l, master_supplier s
		  where p.k_landing = l.id_landing and p.k_perusahaan = s.id_supplier 
          ".$addition1." ".$addition2."
		  and status_trip = '2'
		  order by namafile ;");

		return $query;

	}


	public function trip_approve($namafile, $status){


		$query = $this->db->query("UPDATE tps_pendaratan set status_trip='".$status."' where namafile ='".$namafile."' ");

		return $query;

	}


	function general_select($table, $data, $column="", $order_by=""){
        $where_ = "";
        if (count($data)>0) {
            foreach ($data as $inputkey => $input_value) {
                $where_ .= " AND ".$inputkey." = '".$input_value."' ";
            }
        }
        $where_ = ($where_ != ""?"(".substr($where_, 4).")":"(1=1)");

        $select = "*";
        if ($column!="") {
            $select = $column;
        }

        $order_by_ = "";
        if ($order_by!="") {
            $order_by_ = "ORDER BY ".$order_by."";
        }

        $query_string = "
            SELECT ".$select." 
            FROM ".$table." 
            WHERE (1=1)
            AND ".$where_.
            $order_by_;

        $query = $this->db->query($query_string);
      
        return $query; 
    }



	public function add_new_trip($data=array()){

			$user = $this->auth->get_data_session();

        	$id_user = $user->id_user;

			$created_date = date('Y-m-d h:i:s');

            $sampling_date_input =  $data['sampling_date'] ; 

			$sampling_date=strtotime($data['sampling_date']); 

			$thn=date("Y",$sampling_date);

			$bln=floatval(date("m",$sampling_date));

			$tgl=floatval(date("d",$sampling_date));

			$tanggal_berangkat=strtotime($data['tanggal_berangkat']); 

			$tanggal_berangkat=date("Y-m-d",$tanggal_berangkat);

			$tanggal_kembali=strtotime($data['tanggal_kembali']); 

			$tanggal_kembali=date("Y-m-d",$tanggal_kembali);

			$sampling_time =  $this->db->escape($data['sampling_time']);

			$sampling_time = explode(":",$sampling_time);

			$jam_sampling = str_replace("'","", $sampling_time[0]);

			$mnt_sampling = str_replace("'","", $sampling_time[1]);

			$teknik_cari_tuna="";

			if($data['teknik_cari_tuna1'] != ""){

				$teknik_cari_tuna = $data['teknik_cari_tuna1'].",".$data['teknik_cari_tuna2'];
			}


			$griding[] = $data['grid11']." - ".$data['grid12']; 
            $griding[] = $data['grid21']." - ".$data['grid21'];
            $griding = json_encode($griding); 

			if ($data)
        {

				$sql = "INSERT INTO tps_pendaratan(
            namafile, 
            k_landing, 
            k_perusahaan, 
            enumerator1,
            enumerator2, 
            no_sipi,
            nama_kapal,
            kapten_kapal,
            total_penangkapan,
            est_ikanhilang,
            grid1,
            grid2,
            grid,
            thn_sampling, 
            bln_sampling, 
            tgl_sampling, 
            jam_sampling, 
            mnt_sampling, 
            mesin_kapal,
            gt_kapal,
            panjang_kapal,
            jumlah_rumpon_singgah,
            	lama_satuan,
            	lama_jam,
            	lama_hari,
            ukuran_pancing,
            hl_alat_tangkap_lain,
            bahan_kapal,
            bbm,
            teknik_cari_tuna,
            tanggal_berangkat,
            tanggal_kembali,
            jumlah_hari_memancing,
            es,
            jum_awak,
            jumlah_pakura,
            hl_tipe_mata_pancing,
            pl_kapasitas_ember,
            pl_jum_pancing,
            tipe,
            status_trip,
            pengguna,
            tgl_impor,
            jam_impor,
            tanggal_sampling

           
            )
    VALUES ( 
    		".$this->db->escape($data['namafile'] ? : "")." , 
            ".$this->db->escape($data['k_landing'] ? : "")." , 
            ".$this->db->escape($data['k_perusahaan'] ? : "")." , 
            ".$this->db->escape($data['enumerator1'] ? : "")." ,
            ".$this->db->escape($data['enumerator2'] ? : "")." , 
            ".$this->db->escape($data['no_sipi'] ? : "")." ,
            ".$this->db->escape($data['nama_kapal'] ? : "")." ,
            ".$this->db->escape($data['kapten_kapal'] ? : "")." ,
            ".$this->db->escape($data['total_penangkapan'] ? : "0")." ,
            ".$this->db->escape($data['est_ikanhilang'] ? : "0")." ,

            '".$data['grid11']."', 
            '".$data['grid12']."', 
            '".$griding."',
            '".$thn."', 
            '".$bln."', 
            '".$tgl."', 
            '".$jam_sampling."', 
            '".$mnt_sampling."', 
            ".$this->db->escape($data['mesin_kapal'] ? : "0")." ,
            ".$this->db->escape($data['gt_kapal'] ? : "0")." ,
            ".$this->db->escape($data['panjang_kapal'] ? : "0")." ,
            ".$this->db->escape($data['jumlah_rumpon_singgah'] ? : "")." ,
            	".$this->db->escape($data['satuan_trip'] ? : "")." ,
            	".$this->db->escape($data['lama_trip'] ? : "0")." ,
            	".$this->db->escape($data['lama_trip'] ? : "0")." ,
            ".$this->db->escape($data['ukuran_pancing'] ? : "")." ,
            ".$this->db->escape($data['hl_alat_tangkap_lain'] ? : "")." ,
            ".$this->db->escape($data['bahan_kapal'] ? : "")." ,
            ".$this->db->escape($data['bbm'] ? : "0")." ,
            ".$this->db->escape($teknik_cari_tuna)." ,
            '".$tanggal_berangkat."', 
            '".$tanggal_kembali."', 
            ".$this->db->escape($data['jumlah_hari_memancing'] ? : "")." ,
            ".$this->db->escape($data['es'] ? : "0")." ,
            ".$this->db->escape($data['jum_awak'] ? : "0")." ,
            ".$this->db->escape($data['jumlah_pakura'] ? : "")." ,
            ".$this->db->escape($data['hl_tipe_mata_pancing'] ? : "")." ,
            ".$this->db->escape($data['pl_kapasitas_ember'] ? : "0")." ,
            ".$this->db->escape($data['pl_jum_pancing'] ? : "0")." ,
            ".$this->db->escape($data['tipe'] ? : "")." ,
            '2',
            '".$id_user."',
            '".date("Y-m-d")."',
            '".date("H:i:s")."',
            '".$sampling_date_input."'
    		 )";
		
			
			$saved = $this->db->query($sql);

			if($saved){
				return TRUE;
			}
			

		}


		return FALSE; 



	}


	function checkExsisting($table, $data, $column=""){

		$where_ = "";
        if (count($data)>0) {
            foreach ($data as $inputkey => $input_value) {
                $where_ .= " AND ".$inputkey." = '".$input_value."' ";
            }
        }
        $where_ = ($where_ != ""?"(".substr($where_, 4).")":"(1=1)");

        $select = "*";
        if ($column!="") {
            $select = $column;
        }

     

        $query = "
            SELECT ".$select." 
            FROM ".$table." 
            WHERE (1=1)
            AND ".$where_;


        return $this->db->query($query)->num_rows();

	}


	public function update_trip_utama($data=array()){


		$ci = & get_instance();

		if ($data)
        {

        	$tanggal_berangkat=strtotime($data['tanggal_berangkat']); 

			$tanggal_berangkat=date("Y-m-d",$tanggal_berangkat);

			$tanggal_kembali=strtotime($data['tanggal_kembali']); 

			$tanggal_kembali=date("Y-m-d",$tanggal_kembali);

        	$teknik_cari_tuna="";

			if($data['teknik_cari_tuna1'] != ""){

				$teknik_cari_tuna = $data['teknik_cari_tuna1'].",".$data['teknik_cari_tuna2'];
			}


			$griding[] = $data['grid11']." - ".$data['grid12']; 
            $griding[] = $data['grid21']." - ".$data['grid21'];
            $griding = json_encode($griding); 


            if($data['satuan_trip'] == 'hari'){

            	$lama_hari = $data['lama_trip'];

            	$lama_jam = "0";

        	}else{

	            $lama_hari = "0";

            	$lama_jam = $data['lama_trip'];

        	}

			if ($data)
        {

			echo 	$sql = "UPDATE tps_pendaratan set
      
            enumerator1=".$this->db->escape($data['enumerator1'] ? : "")." ,
            enumerator2=".$this->db->escape($data['enumerator2'] ? : "")." , 
            no_sipi=".$this->db->escape($data['no_sipi'] ? : "").",
            nama_kapal=".$this->db->escape($data['nama_kapal'] ? : "")." ,
            kapten_kapal=".$this->db->escape($data['kapten_kapal'] ? : "")." ,
            total_penangkapan=".$this->db->escape($data['total_penangkapan'] ? : "0").",
            est_ikanhilang=".$this->db->escape($data['est_ikanhilang'] ? : "0").",
            grid1='".$data['grid11']."',
            grid2='".$data['grid12']."',
            grid='".$griding."',
           
            mesin_kapal=".$this->db->escape($data['mesin_kapal'] ? : "0")." ,
            gt_kapal=".$this->db->escape($data['gt_kapal'] ? : "0")." ,
            panjang_kapal=".$this->db->escape($data['panjang_kapal'] ? : "0")." ,
            jumlah_rumpon_singgah=".$this->db->escape($data['jumlah_rumpon_singgah'] ? : "")." ,
            	lama_satuan=".$this->db->escape($data['satuan_trip'] ? : "")." ,
            	lama_jam=".$this->db->escape($lama_jam ? : "0")." ,
            	lama_hari=".$this->db->escape($lama_hari ? : "0")." ,
            ukuran_pancing=".$this->db->escape($data['ukuran_pancing'] ? : "")." ,
            hl_alat_tangkap_lain=".$this->db->escape($data['hl_alat_tangkap_lain'] ? : "")." ,
            bahan_kapal=".$this->db->escape($data['bahan_kapal'] ? : "")." ,
            bbm=".$this->db->escape($data['bbm'] ? : "0")." ,
            teknik_cari_tuna=".$this->db->escape($teknik_cari_tuna ? : "")." ,
            tanggal_berangkat='".$tanggal_berangkat."',
            tanggal_kembali='".$tanggal_kembali."',
            jumlah_hari_memancing=".$this->db->escape($data['jumlah_hari_memancing'] ? : "")." ,
            es=".$this->db->escape($data['es'] ? : "0")." ,
            jum_awak=".$this->db->escape($data['jum_awak'] ? : "0")." ,
            jumlah_pakura=".$this->db->escape($data['jumlah_pakura'] ? : "")." ,
            hl_tipe_mata_pancing=".$this->db->escape($data['hl_tipe_mata_pancing'] ? : "")." ,
            pl_kapasitas_ember=".$this->db->escape($data['pl_kapasitas_ember'] ? : "0")." ,
            pl_jum_pancing=".$this->db->escape($data['pl_jum_pancing'] ? : "0")." ,
            tipe=".$this->db->escape($data['tipe'] ? : "")." ,
            status_trip='2'
            where namafile = '".$data['namafile']."'
           
            ";
		
			
			$saved = $this->db->query($sql);



			if($saved){
				return TRUE;
			}
			

        }

        return FALSE;



	}


	}



	public function trip_disable($namafile){


		$query = $this->db->query("delete from tps_pendaratan where namafile = '".$namafile."'");


    	return $query ;

	}

	function select_max($table, $data, $column="" ){

        $where_ = "";
        if (count($data)>0) {
            foreach ($data as $inputkey => $input_value) {
                $where_ .= " AND ".$inputkey." = '".$input_value."' ";
            }
        }
        $where_ = ($where_ != ""?"(".substr($where_, 4).")":"(1=1)");

      
        $query_string = "
            SELECT MAX( ".$column." )
            FROM ".$table." 
            WHERE (1=1)
            AND ".$where_;

        $query = $this->db->query($query_string);

        return $query ; 
     }



    public function load_vessel_from_id_supplier($id){

        $query = $this->db->query("Select id_vessel , nama_kapal from master_vessel where id_supplier = '".$id."' and status = 'active'");

        return $query;

    }



	public function form2_add($data=array()){

			$no = $this->select_max( "tps_umpan" , array('namafile' => $data['namafile']) , "urut" )->row_array();
        	$no = $no['max'] + 1; 


			$sql = "

				INSERT INTO tps_umpan(
            namafile, k_umpan, urut, species, rumpon1, rumpon2, total, estimasi, 
            k_alattangkap, pl_pengadaan_umpan, pl_jum_ember, domestic_import, 
            hl_estimasi_ekor_umpan)
		    VALUES (
		    ".$this->db->escape($data['namafile'] ? : "").", 
		    ".$this->db->escape($data['k_umpan'] ? : "").", 
		    '".$no."', 
		    ".$this->db->escape($data['species'] ? : "").", 
		    ".$this->db->escape($data['grid1'] ? : "").", 
		    ".$this->db->escape($data['grid2'] ? : "").", 
		    '0', 
		    ".$this->db->escape($data['estimasi'] ? : "0").", 
		    ".$this->db->escape($data['k_alattangkap'] ? : "").", 
		    '', 
		    ".$this->db->escape($data['pl_jum_ember'] ? : "0").", 
		    '', 
		    ".$this->db->escape($data['hl_estimasi_ekor_umpan'] ? : "")."
		    );
          	";


			$this->db->query($sql);

		

			return TRUE; 


	}


	public function form2_update($data=array()){

		$sql = "UPDATE tps_umpan
			   SET namafile=".$this->db->escape($data['namafile'] ? : "").", 
			   k_umpan=".$this->db->escape($data['k_umpan'] ? : "").",
			   species=".$this->db->escape($data['species'] ? : "").", 
			   rumpon1=".$this->db->escape($data['grid1'] ? : "").", 
			   rumpon2=".$this->db->escape($data['grid2'] ? : "").", 
			   total='0', 
			   estimasi=".$this->db->escape($data['estimasi'] ? : "0").", 
			   k_alattangkap=".$this->db->escape($data['k_alattangkap'] ? : "").", 
			   pl_jum_ember=".$this->db->escape($data['pl_jum_ember'] ? : "0").", 
			   hl_estimasi_ekor_umpan=".$this->db->escape($data['hl_estimasi_ekor_umpan'] ? : "")."
			 WHERE namafile=".$this->db->escape($data['namafile'] ? : "")."
			 and urut=".$this->db->escape($data['urut'] ? : "")."
			 ;


					"; 
		$this->db->query($sql);

		

			return TRUE; 

	}


	public function form2_delete($namafile,$urut){

		return $this->db->query("DELETE from tps_umpan where namafile ='$namafile' and urut = '$urut'");


	}





	public function form3_add($data=array()){

		


			$sql = "

				INSERT INTO tps_bycatch(
            namafile, k_species, jumlah, berat, estimasi, kode_panjang , panjang )
		    VALUES (
		    ".$this->db->escape($data['namafile'] ? : "").", 
		    ".$this->db->escape($data['k_species'] ? : "").", 
		    ".$this->db->escape($data['jumlah'] ? : "0").", 
		    ".$this->db->escape($data['berat'] ? : "0").", 
		    ".$this->db->escape($data['estimasi'] ? : "").", 
		    ".$this->db->escape($data['kode_panjang'] ? : "").",
		    ".$this->db->escape($data['panjang'] ? : "")."
		    )
		    ;
          	";


			$this->db->query($sql);

		

			return TRUE; 


	}


	public function form3_update($data=array()){


		echo $sql = "

				UPDATE tps_bycatch
   					SET 
   					k_species=".$this->db->escape($data['k_species'] ? : "").",
   					jumlah=".$this->db->escape($data['jumlah'] ? : "0").", 
   					berat=".$this->db->escape($data['berat'] ? : "0").", 
   					estimasi=".$this->db->escape($data['estimasi'] ? : "").", 
   					kode_panjang=".$this->db->escape($data['kode_panjang'] ? : "").",
   					panjang=".$this->db->escape($data['panjang'] ? : "")."
 				WHERE 
 				namafile=".$this->db->escape($data['namafile'] ? : "")." and 
   				k_species=".$this->db->escape($data['k_species_awal'] ? : "")."
 				;
          	";

          	$this->db->query($sql);

		

			return TRUE; 


	}



	public function form3_delete($namafile,$k_species){

		return $this->db->query("DELETE from tps_bycatch where namafile ='$namafile' and k_species = '$k_species'");


	}



	public function form4_add($data=array()){

		


			$sql = "

				INSERT INTO tps_ringkasan_ikankecil(
            namafile, kode, deskripsi, berat )
		    VALUES (
		    ".$this->db->escape($data['namafile'] ? : "").", 
		    ".$this->db->escape($data['kode'] ? : "").", 
		    ".$this->db->escape($data['deskripsi'] ? : "").", 
		    ".$this->db->escape($data['berat'] ? : "0")."
		    )
		    ;
          	";


			$this->db->query($sql);

		

			return TRUE; 


	}


	public function form4_update($data=array()){


		echo $sql = "

				UPDATE tps_ringkasan_ikankecil
   					SET 
   					kode=".$this->db->escape($data['kode'] ? : "").",
   					deskripsi=".$this->db->escape($data['deskripsi'] ? : "").", 
   					berat=".$this->db->escape($data['berat'] ? : "0")."
 				WHERE 
 				namafile=".$this->db->escape($data['namafile'] ? : "")." and 
   				kode=".$this->db->escape($data['kode_species'] ? : "")."
 				;
          	";

          	$this->db->query($sql);

		

			return TRUE; 


	}

	public function form4_delete($namafile,$k_species){

		return $this->db->query("DELETE from tps_ringkasan_ikankecil where namafile ='$namafile' and kode = '$k_species'");


	}


	public function add_detail_ikan_kecil($data=array()){


			if ($data)
        {

        	$no_ikan = $this->select_max( "tps_ikankecil" , array('namafile' => $data['namafile'] , 'nomor' =>  $data['nomor'] ) , "no_ikan" )->row_array();
        	$no_ikan = $no_ikan['max'] + 1; 

        	
			$sql = "

				INSERT INTO tps_ikankecil(
            namafile, nomor, no_ikan, k_species, panjang, berat_keranjang
            , berat_sample, kode_panjang, kondisi, k_kapalkecil)
			    VALUES (
			    ".$this->db->escape($data['namafile'] ? : "").", ".$this->db->escape($data['nomor'] ? : "").", ".$no_ikan.", ".$this->db->escape($data['fao'] ? : "").", ".$this->db->escape($data['panjang'] ? : "0").",".$this->db->escape($data['berat_keranjang'] ? : "0").", 
			             ".$this->db->escape($data['berat_sample'] ? : "0").", ".$this->db->escape($data['kode_panjang'] ? : "").", ".$this->db->escape($data['kondisi'] ? : "")." , 0
			    );
			          	";



			$this->db->query($sql);

			return TRUE; 

        }

        return FALSE; 

	}


	public function update_detail_ikan_kecil($data=array()){



			if ($data)
        {

        		$sql = "

				UPDATE tps_ikankecil set 
		             k_species=".$this->db->escape($data['edit_fao'] ? : "").",
		             panjang=".$this->db->escape($data['edit_panjang'] ? : "0").",
		             berat_keranjang=".$this->db->escape($data['edit_berat_keranjang'] ? : "0").",
		             berat_sample=".$this->db->escape($data['edit_berat_sample'] ? : "0").",
		             kode_panjang=".$this->db->escape($data['edit_kode_panjang'] ? : "").",
		             kondisi=".$this->db->escape($data['edit_kondisi'] ? : "")."
		            WHERE 
		            namafile=".$this->db->escape($data['edit_namafile'] ? : "")."
		            and nomor=".$this->db->escape($data['edit_nomor'] ? : "")." 
		            and no_ikan=".$this->db->escape($data['edit_no_ikan'] ? : "")."

		
			          	";



			$this->db->query($sql);

			return TRUE; 

        }


	}


	public function delete_detail_ikan_kecil($namafile , $nomor , $no_ikan){


		if($namafile){


			$sql = "DELETE FROM tps_ikankecil WHERE namafile = ".$this->db->escape($namafile)."  and nomor = ".$this->db->escape($nomor)." and no_ikan = ".$this->db->escape($no_ikan)." "; 

			$this->db->query($sql);


			return TRUE;

		}

		return FALSE;


	}



	public function form5_add($data=array()){

		


			$sql = "

				INSERT INTO tps_ringkasan_ikanbesar(
            namafile, kode, deskripsi, berat )
		    VALUES (
		    ".$this->db->escape($data['namafile'] ? : "").", 
		    ".$this->db->escape($data['kode'] ? : "").", 
		    ".$this->db->escape($data['deskripsi'] ? : "").", 
		    ".$this->db->escape($data['berat'] ? : "0")."
		    )
		    ;
          	";


			$this->db->query($sql);

			return TRUE; 


	}



	public function form5_update($data=array()){


		echo $sql = "

				UPDATE tps_ringkasan_ikanbesar
   					SET 
   					kode=".$this->db->escape($data['kode'] ? : "").",
   					deskripsi=".$this->db->escape($data['deskripsi'] ? : "").", 
   					berat=".$this->db->escape($data['berat'] ? : "0")."
 				WHERE 
 				namafile=".$this->db->escape($data['namafile'] ? : "")." and 
   				kode=".$this->db->escape($data['kode_species'] ? : "")."
 				;
          	";

          	$this->db->query($sql);

		

			return TRUE; 


	}

	public function form5_delete($namafile,$k_species){

		return $this->db->query("DELETE from tps_ringkasan_ikanbesar where namafile ='$namafile' and kode = '$k_species'");


	}


		public function add_detail_ikan_besar($data=array()){


			if ($data)
        {

        	$no_ikan = $this->select_max( "tps_ikanbesar" , array('namafile' => $data['namafile'] ) , "no_ikan" )->row_array();
        	$no_ikan = $no_ikan['max'] + 1; 

        	
			$sql = "

				INSERT INTO tps_ikanbesar(
            		   namafile, 
            		   no_ikan, 
            		   k_species,
            		   kode,
            		   berat, 
            		   panjang , 
            		   kode_panjang,
                       loin1_berat , 
                       loin1_panjang ,
                       insang,
                       isi_perut,
                       daging_perut,
                       k_kapalkecil
                       )
			    VALUES (

			    	 ".$this->db->escape($data['namafile'] ? : "").",
            		  ".$no_ikan.", 
            		  ".$this->db->escape($data['k_species'] ? : "").", 
            		  '-', 
            		  ".$this->db->escape($data['berat'] ? : "0").",  
            		  ".$this->db->escape($data['panjang'] ? : "0").",  
            		  ".$this->db->escape($data['kode_panjang'] ? : "").",
                      ".$this->db->escape($data['loin1_berat'] ? : "0").",  
                       ".$this->db->escape($data['loin1_panjang'] ? : "0").", 
                      ".$this->db->escape($data['insang'] ? : "").", 
                      ".$this->db->escape($data['isi_perut'] ? : "").", 
                      ".$this->db->escape($data['daging_perut'] ? : "").",
                      '0'

			
			    );
			          	";



			$this->db->query($sql);

			return TRUE; 

        }

        return FALSE; 

	}


	public function update_detail_ikan_besar($data=array()){



			if ($data)
        {

        		$sql = "

				UPDATE tps_ikanbesar set 
            		   k_species=".$this->db->escape($data['edit_k_species'] ? : "").",
            		   berat=".$this->db->escape($data['edit_berat'] ? : "0").",
            		   panjang=".$this->db->escape($data['edit_panjang'] ? : "0").", 
            		   kode_panjang=".$this->db->escape($data['edit_kode_panjang'] ? : "0").",
                       loin1_berat=".$this->db->escape($data['edit_loin1_berat'] ? : "0").", 
                       loin1_panjang=".$this->db->escape($data['edit_loin1_panjang'] ? : "0").", 
                       insang=".$this->db->escape($data['edit_insang'] ? : "").", 
                       isi_perut=".$this->db->escape($data['edit_isi_perut'] ? : "").", 
                       daging_perut=".$this->db->escape($data['edit_daging_perut'] ? : "")."
                       where namafile=".$this->db->escape($data['edit_namafile'] ? : "")."
                       and no_ikan=".$this->db->escape($data['edit_no_ikan'] ? : "")."
		
			          	";



			$this->db->query($sql);

			return TRUE; 

        }


	}


	public function delete_detail_ikan_besar($namafile , $no_ikan){


		if($namafile){


			$sql = "DELETE FROM tps_ikanbesar WHERE namafile = ".$this->db->escape($namafile)." and no_ikan = ".$this->db->escape($no_ikan)." "; 

			$this->db->query($sql);


			return TRUE;

		}

		return FALSE;


	}



	public function update_form6($data=array()){


		if ($data)
        {

        		$sql = "

				UPDATE tps_pendaratan set 
            		   deskripsi=".$this->db->escape($data['deskripsi'] ? : "").",
            		   deskripsi_foto=".$this->db->escape($data['deskripsi_foto'] ? : "")."
                       where namafile=".$this->db->escape($data['namafile'] ? : "")."
			          	";



			$this->db->query($sql);

			return TRUE; 

        }


	}


	public function update_form7($data=array()){


		if ($data)
        {

        		$sql = "

				UPDATE tps_pendaratan set 
            		   e_pewawancara=".$this->db->escape($data['e_pewawancara'] ? : "").",
            		   e_umur=".$this->db->escape($data['e_umur'] ? : "").",
            		   e_lama_tahun=".$this->db->escape($data['e_lama_tahun'] ? : "").",
            		   e_lama_bulan=".$this->db->escape($data['e_lama_bulan'] ? : "").",
            		   e_jabatan=".$this->db->escape($data['e_jabatan'] ? : "").",
            		   e_keterangan=".$this->db->escape($data['e_keterangan'] ? : "")."
                       where namafile=".$this->db->escape($data['namafile'] ? : "")."
			          	";



			$this->db->query($sql);

			return TRUE; 

        }


	}



		public function add_detail_etp($data=array()){


			if ($data)
        {

        	$urut = $this->select_max( "tps_etp" , array('namafile' => $data['namafile'] ) , "urut" )->row_array();
        	$urut = $urut['max'] + 1; 

        	
			$sql = "

			INSERT INTO tps_etp(
            namafile, 
            urut, 
            k_species, 
            jml_interaksi, 
            jml_didaratkan, 
            est_interaksi, 
            est_didaratkan, 
            d_1, 
            d_2, 
            d_3, 
            d_4, 
            d_5, 
            td_1, 
            td_2, 
            td_3, 
            td_4, 
            td_5, 
            dibuang, 
            dimakan, 
            dijual, 
            diumpan, 
            tidak_tahu, 
            k_kelompok, 
            namalokal, 
            yakin_lokal, 
            yakin_species, 
            lokasi_interaksi, 
            r1, 
            r2, 
            r3, 
            alat_etp, 
            alat_lain, 
            tangan, 
            kapal, 
            lainnya, 
            interaksi
            )
    VALUES (
    		".$this->db->escape($data['namafile'] ? : "").", 
            ".$urut.", 
            ".$this->db->escape($data['k_species'] ? : "").", 
            ".$this->db->escape($data['jml_interaksi'] ? : "").", 
            ".$this->db->escape($data['jml_didaratkan'] ? : "").", 
            ".$this->db->escape($data['est_interaksi'] ? : "").", 
            ".$this->db->escape($data['est_didaratkan'] ? : "").", 
            ".$this->db->escape($data['d_1'] ? : "0").", 
            ".$this->db->escape($data['d_2'] ? : "0").", 
            ".$this->db->escape($data['d_3'] ? : "0").", 
            ".$this->db->escape($data['d_4'] ? : "0").", 
            ".$this->db->escape($data['d_5'] ? : "0").", 
            ".$this->db->escape($data['td_1'] ? : "0").", 
            ".$this->db->escape($data['td_2'] ? : "0").", 
            ".$this->db->escape($data['td_3'] ? : "0").", 
            ".$this->db->escape($data['td_4'] ? : "0").", 
            ".$this->db->escape($data['td_5'] ? : "0").", 
            ".$this->db->escape($data['dibuang'] ? : "").", 
            ".$this->db->escape($data['dimakan'] ? : "").", 
            ".$this->db->escape($data['dijual'] ? : "").", 
            ".$this->db->escape($data['diumpan'] ? : "").", 
            ".$this->db->escape($data['tidak_tahu'] ? : "").",
            ".$this->db->escape($data['k_kelompok'] ? : "").", 
            ".$this->db->escape($data['namalokal'] ? : "").", 
            ".$this->db->escape($data['yakin_lokal'] ? : "").", 
            ".$this->db->escape($data['yakin_species'] ? : "").", 
            ".$this->db->escape($data['lokasi_interaksi'] ? : "").", 
            ".$this->db->escape($data['r1'] ? : "").",
            ".$this->db->escape($data['r2'] ? : "").", 
            ".$this->db->escape($data['r3'] ? : "").", 
            ".$this->db->escape($data['alat_etp'] ? : "").",
            ".$this->db->escape($data['alat_lain'] ? : "").",
            ".$this->db->escape($data['tangan'] ? : "").",
            ".$this->db->escape($data['kapal'] ? : "").",
            ".$this->db->escape($data['lainnya'] ? : "").", 
            ".$this->db->escape($data['interaksi'] ? : "")."
    );";



			$this->db->query($sql);

			return TRUE; 

        }

        return FALSE; 

	}



	public function update_detail_etp($data=array()){


		if ($data)
        {

        		$sql = "

				UPDATE tps_etp
				   SET k_species=".$this->db->escape($data['edit_k_species'] ? : "").",  
				   jml_interaksi=".$this->db->escape($data['edit_jml_interaksi'] ? : "").",  
				   jml_didaratkan=".$this->db->escape($data['edit_jml_didaratkan'] ? : "").", 
				   est_interaksi=".$this->db->escape($data['edit_est_interaksi'] ? : "").", 
				   est_didaratkan=".$this->db->escape($data['edit_est_didaratkan'] ? : "").", 
				   d_1=".$this->db->escape($data['edit_d_1'] ? : "0").", 
				   d_2=".$this->db->escape($data['edit_d_2'] ? : "0").", 
				   d_3=".$this->db->escape($data['edit_d_3'] ? : "0").",  
				   d_4=".$this->db->escape($data['edit_d_4'] ? : "0").", 
				       d_5=".$this->db->escape($data['edit_d_5'] ? : "0").", 
				       td_1=".$this->db->escape($data['edit_td_1'] ? : "0").",  
				       td_2=".$this->db->escape($data['edit_td_2'] ? : "0").", 
				       td_3=".$this->db->escape($data['edit_td_3'] ? : "0").", 
				       td_4=".$this->db->escape($data['edit_td_4'] ? : "0").", 
				       td_5=".$this->db->escape($data['edit_td_5'] ? : "0").",  
				       dibuang=".$this->db->escape($data['edit_dibuang'] ? : "0").", 
				       dimakan=".$this->db->escape($data['edit_dimakan'] ? : "0").", 
				       dijual=".$this->db->escape($data['edit_dijual'] ? : "0").", 
				       diumpan=".$this->db->escape($data['edit_diumpan'] ? : "0").", 
				       tidak_tahu=".$this->db->escape($data['edit_tidak_tahu'] ? : "0").", 
				       k_kelompok=".$this->db->escape($data['edit_k_kelompok'] ? : "").", 
				       namalokal=".$this->db->escape($data['edit_namalokal'] ? : "").", 
				       yakin_lokal=".$this->db->escape($data['edit_yakin_lokal'] ? : "").", 
				       yakin_species=".$this->db->escape($data['edit_yakin_species'] ? : "").", 
				       lokasi_interaksi=".$this->db->escape($data['edit_lokasi_interaksi'] ? : "").", 
				       r1=".$this->db->escape($data['edit_r1'] ? : "0").", 
				       r2=".$this->db->escape($data['edit_r2'] ? : "0").", 
				       r3=".$this->db->escape($data['edit_r3'] ? : "0").", 
				       alat_etp=".$this->db->escape($data['edit_alat_etp'] ? : "").", 
				       alat_lain=".$this->db->escape($data['edit_alat_lain'] ? : "").", 
				       tangan=".$this->db->escape($data['edit_tangan'] ? : "").", 
				       kapal=".$this->db->escape($data['edit_kapal'] ? : "").", 
				       lainnya=".$this->db->escape($data['edit_lainnya'] ? : "").", 
				       interaksi=".$this->db->escape($data['edit_interaksi'] ? : "")." 
				 WHERE namafile=".$this->db->escape($data['edit_namafile'] ? : "")." 
				 and 
				 urut=".$this->db->escape($data['edit_urut'] ? : "")." 

			          	";



			$this->db->query($sql);

			return TRUE; 

        }


	}



		public function delete_detail_etp($namafile , $urut){


		if($namafile){


			$sql = "DELETE FROM tps_etp WHERE namafile = ".$this->db->escape($namafile)." and urut = ".$this->db->escape($urut)." "; 

			$this->db->query($sql);


			return TRUE;

		}

		return FALSE;


	}




}

?>