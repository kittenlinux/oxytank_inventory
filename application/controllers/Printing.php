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

    public function View($start_date, $end_date, $status)
    {
        $_SESSION['pr_start_date']=$start_date;
        $_SESSION['pr_end_date']=$end_date;
        $_SESSION['pr_status']=$status;
                
        $this->render('printing/table_view', 'plain');
    }

    // public function View_Action()
    // {
    //     if (isset($_POST['bike'])&&isset($_POST['start_date'])&&isset($_POST['end_date'])) {
    //         redirect('Maps/View/'.$_POST['bike'].'/'.strtotime($_POST['start_date']).'/'.strtotime($_POST['end_date']).'/');
    //     } else {
    //         redirect('Maps');
    //     }
    // }
}
