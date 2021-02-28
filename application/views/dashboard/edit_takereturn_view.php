<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    $this->db->select();
    $this->db->from('tank');
    $this->db->where('status', '1');

    $query1 = $this->db->get()->result_array();

    $this->db->select();
    $this->db->from('employee');

    $query2 = $this->db->get()->result_array();

    $this->db->select(array('take_date', 'take_name', 'return_date', 'return_name', 'tank_number'));
    $this->db->from('inventory');
    $this->db->where('id', $_SESSION['id']);

    $query3 = $this->db->get();
    foreach ($query3->result() as $row) {
        $query01 = $row->take_date;
        $query02 = $row->take_name;
        $query03 = $row->tank_number;
        $query04 = $row->return_date;
        $query05 = $row->return_name;
    }
?>
<section id="dashboard">
    <!-- Start Page Banner -->
    <div class="page-banner" style="padding:40px 0; background: #f9f9f9;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>แก้ไขข้อมูลการเบิก-จ่ายถังแก๊สออกซิเจน<br />หมายเลขหัวถัง <?php echo $query03; ?></h2>
                    <p>ทำการแก้ไขข้อมูลการเบิก-จ่ายถังแก๊สออกซิเจน</p>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumbs">
                        <li><a href="<?php echo base_url(); ?>">หน้าหลัก</a></li>
                        <li><a href="<?php echo base_url(); ?>Dashboard">ข้อมูลการเบิก-จ่าย</a></li>
                        <li>เบิกถังแก๊สออกซิเจน</li>
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
                    <div class="col-md-7">
                        <!-- Classic Heading -->
                        <h4 class="classic-title"><span>ข้อมูลการเบิก-จ่าย</span></h4>

                        <!-- Start Contact Form -->
                        <form accept-charset="utf-8" role="form" class="contact-form" id="contact-form"
                            autocomplete="off">
                            <div class="alert alert-danger print-error-msg" style="display:none"></div>
                            <label for="start_date">วันที่เบิก :</label>
                            <div class="form-group">
                                <div class="controls">
                                    <div class='input-group date' id='datetimepicker'>
                                        <input type='text' class="form-control" id="take_date" name="take_date" required
                                            style="margin-bottom: auto;" value="<?php echo $query01; ?>" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <label for="model">ชื่อผู้เบิก :</label>
                            <div class="form-group">
                                <div class="controls">
                                    <input type="text" class="form-control" placeholder="ชื่อผู้เบิก" id="take_name"
                                        name="take_name" required value="<?php echo $query02; ?>" autofocus
                                        list="employee" />
                                    <datalist id="employee">
                                        <?php foreach ($query2 as $employee) {
    echo "<option value=\"".$employee['employee_name']."\">";
}
                                    ?>
                                    </datalist>
                                </div>
                            </div>
                            <label for="start_date">วันที่นำส่งคืน :</label>
                            <div class="form-group">
                                <div class="controls">
                                    <div class='input-group date' id='datetimepicker2'>
                                        <input type='text' class="form-control" id="return_date" name="return_date" required
                                            style="margin-bottom: auto;" value="<?php echo $query04; ?>" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <label for="model">ชื่อผู้นำส่งคืน :</label>
                            <div class="form-group">
                                <div class="controls">
                                    <input type="text" class="form-control" placeholder="ชื่อผู้นำส่งคืน" id="return_name"
                                        name="return_name" required value="<?php echo $query05; ?>" autofocus
                                        list="employee" />
                                </div>
                            </div>
                            <label for="model">หมายเลขหัวถัง :</label>
                            <div class="form-group">
                                <div class="controls">
                                    <input type="text" class="form-control" placeholder="หมายเลขหัวถัง" id="tank_number"
                                        name="tank_number" required value='<?php echo $query03; ?>' autofocus
                                        list="tank" />
                                    <datalist id="tank">
                                        <?php foreach ($query1 as $tank) {
                                        echo "<option value=\"".$tank['tank_number']."\">";
                                    }
                                    ?>
                                    </datalist>
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
var newTitle = "เบิกถังแก๊สออกซิเจน | Oxygen Tank Inventory";
if (document.title != newTitle) {
    document.title = newTitle;
}

var todayDate = new Date().getDate();
var start_date = new Date(new Date().setDate(todayDate - 1))
$(function() {
    $('#datetimepicker').datetimepicker({
        format: "YYYY-MM-DD",
        useCurrent: false
    });
    $('#datetimepicker2').datetimepicker({
        format: "YYYY-MM-DD",
        useCurrent: false
    });
});

$(document).ready(function() {
    $(".btn-submit").click(function(e) {
        e.preventDefault();
        $("#submit").attr("disabled", true);

        var take_date = $("input[name='take_date']").val();
        var take_name = $("input[name='take_name']").val();
        var return_date = $("input[name='return_date']").val();
        var return_name = $("input[name='return_name']").val();
        var tank_number = $("input[name='tank_number']").val();

        $.ajax({
            url: "<?php echo base_url(); ?>Dashboard/Edit_TakeReturn_Action/<?php echo $_SESSION['id']; ?>",
            type: 'POST',
            dataType: "json",
            data: {
                take_date: take_date,
                take_name: take_name,
                return_date: return_date,
                return_name: return_name,
                tank_number: tank_number
            },
            success: function(data) {
                if ($.isEmptyObject(data.error)) {
                    $(".print-error-msg").css('display', 'none');
                    location.href = '<?php echo base_url(); ?>Dashboard';
                } else {
                    $("#submit").attr("disabled", false);
                    $(".print-error-msg").css('display', 'block');
                    $(".print-error-msg").html(data.error);
                }
            }
        });
    });
});
</script>