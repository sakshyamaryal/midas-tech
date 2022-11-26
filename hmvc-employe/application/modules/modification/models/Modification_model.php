<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modification_model extends CI_Model{
    public function __construct(){
        parent:: __construct();
        $this->db=$this->load->database('default',true); // no need for now
    }

    function saveData($projectname,$modificationid,$purpose,$oldvalue,$newalter)
    {
        $getData = $this->db->set('projectname',$projectname)
        ->set('modificationid',$modificationid)
        ->set('purpose',$purpose)
        ->set('oldvalue',$oldvalue)
        ->set('newalter',$newalter)

        ->insert('modification');


        if($getData){
            return true;
        }
        else{
            return false;
        }

    }
    function getDetails(){
        $query = $this->db->get('modification')->result_array();
        return $query;
    }

    function updateData(){

    }
    
    function deleteData($id){
        // $this->db->delete('modification', array('modificationid' => $modificationid));
        $this->db->where('modificationid', $id);
        $this->db->delete('modification');
    }
}
?>
