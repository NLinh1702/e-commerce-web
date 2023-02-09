<?php

include_once ('../connection/connect_database.php');
$sl_user = "select * from users WHERE idGroup=2";
$rs_user = mysqli_query($conn,$sl_user);
if(!$rs_user)
echo "Không thể truy vấn CSDL";?>

<!DOCTYPE html>
<html>
<header>
    <?php include_once ("header1.php");?>
    <title>Danh sách người dùng </title>
    <?php include_once('header2.php');?>
    <link rel="stylesheet" href="../css/fontawesome-free-6.1.2-web/css/all.css">
    <style>
        div.row {
            padding-top: 2%;
        }
        .quatrai1 {
            margin-left: 832px;
        }
    </style>
</header>
<body>
<?php include_once ('header3.php');?>
<br>
<div>
    <a href="index.php"><span style="color: #6e6e6e;">Trang chủ </span></a> <span style="font-weight: 400;"> > </span>
    <a href="index_user.php"><span style="color: #b1abab;">Quản lý người dùng</span></a>
</div>
<!--Content Start Here -->
<h1 style="text-align: center">DANH SÁCH NGƯỜI DÙNG </h1> 
<a href="them_user.php" ><strong><button type="button" style="background-color: #ff8c00; border-radius: 10px;" class="btn quatrai1"> + Tạo mới </button></strong></a>
<div style="overflow-x: scroll"> <table class=" table table-bordered hover"  style="overflow-x: scroll" border="2">
        <thead class="text-center bg-success p-2 text-white">
        <tr>
            <td width=""><strong> Stt</strong></td>
            <td width=""><strong> Tên người dùng </strong></td>
            <td width=""><strong> Địa chỉ </strong></td>
            <td width=""><strong> SĐT </strong></td>
            <td width=""><strong> Email </strong></td>
            <td COLSPAN="2"><strong> Xóa</strong></a></td>
        </tr>
        </thead>
        <?php $stt = 0;?>
        <?php while ($r = $rs_user->fetch_assoc()) {?>
            <tbody>
            <td width=""> <?php echo ++$stt ;?></td>
           
            <td width=""><?php echo $r['HoTenK'];?></td>
            <td width=""><?php echo $r['DiaChi'];?></td>
            <td width=""><?php echo $r['DienThoai'];?></td>
            <td width=""><?php echo $r['Email'];?> </td>
            <td align="center"><a href="xoa_user.php?idUser=<?php echo $r['idUser'];?>"><i class="fas fa-trash-alt"></i></a></td>
            </tbody>
        <?php }?>
    </table></div>
<?php include_once ('footer.php');?>
</body>
</html>
