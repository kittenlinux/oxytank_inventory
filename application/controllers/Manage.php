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

    public function Tank_Add_Action()
    {
        $this->form_validation->set_rules('tank_number', 'หมายเลขตัวถัง', 'trim|required|is_unique[tank.tank_number]');
        if ($this->form_validation->run()===false) {
            $errors = validation_errors();
            echo json_encode(['error'=>$errors]);
        } else {
            $data = array(
                'tank_number' => $_POST['tank_number'],
                'status' => '1'
            );
            $this->db->insert('tank', $data);
            echo json_encode(['success'=>'เพิ่มข้อมูลหมายเลขตัวถัง '.$_POST['tank_number'].' แล้ว !']);
            $_SESSION['result_message'] = 'เพิ่มข้อมูลหมายเลขตัวถัง '.$_POST['tank_number'].' แล้ว !';
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
        $this->form_validation->set_rules('tank_number', 'หมายเลขตัวถัง', 'trim|required');
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
            echo json_encode(['success'=>'แก้ไขข้อมูลหมายเลขตัวถัง '.$_POST['tank_number'].' แล้ว !']);
            $_SESSION['result_message'] = 'แก้ไขข้อมูลหมายเลขตัวถัง '.$_POST['tank_number'].' แล้ว !';
            $_SESSION['result_message_type'] = 'success';
            $this->session->mark_as_flash('result_message');

            $_SESSION['bike_key']='';
        }
    }

    public function Tank_Remove($id)
    {
        $this->db->delete('tank', array(id => $id));

        $_SESSION['result_message'] = 'ลบถังออกซิเจนแล้ว !';
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
        $this->render('manage/tank_add_view');
    }

    public function Employee_Add_Action()
    {
        $this->form_validation->set_rules('employee_name', 'ชื่อผู้เบิก', 'trim|required|is_unique[employee.employee_name]');

        if ($this->form_validation->run()===false) {
            $errors = validation_errors();
            echo json_encode(['error'=>$errors]);
        } else {
            $data = array(
                'employee_name' => $_POST['employee_name'],
                'status' => '1'
            );
            $this->db->insert('tank', $data);
            echo json_encode(['success'=>'เพิ่มข้อมูลชื่อผู้เบิก '.$_POST['employee_name'].' แล้ว !']);
            $_SESSION['result_message'] = 'เพิ่มข้อมูลชื่อผู้เบิก '.$_POST['employee_name'].' แล้ว !';
            $_SESSION['result_message_type'] = 'success';
            $this->session->mark_as_flash('result_message');
        }
    }

    public function Employee_Edit($id)
    {
        $this->render('manage/employee_edit_view');
    }

    public function Employee_Edit_Action($id)
    {
    }

    public function Employee_Remove($id)
    {
    }

    // public function Bike_Switch($bike_key)
    // {
    //     $user = $this->ion_auth->user()->row();
        
    //     $this->db->select(array('key','user','status'));
    //     $this->db->from('bike');
    //     $this->db->where('key', $bike_key);
    
    //     $query = $this->db->get();
    //     foreach ($query->result() as $row) {
    //         $query1 = $row->key;
    //         $query2 = $row->user;
    //         $query3 = $row->status;
    //     }

    //     if ($query2 == null) {
    //         redirect('Dashboard');
    //     } elseif ($user->id==$query2) {
    //         if ($query3=='1') {
    //             $new_status = '0';
    //             $new_status_desc = 'ปิดใช้งาน';
    //         } elseif ($query3=='0') {
    //             $new_status = '1';
    //             $new_status_desc = 'เปิดใช้งาน';
    //         }

    //         $user = $this->ion_auth->user()->row();

    //         $this->db->select(array('id', 'key', 'plate', 'status'));
    //         $this->db->from('bike');
    //         $this->db->where('key', $bike_key);

    //         $query2 = $this->db->get();
    
    //         $data = array(
    //             'id' => $query2->row()->id,
    //             'status' => $new_status
    //         );
    //         $this->db->where('id', $query2->row()->id);
    //         $this->db->update('bike', $data);

    //         $_SESSION['result_message'] = $new_status_desc.'รถจักรยานยนต์หมายเลขทะเบียน '.$query2->row()->plate.' แล้ว !';
    //         $_SESSION['result_message_type'] = 'success';
    //         $this->session->mark_as_flash('result_message');

    //         redirect('Dashboard');
    //     }
    // }
}
