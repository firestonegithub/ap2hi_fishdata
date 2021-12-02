<?php

require_once( "class.treeManager.php" );

class Menu_model extends CI_Model{



    function __construct(){

        parent::__construct();

        $this->load->database();

    }



    function gen_menu($link){

        $user = $this->auth->get_data_session();

        $arrs = $user->arr_menu;


        $treeManager  = treeManager::get();

        $recordsTree  = $treeManager->getTree( $arrs );

        $q_menu = $this->db->query("SELECT * FROM tb_menu WHERE link='".$link."'");

        $q_menu_ = $q_menu->row();


        $bapaknya = $this->find_pat($arrs,(isset($q_menu_->id_menu)?$q_menu_->id_menu:''));

      
        return $this->build_menu1($recordsTree,$bapaknya);

    }



    function find_pat($a, $n, $key='id_menu' ){

        $out = array();

        foreach ($a as $r){

            if ($r[$key] == $n){

                $out = $this->find_pat($a, $r['parent'],'id_menu');

                $out[]=$r;

            }

        }

        return $out;

    }



    function searchForId($id, $array) {

        foreach ($array as $row) {

            if ($row['id_menu'] == $id) {

               return true;

            }

        }

    }



    function build_menu1($arrs,$aktif,$istree='',$menu_id=''){


        $init = '';

        foreach ($arrs as $arr) {


             if ($this->auth->is_logged_in() && $this->auth->hasPrivilege($arr['perm_desc']) || $this->ChildPrivilege($arr['id_menu'])) {

                 $init .= '

                 <li class="nav-item '.($this->searchForId($arr['id_menu'], $aktif)?'active':'').'" data-toggle="tooltip" data-placement="right" title="'.$arr['description'].'">
                     
                      <a class="nav-link '.(count($arr['children'])>0?'nav-link-collapse collapsed':'').'"  href="'.(count($arr['children'])>0? $arr['link'] : base_url().$arr['link'] ).'" '.(count($arr['children'])>0?' data-toggle="collapse" ':'').' data-parent="#exampleAccordion">
                        
                        <i class="fa fa-fw '.$arr['icon'].'"></i>
                       
                        <span class="nav-link-text">'.$arr['description'].'</span>
                      
                      </a> 


                        '.(count($arr['children'])>0?$this->build_menu2($arr['children'],$aktif,'1',$arr['id_menu'] , str_replace("#","", $arr['link'] ) ):'').'


                 </li>

                ';

                }

        }

        $init .= '

            </li>';

        return $init;

    }

    function build_menu2( $arrs,$aktif,$istree='',$menu_id='' , $cssId) {


        $init = '<ul class="sidenav-second-level collapse" id="'.$cssId.'">';

        foreach ($arrs as $arr) {


            $init .= '
                            <li>
                              <a href="'.base_url().$arr['link'].'">'.$arr['description'].'</a>
                            </li>
                          ' ;

        }

        $init .= '</ul>';

        return $init; 
    }



    function arrChildPrivilege($arrs, $parent=0, $level=0){

        $check = '';

        foreach ($arrs as $arr) {

            if ($arr['parent'] == $parent) {

                if ($this->auth->hasPrivilege($arr['perm_desc'])) {

                    $check .= ',ya';

                }

                else{

                    $check .= ',tidak';   

                }

                $check .= $this->arrChildPrivilege($arrs, $arr['id_menu'], $level+1);

            }

        }

        return $check;

    }



    function ChildPrivilege($id_parent){

        $user = $this->auth->get_data_session();

        $arrs = $user->arr_menu;



        $arrhasil = explode(',', substr($this->arrChildPrivilege($arrs,$id_parent), 1));

        if (in_array('ya', $arrhasil)) {

            return true;

        }

    }

}

?>