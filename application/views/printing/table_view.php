<?php
defined('BASEPATH') or exit('No direct script access allowed');
  $this->db->from('inventory');

  $count = $this->db->count_all_results();

  $this->db->select();
  $this->db->from('inventory');
  $this->db->order_by('id', 'DESC');

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
</body>

</html>