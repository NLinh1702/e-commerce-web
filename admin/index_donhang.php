<?php
include_once('../connection/connect_database.php');
$sl_donhang = "select * from donhang order by idDH desc";
$rs_donhang = mysqli_query($conn, $sl_donhang);
if (!$rs_donhang)
    echo "Không thể truy vấn CSDL"; ?>
<!DOCTYPE html>
<html>
<header>
    <?php include_once("header1.php"); ?>
    <title>Danh sách đơn hàng </title>
    <?php include_once('header2.php'); ?>
    <link rel="stylesheet" href="../css/fontawesome-free-6.1.2-web/css/all.css">
</header>
<body>
<?php include_once('header3.php'); ?>
<br>
<div>
    <a href="index.php"><span style="color: #6e6e6e;">Trang chủ </span></a> <span style="font-weight: 400;"> > </span>
    <a href="index_donhang.php"><span style="color: #b1abab;">Quản lý đơn hàng</span></a>
</div>
<!--Content Start Here -->
<h1 style="text-align: center">DANH SÁCH ĐƠN HÀNG </h1>
<!-- <a href="xu_ly_don_hang.php" style="margin-bottom:1%" ><strong><button type="button" class="btn btn-info"> GIẢI QUYẾT ĐƠN HÀNG </button></strong></a> -->
<div style="overflow-x: scroll">
    <table class=" table table-bordered hover" style="overflow-x: scroll" border="2">
        <thead class="text-center bg-success p-2 text-white">
        <tr>
            <td width=""><strong> Mã ĐH</strong></td>
            <td width=""><strong> Người nhận </strong></td>
            <td width=""><strong> Ngày đặt </strong></td>
            <td width=""><strong>Địa chỉ</strong></td>
            <td width=""><strong> SĐT</strong></td> 
            <td width=""><strong> Chi tiết</strong></td>
            <td width=""><strong> Trạng thái</strong></td>
            <td><strong> Xóa </strong></a></td>
        </tr>
        </thead>
        <?php $stt = 0;
        while ($r = $rs_donhang->fetch_assoc()) { ?>
            <tbody>
            <td width="">SP100<?php echo $r['idDH']; ?></td>
            <td width=""><?php echo $r['TenNguoiNhan']; ?></td>
            <td width=""><?php echo $r['ThoiDiemDatHang']; ?></td>
            <td width=""><?php echo $r['DiaChi']; ?></td>
            <td width="">0<?php echo $r['SDT']; ?></td>
            <td align="center">
                <a href="index_ds_chitietdh.php?idDH=<?php echo $r['idDH']; ?>">
                Xem chi tiết</a>
            </td>
            <td width="" style="color: red;"><strong>
                <?php if($r['DaXuLy'] ==1 ){
                    echo "<button><strong style=\"color: blue;\">Đã xử lý</strong> </button>";
                }
                    if($r['DaXuLy'] ==0){
                        echo "<button><strong style=\"color: red;\">Chưa xử lý</strong> </button>";
                    } 
                    if($r['DaXuLy'] ==2){
                        echo "<button><strong style=\"color: blue;\">Đã giao</strong> </button>";  
                    }              
                    if($r['DaXuLy'] ==3){
                        echo "<button><strong style=\"color: red;\">Yêu cầu hủy</strong> </button>";  
                    } 
                    if($r['DaXuLy'] ==4) {
                        echo "<button><strong style=\"color: black;\"> Đã hủy</strong> </button>";  
                    }?>
            
            
            
            <td><a href="xoa_donhang.php?idDH=<?php echo $r['idDH'];?>" onclick="return confirm('Bạn có muốn xóa không?');";> <i class="fas fa-trash-alt" style="margin-left: 12px;"></i></a></td>
            </tbody>
        <?php } ?>
    </table>
</div>

<?php include_once('footer.php'); ?>
</body>
</html>
