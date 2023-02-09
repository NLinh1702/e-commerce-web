<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Nhipuka
 * Date: 27-Mar-17
 * Time: 16:00
 *
 * */
include_once ('../connection/connect_database.php');
$sl_sanpham = "select * from sanpham order by idSP desc";
$rs_sanpham = mysqli_query($conn,$sl_sanpham);
if(!$rs_sanpham) {
    echo "<script language='javascript'>alert('Không thể kết nối !');";
    echo "location.href='index.php';</script>";
}

?>
<!DOCTYPE html>
<html>
<header>
    <?php include_once ("header1.php");?>
    <title>Danh sách sản phẩm </title>
    <?php include_once('header2.php');?>
    <link rel="stylesheet" href="../css/fontawesome-free-6.1.2-web/css/all.css">
    <style>
        .quatrai {
            margin-left: 600px;
        }
    </style>
</header>
<body>
<?php include_once ('header3.php');?>
<br>
<div>
    <a href="index.php"><span style="color: #6e6e6e;">Trang chủ </span></a> <span style="font-weight: 400;"> > </span>
    <a href="index_ds_sp.php"><span style="color: #b1abab;">Quản lý sản phẩm</span></a>
</div>
<!--Content Start Here -->
<h1 style="text-align: center">QUẢN LÝ SẢN PHẨM </h1> <br>
<a href="them_sp.php" style="margin-bottom:1%" ><strong><button type="button" class="btn quatrai" style="background-color: #ff8c00; border-radius: 10px;">+ Tạo sản phẩm</button></strong></a>
<a href="them_sp_hinh.php" style="margin-bottom:1% " ><strong><button type="button" class="btn" style="background-color: #ff8c00; border-radius: 10px;"> + Tạo hình ảnh</button></strong></a>
<div style="overflow-x: scroll"> <table class=" table table-bordered hover"  style="overflow-x: scroll" border="2">
        <thead class="text-center bg-success p-2 text-white">
        <tr>
            <td width=""><strong>Mã SP</strong></td>
            <td width=""><strong> Sản phẩm</strong></td>
            <td width=""><strong> Loại </strong></td>
            <td width=""><strong> Nhãn hiệu </strong></td>
            <td width=""><strong> Giá </strong></td>
            <!-- <td width=""><strong> GIÁ KM</strong></td> -->
            <td width=""><strong> Tồn kho </strong></td>
            <!-- <td width=""><strong> SLx </strong></td> -->
            <!-- <td width=""><strong> ẨN HIỆN </strong></td> -->
            <td width=""><strong> Sửa/Xóa </strong></td>
        </tr>
        </thead>
        <?php $stt = 0;?>
        <?php while ($r = $rs_sanpham->fetch_assoc()) {?>
            <tbody>
            <td width="" align="center"> <?php echo $r['idSP'];?> </td>
            <td width="" ><a href="sp_chitiet.php?idSP=<?php echo $r['idSP'];?>" > <?php echo $r['TenSP'];?> </a></td>
            <?php
            $sl_loai = "select TenL from loaisp WHERE idL =".$r['idL'];
            $result_loai = mysqli_query($conn,$sl_loai);
            $r_loai = mysqli_fetch_array($result_loai);
            ?>
            <td width="" ><?php echo $r_loai['TenL'];?> </td>
            <?php
            $sl_nh = "select TenNH from nhanhieu WHERE idNH =".$r['idNH'];
            $result_nh = mysqli_query($conn,$sl_nh);
            $r_nh = mysqli_fetch_array($result_nh);
            ?>
            <td width=""><?php echo $r_nh['TenNH'];?> </td>
            <td width="" align="center"><?php echo $r['GiaBan'];?> </td>  
            <td width="" align="center"><?php echo $r['SoLuongTonKho'];?> </td>
            <td><a href="sua_xoa_sp.php?idSP=<?php echo $r["idSP"]?>"> <i class="fa-solid fa-pen-to-square" style="margin-left: 30px;"></i></a></td>
            </tbody>
        <?php }?>
    </table></div>



<?php include_once ('footer.php');?>
</body>
</html>

