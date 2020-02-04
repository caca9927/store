<?php
session_start();
include("connect.php");
// จ ำลองกำรตรวจสอบวำ่ เป็นสมำชกิ ทลี่ ็อกอนิแลว้หรอื ไม่
if (!isset($_SESSION['ses_cus_id']) || $_SESSION['ses_cus_id'] == "") {
    header("Location:login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Order</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            margin: 50;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="product.php">รายการสินค้า</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="check_member.php">สมาชิก</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cart.php">ตะกร้าสินค้า</a>
            </li>
            <li class="nav-item   active">
                <a class="nav-link" href="order.php">ข้อมูลการสั่งซื้อ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">ออกจากระบบ</a>
            </li>

        </ul>
    </nav>
    <div style="margin:auto;width:80%;">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // คิวรี่ข ้อมูลตำรำง tbl_order
                $q = "SELECT * FROM tb_order WHERE order_id='" . $_GET['v_order_id'] . "' ";
                $result = mysqli_query($conn, $q); // ท ำกำร query ค ำสงั่ sql
                $rs = $result->fetch_array();
                ?>
                <?php
                // วนลูป คิวรี่ข ้อมูลตำรำง tbl_orderdetail
                $i = 1;
                $q2 = "SELECT * FROM tb_detailorder WHERE order_id='" . $rs['order_id'] . "' ";
                $result2 = mysqli_query($conn, $q2); // ท ำกำร query ค ำสงั่ sql
                while ($rs2 = mysqli_fetch_array($result2)) { // วนลูปแสดงข ้อมูล
                ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $rs2['name'] ?></td>
                        <td><?= $rs2['price'] ?></td>
                        <td><?= $rs2['pro_qty'] ?></td>
                        <td><?= $rs2['pro_total_price'] ?></td>
                    </tr>
                <?php $i++;
                } ?>
                <tr>
                    <td colspan="3">
                    </td>
                    <td><?= $rs['total_qty'] ?></td>
                    <td><?= $rs['total_price'] ?></td>
                </tr>
                <tr>
                    <th>Name:</th>
                    <td colspan="4">
                        <?= $rs['name'] ?>
                    </td>
                </tr>
                <tr>
                    <th>Address:</th>
                    <td colspan="4">
                        <?= $rs['address'] ?>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td colspan="4">
                        <input type="button" onclick="window.location='order.php'" value="Back">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>