<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Nhipuka
 * Date: 27-Mar-17
 * Time: 17:19
 */

include_once ('../connection/connect_database.php');
$sl_nhanhieu = "select * from nhanhieu";
$rs_nhanhieu = mysqli_query($conn,$sl_nhanhieu);
if(!$rs_nhanhieu)
echo "Không thể truy vấn CSDL";?>

<!DOCTYPE html>
<html>
<header>
    <?php include_once ("header1.php");?>
    <title>Danh sách nhãn hiệu </title>
    <?php include_once('header2.php');?>
    <link rel="stylesheet" href="../css/fontawesome-free-6.1.2-web/css/all.css">
    <style>
        .quatrai1 {
            margin-left: 800px;
        }
    </style>
</header>
<body>
<?php include_once ('header3.php');?>
<br>
<div>
    <a href="index.php"><span style="color: #6e6e6e;">Trang chủ </span></a> <span style="font-weight: 400;"> > </span>
    <a href="index_nh.php"><span style="color: #b1abab;">Quản lý nhãn hiệu</span></a>
</div>
<!--Content Start Here -->
<h1 style="text-align: center">DANH SÁCH NHÃN HIỆU </h1> <br>
<a href="them_nh.php" ><strong><button type="button" style="background-color: #ff8c00; border-radius: 10px;" class="btn quatrai1">+ Tạo nhãn hiệu</button></strong></a>
<table class=" table table-bordered " border="2">
    <thead class="text-center bg-success p-2 text-white">
    <tr>
        <td width="50%"><strong> Nhãn hiệu </strong></td>
        <td width="10%"><strong> Loại nước hoa </strong></td>
        <!-- <td width="10%"><strong> ẨN/HIỆN </strong></td> -->
        <td width="10%"><strong> Sửa/Xóa </strong></td>
    </tr>
    </thead>
    <?php $stt = 0;?>
    <?php while ($r = $rs_nhanhieu->fetch_assoc()) {?>
        <tbody>
        <td width="50%"><?php echo $r['TenNH'];?></td>
        <?php
        $sl_loai = "select TenL from loaisp WHERE idL =".$r['idL'];
        $result_loai = mysqli_query($conn,$sl_loai);
        $r_loai = mysqli_fetch_array($result_loai);
        ?>
        <td width="50%"><?php echo $r_loai['TenL'];?></td>
        <td align="center"><a href="sua_xoa_nh.php?idNH=<?php echo $r['idNH'];?>" ><strong> <i class="fa-solid fa-pen-to-square"></i> </strong></a></td>
        </tbody>
    <?php }?>
</table>

<?php include_once ('footer.php');?>
</body>
</html>



