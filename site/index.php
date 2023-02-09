<?php ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">

<header>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <style type="text/css">
        .example{
            margin: 20px;
        }
    </style>
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
        
    </style>
    <style type="text/css">
        .hovergallery:hover{
            -webkit-transform:scale(1.2); 
            -moz-transform:scale(1.2); 
            -o-transform:scale(1.2); 
            box-shadow:0px 0px 30px gray; 
            -webkit-box-shadow:0px 0px 30px gray; 
            -moz-box-shadow:0px 0px 30px gray; 
            opacity: 1;
        }
    </style>

    <link rel="stylesheet" href="../css/hoa.min.css" type="text/css">
    <link rel="stylesheet" href="../css/layout.min.css" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  
    <link rel="stylesheet" href="../css/fontawesome-free-6.1.2-web/css/all.css">
    

</header>
<body>
    <?php include_once ("header2_index.php");?>

    <!---- Nội dung---->
    <div class="row">
        <div class="col-md-2"><strong></strong></div>
        <div class="col-md-9"></div> 
    </div>
    <!---- Nội dung---->

    <!-- Thanh tìm kiếm -->
    <?php include_once ("timkiem.php");?>

    <!-- Footer  -->
    <?php include_once ("footer.php");?>

</body>
</html>
