<?php
session_start();
include("connect.php");
?>
<?php
// บันทึกข ้อมูลลงตาราง tbl_order
if (isset($_POST['save_order']) && $_POST['name'] != "") {
    $mem_id = $_POST['mem_id'];
    $total_qty = count($_SESSION['ses_cart_pro_qty'], 1) -
        count($_SESSION['ses_cart_pro_qty']);
    $total_price = array_sum($_SESSION['ses_cart_pro_total_price']);
    $q = "INSERT INTO tb_order (order_id,member_id,total_qty,total_price,name,address) VALUES (NULL,'" . $mem_id . "','" . $total_qty . "','" . $total_price . "','" . trim(addslashes($_POST['name'])) . "','" . trim(addslashes($_POST['addresss'])) . "')";
    $sql = mysqli_query($conn, $q);
    // $mysqli->query($q);
    // $order_id=$mysqli->insert_id;
    // วนลูปบันทึกแต่ละรายการลง tbl_orderdetail แล้วลบ session
    if (count($_SESSION['ses_cart_pro_id']) > 0) {
        foreach ($_SESSION['ses_cart_pro_id'] as $k_pro_id => $v_pro_id) {
            $qty_data = array_sum($_SESSION['ses_cart_pro_qty'][$k_pro_id]);
            $q = "INSERT INTO tb_detailorder VALUES ( NULL,'" . $k_pro_id . "','" . trim(addslashes($_SESSION['ses_cart_pro_name'][$k_pro_id])) . "','" . $_SESSION['ses_cart_pro_price'][$k_pro_id] . "','" . $qty_data . "','" . $order_id . "','" . $_SESSION['ses_cart_pro_total_price'][$k_pro_id] . "')";
            // $mysqli->query($q);
            $sql = mysqli_query($conn, $q);


            $keyProID = $k_pro_id;
            unset($_SESSION['ses_cart_pro_id'][$keyProID]);
            unset($_SESSION['ses_cart_pro_name'][$keyProID]);
            unset($_SESSION['ses_cart_pro_qty'][$keyProID]);
            unset($_SESSION['ses_cart_pro_price'][$keyProID]);
            unset($_SESSION['ses_cart_pro_total_price'][$keyProID]);
        }
    }
    header("Location:order.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
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
        <form id="myform" method="post" action="">
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
                    if (count($_SESSION['ses_cart_pro_id']) > 0) {
                        $i = 1;
                        foreach ($_SESSION['ses_cart_pro_id'] as $k_pro_id => $v_pro_id) {
                            $qty_data = array_sum($_SESSION['ses_cart_pro_qty'][$k_pro_id]);
                    ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $_SESSION['ses_cart_pro_name'][$k_pro_id] ?></td>
                                <td><?= $_SESSION['ses_cart_pro_price'][$k_pro_id] ?></td>
                                <td><?= $qty_data ?></td>
                                <td><?= $_SESSION['ses_cart_pro_total_price'][$k_pro_id] ?></td>
                            </tr>
                    <?php $i++;
                        }
                    } ?>
                    <?php
                    if (count($_SESSION['ses_cart_pro_total_price']) > 0) {
                    ?>
                        <tr>
                            <td colspan="3">
                                <input type="button" onclick="window.location='cart.php'" value="Edit">
                            </td>
                            <td><?= count($_SESSION['ses_cart_pro_qty'], 1) -
                                    count($_SESSION['ses_cart_pro_qty']) ?></td>
                            <td><?= array_sum($_SESSION['ses_cart_pro_total_price']) ?></td>
                        </tr>
                        <tr>
                            <th>รหัสสมาชิก</th>
                            <td>
                                <input type="text" name="mem_id">
                            </td>
                        </tr>
                        <tr>
                            <th>Name:</th>
                            <td colspan="4">
                                <input type="text" name="name" id="name" size="50">
                            </td>
                        </tr>
                        <tr>
                            <th>Address:</th>
                            <td colspan="4">
                                <textarea name="addresss" id="addresss" cols="50" rows="5"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th></th>
                            <td colspan="4">
                                <input type="submit" name="save_order" value="บันทึกการสั่งซื้อ">
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </form>
    </div>
</body>

</html>