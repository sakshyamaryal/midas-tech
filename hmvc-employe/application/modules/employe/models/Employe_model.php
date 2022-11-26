<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employe_model extends CI_Model{
    public function __construct(){
        parent:: __construct();
        $this->db=$this->load->database('default',true); // no need for now
    }
    
    function getData(){
        // $this->db->select('EMPLOYENAME','EMPLOYEID','EMPLOYEMAIL');
        $query = $this->db
        ->get('EMPLOYE')
        ->result_array();
        //this method return all record from employe table
        //select all from employe
        return $query;
    }
    function getRowData($id){
       
        $this->db
        ->select('*')
        ->where('EMPLOYEID',$id);
        $data = $this->db
        ->get('EMPLOYE');
        return $data->row();
    }
    

    function saveData($employename,$employeid,$employemail)
    {
        $getData=$this->db->set('EMPLOYENAME',$employename)
                                ->set('EMPLOYEID',$employeid)
                                ->set('EMPLOYEMAIL',$employemail);
                                // ->set('ID',$next_id)
                                

        $update = $this->getFetchedData($employeid);
        if($update->num_rows()){
            $this->db->where('EMPLOYEID',$employeid);
            $this->db->update('EMPLOYE');
        }
        else{
            $this->db->insert('EMPLOYE');
        }
        //checking
        if($getData){
            return true;
        }else{
            return false;
        }
    }

    function getFetchedData($id){
       $data = $this->db->get_where('EMPLOYE', array('EMPLOYEID'=>$id));
        return $data; //array halna baki
    }

    function deleteData($id){
        // $this->db->delete('modification', array('modificationid' => $modificationid));
        $this->db->where('employeid', $id);
        $this->db->delete('employe');
    }
}
