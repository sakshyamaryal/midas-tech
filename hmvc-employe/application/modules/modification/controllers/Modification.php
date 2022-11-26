<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modification extends MX_Controller {

    public function __construct(){
        parent:: __construct();
        $this->load->Model('modification_model');
    }

    function index(){
        $row = $this->modification_model->getDetails();
        $data['row'] = $row;
        $this->load->view('modificationview',$data);
    }

    function saveModification(){
        $projectname = $this->input->post('projectname');
        $modificationid = $this->input->post('modificationid');
        $purpose = $this->input->post('purpose');
        $oldvalue = $this->input->post('oldvalue');
        $newalter = $this->input->post('newalter');

        $alldata = $this->modification_model->saveData($projectname,$modificationid,$purpose,$oldvalue,$newalter);

        if($alldata){
            $status = 'success';
        }
        else{
            $status = 'failed';
        }

        echo json_encode(
            array(
                'status'=>$status
            )
        );
    }
    function updateModification(){

    }

    function delete(){
        $id = $this->input->get('id'); 
        $this->load->Model('modification_model');
        $this->modification_model->deleteData($id);
    }

}
?>