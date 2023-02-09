<?php 
    require('../mailer/sendmail.php');
?>
<!DOCTYPE html>
<html>

<header>
    <?php include_once("header.php"); ?>
    <title>Thanh toán</title>
    <?php include_once("header1.php"); ?>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <script src="../js/jquery-3.1.1.min.js"></script>
    <link rel="stylesheet" href="../css/fontawesome-free-6.1.2-web/css/all.css">
    <style>
        .far-styles {
            margin-bottom: 2%;
        }
    </style>

</header>
<body>
<?php include_once("header2.php"); ?>
<?php include '../connection/connect_database.php';
if (isset($_SESSION['IDUser'])) {
    $sql_u = "select * from users where idUser=" . (int)$_SESSION['IDUser'];
    $query_u = mysqli_query($conn, $sql_u);
    $r_us = mysqli_fetch_array($query_u);
    $flag = true;/// đã đăng nhập
} else {
    $flag = false;
}/// chưa đăng nhập
$sql_pttt = 'select * from phuongthucgiaohang where AnHien =1';
$rs = mysqli_query($conn, $sql_pttt);
$phivc = 0;
if (isset($_POST['PTGH'])) {
    while ($r_phi = $rs->fetch_assoc()) {
        if ($r_phi['idGH'] == $_POST['PTGH'])
            $phivc = $r_phi['Phi'];
    }
}
if (isset($_POST['PTGH'])) {
    $tieude = 'Xác nhận đặt hàng thành công!';
            $noidung = '<div><p">Cảm ơn khách hàng đã đặt hàng thành công bên shop của chúng tôi.</p></div>';
            $tongtien = 0; 
            foreach ($_SESSION['cart'] as $list) {
                $tongtien += (int)$list['qty'] * $list['GiaBan'];
                $noidung .=" <div>
                    <h4>Sản phẩm: <span style=\"color: #1E90FF;\">".$list['TenSP']."</span></h4>
                    <h4>Số lượng: <span style=\"color: #1E90FF;\">".$list['qty']." x ".$list['GiaBan']."</span></h4> 
                    <h4>Tổng tiền: <span style=\"color: #1E90FF;\">".$tongtien."</span></h4> 
                    <h4>Phương thức: <span style=\"color: #1E90FF;\">Thanh toán khi nhận hàng</span></h4> 
                </div>
                
                <p>Chúng tôi mong sẽ được phục vụ bạn nhiều lần nữa. Chúc bạn có một ngày tuyệt vời!
                <br>
                Trân trọng cảm ơn.</p>";
            }
            $maildathang = $_SESSION['Email'];
            $mail = new Mailer();
            $mail->dathangmail($tieude,$noidung,$maildathang);
}
?>


<!---- Nội dung---->
<div class="indexh3 text-center">
    <?php if (isset($_SESSION['Username'])) echo "<h1>Khách hàng đã có tài khoản</h1>"; else echo "<h1>Khách hàng chưa có tài khoản</h1>" ?>
    <div class="sep-wrap center nz-clearfix">
        <div class="nz-separator solid"
             style="margin-top:10px; border-bottom-color:#ddd;width:40%;border-bottom-width:2px;">&nbsp;</div>
    </div>
    <div class="sep-wrap center nz-clearfix">
        <div class="nz-separator solid"
             style="margin-top:1px;margin-left:40%; border-bottom-color:#f1f1f1;width:40%;border-bottom-width:2px;">
            &nbsp;</div>
    </div>
    <p ></p>
    
</div>

