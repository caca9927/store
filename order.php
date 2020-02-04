<?php
session_start();
include("connect.php");
// จ ำลองกำรตรวจสอบวำ่ เป็นสมำชกิ ทลี่ ็อกอนิแลว้หรอื ไม่

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order</title>
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
        <h1>รายละเอียดการสั่งซื้อ</h1>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Qty</th>
                    <th>Total Price</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // วนลูปแสดงรำยกำร order ของสมำชกินัน้ ๆ ทกี่ ำ ลังล็อกอนิ
                $q = "SELECT * FROM tb_order  ";
                $result = mysqli_query($conn, $q); //ท ำกำร query ค ำสงั่ sql
                while ($rs = mysqli_fetch_array($result)) { // วนลูปแสดงข ้อมูล
                ?>
                    <tr>
                        <td><?= $rs['order_id'] ?></td>
                        <td><?= $rs['name'] ?></td>
                        <td><?= $rs['address'] ?></td>
                        <td><?= $rs['total_qty'] ?></td>
                        <td><?= $rs['total_price'] ?></td>
                        <td><a href="view_order.php?v_order_id=<?= $rs['order_id'] ?>">View</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>