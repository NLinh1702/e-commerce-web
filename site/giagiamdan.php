<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<header>
    <?php include_once ("header.php");?>
    <title>Trang chủ</title>
    <?php include_once ("header1.php");?>
    <?php include ('../connection/connect_database.php');?>
    <?php include ('../libs/lib.php');?>
    <link rel="stylesheet" href="../css/fontawesome-free-6.1.2-web/css/all.css">
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
</header>
<?php include_once ("headerchung.php");?>
        <!---- Nội dung---->
        <h1 align="center">Giá giảm dần</h1>

        <body>
        <?php
 $sl_sanpham = "select * from sanpham  WHERE AnHien=1 and idSP <>1 ORDER BY GiaBan DESC";
 $rs_sanpham = mysqli_query($conn,$sl_sanpham);
 if(!$rs_sanpham) {
     echo "<script language='javascript'>alert('Không thể kết nối !');location.href='index.php?index=1';</script>";
 }?>

 <?php
 $result = mysqli_query($conn, 'select count(idSP) as total from sanpham WHERE AnHien=1 and idSP <>1 ORDER BY GiaBan DESC');
 $row = mysqli_fetch_assoc($result);
 $total_records = $row['total'];

 // BƯỚC 3: TÌM LIMIT VÀ CURRENT_PAGE
 $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
 $limit = 11;
 $total_page = ceil($total_records / $limit);

 // Giới hạn current_page trong khoảng 1 đến total_page
 if ($current_page > $total_page){
     $current_page = $total_page;
 }
 else if ($current_page < 1){
     $current_page = 1;
 }

 // Tìm Start
 $start = ($current_page - 1) * $limit;
 $result = mysqli_query($conn, "SELECT * FROM sanpham   WHERE AnHien=1 and idSP <>1 ORDER BY GiaBan DESC LIMIT $start, $limit");
 ?>
<?php
        echo "<div class=\"row text-center\" style=\"margin-top:40px\">
    <div id=\"productlist\">";
        $n=0; while ($r= $rs_sanpham->fetch_assoc()) { if($r['idSP'] == 1) continue;
            echo "<div class=\"col-md-3 col-sm-6 col-xs-6\" style=\"margin-bottom:10px\">
                <div class=\"item\">
                    <div class=\"prod-box\">
                            <span class=\"prod-block\">";?>
            <a href="MoTa.php?idSP=<?php echo $r['idSP'];?>" class="hover-item"></a>
                               <?php echo " <span class=\"prod-image-block\">
                                    <span class=\"prod-image-box\">
                                        <img class=\"prod-image\" src=\"../images/"; echo $r['urlHinh'];echo"\"alt=\"\">
                                    </span>
                                </span>
                                    <span class=\"productname dislay-block limit limit-product\">";
            echo $r['TenSP'];echo"</span>
                                <span class=\"category dislay-block \">
                                        <span class=\"pricein168 dislay-block limit\"><span class=\"money\">";echo $r['GiaBan'];echo"</span>  VNĐ</span>
                                </span>
                            </span>
                        <a   href=\"GioHang.php?idSP="; echo $r['idSP']; echo" class=\"addcartbtn\" onclick=\"AddCart(1379)\"></a>
                        <a style=\"color: #0e86c1; color: #ff8c00; width: 100%;\"  href=\"MoTa.php?idSP="; echo $r['idSP']; echo" onclick=\"BuyNow(1379)\" class=\"btn btn-default buyproduct\"><strong>Xem chi tiết</strong></a>
                    </div>
                </div>
            </div>
";}
        echo" </div>
</div>";
        ?>
        
        <?php include_once ("footer.php");?>
        </body>
</html>





 