<div class="col" >
    <h3 align="center">Thông tin đơn hàng</h3>
    <table class="table table-bordered table-dark">
        <thead style="background-color: darkorange;">
            <tr>
            <th class="col-md-7">Sản phẩm</th>
            <th class="col-md-2">Số lượng</th>
            <th class="col-md-3">Giá</th>
            </tr>
        </thead>
    </table>
        <!--  -->
    <?php $tongtien = 0; ?>
    <?php if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $list) {
            $tongtien += (int)$list['qty'] * $list['GiaBan']; ?>
            <div class="row far-styles" style="margin-left: 5px;">
                <div class="col-md-8"><b><?php echo $list['TenSP']; ?></b></div>
                <div class="col-md-3"><b><?php echo $list['qty']; ?></b></div>
                <div class="col-md-1"><b><?php echo number_format($list['GiaBan'], 0); ?></b></div>
            </div>
        <?php }
    } ?>
    <div class="row far-styles" style="border: dashed;background-color: #ff8c00;border-color: #ff8c00;margin-left: 0px; width: 1218px;"></div>
    <div class="row far-styles">
        <div class="col-md-9"><h4><b style="color: black; margin-left: 730px;">TỔNG TIỀN:</b></h4></div>
        <div class="col-md-3" style=" text-align: right;"><h4><b style="color: red;margin-right: 10px;"><?php echo number_format($tongtien, 0) . '' . ' VNĐ' ?></b></h4></div>
    </div>
</div>


