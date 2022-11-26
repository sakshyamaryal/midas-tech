<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employe extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->Model('employe_model');
    }


    function index()
    {     
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');  

            $this->form_validation->set_rules('EMPLOYENAME', 'EMPLOYENAME', 'required|alpha');
            $this->form_validation->set_rules('EMPLOYEID', 'EMPLOYEID', 'required|integer');
            $this->form_validation->set_rules('EMPLOYEMAIL', 'EMPLOYEMAIL', 'required|alpha');

            if ($this->form_validation->run() == FALSE) {
                $row =  $this->employe_model->getData();
                $data['row'] = $row;
                $this->load->view('employeview', $data);
               
            } else {
                echo 'posted';
            }

    }

    function show()
    {
        $data = $this->employe_model->getData();
        echo json_encode($data);
    }

    function delete()
    {
        // function delete 
        // should be same name of fuction given in href in delete btn
        $id = $this->input->get('id');
        $data = $this->employe_model->deleteData($id);
        echo json_encode($data);
        // $this->index();
        header('location:../employe');
        // calling from employmodel
    }

    function update()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $id = $this->input->get('updateid');
        $col =  $this->employe_model->getRowData($id);
        $data['col'] = $col;
        $this->load->view('employeview', $data);
        // header('location:../employe');

    }



    function saveEmployee()
    {

        $employename = $this->input->post('employename');
        $employeid = $this->input->post('employeid');
        $employemail = $this->input->post('employemail');
        $alldata = $this->employe_model->saveData($employename, $employeid, $employemail);
        // echo "test";die;

        if ($alldata) {
            $status = 'success';
        } else {
            $status = 'Failed';
        }

        echo json_encode(
            array(
                'status' => $status
            )
        );
    }
}
