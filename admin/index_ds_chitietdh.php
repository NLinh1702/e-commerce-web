<?php
include_once('../connection/connect_database.php');
$sl_ctdonhang = "select * from donhangchitiet where idDH =" . $_GET['idDH'];
$rs_ctdonhang = mysqli_query($conn, $sl_ctdonhang);
if (!$rs_ctdonhang)
    echo "Không thể truy vấn CSDL"; ?>
<?php
    if(isset($_POST['capnhatdonhang'])){
        $xuly = $_POST['xuly'];
        $mahang = $_POST['mahang_xuly'];
        $sql_update_donhang = mysqli_query($conn, "UPDATE donhang SET DaXuLy='$xuly' WHERE idDH='$mahang'");
        $sql_update_donhangchitiet = mysqli_query($conn, "UPDATE donhangchitiet SET DaXuLy='$xuly' WHERE idDH='$mahang'");
        $sql_chitietdh= mysqli_query($conn, "SELECT * FROM `donhangchitiet` WHERE idDH='$mahang'");
        while($row = mysqli_fetch_array($sql_chitietdh)){
            $soluong=$row['SoLuong'];
            $idSP=$row['idSP'];
            if($xuly==1){
                mysqli_query($conn, "UPDATE sanpham SET SoLuongTonKho=SoLuongTonKho-'$soluong' WHERE idSP='$idSP' and SoLuongTonKho>='$soluong'");
            }elseif($xuly==4){
                mysqli_query($conn, "UPDATE sanpham SET SoLuongTonKho=SoLuongTonKho+'$soluong' WHERE idSP='$idSP'");
            }
        }
    }
?>
<!--  -->
<!DOCTYPE html>
<html>
<header>
    <?php include_once("header1.php"); ?>
    <title>Chi tiết đơn hàng </title>
    <?php include_once('header2.php'); ?>
    <link rel="stylesheet" href="../css/fontawesome-free-6.1.2-web/css/all.css">
</header>
<body>
<?php include_once('header3.php'); ?>
<br>
<div>
    <a href="index.php"><span style="color: #6e6e6e;">Trang chủ </span></a> 
        <span style="font-weight: 400;"> > </span>
    <a href="index_donhang.php"><span style="color: #6e6e6e;">Quản lý đơn hàng</span></a>
        <span style="font-weight: 400;"> > </span>
    <a href="#"><span style="color: #b1abab;">Chi tiết đơn hàng</span></a>
</div>
<!-- Nội dung ở đây -->
<h1 style="text-align: center">CHI TIẾT ĐƠN HÀNG</h1> <br>
<form method="post" action="" name="ChiTietSP" enctype="multipart/form-data">
    <div style="overflow-x: scroll">
        <table class=" table table-bordered hover" style="overflow-x: scroll" border="2">
            <thead class="text-center bg-success p-2 text-white">
            <tr>
                <td width=""><strong> Mã đơn hàng</strong></td>
                <td width=""><strong> Sản phẩm</strong></td>
                <td width=""><strong> Số lượng </strong></td>
                <td width=""><strong> Giá</strong></td>
                <td width=""><strong> Thành tiền</strong></td>
                <td width=""><strong> Trạng thái </strong></td>
                <td width=""><strong> Xử lý đơn </strong></td>  
            </tr>
            </thead>
            <?php $tong = 0;
            while ($r = $rs_ctdonhang->fetch_assoc()) { ?>
                <tbody>
                    <td width="">SP100<?php echo $r['idDH']; ?> </td>
                    <td width=""><?php echo $r['TenSP']; ?> </td>
                    <td width=""><?php echo $r['SoLuong']; ?> </td>
                    <td width=""><?php echo $r['Gia']; ?> </td>
                    <td width=""><?php echo $tong += $r['Gia'] * $r['SoLuong'] - $r['GiaKhuyenMai']; ?> </td>
                    <input type="hidden" name="mahang_xuly" value="<?php echo $r['idDH'] ?>">
                    <td width="">
                    <?php if($r['DaXuLy'] ==1 ) echo "Đã xử lý"; 
                        if($r['DaXuLy'] ==0) echo "Chưa xử lý"; 
                        if($r['DaXuLy'] ==2) echo "Đã giao"; 
                        if($r['DaXuLy'] ==3) echo "Yêu cầu hủy"; ?> </td>
                    <td width="110px">
                        <select class="form-control" name="xuly">
                            <option value="">-Trạng thái-</option>
                            <option value="1" width="50px">Đã xử lý</option>
                        </select> 
                    </td> 
                </tbody>
            <?php } ?>
        </table>
        
    </div>
    <div class="row">
        <div class="col-lg-offset-3" style="margin-left:75%"><h2>Tổng tiền: <strong style="color:red;"><?php echo $tong; ?> </strong></h2></div>
    </div>
    
    <table>
        <tr>
            
            
            
            <td>
                <input type="submit" value="Xác nhận" name="capnhatdonhang" id="capnhatdonhang" class="btn" style="margin:15px; background-color:#ff8c00; border-radius: 10px;">   
            </td>
        </tr>
    </table>
</form>
<?php
    if(isset($_POST['trove']))
    {
        echo "<script type=\"text/javascript\">
        
                location.href='index_donhang.php';
        </script>";
    }
?>

<?php include_once('footer.php'); ?>

</body>
</html>
