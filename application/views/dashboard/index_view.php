<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  $user = $this->ion_auth->user()->row();

  $this->db->from('inventory');

  $count = $this->db->count_all_results();

  $this->db->select();
  $this->db->from('inventory');

  $query = $this->db->get()->result_array();
?>

<section id="dashboard">
    <!-- Start Page Banner -->
    <div class="page-banner" style="padding:40px 0; background: #f9f9f9;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>จัดการข้อมูล</h2>
                    <p>จัดการรายละเอียดการเบิก-จ่ายถังออกซิเจน</p>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumbs">
                        <li><a href="<?php echo base_url(); ?>">หน้าหลัก</a></li>
                        <li>จัดการข้อมูล</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Banner -->

    <!-- Set active navigator bar menu -->
    <script>
    var nav_bar_active = 'nav-bar-dashboard';
    </script>

    <!-- Start Content -->
    <div id="content">
        <div class="container">
            <div class="page-content">
                <div class="row">
                    <?php echo isset($_SESSION['result_message']) ? "<div class=\"alert alert-".$_SESSION['result_message_type']."\">".$_SESSION['result_message']."</div>" : false; ?>
                    <div class="container">

                        <div class="col-md-12">

                            <!-- Classic Heading -->
                            <h4 class="classic-title"><span>ช่วงระยะเวลารายการ</span></h4>
                            <!-- Start Contact Form -->
                            <form method="post" accept-charset="utf-8" role="form" class="contact-form"
                                action=<?php echo base_url()."Maps/View_Action/"?>>
                                <div class="alert alert-danger print-error-msg" style="display:none"></div>
                                <div class="col-md-3">
                                    <label for="start_date">วันที่เริ่มต้น :</label>
                                    <div class="form-group">
                                        <div class="controls">
                                            <div class='input-group date' id='datetimepicker_startdate'>
                                                <input type='text' class="form-control" id="start_date"
                                                    name="start_date" required onchange="enable_submit()"
                                                    onfocus="enable_submit()" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="end_date">วันที่สิ้นสุด :</label>
                                    <div class="form-group">
                                        <div class="controls">
                                            <div class='input-group date' id='datetimepicker_enddate'>
                                                <input type='text' class="form-control" id="end_date" name="end_date"
                                                    required onchange="enable_submit()" onfocus="enable_submit()" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" id="submit" class="btn btn-success">ยืนยัน</button>
                                </div>
                            </form>
                        </div>
                        <!-- End Contact Form -->

                        <div class="col-md-12">
                            <h4 class="classic-title"><span>รายละเอียดรายการ</span></h4>
                            <p style="text-align: right;">
                                <button type="button" class="btn btn-primary"
                                    onclick="location.href='<?php echo base_url();?>Dashboard/Bike_Add';">เบิกถังออกซิเจน</button>
                            </p>

                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>หมายเลขตัวถัง</th>
                                        <th>วันที่เบิก</th>
                                        <th>ชื่อผู้เบิก</th>
                                        <th>วันที่นำส่งคืน</th>
                                        <th>ชื่อผู้นำส่งคืน</th>
                                        <th>สถานะ</th>
                                        <th>การดำเนินการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>12345</td>
                                        <td>01/01/2021</td>
                                        <td>พิกุลทอง</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>ยังไม่นำส่ง</td>
                                        <td>x</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>55656</td>
                                        <td>20/01/2021</td>
                                        <td>พจมาน</td>
                                        <td>25/01/2021</td>
                                        <td>พิกุลทอง</td>
                                        <td>นำส่งแล้ว</td>
                                        <td>x</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>หมายเลขตัวถัง</th>
                                        <th>วันที่เบิก</th>
                                        <th>ชื่อผู้เบิก</th>
                                        <th>วันที่นำส่งคืน</th>
                                        <th>ชื่อผู้นำส่งคืน</th>
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
var newTitle = "จัดการข้อมูล | Oxygen Tank Inventory";
if (document.title != newTitle) {
    document.title = newTitle;
}

$(document).ready(function() {
    $('#example').DataTable();
});

function Linenoti_delconfirm() {
    Swal.fire({
        title: 'ยืนยันการลบโทเค็น ?',
        text: "หากต้องการใช้งานการแจ้งเตือนอีกครั้ง จะต้องนำโทเค็นไลน์โนติฟายมาเพิ่มเข้าสู่ระบบในภายหลัง",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'ใช่ ต้องการลบ',
        cancelButtonText: 'ยกเลิก',
        allowEnterKey: 'false'
    }).then(function(result) {
        if (result.value) {
            // Swal.fire(
            //     title: 'สำเร็จ!',
            //     text: 'ลบโทเค็นเรียบร้อยแล้ว.',
            //     icon: 'success'
            // )
            window.location.href =
                "<?php echo base_url().'Dashboard/LINENotify_Remove/'.$user->lineapi_key; ?>";
        }
    })
}

function Bike_switchconfirm(bike_key, bike_plate) {
    Swal.fire({
        title: 'ยืนยันการเปลี่ยนสถานะ ?',
        text: "ยืนยันการเปลี่ยนสถานะรถจักรยานยนต์ หมายเลขทะเบียน " + bike_plate + " ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        allowEnterKey: 'true'
    }).then(function(result) {
        if (result.value) {
            // Swal.fire(
            //     title: 'สำเร็จ!',
            //     text: 'ลบโทเค็นเรียบร้อยแล้ว.',
            //     icon: 'success'
            // )
            window.location.href = "<?php echo base_url().'Dashboard/Bike_Switch/'; ?>" + bike_key;
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