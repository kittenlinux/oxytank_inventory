<?php
defined('BASEPATH') or exit('No direct script access allowed');
 
class Printing extends Auth_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->helper('date');
    }
    
    public function index()
    {
        $this->render('printing/index_view');
    }

    public function View($start_date='all', $end_date='all', $status='all')
    {
        $_SESSION['pr_start_date']=$start_date;
        $_SESSION['pr_end_date']=$end_date;
        $_SESSION['pr_status']=$status;
                
        $this->render('printing/table_view', 'plain');
    }

    public function View_Action()
    {
        if (isset($_POST['start_date'])&&isset($_POST['end_date'])&&isset($_POST['status'])) {
            redirect('Printing/View/'.$_POST['start_date'].'/'.$_POST['end_date'].'/'.$_POST['status'].'/');
        } else {
            redirect('Printing');
        }
    }
}
