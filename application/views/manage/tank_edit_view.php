<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    $this->db->select(array('tank_number', 'status'));
    $this->db->from('tank');
    $this->db->where('id', $_SESSION['id']);

    $query = $this->db->get();
    foreach ($query->result() as $row) {
        $query1 = $row->tank_number;
        $query2 = $row->status;
    }
?>
<section id="dashboard">
    <!-- Start Page Banner -->
    <div class="page-banner" style="padding:40px 0; background: #f9f9f9;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>แก้ไขข้อมูลถังแก๊สออกซิเจน<br />หมายเลข <?php echo $query1; ?></h2>
                    <p>แก้ไขข้อมูลหมายเลขตัวถัง และสถานะถังแก๊สออกซิเจน</p>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumbs">
                        <li><a href="<?php echo base_url(); ?>">หน้าหลัก</a></li>
                        <li><a href="<?php echo base_url(); ?>Manage">จัดการข้อมูล</a></li>
                        <li><a href="<?php echo base_url(); ?>Manage/Tank">ถังแก๊สออกซิเจน</a></li>
                        <li>แก้ไขข้อมูลถังแก๊สออกซิเจน</li>
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
                        <form accept-charset="utf-8" role="form" class="contact-form" id="contact-form">
                            <div class="alert alert-danger print-error-msg" style="display:none"></div>
                            <label for="color">สถานะ :</label>
                            <div class="form-group">
                                <div class="controls">
                                    <input type="radio" id="status-on" name="status" value="1" <?php if ($query2=='1') {
    echo 'checked';
}; ?>>
                                    <label for="status-on">เปิด</label>

                                    <input type="radio" id="status-off" name="status" value="0" <?php if ($query2=='0') {
    echo 'checked';
}; ?>>
                                    <label for="status-off">ปิด</label>
                                </div>
                            </div>
                            <label for="model">หมายเลขตัวถัง :</label>
                            <div class="form-group">
                                <div class="controls">
                                    <input type="text" class="form-control" placeholder="หมายเลขตัวถัง" id="tank_number"
                                        name="tank_number" required value="<?php echo $query1; ?>">
                                </div>
                            </div>
                            <button type="submit" id="submit"
                                class="btn-submit btn-system btn-large">แก้ไขข้อมูล</button>
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
var newTitle = "แก้ไขข้อมูลถังแก๊สออกซิเจน | Oxygen Tank Inventory";
if (document.title != newTitle) {
    document.title = newTitle;
}

$(document).ready(function() {
    $(".btn-submit").click(function(e) {
        e.preventDefault();

        var tank_number = $("input[name='tank_number']").val();
        var status = $("input[name='status']:checked").val();

        $.ajax({
            url: "<?php echo base_url(); ?>Manage/Tank_Edit_Action/<?php echo $_SESSION['id']; ?>",
            type: 'POST',
            dataType: "json",
            data: {
                tank_number: tank_number,
                status: status
            },
            success: function(data) {
                if ($.isEmptyObject(data.error)) {
                    $(".print-error-msg").css('display', 'none');
                    location.href = '<?php echo base_url(); ?>Manage/Tank';
                } else {
                    $(".print-error-msg").css('display', 'block');
                    $(".print-error-msg").html(data.error);
                }
            }
        });
    });
});
</script>