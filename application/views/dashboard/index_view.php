<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  $user = $this->ion_auth->user()->row();

  $this->db->from('inventory');

  $count = $this->db->count_all_results();

  $this->db->select();
  $this->db->from('inventory');
  $this->db->order_by('id', 'DESC');

  $query = $this->db->get()->result_array();
?>

<section id="dashboard">
    <!-- Start Page Banner -->
    <div class="page-banner" style="padding:40px 0; background: #f9f9f9;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>ข้อมูลการเบิก-จ่าย</h2>
                    <p>จัดการรายละเอียดการเบิก-จ่ายถังแก๊สออกซิเจน</p>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumbs">
                        <li><a href="<?php echo base_url(); ?>">หน้าหลัก</a></li>
                        <li>ข้อมูลการเบิก-จ่าย</li>
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
                        <div class="col-md-12" style="padding-bottom: 15px;">
                            <!-- Classic Heading -->
                            <h4 class="classic-title"><span>ช่วงระยะเวลารายการ</span></h4>
                            <!-- Start Contact Form -->
                            <form method="post" accept-charset="utf-8" role="form" class="contact-form"
                                action=<?php echo base_url()."Maps/View_Action/"?>>
                                <div class="alert alert-danger print-error-msg" style="display:none"></div>
                                <div class="col-md-4">
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
                                <div class="col-md-4">
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
                                <div class="col-md-4">
                                    <label for="end_date">สถานะ :</label>
                                    <div class="form-group">
                                        <div class="controls">
                                            <select class="form-control" id="status" name="status"">
                                            <option value=" all" selected>ทั้งหมด</option>
                                                <option value="0">ยังไม่นำส่ง</option>
                                                <option value="1">นำส่งแล้ว</option>
                                            </select>
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
                                <button type="button" class="btn btn-success"
                                    onclick="location.href='<?php echo base_url();?>Dashboard/Take_Add';">เบิกถังแก๊สออกซิเจน</button>
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
                                    <?php if ($count != 0) {
    $cnt = 0;

    foreach ($query as $inventory) {
        $cnt++; ?>
                                    <tr>
                                        <td><span style='font-weight:bold'><?php echo $cnt ?></span></td>
                                        <td><?php echo $inventory['tank_number'] ?></td>
                                        <td><?php echo $inventory['take_date'] ?></td>
                                        <td><?php echo $inventory['take_name'] ?></td>
                                        <?php if ($inventory['status']=='0') { ?>
                                        <td><?php echo "-" ?></td>
                                        <td><?php echo "-" ?></td><?php } elseif ($inventory['status']=='1') { ?>
                                        <td><?php echo $inventory['return_date'] ?></td>
                                        <td><?php echo $inventory['return_name'] ?></td><?php } ?>
                                        <td><?php if ($inventory['status']=='0') {
            echo "<span style='color:red;font-weight:bold'>ยังไม่นำส่ง</span>";
        } elseif ($inventory['status']=='1') {
            echo "<span style='color:green;font-weight:bold'>นำส่งแล้ว</span>";
        } ?></td>
                                        <td>
                                            <?php if ($inventory['status']=='0') { ?>
                                            <button type="button" class="btn btn-success"
                                                onclick="location.href='<?php echo base_url(); ?>Dashboard/Returning/<?php echo $inventory['id']; ?>';">น่าส่ง</button>
                                            <button type="button" class="btn btn-primary"
                                                onclick="location.href='<?php echo base_url(); ?>Dashboard/Data_Edit_Take/<?php echo $inventory['id']; ?>';">แก้ไข</button>
                                            <?php } elseif ($inventory['status']=='1') { ?>
                                            <button type="button" class="btn btn-primary"
                                                onclick="location.href='<?php echo base_url(); ?>Dashboard/Data_Edit_TakeReturn/<?php echo $inventory['id']; ?>';">แก้ไข</button>
                                            <?php } ?>
                                            <button type="button" class="btn btn-danger"
                                                onclick="Tank_delconfirm(<?php echo $inventory['id']; ?>, '<?php echo $inventory['tank_number'] ?>')">ลบ</button>
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
var newTitle = "ข้อมูลการเบิก-จ่าย | Oxygen Tank Inventory";
if (document.title != newTitle) {
    document.title = newTitle;
}

$(document).ready(function() {
    $('#example').DataTable();
});

$(document).ready(function() {

});

var todayDate = new Date().getDate();
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