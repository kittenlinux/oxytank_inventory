<?php
  defined('BASEPATH') or exit('No direct script access allowed');

  $this->db->select(array('tank_number'));
  $this->db->from('inventory');
  $this->db->where('id', $_SESSION['id']);

  $query = $this->db->get();
  foreach ($query->result() as $row) {
      $query1 = $row->tank_number;
  }

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
                    <h2>นำส่งถังแก๊สออกซิเจน<br />หมายเลขตัวถัง <?php echo $query1; ?></h2>
                    <p>ทำรายการนำส่งถังแก๊สออกซิเจน</p>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumbs">
                        <li><a href="<?php echo base_url(); ?>">หน้าหลัก</a></li>
                        <li><a href="<?php echo base_url(); ?>Dashboard">ข้อมูลการเบิก-จ่าย</a></li>
                        <li>นำส่งถังแก๊สออกซิเจน</li>
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
                            <label for="start_date">วันที่ทำรายการ :</label>
                            <div class="form-group">
                                <div class="controls">
                                    <div class='input-group date' id='datetimepicker'>
                                        <input type='text' class="form-control" id="take_date" name="take_date" required
                                            style="margin-bottom: auto;" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <label for="model">ชื่อผู้นำส่ง :</label>
                            <div class="form-group">
                                <div class="controls">
                                    <select class="form-control" id="take_name" name="take_name"
                                        onchange="enable_submit()" onfocus="enable_submit()">
                                        <option value="0" disabled selected>เลือกชื่อผู้นำส่ง</option>
                                        <?php foreach ($query2 as $employee) {
    echo "<option value=\"".$employee['employee_name']."\">".$employee['employee_name']."</option>";
}
                                    ?>
                                    </select>
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
var newTitle = "นำส่งถังแก๊สออกซิเจน | Oxygen Tank Inventory";
if (document.title != newTitle) {
    document.title = newTitle;
}

function enable_submit() {
    var e = document.getElementById("take_name");
    if (e.options[e.selectedIndex].value !== "0") {
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

        var take_date = $("input[name='take_date']").val();
        var take_name = $("#take_name").children("option").filter(":selected").text();

        $.ajax({
            url: "<?php echo base_url(); ?>Dashboard/Returning_Action/<?php echo $_SESSION['id']; ?>",
            type: 'POST',
            dataType: "json",
            data: {
                take_date: take_date,
                take_name: take_name
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