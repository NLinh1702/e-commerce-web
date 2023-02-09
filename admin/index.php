<?php

?>
<!DOCTYPE html>
<html>
<header>
    <?php include_once("header1.php"); ?>
    <title>Pages Admin</title>
    <?php include_once('header2.php'); ?>
    <link href="../css/hieuung.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="../css/fontawesome-free-6.1.2-web/css/all.css">
    <link rel="stylesheet" href="../css/fontawesome-free-6.1.2-web/css/all.css">
</header>
<body>
<?php include_once('header3.php'); ?>
<div class="row" style="padding-top: 10%; padding-bottom: 8%; text-align: center;">
    <h1>Chào mừng bạn đến với trang admin</h1>
</div>
<div>
    <table class="table table-bordered table-dark">
        <thead style="background-color: #ffb55b">
            <tr>
                <th class="col-md-6" style="text-align: center;"><h2><i class="fa-solid fa-book"></i> Tổng số đơn hàng <br> <a href="index_donhang.php">Xem chi tiết</a></h2>    
                </th>
                <th class="col-md-6" style="text-align: center;"><h2> Tổng doanh thu <br><i class="fa-brands fa-paypal"></i></h2></th>
            </tr>
        </thead>
    </table>
    <table class="table table-bordered table-dark">
        <thead>
            <tr >
                <th class="col-md-6" style="text-align: center;"><h3><?php echo $soluong ?></h3></th>
                <th class="col-md-6" style="text-align: center;"><h3><?php echo $tong1 ?></h3></th>
            </tr>
        </thead>
    </table>
</div>


<?php include_once('footer.php'); ?>
</body>
</html>