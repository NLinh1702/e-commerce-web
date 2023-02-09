
<?php
if (isset($_POST['btn'])) {
    $noidung = $_POST['noidung'];
 }
 else{
     echo $noidung = false;
 }
$sql = "SELECT * FROM sanpham where  AnHien=1 and  TenSP LIKE '%$noidung%'";
$result = mysqli_query($conn, $sql);
?>
<div class="row text-center" style="margin-top:40px">
    <div id="productlist">
        <?php  while ($r = mysqli_fetch_array($result)) { ?>

            <div class="col-md-3 col-sm-6 col-xs-6" style="margin-bottom:10px">

                <div class="item">

                    <div class="prod-box">
                            <span class="prod-block">
                                <a href="MoTa.php?idSP=<?php echo $r['idSP'];?>" class="hover-item"></a>
                                <span class="prod-image-block">
                                    <span class="prod-image-box">
                                        <img class="prod-image" src="../images/<?php echo $r['urlHinh'];?>"alt="">
                                    </span>
                                </span>
                                    <span class="productname dislay-block limit limit-product">
                                    <?php echo $r['TenSP'];?>
                                     </span>
                                <span class="category dislay-block ">
                                        <span class="pricein168 dislay-block limit"><span class="money"><?php echo number_format($r['GiaBan'],0);?></span>  VNĐ</span>
                                </span>
                            </span>
                            <br>
                        <a style="color: #ff8c00; width: 100%;" href="MoTa.php?idSP=<?php echo $r['idSP'];?>" onclick="BuyNow(1379)" class="btn btn-default buyproduct"><strong>Xem chi tiết</strong></a>
                    </div>
                </div>
            </div>

        <?php }?>
    </div>
</div>


