<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  $this->db->from('employee');

  $count = $this->db->count_all_results();

  $this->db->select();
  $this->db->from('employee');

  $query = $this->db->get()->result_array();
?>

<section id="dashboard">
    <!-- Start Page Banner -->
    <div class="page-banner" style="padding:40px 0; background: #f9f9f9;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>ชื่อผู้ทำการเบิก-จ่าย</h2>
                    <p>รายชื่อผู้ทำการเบิก-จ่ายในระบบ</p>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumbs">
                        <li><a href="<?php echo base_url(); ?>">หน้าหลัก</a></li>
                        <li><a href="<?php echo base_url(); ?>Manage">จัดการข้อมูล</a></li>
                        <li>ชื่อผู้ทำการเบิก-จ่าย</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Banner -->

    <!-- Set active navigator bar menu -->
    <script>
    var nav_bar_active = 'nav-bar-manage';
    </script>

    <!-- Start Content -->
    <div id="content">
        <div class="container">
            <div class="page-content">
                <div class="row">
                    <?php echo isset($_SESSION['result_message']) ? "<div class=\"alert alert-".$_SESSION['result_message_type']."\">".$_SESSION['result_message']."</div>" : false; ?>
                    <div class="container">
                        <div class="col-md-12">
                            <h4 class="classic-title"><span>รายชื่อผู้ทำการเบิก-จ่าย</span></h4>
                            <p style="text-align: right;">
                                <button type="button" class="btn btn-success"
                                    onclick="location.href='<?php echo base_url();?>Manage/Employee_Add';">เพิ่มชื่อผู้ทำการเบิก-จ่าย</button>
                            </p>

                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>ชื่อผู้ทำการเบิก-จ่าย</th>
                                        <th>การดำเนินการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($count != 0) {
    $cnt = 0;

    foreach ($query as $employee) {
        $cnt++; ?>
                                    <tr>
                                        <td><span style='font-weight:bold'><?php echo $cnt ?></span></td>
                                        <td><?php echo $employee['employee_name'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary"
                                                onclick="location.href='<?php echo base_url(); ?>Manage/Employee_Edit/<?php echo $employee['id']; ?>';">แก้ไข</button>
                                            <button type="button" class="btn btn-danger"
                                                onclick="Employee_delconfirm(<?php echo $employee['id']; ?>, '<?php echo $employee['employee_name'] ?>')">ลบ</button>
                                        </td>
                                    </tr>
                                    <?php
    }
} ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>ชื่อผู้ทำการเบิก-จ่าย</th>
                                        <th>การดำเนินการ</th>
                                    </tr>
                                </tfoot>
                            </table>

                            <!-- Some Text -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End content -->
    </div>
</section>

<script>
var newTitle = "ชื่อผู้ทำการเบิก-จ่าย | Oxygen Tank Inventory";
if (document.title != newTitle) {
    document.title = newTitle;
}

$(document).ready(function() {
    $('#example').DataTable();
});

function Employee_delconfirm(id, employee_name) {
    Swal.fire({
        title: 'ยืนยันการลบผู้ทำการเบิก-จ่าย ?',
        text: "ยืนยันการลบชื่อผู้ทำการเบิก-จ่าย " + employee_name + " ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'ลบชื่อผู้ทำการเบิก-จ่าย',
        cancelButtonText: 'ยกเลิก',
        allowEnterKey: 'false'
    }).then(function(result) {
        if (result.value) {
            window.location.href = "<?php echo base_url().'Manage/Employee_remove/' ?>" + id;
        }
    })
}

$(document).ready(function() {

});

var todayDate = new Date().getDate();
var todaySeconds = new Date().getSeconds();
var start_date = new Date(new Date().setDate(todayDate - 1))
$(function() {
    $('#datetimepicker_startdate').datetimepicker({
        format: "YYYY-MM-DD",
        useCurrent: false,
        defaultDate: new Date(start_date.setDate(todayDate - 30)),
        maxDate: new Date()
    });
    $('#datetimepicker_enddate').datetimepicker({
        format: "YYYY-MM-DD",
        useCurrent: false,
        defaultDate: new Date(new Date().setDate(todayDate)),
        maxDate: new Date()
    });
});
</script>