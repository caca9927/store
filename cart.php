<?php
session_start();
include("connect.php");

if (isset($_POST['add_to_cart'])) {
    $keyProID = $_POST['h_pro_id'];
    if (
        $_POST['h_pro_id'] != "" && $_POST['h_pro_name'] != "" &&
        $_POST['h_pro_price'] != ""
    ) {
        $_SESSION['ses_cart_pro_id'][$keyProID] = $_POST['h_pro_id'];
        $_SESSION['ses_cart_pro_name'][$keyProID] = $_POST['h_pro_name'];
        $_SESSION['ses_cart_pro_qty'][$keyProID][] = 1;
        $_SESSION['ses_cart_pro_price'][$keyProID] = $_POST['h_pro_price'];
        $_SESSION['ses_cart_pro_total_price'][$keyProID] =

            array_sum($_SESSION['ses_cart_pro_qty'][$keyProID]) * $_SESSION['ses_cart_pro_price'][$keyProID];
    }
}

// ยกเลิก และลบรายการในตัวแปร session
if (isset($_GET['remove']) && $_GET['d_pro_id'] != "") {
    $keyProID = $_GET['d_pro_id'];
    unset($_SESSION['ses_cart_pro_id'][$keyProID]);
    unset($_SESSION['ses_cart_pro_name'][$keyProID]);
    unset($_SESSION['ses_cart_pro_qty'][$keyProID]);
    unset($_SESSION['ses_cart_pro_price'][$keyProID]);
    unset($_SESSION['ses_cart_pro_total_price'][$keyProID]);
    header("Location:cart.php");
    exit;
}
// สว่ นของการอพั เดทจ านวนและราคาของแตล่ ะรายการ เมอื่ เปลยี่ นแปลงจ านวน
if (isset($_GET['update']) && $_GET['u_pro_id'] != "" && $_GET['new_qty'] != "") {
    $keyProID = $_GET['u_pro_id'];
    unset($_SESSION['ses_cart_pro_qty'][$keyProID]);
    for ($i = 0; $i < $_GET['new_qty']; $i++) {
        $_SESSION['ses_cart_pro_qty'][$keyProID][] = 1;
    }
    $_SESSION['ses_cart_pro_total_price'][$keyProID] =

        array_sum($_SESSION['ses_cart_pro_qty'][$keyProID]) * $_SESSION['ses_cart_pro_price'][$keyProID];
    header("Location:cart.php");
    exit;
}

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
    <title>Document</title>
</head>

<body>
    <div>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="product.php">รายการสินค้า</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="check_member.php">สมาชิก</a>
                </li>
                <li class="nav-item  active">
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
        <h1>ตะกร้าสินค้า</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total Price</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($_SESSION['ses_cart_pro_id']) > 0) {
                    $i = 1;
                    foreach ($_SESSION['ses_cart_pro_id'] as $k_pro_id => $v_pro_id) {
                        $qty_data = array_sum($_SESSION['ses_cart_pro_qty'][$k_pro_id]);
                ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $_SESSION['ses_cart_pro_name'][$k_pro_id] ?></td>
                            <td><?= $_SESSION['ses_cart_pro_price'][$k_pro_id] ?></td>
                            <td>
                                <select name="qty[]" onchange="window.location='?u_pro_id=<?= $k_pro_id ?>&new_qty='+this.value+'&update'">
                                    <?php for ($v = 1; $v <= 10; $v++) { ?>
                                        <option value="<?= $v ?>" <?= ($qty_data == $v) ? "selected" : "" ?>><?= $v ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td><?= $_SESSION['ses_cart_pro_total_price'][$k_pro_id] ?></td>
                            <td><a href="?d_pro_id=<?= $k_pro_id ?>&remove">Remove</a></td>
                        </tr>
                <?php $i++;
                    }
                } ?>
                <?php
                if (count($_SESSION['ses_cart_pro_total_price']) > 0) {
                ?>
                    <tr>
                        <td colspan="3"></td>
                        <td><?= count($_SESSION['ses_cart_pro_qty'], 1) -
                                count($_SESSION['ses_cart_pro_qty']) ?></td>
                        <td><?= array_sum($_SESSION['ses_cart_pro_total_price']) ?></td>
                        <td>
                            <input type="button" onclick="window.location='checkout.php'" value="Checkout">
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>