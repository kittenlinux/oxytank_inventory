<?php
defined('BASEPATH') or exit('No direct script access allowed');
 
class Dashboard extends Auth_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url', 'file'));
    }
    
    public function index()
    {
        $this->render('dashboard/index_view');
    }

    public function Take_Add()
    {
        $this->render('dashboard/take_add_view');
    }

    public function Take_Add_Action()
    {
        $this->form_validation->set_rules('take_date', 'วันที่ทำรายการ', 'trim|required');
        $this->form_validation->set_rules('take_name', 'ชื่อผู้เบิก', 'trim|required');
        $this->form_validation->set_rules('tank_number', 'หมายเลขตัวถัง', 'trim|required');
        if ($this->form_validation->run()===false) {
            $errors = validation_errors();
            echo json_encode(['error'=>$errors]);
        } else {
            $data = array(
                'take_date' => $_POST['take_date'],
                'take_name' => $_POST['take_name'],
                'tank_number' => $_POST['tank_number'],
                'status' => '0'
            );
            $this->db->insert('inventory', $data);
            echo json_encode(['success'=>'เพิ่มข้อมูลการเบิกของถังแก๊สออกซิเจน หมายเลขตัวถัง '.$_POST['tank_number'].' แล้ว !']);
            $_SESSION['result_message'] = 'เพิ่มข้อมูลการเบิกของถังแก๊สออกซิเจน หมายเลขตัวถัง '.$_POST['tank_number'].' แล้ว !';
            $_SESSION['result_message_type'] = 'success';
            $this->session->mark_as_flash('result_message');
        }
    }

    public function Returning($id)
    {
        $this->render('dashboard/return_view');
    }

    public function Returning_Action($id)
    {
    }

    public function Data_Edit_Take($id)
    {
        $_SESSION['id']=$id;
        $this->render('dashboard/data_edit_takeview');
    }

    public function Data_Edit_TakeAction($id)
    {
    }

    public function Data_Edit_TakeReturn($id)
    {
        $_SESSION['id']=$id;
        $this->render('dashboard/data_edit_takereturnview');
    }

    public function Data_Edit_TakeReturnAction($id)
    {
    }

    public function Data_Remove($id)
    {
    }
}
