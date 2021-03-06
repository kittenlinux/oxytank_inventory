<?php
    defined('BASEPATH') or exit('No direct script access allowed');

  $this->db->select();
  $this->db->from('tank');
  $this->db->where('status', '1');

  $query1 = $this->db->get()->result_array();

  $this->db->select();
  $this->db->from('employee');

  $query2 = $this->db->get()->result_array();
?>
<section id="dashboard">
    <!-- Start Page Banner -->
    <div class="page-banner" style="padding:40px 0; background: #f9f9f9;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>นำส่งถังแก๊สออกซิเจนด้วยหมายเลขหัวถัง</h2>
                    <p>ทำรายการนำส่งถังแก๊สออกซิเจน ด้วยการสแกนบาร์โค้ดหมายเลขหัวถัง</p>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumbs">
                        <li><a href="<?php echo base_url(); ?>">หน้าหลัก</a></li>
                        <li><a href="<?php echo base_url(); ?>Dashboard">ข้อมูลการเบิก-จ่าย</a></li>
                        <li>นำส่งถังแก๊สออกซิเจนด้วยหมายเลขหัวถัง</li>
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
                        <h4 class="classic-title"><span>ข้อมูลการนำส่ง</span></h4>

                        <!-- Start Contact Form -->
                        <form accept-charset="utf-8" role="form" class="contact-form" id="contact-form" autocomplete="off">
                            <div class="alert alert-danger print-error-msg" style="display:none"></div>
                            <label for="start_date">วันที่นำส่งคืน :</label>
                            <div class="form-group">
                                <div class="controls">
                                    <div class='input-group date' id='datetimepicker'>
                                        <input type='text' class="form-control" id="return_date" name="return_date" required
                                            style="margin-bottom: auto;" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <label for="model">ชื่อผู้นำส่งคืน :</label>
                            <div class="form-group">
                                <div class="controls">
                                    <select class="form-control" id="return_name" name="return_name"
                                        onchange="enable_submit()" onfocus="enable_submit()">
                                        <option value="0" disabled selected>เลือกชื่อผู้นำส่ง</option>
                                        <?php foreach ($query2 as $employee) {
    echo "<option value=\"".$employee['employee_name']."\">".$employee['employee_name']."</option>";
}
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <label for="color">สถานะคงเหลือ :</label>
                            <div class="form-group">
                                <div class="controls">
                                    <input type="radio" id="status-green" name="return_color" value="green"
                                        onchange="enable_submit()" onfocus="enable_submit()">
                                    <label for="status-green" style='color:green;font-weight:bold'>██ สีเขียว</label>

                                    <input type="radio" id="status-yellow" name="return_color" value="yellow"
                                        onchange="enable_submit()" onfocus="enable_submit()">
                                    <label for="status-yellow" style='color:#FFBF00;font-weight:bold'>██ สีเหลือง</label>

                                    <input type="radio" id="status-red" name="return_color" value="red"
                                        onchange="enable_submit()" onfocus="enable_submit()">
                                    <label for="status-red" style='color:red;font-weight:bold'>██ สีแดง</label>
                                </div>
                            </div>
                            <label for="model">หมายเลขหัวถัง :</label>
                            <div class="form-group">
                                <div class="controls">
                                    <input type="text" class="form-control" placeholder="หมายเลขหัวถัง" id="tank_number"
                                        name="tank_number" required value="" autofocus list="tank" />
                                    <datalist id="tank">
                                        <?php foreach ($query1 as $tank) {
                                        echo "<option value=\"".$tank['tank_number']."\">";
                                    }
                                    ?>
                                    </datalist>
                                </div>
                            </div>
                            <button type="submit" id="submit" class="btn-submit btn-system btn-large"
                                disabled>นำส่ง</button>
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

function enable_submit() {
    var selector = document.querySelector('input[name="return_color"]:checked');
    var e = document.getElementById("return_name");
    if (e.options[e.selectedIndex].value !== "0" && selector) {
        $('#submit').removeAttr('disabled');
    }
}

var todayDate = new Date().getDate();
var start_date = new Date(new Date().setDate(todayDate - 1))
$(function() {
    $('#datetimepicker').datetimepicker({
        format: "YYYY-MM-DD",
        useCurrent: false,
        defaultDate: new Date(new Date().setDate(todayDate))
    });
});

$(document).ready(function() {
    $(".btn-submit").click(function(e) {
        e.preventDefault();
        $("#submit").attr("disabled", true);

        var return_date = $("input[name='return_date']").val();
        var return_name = $("#return_name").children("option").filter(":selected").text();
        var return_color = $("input[name='return_color']:checked").val();
        var tank_number = $("input[name='tank_number']").val();

        $.ajax({
            url: "<?php echo base_url(); ?>Dashboard/Returning_Quick_Action",
            type: 'POST',
            dataType: "json",
            data: {
                return_date: return_date,
                return_name: return_name,
                return_color: return_color,
                tank_number: tank_number
            },
            success: function(data) {
                if ($.isEmptyObject(data.error)) {
                    $(".print-error-msg").css('display', 'none');
                    location.href = '<?php echo base_url(); ?>Dashboard';
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