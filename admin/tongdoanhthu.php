<!-- Tổng doanh thu -->
<?php
$conn = mysqli_connect('localhost', 'root', '', 'datashop')
or die ('Không thể kết nối tới database');
$conn->set_charset("utf8");
date_default_timezone_set('Asia/Ho_Chi_Minh');
$sl_tk = "select * from donhang where DaXuLy>0 and DaXuLy<4";
$rs_tk = mysqli_query($conn, $sl_tk);
$tong=0; $soluong=0;
while ($r = $rs_tk->fetch_assoc()) { 
?>
    <?php
    $sl_ctdh="select sum(SoLuong*Gia) as TongTien from sanpham a, donhangchitiet b where a.idSP=b.idSP and idDH=".$r['idDH'];
    $rs=mysqli_query($conn,$sl_ctdh);
    $d=mysqli_fetch_array($rs);
    $sl_sl="select count(SoLuong) as DemSL from sanpham a, donhangchitiet b where a.idSP=b.idSP and idDH=".$r['idDH'];
    $rs_sl=mysqli_query($conn,$sl_sl);
    $c=mysqli_fetch_array($rs_sl);
    ?> 
        <?php  $tong+=$d['TongTien']; 
        $tong1 = number_format($tong);
        $soluong +=$c['DemSL'];?> 
<?php }?>