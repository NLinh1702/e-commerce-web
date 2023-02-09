<?php
session_start();
ob_start();

include_once ('../connection/connect_database.php');
if(isset($_SESSION['IDUser'])) {
    $sl = "select * from Users where idUser=".$_SESSION['IDUser'];
    $kq = mysqli_query($conn, $sl);
    $d=mysqli_fetch_array($kq);
    if (isset($_POST['Sua'])) {
        $sql = "select * from Users ";
        $query = mysqli_query($conn, $sql);
        $thongbao = "";

        if ($_POST['Username'] != "" && $_POST['Password_old'] != "" && $_POST['Password'] != "" && $_POST['Password_1'] != "" && $_POST['DienThoai'] != "") {
            if (md5($_POST["Password_old"]) != $d['Password']) {
                $thongbao = $thongbao . "Mật khẩu không chính xác ";
            }
            while ($r = $query->fetch_assoc()) {
                if ($r['HoTen'] == $_POST['Username'])
                    if ($r['idUser'] != $d['idUser'])
                        $thongbao = $thongbao . 'Username đã tồn tại ';
                if ($r['Email'] == $_POST['Email'])
                    if ($r['idUser'] != $d['idUser'])
                        $thongbao = $thongbao . 'Email đã tồn tại ';
                if ($r['DienThoai'] == $_POST['DienThoai'])
                    if ($r['idUser'] != $d['idUser'])
                        $thongbao = $thongbao . 'Số điện thoại đã tồn tại ';
            }
            if (md5($_POST['Password']) != md5($_POST['Password_1'])) {
                $thongbao = $thongbao . "Mật khẩu không trùng khớp ";
            }
            if ($thongbao != "") {
                echo "<script language='javascript'>alert('$thongbao');</script>";
            } else {
                $sl1 = "update Users set HoTen='" . $_POST['Username'] . "',
                HoTenK='" . $_POST['HoTenK'] . "',
                Password='" .md5($_POST['Password']). "',
                DiaChi='" . $_POST['DiaChi'] . "',
                DienThoai='" . $_POST['DienThoai'] . "',
                Email='" . $_POST['Email'] . "',
                NgayDangKy='" . $_POST['NgayDangKy'] . "'
                where HoTen='".$_SESSION['Username']."'";
                $kq1 = mysqli_query($conn, $sl1);
                if ($kq1) {
                    echo "<script language='javascript'>alert('Sửa thành công');";
                    echo "location.href='../site/index.php';</script>";
                }
            }
        } else
            echo "<script language='javascript'>alert('Vui lòng nhập đầy đủ thông tin!!!');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<header>
    <?php include_once ("header.php");?>
    <title>Trang chủ</title>
    <?php include_once ("header1.php");?>
    <link rel="stylesheet" href="../css/fontawesome-free-6.1.2-web/css/all.css">
</header>
<body>

<!---- Nội dung---->
<div class="row row-style " style="background:transparent url('../images/img_login.jpg') no-repeat center center /cover">
    <div class="container">
        <div class="row">
            <form action="Sua_TaiKhoan.php" method="post" style="padding: 29px;">
                <div class="container" style="background:transparent url('../images/anhdangky2.jpg'); width:40%; ">
                <br>
                <div class="row">
                    <div   style="font-size: 150%; font-family: 'Helvetica Neue', helvetica, arial, sans-serif; color: #0e0079; text-align: center;"><b>Sửa Tài Khoản</b></div>
                </div>
            <br/>
            <div class="row" style="margin-left: 80px;">
                <div style="color: red;"><input style="border-radius: 2px; color: black; height:35px;" size="30" type="text" name="Username" placeholder="ví dụ: abc" size="50" value="<?php echo $_SESSION['Username'];?>"/></div>
            </div>
            <br/>
            <div class="row" style="margin-left: 80px;">
                <div  style="color: red;">
                    <input type="text" style="border-radius: 2px; color: black; height:35px;" size="30"   size="30" name="HoTenK" id="HoTenK" placeholder="ví dụ: Nguyễn Thị A" value="<?php echo $_SESSION['HoTenK'];?>" > 
                </div>
            </div>
            <br/>
            <div class="row" style="margin-left: 80px;">
                <div style="color: red;"><input style="border-radius: 2px; color: black; height:35px;" size="30" type="password" name="Password_old" placeholder="Nhập password cũ" size="50"/></div>
            </div>
            <br/>
            <div class="row" style="margin-left: 80px;">
                <div style="color: red;"><input style="border-radius: 2px; color: black; height:35px;" size="30" type="password" name="Password" placeholder="Nhập password mới" size="50"/></div>
            </div>
            <br/>
            <div class="row" style="margin-left: 80px;">
                  
                <div style="color: red;"><input style="border-radius: 2px; color: black; height:35px;" size="30" type="password" name="Password_1" placeholder="Nhập lại password mới" size="50"/></div>
            </div>
            <br/>
            <div class="row" style="margin-left: 80px;">
                <div style="color: red;"><input style="border-radius: 2px; color: black; height:35px;" size="30" type="text" name="DiaChi" placeholder="Ví dụ: TpHCM, Quảng Ngãi" size="50" value="<?php echo $d['DiaChi'];?>"/></div>
            </div>
            <br/>
            <div class="row" style="margin-left: 80px;">
                <div style="color: red;"><input style="border-radius: 2px; color: black; height:35px;" size="30" type="tel" name="DienThoai" placeholder="ví dụ: 0965555555" maxlength="13"size="50" value="<?php echo $d['DienThoai'];?>"/></div>
            </div>
            <br/>
            <div class="row" style="margin-left: 80px;">
                <div style="color: red;"><input style="border-radius: 2px; color: black; height:35px;" size="30" type="email" name="Email" placeholder="ví dụ: abc@gmail.com" size="50" value="<?php echo $d['Email'];?>" /></div>
            </div>
            <br/>
            <div class="row" style=" margin-left: 155px">
                <div> <button id="Sua" name="Sua"  class="btn btn-success">Sửa</button>   <button class="btn btn-success"><a style="text-decoration: none; color: #FFFFFF;" href="../site/index.php">Thoát</a></button> </div>
            </div>
        <br/>
    </div>
</form>
    
</body>
</html>