<!----------------------------------------------------->
<div class="col">
    <form action="" method="post" name="x">
        <?php if ($flag == true) { ?><!-------------Đã đăng nhập------------>
        <div class="col">
            <h3 align="center">Thông tin người nhận</h3>
        <table class="table table-bordered table-dark">
            <thead style="background-color: white;">
                <tr>
                <th scope="col">Khách hàng</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">Địa chỉ</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="row far-styles"><b><i><?php if ($flag == true) echo $r_us['HoTenK']; ?></i></b></td>
                    <td class="row far-styles"><b> <?php if ($flag == true) echo $r_us['DienThoai']; ?></b></td>
                    <td class="row far-styles"><b><?php if ($flag == true) echo $r_us['DiaChi']; ?></b></td>
                </tr>
            </tbody>
        </table>
        </div>
        <?php }
         else { ?> <!-------------Chưa đang nhập------------>
            <div class="col">
                <div class="row center-block">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-2 far-styles" style="color: black; font-weight:700;">1. Họ tên người nhận:</div>
                            <div class="col-md-10 far-styles"><input type="text" class="form-control" name="HoTen" placeholder="Nhập tên khách hàng..."></div>
                            <div class="col-md-2 far-styles" style="color: black; font-weight:700;">2. Email:</div>
                            <div class="col-md-10 far-styles"><input type="email" class="form-control" name="email"
                                                             placeholder="a@gmail.com"></div>
                            <div class="col-md-2 far-styles" style="color: black; font-weight:700;">3. Số điện thoại:</div>
                            <div class="col-md-10 far-styles"><input type="tel" class="form-control" name="SDT"
                                                                placeholder="Nhập số điện thoại..."></div>
                            <div class="col-md-2 far-styles" style="color: black; font-weight:700;">4. Địa chỉ nhận hàng:</div>
                            <div class="col-md-10 far-styles"><textarea class="form-control" rows="2" id="DiaChi" name="DiaChi"
                                                                    placeholder="Nhập chính xác địa chỉ nhận hàng!"></textarea></div>
                        </div>
                    </div>
                    <?php } ?><!---Chưa đang nhập------------>
                    <div class="col">
                        <div class="row center-block">
                            <div class="row" style="margin-left: -15px;">
                                <div class="col-md-2 far-styles" style="color: black; font-weight:700; margin-left: -10px;" ><i class="fa-solid fa-car-side"></i> Phương thức:</div>
                                <div class="col-md-10 far-styles">
                                    <select name="PTGH" class="check" id="PTGH" style="height: 30px;" >
                                        <?php
                                        while ($r = $rs->fetch_assoc()) { ?>                             
                                            <option value="<?php echo $r['idGH']; ?>" selected='selected'><?php echo $r['TenGH']  ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <button type="submit;" class="form-control col-md-2 btn btn-success" value="Đặt hàng" name="OK" style="margin-left: 1051px;">Đặt hàng</button>
                    </div>
                </div>
            </div>

        
    </form>
</div>

<?php

$sl_donhang = "select  idDH  from donhang ORDER By  idDH DESC ";
$rs_donhang = mysqli_query($conn, $sl_donhang);
$sodh = 0;
$date = date('Y-m-d H:i:s');
while ($rsodh = $rs_donhang->fetch_assoc()) {
    $sodh = $rsodh['idDH'];
    break;
}
$sodh = (int)$sodh + 1;
if ($flag != true && isset($_SESSION['cart'])) {
    if (isset($_POST['OK']) && isset($_POST['HoTen']) && isset($_POST['email']) && isset($_POST['DiaChi']) && isset($_POST['SDT'])) {
        $sql_dh1 = "insert into donhang values (" . $sodh . ",0,'" . $date . "','" . $_POST['HoTen'] . "','" . $_POST['DiaChi'] . "'," . $_POST['SDT'] . ",0," . $_POST['PTGH'] . ",0,0,'" . $_POST['email'] . "')";
        $rs_dh1 = mysqli_query($conn, $sql_dh1);
        if (!$rs_dh1) {

            echo "<script language='JavaScript'> alert('Thêm  không thành công1!');</script>";

        } else {
            foreach ($_SESSION['cart'] as $pro) {
                $sql_ctdh = "INSERT INTO donhangchitiet(idDH, idSP, TenSP, SoLuong, Gia) VALUES (" . $sodh . "," . $pro['idSP'] . ",N'" . $pro['TenSP'] . "'," . $pro['qty'] . "," . $pro['GiaBan'] . ")";
                $rs_ctdh = mysqli_query($conn, $sql_ctdh);
                $sql_sanpham = " update sanpham set SoLuongTonKho -=".(int)$pro['qty'].'where idSP='.$pro['idSP'];
                $rs_sanpham = mysqli_query($conn, $sql_sanpham);
                if (!$rs_ctdh) {
                    echo "<script language='JavaScript'> alert('Thêm  không thành công2!');</script>";
                } else {
                    echo "<script language='JavaScript'> alert('Đơn hàng của bạn đã được xác nhận thành công.');";
                    unset($_SESSION['cart']);
                    echo " location.href='../site/index.php?index=1';</script>";
                }
            }


        }


    }
} else {

    if (isset($_POST['OK']) && isset($_SESSION['cart'])) {
        $sql_dh2 = "insert into donhang VALUES (" . $sodh . "," . $_SESSION['IDUser'] . ",'" . $date . "',N'" . $_SESSION['HoTenK'] . "',N'" . $_SESSION['DC'] . "',
                 " . $_SESSION['SDT'] . ",0," . $_POST['PTGH'] . ",0,0,'" . $_SESSION['Email'] . "'
                 ) ";
        $rs_dh2 = mysqli_query($conn, $sql_dh2);
        if (!$rs_dh2) {
            echo "<script language='JavaScript'> alert('Thêm  không thành công3!');</script>";
        } else {
            foreach ($_SESSION['cart'] as $pro) {
                $sql_ctdh = "INSERT INTO donhangchitiet(idDH, idSP, TenSP, SoLuong, Gia) VALUES (" . $sodh . "," . $pro['idSP'] . ",N'" . $pro['TenSP'] . "'," . $pro['qty'] . "," . $pro['GiaBan'] . ")";
                $rs_ctdh = mysqli_query($conn, $sql_ctdh);
                $sql_sanpham = " update sanpham set SoLuongTonKho -=".(int)$pro['qty'].'where idSP='.$pro['idSP'];
                $rs_sanpham = mysqli_query($conn, $sql_sanpham);
                if (!$rs_ctdh) {
                    echo "<script language='JavaScript'> alert('Thêm  không thành công4!');</script>";
                } else {
                    echo "<script language='JavaScript'> alert('Đơn hàng của bạn đã được xác nhận thành công');";
                    unset($_SESSION['cart']);
                    echo " location.href='../site/index.php?index=1';</script>";
                }

            }


        }
    }
}
?>

<?php include_once("footer.php"); ?>

</body>
</html>