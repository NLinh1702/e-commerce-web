<?php
?>
<?php include ('../connection/connect_database.php'); ?>
<?php
if(isset($_GET['idSP']))
{
    $idSP=1;
    $idSP= (int)$_GET['idSP'];
    $sql = "select * from sanpham_hinh where idSP=".$idSP;
    $result = mysqli_query($conn,$sql);
    $sql1 = "select * from sanpham_hinh where idSP=".$idSP;
    $result1 = mysqli_query($conn,$sql1);
    $sl ="select * from sanpham where idSP=".$idSP;
    $rs_sp = mysqli_query($conn,$sl);
    $sql_comment="select * from sanpham_comment where idSP=".$idSP;
    $rs_cm=mysqli_query($conn,$sql_comment);
}
else
{
    echo "<script language='javascript'>alert('Không thể kết nối !');";
    echo "location.href='index.php?index=1';</script>";
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">

<header>
    <?php include_once ("header.php");?>
    <title>Trang chủ</title>
    <?php include_once ("header1.php");?>
    <?php include ('../connection/connect_database.php');?>
    <?php include ('../libs/lib.php');?>
    <style>
        .box{ border-radius: 2%;}
        .box.hover{border-color: green;}
        .boxsizing {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            width: 180px;
            height: 182px;
            border: 1px solid blue;
        }
        div.row{padding-top: 2%;}

        .buyproduct{ background-color: #fbc902;}
        .ml-style {
            padding: 40px;
        }
    </style>
    <style type="text/css">

        .hovergallery:hover{
            -webkit-transform:scale(1.2); /*Webkit: Scale up image to 1.2x original size*/
            -moz-transform:scale(1.2); /*Mozilla scale version*/
            -o-transform:scale(1.2); /*Opera scale version*/
            box-shadow:0px 0px 30px gray; /*CSS3 shadow: 30px blurred shadow all around image*/
            -webkit-box-shadow:0px 0px 30px gray; /*Safari shadow version*/
            -moz-box-shadow:0px 0px 30px gray; /*Mozilla shadow version*/
            opacity: 1;
        }
    </style>
    <link rel="stylesheet" href="../css/hoa.min.css" type="text/css">
    <link rel="stylesheet" href="../css/layout.min.css" type="text/css">
    <script type="text/javascript" src="../js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="../css/fontawesome-free-6.1.2-web/css/all.css">
</header>
<body>

<?php include_once ("header2_mota.php");?>
<h2><strong>--------------------------------------------   Thông tin sản phẩm   --------------------------------------------</strong></h2>
<div class="container">
    <div class="row">
            <div class="col-md-5">
                <div class="wrapper">
                <div class="row">
                        <div class="flexslider">
                            <ul class="slides">
                            <?php
                            while($r = $rs_sp->fetch_assoc()) {
                                while( $row1 = $result1->fetch_assoc()) {?>
                                <li ><img  src="../images/<?php echo $row1['urlHinh']; ?>"> </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1">
            </div>
        <div class="col-md-6 bg-success p-2 text-white" style="border-radius: 5px;">
            <form method="post" action="" name="ThemUser" enctype="multipart/form-data">
                <div class="row"><h4 align="center"><strong><div>Sản phẩm: <?php echo $r['TenSP'];?></div></strong></h4></div>
                <div class="row">
                    <div class="col-md-2" ><strong>Xuất xứ: </strong></div>
                    <div class="col-md-1"><strong>Pháp</strong></div>
                </div>
                <div class="row">
                    <div class="col-md-2"><strong>Giá: </strong></div>
                    <div class="col-md-6" style="color: #098dff;">
                        <span class="money" style="font-size: 120%;"><b><?php echo number_format($r['GiaBan']);?> VND</b></span>
                    </div>
                    <div class="col-md-9" style="color: #098dff;"></div>
                </div>
                <div class="row" style="margin-left: 10px;">
                    <?php echo $r['MoTa'];?>
                </div>
                <div class="row" style="padding: 8px;">
                       <?php  if($r['SoLuongTonKho']==0) {
                           echo "<button type=\"button\"  style=\"margin-left: 160px;\" class=\"btn btn-success\" data-toggle=\"modal\" data-target=\"#myModal\"><a style=\"color:white;\">Thêm vào giỏ </a></button>";
                       }else
                       {?><button  style="margin-left: 160px;" id="mua" name="mua"  class="btn btn-success">
                        <a style="color:white;" href="../site/GioHang.php?idSP=<?php echo $_GET['idSP'];?> " >Thêm vào giỏ </a> </button><?php }?>

                </div>
                <?php }?>
        </div>
    </div>
</div>
<h2><strong>=========================   ==================   =========================</strong></h2>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p style="color: red;"><strong>Sản phẩm này tạm hết hàng. Vui lòng khách hàng chọn sản phẩm khác!</strong></p>
            </div>
        </div>
    </div>
</div>
<?php include_once ("footer.php");?>
</body>
</html>

