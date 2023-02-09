<?php

?>
<?php
session_start();
include("../connection/connect_database.php");
if (isset($_POST['Username']) && isset($_POST['Password'])) {
    $username = $_POST['Username'];
    $password = md5($_POST['Password']);
    $username = strip_tags($username);
    $username = addslashes($username);
    $password = strip_tags($password);
    $password = addslashes($password);
    if ($username == "" || $password = "")
        echo "Username và password không được để trống!";
    else {
        $sql = "select * from Users where HoTen='" . $_POST['Username'] . "' and Password='" . md5($_POST['Password']) . "'";
        $query = mysqli_query($conn, $sql);
        $num_rows = mysqli_num_rows($query);
        if ($num_rows > 0) {
            //lưu tên đăng nhập vào session
            $_SESSION['Username'] = $username;
            $r_us = mysqli_fetch_array($query);
            $_SESSION['HoTenK'] = $r_us['HoTenK'];
            $_SESSION['IDUser'] = $r_us['idUser'];
            $_SESSION['SDT'] = $r_us['DienThoai'];
            $_SESSION['DC'] = $r_us['DiaChi'];
            $_SESSION['Email'] = $r_us['Email'];
            if ($_SESSION['IDUser'] == 1) {
                echo "<script language='javascript'>alert('Đăng nhập thành công! " . $r_us['HoTenK'] . "');";
                echo "location.href='../admin/index.php';</script>";
            } else {
                echo "<script language='javascript'>alert('Đăng nhập thành công! " . $r_us['HoTenK'] . "');";
                if (isset($_SESSION['cart']))
                    echo "location.href='GioHang.php?idSP=1';</script>";
                else
                    echo "location.href='index.php';</script>";

            }
        } else {
            echo "<script language='javascript'>alert('Đăng nhập thất bại!');";
            echo "location.href='DangNhap.php';</script>";
        }
    }
}

?>
<!DOCTYPE html>
<html>
<header>
    <?php include_once("header.php"); ?>
    <title>Trang chủ</title>
    <?php include_once("header1.php"); ?>
</header>
<style>
    .row-style {
        padding: 200px;
    }
</style>
<body>

<!---- Nội dung---->
<div class="row row-style" style="background:transparent url('../images/img_login.jpg') no-repeat center center /cover">
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="margin-left:-98px;">
            <form method="post" action="DangNhap.php">
            <div class="container" style="background:transparent url('../images/anhdangky2.jpg'); width:40%; ">
            <br>
            <div class="row">
                <div   style="font-size: 150%; font-family: 'Helvetica Neue', helvetica, arial, sans-serif; color: #0e0079; text-align: center;"><b>Đăng Nhập Tài Khoản</b></div>
            </div>
            <br>
            <div class="row" style="margin-left: 80px;">
                <div style="color: red;">
                    <input type="text" style="border-radius: 2px; color: black; height:35px;" size="30" name="Username" id="Username"
                           placeholder="Nhập tên..." autofocus="autofocus" maxlength="50"
                           value="<?php if (isset($_POST['Username'])) echo $username; ?>">
                </div>
            </div>
            <br/>
            <div class="row" style="margin-left: 80px;">
                <div style="color: red;">
                    <input type="password" style="border-radius: 2px; color: black; height:35px;" size="30" name="Password" id="Password"
                           placeholder="Nhập password...">
                </div>
            </div>
            <br/>
            <div class="row"  style=" margin-left: 135px">
                <div>
                    <button id="Submit" name="Submit" class="btn btn-success">Đăng nhập</button>
                    <button class="btn btn-success"><a style="text-decoration: none; color: #FFFFFF;"
                                                       href="../site/index.php">Thoát</a></button>
                </div>
            </div>
            <div class="row" style="margin-left: 100px;">
                        <p>Bạn đã là thành viên chưa? <a href="../site/TaoTaiKhoan.php">Đăng ký</a></p>
                    </div>
        <br/>
        </form>
            </div>
        </div>
    </div>
    <!---- Nội dung---->
</div>

</div>
</body>
</html>
