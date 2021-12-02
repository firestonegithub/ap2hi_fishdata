<?php

class Global_model extends CI_Model {

    public function __construct(){
        parent::__construct();
        
    }

    function general_add($data,$table) {
        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }

    function general_update($data_post,$table,$data_where){
        $this->db->where($data_where);
        return $this->db->update($table,$data_post);
    }

    function general_delete($data,$table){
        $this->db->where($data);
        return $this->db->delete($table);
    }

    function general_select2($table,$data,$data_show,$column="",$group_by=""){
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

        $group_by_ = "";
        if ($group_by!="") {
            $group_by_ = "GROUP BY ".$group_by;
        }

        $query_string = "
            SELECT ".$select." 
            FROM ".$table." 
            WHERE (1=1)
            AND ".$where_.
            $group_by_;

        $query = $this->db->query($query_string);
        

        if ($data_show=="row") {
            return $query->row();   
        }
        elseif ($data_show=="result"){
            return $query->result();   
        }else{
            return $query->result();   
        }

    }

    function getMonth($month , $tipe){

        $arrayMonth = array('1' => 'Januari',
                                '2' => 'Februari',
                                '3' => 'Maret',
                                '4' => 'April',
                                '5' => 'Mei',
                                '6' => 'Juni',
                                '7' => 'Juli',
                                '8' => 'Agustus',
                                '9' => 'September',
                                '10' => 'Oktober',
                                '11' => 'November',
                                '12' => 'Desember' ); 


        if($tipe == 'monthToNumber'){

            $value = array_search($month, $arrayMonth); 

        }else if($tipe == 'numberToMonth'){

            $value = $arrayMonth[$month];
        }   

        return $value; 

    }


    function general_select($table,$data,$data_show="row",$column="",$group_by=""){
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

        $group_by_ = "";
        if ($group_by!="") {
            $group_by_ = "GROUP BY ".$group_by;
        }

        $query_string = "
            SELECT ".$select." 
            FROM ".$table." 
            WHERE (1=1)
            AND ".$where_.
            $group_by_;

        $query = $this->db->query($query_string);
        /*
        if ($data_show=="row") {
            return $query->row();   
        }
        elseif ($data_show=="result"){
            return $query->result();   
        }
        //So We can maintain the results
        */
        return $query; 
    }

    function general_dataselect($select="*",$table_from,$table_join=array(),$table_where=array(),$table_order=array(),$data_show="row"){
        $this->db->select($select);

        if (count($table_join)>0) {
            foreach ($table_join as $inputkey => $input_value) {
                foreach ($input_value as $inputkey1 => $input_value1) {
                    $this->db->where($inputkey,$inputkey1,$input_value1);
                }
            }
        }

        if (count($table_where)>0) {
            foreach ($table_where as $inputkey => $input_value) {
                $this->db->where($inputkey,$input_value);
            }
        }

        if (count($table_order)>0) {
            foreach ($table_order as $inputkey => $input_value) {
                $this->db->order_by($inputkey,$input_value);
            }
        }

        $query = $this->db->get($table_from);

        if ($data_show=="row") {
            return $query->row();   
        }
        elseif ($data_show=="result"){
            return $query->result();   
        }
        elseif ($data_show=="result_array"){
            return $query->result_array();   
        }
    }


    function datetotext($date){
        if ($date!='' && $date!='0000-00-00') {
            $datex = explode(" ", $date);
            $datetotext2 = explode("-", $datex[0]);
            return $datetotext2[2]."/".$datetotext2[1]."/".$datetotext2[0];
        }
        else{
            return "";
        }
    }

    function texttodate($date){
        if ($date!='' && $date!='0000-00-00') {
            $datex = explode(" ", $date);
            $datetotext2 = explode("/", $datex[0]);
            return $datetotext2[2]."-".$datetotext2[1]."-".$datetotext2[0];
        }
        else{
            return "";
        }
    }

    public function view_time($time){
        if ($time!='') {
            $timex = explode(":", $time);
            return $timex[0].":".$timex[1];
        }
        else{
            return "";
        }
    }

    public function formatHours($time){
        $date = explode(':', $time.":00");
        return ($date[0]*60*60)+($date[1]*60)+$date[2];
    }


    public function getAlerts(){

        $today = date('Y-m-d');
        $last7Days = date('Y-m-d', strtotime('-7 days'));

        $query= $this->db->query("
                                SELECT namafile , name , date_upload
                                  FROM ap2hi_boat_unload , tb_user
                                    where ap2hi_boat_unload.pengguna::integer = tb_user.id_user and 
                                    date_upload between '".$last7Days."' and '".$today."' 
                                    group by namafile , name , date_upload order by date_upload desc
                           ;");

        $text = "";
        $i=1;

       
                foreach($query->result() as $res){
                    if($i <= 10){
                        $text .= '<div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                              <span class="text-success">
                                <strong>
                                  <i class="fa fa-long-arrow-up fa-fw"></i>Unloading Uploaded</strong>
                              </span>
                              <span class="small float-right text-muted">'.$res->date_upload.'</span>
                              <div class="dropdown-message small">Pengguna '.$res->name.' '.$res->namafile.' Successfully Insert</div>
                            </a>'; 

                            $i++;
                        }
                }


        return $text;
    }


    public function getDraft(){

        $query= $this->db->query("
                                SELECT count(namafile) as jumlah_draft FROM tps_pendaratan where status_trip = '2';

                           ;");

        
        $text = "";

           
                foreach($query->result() as $res){
                   
                        $text .= '<div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                              <span class="text-success">
                                <strong>
                                  <i class="fa fa-long-arrow-up fa-fw"></i>Draft Sampling Info</strong>
                              </span>
                              <span class="small float-right text-muted">Draft Information</span>
                              <div class="dropdown-message small"> '.$res->jumlah_draft.' Draft in system</div>
                            </a>'; 

                            
                        
                }


        return $text;


    }

    function sent_email($data){
        //sent email-----------------------------------------------------------------
        $config = Array(
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1'
        );
        $this->load->library('email',$config);

        $this->email->from('hr@mdpi.or.id', "HR System");
        $this->email->to($data['email_to']);
        $this->email->subject($data['subject']);

        // $email_body = '
        // <html>
        //     <body>
        //         <p>Wellcome, Your Account has been created by admin. Please follow this link to update your profile data:</p>
        //         <p>http://localhost/sihr/profile/mainpage</p>
        //         <p>username : x</p>
        //         <p>password : x</p>
        //         <br>
        //         <br>
        //         <div><i>Have a nice day...</i></div>
        //     </body>
        // </html>';

        $this->email->message($data['email_body']);

        @$this->email->send();
    }

    function sent_email_easy($namafile){

        //sent email-----------------------------------------------------------------
        $config = Array(
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1'
        );
        $this->load->library('email',$config);

        $this->email->from('eclair.user@gmail.com', "AP2HI FishData");
        $this->email->to('winatamika@gmail.com');
        $this->email->subject('Testing Mail');

        echo $email_body = '
        <html>
            <body>
                <p>Dear AP2HI Administrator, Terdapat informasi trip baru yang telah diinput :</p>
                <p>Silahkan check pada link <a href="'.base_url().'sampling/mainpage/trip_detail/'.$namafile.'">ini</a></p>
                <br>
                <br>
                <div><i>Have a nice day...</i></div>
            </body>
        </html>';

        $this->email->message($email_body);

        $this->email->send();
    }




  public function getIdSupp($kode_name){

        $result = $this->db->query("Select id_supplier from master_supplier where kode_name = '".$kode_name."' ")->row();

        return $result;


    }
    


}