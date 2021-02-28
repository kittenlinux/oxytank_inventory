<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  $this->db->from('tank');

  $count = $this->db->count_all_results();

  $this->db->select();
  $this->db->from('tank');

  $query = $this->db->get()->result_array();
?>

<section id="dashboard">
    <!-- Start Page Banner -->
    <div class="page-banner" style="padding:40px 0; background: #f9f9f9;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>ถังแก๊สออกซิเจน</h2>
                    <p>รายชื่อถังแก๊สออกซิเจนในระบบ</p>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumbs">
                        <li><a href="<?php echo base_url(); ?>">หน้าหลัก</a></li>
                        <li><a href="<?php echo base_url(); ?>Manage">จัดการข้อมูล</a></li>
                        <li>ถังแก๊สออกซิเจน</li>
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
                            <h4 class="classic-title"><span>รายชื่อถังแก๊สออกซิเจน</span></h4>
                            <p style="text-align: right;">
                                <button type="button" class="btn btn-success"
                                    onclick="location.href='<?php echo base_url();?>Manage/Tank_Add';">เพิ่มถังแก๊สออกซิเจน</button>
                                <button type="button" class="btn btn-primary"
                                    onclick="location.href='<?php echo base_url();?>Manage/Tank_AddBulk';">เพิ่มถังแก๊สออกซิเจนแบบต่อเนื่อง</button>
                            </p>

                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>หมายเลขตัวถัง</th>
                                        <th>สถานะ</th>
                                        <th>การดำเนินการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($count != 0) {
    $cnt = 0;

    foreach ($query as $tank) {
        $cnt++; ?>
                                    <tr>
                                        <td><span style='font-weight:bold'><?php echo $cnt ?></span></td>
                                        <td><?php echo $tank['tank_number'] ?></td>
                                        <td><?php if ($tank['status']=='1') {
            echo "<span style='color:green;font-weight:bold'>เปิด</span>";
        } elseif ($tank['status']=='0') {
            echo "<span style='color:red;font-weight:bold'>ปิด</span>";
        } ?></td>
                                        <td>
                                            <?php if ($tank['status']=='1') {?><button type="button"
                                                class="btn btn-danger"
                                                onclick="location.href='<?php echo base_url(); ?>Manage/Tank_Switch/<?php echo $tank['id']; ?>';">ปิด</button><?php } ?>
                                            <?php if ($tank['status']=='0') {?><button type="button"
                                                class="btn btn-success"
                                                onclick="location.href='<?php echo base_url(); ?>Manage/Tank_Switch/<?php echo $tank['id']; ?>';">เปิด</button><?php } ?>
                                            <button type="button" class="btn btn-primary"
                                                onclick="location.href='<?php echo base_url(); ?>Manage/Tank_Edit/<?php echo $tank['id']; ?>';">แก้ไข</button>
                                            <button type="button" class="btn btn-danger"
                                                onclick="Tank_delconfirm(<?php echo $tank['id']; ?>, '<?php echo $tank['tank_number'] ?>')">ลบ</button>
                                        </td>
                                    </tr>
                                    <?php
    }
} ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>หมายเลขตัวถัง</th>
                                        <th>สถานะ</th>
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
var newTitle = "ถังแก๊สออกซิเจน | Oxygen Tank Inventory";
if (document.title != newTitle) {
    document.title = newTitle;
}

$(document).ready(function() {
    $('#example').DataTable();
});

function Tank_delconfirm(id, tank_number) {
    Swal.fire({
        title: 'ยืนยันการลบถังแก๊สออกซิเจน ?',
        text: "ยืนยันการลบถังแก๊สออกซิเจน หมายเลขตัวถัง " + tank_number + " ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'ลบถังแก๊สออกซิเจน',
        cancelButtonText: 'ยกเลิก',
        allowEnterKey: 'false'
    }).then(function(result) {
        if (result.value) {
            window.location.href = "<?php echo base_url().'Manage/Tank_remove/' ?>" + id;
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