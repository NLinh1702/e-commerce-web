<?php

if(!isset($_SESSION))
{
    session_start();ob_start();
}
$idSP =(int)$_GET['idSP'];
include ("../connection/connect_database.php");
$product = array();
$sl_sanpham = "select * from sanpham";
$rs_sanpham = mysqli_query($conn,$sl_sanpham);
while ($r= $rs_sanpham->fetch_assoc())
{
    if($r['idSP'] == 1) continue;
    $tennh="Chưa xác định";
    $sl_nh = "select * from nhanhieu WHERE idNH=".$r['idNH'];
    $rs_nh = mysqli_query($conn,$sl_nh);
   while ($r_tennh = $rs_nh->fetch_assoc())
   {
           $tennh = $r_tennh['TenNH'];
   }
    $product[] = array("idSP"=>$r['idSP'],"TenSP" =>$r['TenSP'],
    "GiaBan" =>$r['GiaBan'],"urlHinh" => $r['urlHinh'],
    "TenNH"=>$tennh,"SoLTon"=>$r['SoLuongTonKho']);
}
$newproduct = array();
foreach ($product as $val)
{
    $newproduct[$val['idSP']] = $val;
}
if((!isset($_SESSION['cart']) || isset($_SESSION['cart']) == null )&& $idSP !=1) // giỏ rỗng
{
    $newproduct[$idSP]['qty'] =1;
    $_SESSION['cart'][$idSP] = $newproduct[$idSP];/// đưa sp vào giỏ
}else// giỏ đã có hàng
{
    if($idSP !=1)
    {
        if(array_key_exists($idSP,$_SESSION['cart']))///// kiểm tra xem đã có sp này trong giỏ hay chưa
        {
            //// nếu có thì tăng số lượng của sản phẩm đó, không thêm vào giỏ
            $_SESSION['cart'][$idSP]['qty'] +=1;
        }else{
            //// nếu không thì thêm vào giỏ
            $newproduct[$idSP]['qty'] =1;
            $_SESSION['cart'][$idSP] = $newproduct[$idSP];
        }
    }

}
$so =0;
if(isset($_SESSION['cart']))
    $so = count($_SESSION['cart']);
?>
<!DOCTYPE html>
<html>
<header>
    <?php include_once ("header.php");?>
    <title>Giỏ hàng</title>
    <?php include_once ("header1.php");?>
    <style>
        .glyphicon.glyphicon-pencil{ color: #1fb3f6;}
    </style>
    <link rel="stylesheet" href="../css/fontawesome-free-6.1.2-web/css/all.css">
<?php
echo "<script>$('#x').click(function(event){
    $('#myModal').hide();
$('.modal-backdrop').hide(); 

});</script>";
if($_GET['idSP'] ==1)
{
    echo "<script language='JavaScript'>
$('#myModal').hide();
$('.modal-backdrop').hide();
</script>";
}
   else
       echo " <script language=\"JavaScript\">
       $(window).on('load',function(){
           $('#myModal').modal('show');
        });
  </script>"?>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->

    <!-- end JS-->
    <style> .ngang{
    background-color: #332c68;
    margin-top: 2%;
    margin-bottom: 2%;
    margin-left: 10px;
}
    .form-style {
        opacity:1;
    display:inline-block;
    display:-ms-inline-flexbox;
    display:inline-flex;
    white-space:nowrap;
    vertical-align:top;
    }
    </style>
</header>
<body>
<?php include_once ("header2.php");?>
<!---- Nội dung---->
<div class="content">
    <!-----Thông tin giỏ hàng------>
    <h1><p align="center"><i class="fa-sharp fa-solid fa-cart-shopping"></i><b> Giỏ hàng</b></p></h1><br>
    <br>
    <div class="row">
        <div class=" col-md-8">
            <div class=" row">
                <table class="table">
                    <thead class="thead-dark" style="background-color: darkorange;">
                        <tr>
                        <th class="col-md-3"><b style="margin-left: 40px;">Hình ảnh</b></th>
                        <th class="col-md-3"><b>Tên sản phẩm
                            <th class="row"></th>
                        </b></th>
                        <th class="col-md-3"><b>Giá</b></th>
                        <th class="col-md-3"><b>Số lượng</b></th>
                        <th class="col-md-3"><b style="margin-right: 13px;">Xóa</b></th>
                        </tr>
                    </thead>
                </table>
                <!-- <div class="col-md-3"><b>IMG</b> </div>
                <div class="col-md-3"><b>Name</b> 
                    <div class="row"></div>
                    <div class="row"></div>
                </div>
                <div class="col-md-3"><b>Price</b></div>
                <div class="col-md-2"><b>Quantity</b></div>
                <div class="col-md-1"><b>Delete</b></div> -->
            </div>
        </div>
    </div>
    <!-- <div class="row"><div class=" col-md-12" style="background-color: #5a5355;"></div></div> -->

