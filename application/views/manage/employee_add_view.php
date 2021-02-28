<?php
    defined('BASEPATH') or exit('No direct script access allowed');
?>
<section id="dashboard">
    <!-- Start Page Banner -->
    <div class="page-banner" style="padding:40px 0; background: #f9f9f9;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>เพิ่มชื่อผู้ทำการเบิก-จ่าย</h2>
                    <p>เพิ่มข้อมูลชื่อผู้ทำการเบิก-จ่าย</p>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumbs">
                        <li><a href="<?php echo base_url(); ?>">หน้าหลัก</a></li>
                        <li><a href="<?php echo base_url(); ?>Manage">จัดการข้อมูล</a></li>
                        <li><a href="<?php echo base_url(); ?>Manage/Employee">ชื่อผู้ทำการเบิก-จ่าย</a></li>
                        <li>เพิ่มชื่อผู้ทำการเบิก-จ่าย</li>
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
                    <div class="col-md-7">
                        <!-- Classic Heading -->
                        <h4 class="classic-title"><span>ข้อมูลชื่อผู้ทำการเบิก-จ่าย</span></h4>

                        <!-- Start Contact Form -->
                        <form accept-charset="utf-8" role="form" class="contact-form" id="contact-form">
                            <div class="alert alert-danger print-error-msg" style="display:none"></div>
                            <label for="model">ชื่อผู้ทำการเบิก-จ่าย :</label>
                            <div class="form-group">
                                <div class="controls">
                                    <input type="text" class="form-control" placeholder="ชื่อผู้ทำการเบิก-จ่าย"
                                        id="employee_name" name="employee_name" required value="" autofocus>
                                </div>
                            </div>
                            <button type="submit" id="submit" class="btn-submit btn-system btn-large">เพิ่ม</button>
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

<script type="text/javascript">
var newTitle = "เพิ่มชื่อผู้ทำการเบิก-จ่าย | Oxygen Tank Inventory";
if (document.title != newTitle) {
    document.title = newTitle;
}

$(document).ready(function() {
    $(".btn-submit").click(function(e) {
        e.preventDefault();
        $("#submit").attr("disabled", true);

        var employee_name = $("input[name='employee_name']").val();

        $.ajax({
            url: "<?php echo base_url(); ?>Manage/Employee_Add_Action",
            type: 'POST',
            dataType: "json",
            data: {
                employee_name: employee_name
            },
            success: function(data) {
                if ($.isEmptyObject(data.error)) {
                    $(".print-error-msg").css('display', 'none');
                    location.href = '<?php echo base_url(); ?>Manage/Employee';
                } else {
                    $("#submit").attr("disabled", false);
                    $("input[name='employee_name']").focus();
                    $(".print-error-msg").css('display', 'block');
                    $(".print-error-msg").html(data.error);
                }
            }
        });
    });
});
</script>