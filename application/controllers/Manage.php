<?php
defined('BASEPATH') or exit('No direct script access allowed');
 
class Manage extends Auth_Controller
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
        $this->render('manage/tank_view');
    }

    public function Tank()
    {
        $this->render('manage/tank_view');
    }

    public function Tank_Add()
    {
        $this->render('manage/tank_add_view');
    }

    public function Tank_AddBulk()
    {
        $this->render('manage/tank_addbulk_view');
    }

    public function Tank_Add_Action()
    {
        $this->form_validation->set_rules('tank_number', 'หมายเลขหัวถัง', 'trim|required|is_unique[tank.tank_number]');
        if ($this->form_validation->run()===false) {
            $errors = validation_errors();
            echo json_encode(['error'=>$errors]);
        } else {
            $data = array(
                'tank_number' => $_POST['tank_number'],
                'status' => '1'
            );
            $this->db->insert('tank', $data);
            echo json_encode(['success'=>'เพิ่มข้อมูลหมายเลขหัวถัง '.$_POST['tank_number'].' แล้ว !']);
            $_SESSION['result_message'] = 'เพิ่มข้อมูลหมายเลขหัวถัง '.$_POST['tank_number'].' แล้ว !';
            $_SESSION['result_message_type'] = 'success';
            $this->session->mark_as_flash('result_message');
        }
    }

    public function Tank_Edit($id)
    {
        $_SESSION['id']=$id;
        $this->render('manage/tank_edit_view');
    }

    public function Tank_Edit_Action($id)
    {
        $this->form_validation->set_rules('tank_number', 'หมายเลขหัวถัง', 'trim|required');
        $this->form_validation->set_rules('status', 'สถานะ', 'trim');
        if ($this->form_validation->run()===false) {
            $errors = validation_errors();
            echo json_encode(['error'=>$errors]);
        } else {
            $data = array(
                'tank_number' => $_POST['tank_number'],
                'status' => $_POST['status']
                );
            $this->db->where('id', $id);
            $this->db->update('tank', $data);
            echo json_encode(['success'=>'แก้ไขข้อมูลหมายเลขหัวถัง '.$_POST['tank_number'].' แล้ว !']);
            $_SESSION['result_message'] = 'แก้ไขข้อมูลหมายเลขหัวถัง '.$_POST['tank_number'].' แล้ว !';
            $_SESSION['result_message_type'] = 'success';
            $this->session->mark_as_flash('result_message');
        }
    }

    public function Tank_Switch($id)
    {
        $this->db->select(array('id','tank_number','status'));
        $this->db->from('tank');
        $this->db->where('id', $id);
    
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $query0 = $row->id;
            $query1 = $row->tank_number;
            $query2 = $row->status;
        }

        if ($query2=='1') {
            $new_status = '0';
            $new_status_desc = 'ปิดใช้งาน';
        } elseif ($query2=='0') {
            $new_status = '1';
            $new_status_desc = 'เปิดใช้งาน';
        }
    
        $data = array(
                'id' => $id,
                'status' => $new_status
            );
        $this->db->where('id', $query0);
        $this->db->update('tank', $data);

        $_SESSION['result_message'] = $new_status_desc.'ถังแก๊สออกซิเจน หมายเลขหัวถัง '.$query1.' แล้ว !';
        $_SESSION['result_message_type'] = 'success';
        $this->session->mark_as_flash('result_message');

        redirect('Manage/Tank');
    }

    public function Tank_Remove($id)
    {
        $this->db->select(array('id','tank_number'));
        $this->db->from('tank');
        $this->db->where('id', $id);
    
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $query0 = $row->tank_number;
        }

        $this->db->delete('tank', array(id => $id));

        $_SESSION['result_message'] = 'ลบถังแก๊สออกซิเจน หมายเลขหัวถัง '.$query0.' แล้ว !';
        $_SESSION['result_message_type'] = 'danger';
        $this->session->mark_as_flash('result_message');

        redirect('Manage/Tank');
    }

    public function Employee()
    {
        $this->render('manage/employee_view');
    }

    public function Employee_Add()
    {
        $this->render('manage/employee_add_view');
    }

    public function Employee_Add_Action()
    {
        $this->form_validation->set_rules('employee_name', 'ชื่อผู้ทำการเบิก-จ่าย', 'trim|required|is_unique[employee.employee_name]');

        if ($this->form_validation->run()===false) {
            $errors = validation_errors();
            echo json_encode(['error'=>$errors]);
        } else {
            $data = array(
                'employee_name' => $_POST['employee_name']
            );
            $this->db->insert('employee', $data);
            echo json_encode(['success'=>'เพิ่มข้อมูลชื่อผู้ทำการเบิก-จ่าย '.$_POST['employee_name'].' แล้ว !']);
            $_SESSION['result_message'] = 'เพิ่มข้อมูลชื่อผู้ทำการเบิก-จ่าย '.$_POST['employee_name'].' แล้ว !';
            $_SESSION['result_message_type'] = 'success';
            $this->session->mark_as_flash('result_message');
        }
    }

    public function Employee_Edit($id)
    {
        $_SESSION['id']=$id;
        $this->render('manage/employee_edit_view');
    }

    public function Employee_Edit_Action($id)
    {
        $this->form_validation->set_rules('employee_name', 'ชื่อผู้ทำการเบิก-จ่าย', 'trim|required');
        if ($this->form_validation->run()===false) {
            $errors = validation_errors();
            echo json_encode(['error'=>$errors]);
        } else {
            $data = array(
                'employee_name' => $_POST['employee_name']
                );
            $this->db->where('id', $id);
            $this->db->update('employee', $data);
            echo json_encode(['success'=>'แก้ไขข้อมูลชื่อผู้ทำการเบิก-จ่าย '.$_POST['employee_name'].' แล้ว !']);
            $_SESSION['result_message'] = 'แก้ไขข้อมูลชื่อผู้ทำการเบิก-จ่าย '.$_POST['employee_name'].' แล้ว !';
            $_SESSION['result_message_type'] = 'success';
            $this->session->mark_as_flash('result_message');
        }
    }

    public function Employee_Remove($id)
    {
        $this->db->select(array('id','employee_name'));
        $this->db->from('employee');
        $this->db->where('id', $id);
    
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $query0 = $row->employee_name;
        }

        $this->db->delete('employee', array(id => $id));

        $_SESSION['result_message'] = 'ลบชื่อผู้ทำการเบิก-จ่าย '.$query0.' แล้ว !';
        $_SESSION['result_message_type'] = 'danger';
        $this->session->mark_as_flash('result_message');

        redirect('Manage/Employee');
    }
}