<div class="row">
    <div class=" col-md-8">
        <?php $tongtien =0;
        if($so ==0)
        {
            echo"<div class='row' align='center'><h2><b>Giỏ hàng chưa có sản phẩm nào.</b></h2></div>";
            echo"<img src='../images/no-cart.png' class='center-block'>";

        }
        else
        {
        foreach ($_SESSION['cart'] as $list)
        { $tongtien += (int)$list['qty']*$list['GiaBan'];?>
            <div class=" row" style="margin-bottom: 2%;background-color:#F5F5F5;">
                <div class="col-md-2"><a href="MoTa.php?idSP=<?php echo $list['idSP'];?>"> <img height="100%" style=" margin: 10%" width="70%" src="../images/<?php echo $list['urlHinh'];?>"></a></div>
                <div class="col-md-3" style="margin-top: 2%">
                    <div class="row"><?php echo $list['TenSP'];?></div>
                    
                </div>
                <div class="col-md-2" style="margin-top: 2%; margin-left: 53px; color:red;">
                    <div class="row" style="margin-top: 5px;"><?php echo number_format($list['GiaBan'],0)." VNĐ";?></div>

                </div>
                <div class="col-md-3" style="margin-top: 2%">
                    <form action="" method="post">
                        <div class="form-group form-style">
                            <?php if($list['qty']>1) {?> <a href="Giam_SL.php?idSP=<?php echo $list['idSP'];?>" class="addcartbtn" onclick="AddCart"><input type="button" style="font-size: 20px;" value="-"></a><?php }?>
                            <input style="width:50%;" id="<?php echo $r['idSP']."SL";?>" name="<?php echo $r['idSP']."SL";?>" class="form-control bfh-number" type="text" value="<?php echo $list['qty'];?>" min="1" max="<?php echo (int)$list['SoLTon'];?>" />
                            <?php if($list['qty']< (int)$list['SoLTon']) {?> <a href="Tang_SL.php?idSP=<?php echo $list['idSP'];?>" class="addcartbtn" onclick="AddCart"><input type="button"  style="font-size: 20px;" value="+"></a><?php }?>
                        </div>
                    </form>
                </div><br>
                <div class="col-md-1" style="margin-left: 3px;"> 
                    <td>
                        <a onclick="return confirm('Bạn có muốn xóa không?');" href="Xoa_Gio_Hang.php?idSP=<?php echo $list['idSP'];?>"><button type="button" class="btn btn-danger">Xóa</button></a>
                    </td>
                </div>
            </div>
        <?php }}?>

    </div>
    <div class="col-md-1"></div>
    <div class="col-md-3" style="margin-bottom: 2%;background-color:#F5F5F5;">
            <div class="row" >
                <div class="col-md-12" align="center"><h3><b style="margin-right: 30px; color: #ff8c00;"><i class="fa-solid fa-receipt"></i> Đơn hàng </b></h3></div>
                 <div class="col-md-11 ngang"></div>
            </div>
            <div class="row">
                <div class="col-md-6"><strong style="color: black;">Tạm tính:</strong></div>
                <div class="col-md-6"><strong style="color: firebrick"><?php echo number_format($tongtien,0);?></div>
                <div class="col-md-11 ngang"></div>
            </div>
            <div class="row">
                <div class="col-md-12"> <strong style="color: black;">Tổng cộng: </strong><strong style="color: firebrick; margin-left: 51px;"><?php echo  number_format($tongtien);?></strong></div>
            </div>
                <div class="row">
                    <div class="col-md-11 ngang"></div>
                    <div class="col-md-6"><a href='index.php?index=1'><button type="button" class="btn btn-success"><i class="fa-sharp fa-solid fa-rotate-left"></i> Mua tiếp</button></a></div>
                    <div class="col-md-6"><a href='ThanhToan.php'><button type="button" class="btn btn-success" style=" width: 108px;"><i class="fa-brands fa-amazon-pay"></i> Thanh toán</button></a></div>
                </div>
    </div>
</div>

</div>

<!-- <div class="row"  style="padding-top: 3%;"><div class=" col-md-12" style="background-color: #5a5355;"></div></div> -->

<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content" style="font-size: 14px;color: black;text-align: center;width: 400px;margin-left: 235px;background: gainsboro;">
                <div class="modal-header">
                    <button id="x" type="button" class="close" data-dismiss="modal">&times;</button>
                    <!-- <div class="row" align="center"><img src="../images/Cart.png" width="30px" height="30px" alt="logo"> -->
                        <!-- <span class="modal-title" ><b>Giỏ hàng</b></span></div> -->
                </div>
                <div class="modal-body">

                    <?php
                    if(isset($_SESSION['cart']) && $_SESSION['cart'] == null) {
                        echo "<p>Không có sản phẩm nào trong giỏ hàng</p>";
                        echo "<div><a href='index.php?index=1'>Tiếp tục mua hàng</a> </div>";
                    }
                    else
                    {   echo 'Một sản phẩm mới được thêm vào giỏ hàng!!!';?>
                       
                    <?php }?>
            </div>

        </div>
    </div>

    <!------>
<?php include_once ("footer.php");?>
<script src="../js/jquery-1.11.2.min.js" ></script>
<script src="../js/bootstrap.min.js" ></script>



</body>
</html>
