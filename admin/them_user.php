<?php
/**
 * Created by PhpStorm.
 * User: tu05d
 * Date: 4/16/2017
 * Time: 7:54 PM
 */
?>
<?php
include_once ('../connection/connect_database.php');
if(isset($_POST['Them'])) {
    if ($_POST['Username'] != "" && $_POST['Password'] != "" && $_POST['Password_1'] != ""&& $_POST['DienThoai'] != "") {
        $sql = "select * from Users";
        $query = mysqli_query($conn, $sql);
        $thongbao = "";
        while ($r = $query->fetch_assoc()) {
            if ($r['HoTen'] == $_POST['Username'])
                $thongbao = $thongbao . 'Username đã tồn tại ';
            if ($r['Email'] == $_POST['Email']&&$_POST['Email']!="")
                $thongbao = $thongbao . 'Email đã tồn tại ';
            if ($r['DienThoai'] == $_POST['DienThoai'])
                $thongbao = $thongbao . 'Số điện thoại đã tồn tại ';
        }
        if (md5($_POST['Password'] )!= md5($_POST['Password_1'])) {
            $thongbao = 'Mật khẩu không trùng khớp';
        }
        if ($thongbao != "") {
            echo "<script language='javascript'>alert('$thongbao');</script>";
        } else {
            $sl = "insert into Users(HoTen,HoTenK,Password,DiaChi,DienThoai,Email,NgayDangKy,idGroup) VALUES ('" . $_POST['Username'] . "','" . $_POST['HoTenK'] . "','" . md5($_POST['Password']) . "','" . $_POST['DiaChi'] . "','" . $_POST['DienThoai'] . "','" . $_POST['Email'] . "','" . $_POST['NgayDangKy'] . "',2)";
            $kq = mysqli_query($conn, $sl);
            if ($kq) {
                echo "<script language='javascript'>alert('Thêm thành công');";
                echo "location.href='../admin/index_user.php';</script>";
            }
        }
    }
    else
        echo "<script language='javascript'>alert('Vui lòng nhập đầy đủ thông tin!');</script>";
}
?>
<!DOCTYPE html>
<html>
<header>
    <?php include_once ("header1.php");?>
    <title>Thêm users </title>
    <?php include_once('header2.php');?>
    <style>div.row {
            padding-top: 2%;
        }</style>
    <link rel="stylesheet" href="../css/fontawesome-free-6.1.2-web/css/all.css">
</header>
<body>
<?php include_once ('header3.php');?>
<br>
<div>
    <a href="index.php"><span style="color: #6e6e6e;">Trang chủ </span></a> <span style="font-weight: 400;"> > </span>
    <a href="index_user.php"><span style="color: #6e6e6e;">Quản lý người dùng</span></a> <span style="font-weight: 400;"> > </span>
    <a href="them_user.php"><span style="color: #b1abab;">Tạo người dùng mới</span></a>
</div>
<!-- Nội dung ở đây -->
<h1 style="text-align: center">Tạo người dùng mới</h1>
<form method="post" action="" name="ThemUser" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-4" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>Username:</strong></div>
        <div class="col-md-12" style="color: red;"><input style="width:100%;"type="text" name="Username" placeholder="ví dụ: abc" size="50"/></div>
    </div>
    <div class="row">
        <div class="col-md-4" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>Họ và Tên:</strong></div>
        <div class="col-md-12" style="color: red;"><input style="width:100%;"type="text" name="HoTenK" placeholder="ví dụ: abc" size="50"/></div>
    </div>
    <div class="row">
        <div class="col-md-4" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>Password:</strong></div>
        <div class="col-md-12" style="color: red;"><input style="width:100%;" type="password" name="Password" placeholder="Nhập password" size="50"/></div>
    </div>
    <div class="row">
        <div class="col-md-4" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>Nhập lại Password:</strong></div>
        <div class="col-md-12"style="color: red;"><input style="width:100%; " type="password" name="Password_1" placeholder="Nhập lại password" size="50"/></div>
    </div>
    <div class="row">
        <div class="col-md-4" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>Địa chỉ:</strong></div>
        <div class="col-md-12" style="color: red;"><input style="width:100%;" type="text" name="DiaChi" placeholder="Ninh Kiều, Cần Thơ" size="50"/></div>
    </div>
    <div class="row">
        <div class="col-md-4" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>Điện thoại: </strong></div>
        <div class="col-md-12" style="color: red;"><input style="width:100%;" type="tel" name="DienThoai" placeholder="0834777999" maxlength="13"size="50" /></div>
    </div>
    <div class="row">
        <div class="col-md-4" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>Email: </strong></div>
        <div class="col-md-12" style="color: red;"><input style="width:100%;" type="email" name="Email" placeholder="abc@gmail.com" size="50" /></div>
    </div>
    <div class="row">
        <div class="col-md-4" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>Ngày đăng ký: </strong></div>
        <div class="col-md-12"style="color: red;"><input style="width:100%;"  type="text" name="NgayDangKy" readonly="readonly" size="50" value="<?php echo date("Y-m-d h:i:s");?>"/></div>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-12">
        <button style="background-color: #ff8c00; margin-left: 835px; font-size: 20px; border-radius:10px" id="Them" name="Them"  class="btn"> + Thêm</button> 
    </div>

</form>
<?php include_once ('footer.php');?>
</body>
</html>