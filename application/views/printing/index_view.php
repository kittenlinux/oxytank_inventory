<?php
  defined('BASEPATH') or exit('No direct script access allowed');
?>

<section id="maps">
    <!-- Start Page Banner -->
    <div class="page-banner" style="padding:40px 0; background: #f9f9f9;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>สั่งพิมพ์ข้อมูล</h2>
                    <p>จัดข้อมูลตามระยะเวลาที่กำหนด เพื่อการพิมพ์หรือนำไปใช้ประโยชน์ด้านอื่น ๆ</p>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumbs">
                        <li><a href="<?php echo base_url(); ?>">หน้าหลัก</a></li>
                        <li>สั่งพิมพ์ข้อมูล</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Banner -->

    <!-- Set active navigator bar menu -->
    <script>
    var nav_bar_active = 'nav-bar-printing';
    </script>

    <!-- Start Content -->
    <div id="content">
        <div class="container">
            <div class="page-content">
                <div class="row">
                    <?php echo isset($_SESSION['result_message']) ? "<div class=\"alert alert-".$_SESSION['result_message_type']."\">".$_SESSION['result_message']."</div>" : false; ?>
                    <div class="col-md-12">
                        <!-- Classic Heading -->
                        <h4 class="classic-title"><span>ช่วงเวลาที่ต้องการพิมพ์ข้อมูล</span></h4>

                        <!-- Start Contact Form -->
                        <form method="post" accept-charset="utf-8" role="form" class="contact-form"
                            action="<?php echo base_url()."Printing/View_Action"?>" target="_blank">
                            <div class="alert alert-danger print-error-msg" style="display:none"></div>
                            <div class="col-md-4">
                                <label for="start_date">วันและเวลาเริ่มต้น :</label>
                                <div class="form-group">
                                    <div class="controls">
                                        <div class='input-group date' id='datetimepicker_startdate'>
                                            <input type='text' class="form-control" id="start_date" name="start_date"
                                                required" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="end_date">วันและเวลาสิ้นสุด :</label>
                                <div class="form-group">
                                    <div class="controls">
                                        <div class='input-group date' id='datetimepicker_enddate'>
                                            <input type='text' class="form-control" id="end_date" name="end_date"
                                                required" />
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
                                        <select class="form-control" id="status" name="status">
                                            <option value="all" selected>ทั้งหมด</option>
                                            <option value="0">ยังไม่นำส่ง</option>
                                            <option value="1">นำส่งแล้ว</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" id="submit" class="btn btn-success">ยืนยัน</button>
                                <button type="button" class="btn btn-primary"
                                    onclick="window.open('<?php echo base_url();?>Printing/View/all/all/all/', '_blank');">ดูข้อมูลทั้งหมด</button>
                            </div>
                        </form>
                        <!-- End Contact Form -->

                        <!-- Divider -->
                        <div class="hr1" style="margin-bottom:15px;"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End content -->
</section>

<script>
var newTitle = "สั่งพิมพ์ข้อมูล | Oxygen Tank Inventory";
if (document.title != newTitle) {
    document.title = newTitle;
}

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