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
    <title>Đơn hàng của bạn</title>
    <?php include_once('header2.php'); ?>
    <link rel="stylesheet" href="../css/fontawesome-free-6.1.2-web/css/all.css">
</header>
<body>
<h1 style="text-align: center; margin-top: -40px">Đơn hàng của bạn</h1>
<!--Content Start Here -->
<div>
    <?php
    if (isset($_SESSION['IDUser'])) {
        $sql_u = "select * from users where idUser=" . (int)$_SESSION['IDUser'];
        $query_u = mysqli_query($conn, $sql_u);
        $flag = true;/// đã đăng nhập
    }
    while ($r = $query_u->fetch_assoc()) { ?>
        <div style="margin-left:132px;">       
            <div><span>Tên Khách Hàng: </span><strong><?php echo $r['HoTenK']; ?><strong></div>  
            <div><span style="font-weight: 100;">Số Điện Thoại: </span><strong><?php echo $r['DienThoai']; ?><strong></div>
            <div><span style="font-weight: 100;">Email: </span><strong><?php echo $r['Email']; ?> </strong></div>
            <div><span style="font-weight: 100;">Địa Chỉ: </span><strong><?php echo $r['DiaChi']; ?> </strong></div>
        </div>
    <?php } ?>
</div>
    <br>
    <h4 style="color: firebrick; margin-left: 130px;" >Quý khách hàng lưu ý: Khi shop đã xử lý đơn hàng thì quý khách hàng không được hủy đơn. </h4>
<div class="main" style="margin-left:10%; margin-right:10%; height:380px">
<div style="overflow-x: scroll">
    <table class=" table table-bordered hover" style="overflow-x: scroll" border="2">
        <thead class="text-center">
        <tr style="    background-color: darkorange;">
            <td width=""><strong>Mã đơn hàng</strong></td>
            <td width=""><strong>Thời gian đặt</strong></td>
            <td width=""><strong>Tổng tiền</strong></td>
            <td width=""><strong>Trạng thái</strong></td>
            <td width=""><strong>Hủy đơn</strong></td>
        </tr>
        </thead>
        <?php
        if (isset($_SESSION['IDUser'])) {
            $sql_u = "select * from donhang where idUser=" . (int)$_SESSION['IDUser'];
            $query_u = mysqli_query($conn, $sql_u);
            $flag = true;/// đã đăng nhập
        }
        while ($r = $query_u->fetch_assoc()) { 
            ?>
            <tbody>         
            <td width=""><strong>MD100<?php echo $r['idDH']; ?><strong></td>
            <td width=""><strong><?php echo $r['ThoiDiemDatHang']; ?> </strong></td>
            <td width=""><strong><?php
                    $sl_sp_ctdh="select sum(SoLuong*Gia) as TongTien from sanpham a, donhangchitiet b where a.idSP=b.idSP and idDH=".$r['idDH'];
                    $rs_tt=mysqli_query($conn,$sl_sp_ctdh);
                    $d=mysqli_fetch_array($rs_tt);
                    echo $d['TongTien']; ?> </strong></td>
            <?php
                if($r['DaXuLy']=='0'){ ?>
                <td><strong><?php echo 'Đang xác nhận';?></strong></td>
                
                <?php }elseif($r['DaXuLy']=='1'){ ?>
                
                <td><a href="xuly.php?idDH=<?php echo $r['idDH'];?>"><strong> Nhận hàng</strong></a></td>

                
                <?php }elseif($r['DaXuLy']=='2'){ ?>
                
                    <td><strong ><?php echo 'Đã nhận được hàng'; ?></strong></td>


                <?php }elseif($r['DaXuLy']=='3'){ ?>
                        
                    <td><strong style="color: blue;"><?php echo 'Đã nhận'; ?></strong></td>

                    
                <?php }elseif($r['DaXuLy']=='4'){ ?>
                <td><strong style="color: firebrick"><?php echo 'Đã hủy'; ?></strong></td> 


                <?php }else echo "";?>

            <?php
            if($r['DaXuLy']=='0'){
                ?>
                <td><button class="btn btn-primary"><a href="xoa_donhang1.php?idDH=<?php echo $r['idDH'];?>"><strong style="color: black;"> Hủy đơn </strong></a></button></td>
                <?php
                    }elseif($r['DaXuLy']=='1'){
                ?>
                <td><strong style="color: red;">Không hủy được</strong></td>
                <?php
                    }elseif($r['DaXuLy']=='2'){
                ?>
                <td><strong style="color: red;"> Không hủy được </strong></td>
                
                
                <?php
                    }elseif($r['DaXuLy']=='3'){
                ?>
                <td><strong style="color: red;"> Đang yêu cầu... </strong></td>
                <?php
                    }elseif($r['DaXuLy']=='4'){?>
                <td><strong><?php echo 'Đơn đã hủy'; ?></strong></td> <?php
                }else echo "";?>
            </tbody>
        <?php } ?>
    </table>
</div>
</div>

<div>
    <img src="../images/freeship.PNG" style="margin-left: 140px;border-radius: 34px;">
</div>
<br>
<?php include_once('footer.php'); ?>
</body>
</html>
<!-- -0: chờ xác nhận -1:đang giao/đã nhận được hàng -2:đã nhận -3:đang yêu cầu -4:đã hủy -->
