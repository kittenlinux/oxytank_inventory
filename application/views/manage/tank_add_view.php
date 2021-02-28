<?php
    defined('BASEPATH') or exit('No direct script access allowed');
?>
<section id="dashboard">
    <!-- Start Page Banner -->
    <div class="page-banner" style="padding:40px 0; background: #f9f9f9;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>เพิ่มถังแก๊สออกซิเจน</h2>
                    <p>เพิ่มข้อมูลหมายเลขตัวถัง</p>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumbs">
                        <li><a href="<?php echo base_url(); ?>">หน้าหลัก</a></li>
                        <li><a href="<?php echo base_url(); ?>Manage">จัดการข้อมูล</a></li>
                        <li><a href="<?php echo base_url(); ?>Manage/Tank">ถังแก๊สออกซิเจน</a></li>
                        <li>เพิ่มถังแก๊สออกซิเจน</li>
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
                        <h4 class="classic-title"><span>ข้อมูลถังแก๊สออกซิเจน</span></h4>

                        <!-- Start Contact Form -->
                        <form accept-charset="utf-8" role="form" class="contact-form" id="contact-form" autocomplete="off">
                            <div class="alert alert-danger print-error-msg" style="display:none"></div>
                            <label for="model">หมายเลขตัวถัง :</label>
                            <div class="form-group">
                                <div class="controls">
                                    <input type="text" class="form-control" placeholder="หมายเลขตัวถัง" id="tank_number"
                                        name="tank_number" required value="" autofocus>
                                </div>
                            </div>
                            <button type="submit" id="submit"
                                class="btn-submit btn-system btn-large">เพิ่ม</button>
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
var newTitle = "เพิ่มถังแก๊สออกซิเจน | Oxygen Tank Inventory";
if (document.title != newTitle) {
    document.title = newTitle;
}

$(document).ready(function() {
    $(".btn-submit").click(function(e) {
        e.preventDefault();
        $("#submit").attr("disabled", true);

        var tank_number = $("input[name='tank_number']").val();

        $.ajax({
            url: "<?php echo base_url(); ?>Manage/Tank_Add_Action",
            type: 'POST',
            dataType: "json",
            data: {
                tank_number: tank_number
            },
            success: function(data) {
                if ($.isEmptyObject(data.error)) {
                    $(".print-error-msg").css('display', 'none');
                    location.href = '<?php echo base_url(); ?>Manage/Tank';
                } else {
                    $("#submit").attr("disabled", false);
                    $("input[name='tank_number']").val('');
                    $("input[name='tank_number']").focus();
                    $(".print-error-msg").css('display', 'block');
                    $(".print-error-msg").html(data.error);
                }
            }
        });
    });
});
</script>