<?php
  defined('BASEPATH') or exit('No direct script access allowed');
  date_default_timezone_set("Asia/Bangkok");
  $this->db->from('inventory');
  if ($_SESSION['pr_status']!='all') {
      if ($_SESSION['pr_status']=='0') {
          $this->db->where('status < 1');
      } elseif ($_SESSION['pr_status']=='1') {
          $this->db->where('status', '1');
      }
  }
  if ($_SESSION['pr_start_date']!='all') {
      $this->db->where('take_date >= date("'.$_SESSION['pr_start_date'].'")');
  }
  if ($_SESSION['pr_end_date']!='all') {
      $this->db->where('take_date <= date("'.$_SESSION['pr_end_date'].'")');
  }
  if ($_SESSION['pr_start_date']!='all') {
      $this->db->or_where('return_date >= date("'.$_SESSION['pr_start_date'].'")');
  }
  if ($_SESSION['pr_end_date']!='all') {
      $this->db->where('return_date <= date("'.$_SESSION['pr_end_date'].'")');
  }
  
  $count = $this->db->count_all_results();

  $this->db->select();
  $this->db->from('inventory');
  if ($_SESSION['pr_status']!='all') {
      if ($_SESSION['pr_status']=='0') {
          $this->db->where('status < 1');
      } elseif ($_SESSION['pr_status']=='1') {
          $this->db->where('status', '1');
      }
  }
  if ($_SESSION['pr_start_date']!='all') {
      $this->db->where('take_date >= date("'.$_SESSION['pr_start_date'].'")');
  }
if ($_SESSION['pr_end_date']!='all') {
    $this->db->where('take_date <= date("'.$_SESSION['pr_end_date'].'")');
}
if ($_SESSION['pr_start_date']!='all') {
    $this->db->or_where('return_date >= date("'.$_SESSION['pr_start_date'].'")');
}
if ($_SESSION['pr_end_date']!='all') {
    $this->db->where('return_date <= date("'.$_SESSION['pr_end_date'].'")');
}
  $query = $this->db->get()->result_array();
?>
<!DOCTYPE html>

<head>
    <title>Oxygen Tank Inventory</title>
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <style>
    body {
        font-family: 'Sarabun', sans-serif;
    }

    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    </style>
</head>

<body>
    <p style='font-weight:bold;text-align:center'>แบบบันทึกการเบิกจ่ายถังแก๊สออกซิเจน</p>
    <p style='font-weight:bold;text-align:center'>
        <?php if ($_SESSION['pr_start_date']!='all') {
    echo "ตั้งแต่วันที่ ".$_SESSION['pr_start_date'];
}
  if ($_SESSION['pr_end_date']!='all') {
      echo " ถึงวันที่ ".$_SESSION['pr_end_date'];
  }
    if ($_SESSION['pr_status']=='0') {
        echo " เฉพาะสถานะ ยังไม่นำส่ง";
    }
  if ($_SESSION['pr_status']=='1') {
      echo " เฉพาะสถานะ นำส่งแล้ว";
  }?></p>
    <table id="table-print" class="display responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>หมายเลขหัวถัง</th>
                <th>วันที่เบิก</th>
                <th>ชื่อผู้เบิก</th>
                <th>วันที่นำส่งคืน</th>
                <th>ชื่อผู้นำส่งคืน</th>
                <th>สถานะ</th>
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
            </tr>
            <?php
      }
  } ?>
        </tbody>
        <!-- <tfoot>
            <tr>
                <th>No.</th>
                <th>หมายเลขหัวถัง</th>
                <th>วันที่เบิก</th>
                <th>ชื่อผู้เบิก</th>
                <th>วันที่นำส่งคืน</th>
                <th>ชื่อผู้นำส่งคืน</th>
                <th>สถานะ</th>
            </tr>
        </tfoot> -->
    </table>
    <p style='text-align:right'>พิมพ์เมื่อวันที่ <?php echo date('Y-m-d'); ?> เวลา <?php echo date('H:i:s'); ?></p>
</body>

</html>