<?php

if(!isset($_SESSION))
{
    session_start();ob_start();
}

include_once ('../connection/connect_database.php');
if(isset($_POST['TaoTK'])){
    if ($_POST['Username']!=""&& $_POST['Password']!="" && $_POST['Password1']!="" && $_POST['DiaChi']!="" && $_POST['DienThoai']!="") {
        $sql = "select * from users";
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
        if (md5($_POST['Password']) !=md5( $_POST['Password1'])){
            $thongbao = $thongbao . 'Mật khẩu không trùng khớp';
        }
        if ($thongbao != "") {
            echo "<script language='javascript'>alert('$thongbao');</script>";
        } else {

            $sl = "insert into users(HoTen,HoTenK,Password,DiaChi,DienThoai,Email,NgayDangKy,idGroup) VALUES ('" . $_POST['Username'] . "','" . $_POST['HoTenK'] . "','" .md5( $_POST['Password'] ). "','" . $_POST['DiaChi'] . "','" . $_POST['DienThoai'] . "','" . $_POST['Email'] . "','" . $_POST['NgayDangKy'] . "',2)";
            $kq = mysqli_query($conn, $sl);
            if ($kq) {
                echo "<script language='javascript'>alert('Đăng ký thành công');";
                $sql = "select idUser from Users where HoTen='" . $_POST['Username'] . "'";
                $query = mysqli_query($conn, $sql);
                $d=mysqli_fetch_array($query);
                $_SESSION['Username'] = $_POST['Username'];
                $_SESSION['HoTenK'] = $_POST['HoTenK'];
                $_SESSION['IDUser'] = $d['idUser'];
                $_SESSION['SDT'] = $_POST['DienThoai'];
                $_SESSION['DC'] = $_POST['DiaChi'];
                $_SESSION['Email'] = $_POST['Email'];
                // $_SESSION['Email'] = $Email;
                echo "location.href='../site/DangNhap.php';</script>";
            }
            else
                echo "<script language='javascript'>alert('$thongbao');</script>";
        }
    }
    else
        echo "<script language='javascript'>alert('Vui lòng nhập đầy đủ thông tin!');</script>";
}
?>

<!DOCTYPE html>
<html>
<header>
    <?php include_once ("header.php");?>
    <title>Trang chủ</title>
    <?php include_once ("header1.php");?>
</header>
<style>
    .row-style {
        padding: 100px;
    }
    .ct {
        margin-right: 370px;
    }
</style>
<body>
    
<div class="row row-style" style="background:transparent url('../images/img_login.jpg') no-repeat center center /cover">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="TaoTaiKhoan.php" method="post">
                <div class="container" style="background:transparent url('../images/anhdangky2.jpg'); width:40%; ">
                    <br>
                    <div class="row">
                        <div   style="font-size: 150%; font-family: 'Helvetica Neue', helvetica, arial, sans-serif; color: #0e0079; text-align: center;"><b>Đăng Ký Tài Khoản</b></div>
                    </div>
                    <br/>
                    <div class="row" style="margin-left: 80px;">
                        <div style="color: red;">
                            <input type="text" style="border-radius: 2px; color: black; height:35px;"   size="30" name="Username" id="Username" placeholder="Nhập username..." > 
                        </div>
                    </div>
                    <br/>
                    <div class="row" style="margin-left: 80px;">
                        <div   style="color: red;">
                            <input type="text" style="border-radius: 2px; color: black; height:35px;"   size="30" name="HoTenK" id="HoTenK" placeholder="Nhập họ tên..." > 
                        </div>
                    </div>
                    <br/>
                    <div class="row" style="margin-left: 80px;">
                        <div  style="color: red;">
                            <input type="password" style="border-radius: 2px; color: black; height:35px;" size="30" name="Password" id="Password" placeholder="Nhập password..." > 
                        </div>
                    </div>
                    <br/>
                    <div class="row" style="margin-left: 80px;">  
                        <div  style="color: red;">
                            <input type="password" style="border-radius: 2px; color: black; height:35px;"  size="30" name="Password1" id="Password1" placeholder="Nhập lại password..." > 
                        </div>
                    </div>
                    <br/>
                    <div class="row" style="margin-left: 80px;">   
                        <div  style="color: red;">
                            <input type="text" style="border-radius: 2px; color: black; height:35px;"  size="30" name="DiaChi" id="DiaChi" placeholder="Nhập địa chỉ...">
                        </div>
                    </div>
                    <br/>
                    <div class="row" style="margin-left: 80px;">
                        <div  style="color: red;">
                            <input type="tel" style="border-radius: 2px; color: black; height:35px;" size="30" name="DienThoai" id="DienThoai" placeholder="Nhập số điện thoại..." >
                        </div>
                    </div>
                    <br/>
                    <div class="row" style="margin-left: 80px;">
                        <div  style="color: red;">
                            <input type="email" style="border-radius: 2px; color: black; height:35px;"   size="30" name="Email" id="Email" placeholder="Nhập email...">
                        </div>
                    </div>
                    
                    <!-- <div class="row">
                        
                        <div  class="col-md-3" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><b><i>Ngày đăng ký: </i></b></div>
                        <div  style="color: red;">
                            <input type="text" style="border-radius: 2px; color: black; height:35px;"  readonly="readonly" size="30" name="NgayDangKy" id="NgayDangKy" value="<?php echo date("Y-m-d h:i:s");?>">
                        </div>
                    </div> -->
                    <br/>
                    <div class="row" style="margin-left: 135px;">
                        <div>
                            <button id="TaoTK" name="TaoTK"  class="btn btn-success">Đăng Ký</button>  
                            <button class="btn btn-success"><a style="text-decoration: none; color: #FFFFFF;" href="../site/index.php?index=1">Thoát</a></button>
                        </div>
                    </div>
                    <div class="row" style="margin-left: 100px;">
                        <p>Bạn đã có tài khoản? <a href="../site/DangNhap.php">Đăng nhập</a></p>
                    </div>
                 
                </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!---- Nội dung---->
</div>
<?php

?>
</body>
</html>

