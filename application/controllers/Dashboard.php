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
