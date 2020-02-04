<?php
// session_start();
include("connect.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
                <a class="nav-link active" href="check_member.php">สมาชิก</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cart.php">ตะกร้าสินค้า</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="order.php">ข้อมูลการสั่งซื้อ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">ออกจากระบบ</a>
            </li>
        </ul>
    </nav>
    <h1>สมาชิก</h1>
    <div class="container">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>รหัสสมาชิก</th>
                    <th>ชื่อสมาชิก</th>
                    <th>เบอร์โทรศัพท์</th>
                </tr>
            </thead>
            <?php
        $i = 1;
        $q = "SELECT * FROM tb_member";
        $result = mysqli_query($conn, $q);
        $total = mysqli_num_rows($result);
        while ($rs = mysqli_fetch_array($result)) {
        ?>
            <tbody>
                <tr>
                    <td><?= $rs['member_id'] ?></td>
                    <td><?= $rs['name'] ?></td>
                    <td><?= $rs['phone'] ?></td>
                </tr>
            </tbody>
        <?php } ?>
        </table>
    </div>
</body>

</html>