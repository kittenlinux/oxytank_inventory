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
        $this->render('dashboard/bikeadd_view');
    }

    public function Take_Add_Action()
    {
        $this->form_validation->set_rules('plate', 'หมายเลขทะเบียนรถ', 'trim|required|is_unique[bike.plate]');
        $this->form_validation->set_rules('model', 'ยี่ห้อ รุ่น', 'trim|required');
        $this->form_validation->set_rules('color', 'สี', 'trim|required');

        if ($this->form_validation->run()===false) {
            $errors = validation_errors();
            echo json_encode(['error'=>$errors]);
        } else {
            $user = $this->ion_auth->user()->row();

            $data = array(
                'user' => $user->id,
                'key' => bin2hex(openssl_random_pseudo_bytes(16)),
                'plate' => $_POST['plate'],
                'model' => $_POST['model'],
                'color' => $_POST['color'],
                'reg_date' => date('Y-m-d H:i:s'),
                'status' => '1'
            );
            $this->db->insert('bike', $data);

            echo json_encode(['success'=>'เพิ่มข้อมูลรถจักรยานยนต์ หมายเลขทะเบียน '.$_POST['plate'].' แล้ว !']);

            $_SESSION['result_message'] = 'เพิ่มข้อมูลรถจักรยานยนต์ หมายเลขทะเบียน '.$_POST['plate'].' แล้ว !';
            $_SESSION['result_message_type'] = 'success';
            $this->session->mark_as_flash('result_message');
        }
    }

    public function Bike_Edit($bike_key)
    {
        $user = $this->ion_auth->user()->row();
        
        $this->db->select(array('key','user'));
        $this->db->from('bike');
        $this->db->where('key', $bike_key);
    
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $query1 = $row->key;
            $query2 = $row->user;
        }

        if ($query2 == null) {
            redirect('Dashboard');
        } elseif ($user->id==$query2) {
            $_SESSION['bike_key']=$bike_key;
                
            $this->render('dashboard/bikeedit_view');
        }
    }

    public function Bike_Edit_Action($bike_key)
    {
        $user = $this->ion_auth->user()->row();
        
        $this->db->select(array('key','user'));
        $this->db->from('bike');
        $this->db->where('key', $bike_key);
    
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $query1 = $row->key;
            $query2 = $row->user;
        }

        if ($query2 == null) {
            redirect('Dashboard');
        } elseif ($user->id==$query2) {
            $this->form_validation->set_rules('model', 'ยี่ห้อ รุ่น', 'trim|required');
            $this->form_validation->set_rules('color', 'สี', 'trim|required');
    
            if ($this->form_validation->run()===false) {
                $errors = validation_errors();
                echo json_encode(['error'=>$errors]);
            } else {
                $user = $this->ion_auth->user()->row();

                $this->db->select(array('id', 'plate'));
                $this->db->from('bike');
                $this->db->where('key', $bike_key);

                $query2 = $this->db->get();
    
                $data = array(
                    'id' => $query2->row()->id,
                    'key' => $bike_key,
                    'model' => $_POST['model'],
                    'color' => $_POST['color']
                );
                $this->db->where('id', $query2->row()->id);
                $this->db->update('bike', $data);

                echo json_encode(['success'=>'แก้ไขข้อมูลรถจักรยานยนต์หมายเลขทะเบียน '.$query2->row()->plate.' แล้ว !']);
    
                $_SESSION['result_message'] = 'แก้ไขข้อมูลรถจักรยานยนต์หมายเลขทะเบียน '.$query2->row()->plate.' แล้ว !';
                $_SESSION['result_message_type'] = 'success';
                $this->session->mark_as_flash('result_message');

                $_SESSION['bike_key']='';
            }
        }
    }

    public function Bike_Switch($bike_key)
    {
        $user = $this->ion_auth->user()->row();
        
        $this->db->select(array('key','user','status'));
        $this->db->from('bike');
        $this->db->where('key', $bike_key);
    
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $query1 = $row->key;
            $query2 = $row->user;
            $query3 = $row->status;
        }

        if ($query2 == null) {
            redirect('Dashboard');
        } elseif ($user->id==$query2) {
            if ($query3=='1') {
                $new_status = '0';
                $new_status_desc = 'ปิดใช้งาน';
            } elseif ($query3=='0') {
                $new_status = '1';
                $new_status_desc = 'เปิดใช้งาน';
            }

            $user = $this->ion_auth->user()->row();

            $this->db->select(array('id', 'key', 'plate', 'status'));
            $this->db->from('bike');
            $this->db->where('key', $bike_key);

            $query2 = $this->db->get();
    
            $data = array(
                'id' => $query2->row()->id,
                'status' => $new_status
            );
            $this->db->where('id', $query2->row()->id);
            $this->db->update('bike', $data);

            $_SESSION['result_message'] = $new_status_desc.'รถจักรยานยนต์หมายเลขทะเบียน '.$query2->row()->plate.' แล้ว !';
            $_SESSION['result_message_type'] = 'success';
            $this->session->mark_as_flash('result_message');

            redirect('Dashboard');
        }
    }


    public function Bike_Remove($bike_key)
    {
        $user = $this->ion_auth->user()->row();
        
        $this->db->select(array('key','user'));
        $this->db->from('bike');
        $this->db->where('key', $bike_key);
    
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $query1 = $row->key;
            $query2 = $row->user;
        }

        if ($query2 == null) {
            redirect('Dashboard');
        } elseif ($user->id==$query2) {
            $this->db->delete('bike', array(key => $bike_key));

            $_SESSION['result_message'] = 'ลบรถจักรยานยนต์แล้ว !';
            $_SESSION['result_message_type'] = 'danger';
            $this->session->mark_as_flash('result_message');

            redirect('Dashboard');
        }
    }

}