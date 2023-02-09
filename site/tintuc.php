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
    <link rel="stylesheet" href="../css/hoa.min.css" type="text/css">
    <link rel="stylesheet" href="../css/layout.min.css" type="text/css">
</header>
<?php include_once ("headerchung.php");?>
        <!---- Nội dung---->
        <h1 align="center">Tin tức</h1>

<body>

<div style="margin-top:20px">
    <div class="row">
        <div class="col-md-6 col-sm-6" style="margin-bottom:20px">
            <div class="newsboxinmenu">
                <div class="row">
                    <div class="col-md-7" style="width: 60%; margin-left: 18px;">
                        <div class="prod-image-blocknewtit">
                            <a href="https://namperfume.net/blogs/thuong-hieu-nuoc-hoa/christian-dior?ref=gcli-CjwKCAiAvK2bBhB8EiwAZUbP1BiP3Ich4vF0hk5rT3T17QexNSPMwqlV-7LgH78GddJl6WgK3INY2hoCQ2gQAvD_BwE" class="new-block">
                                    <h4 class="color-hover" style="color: blue; text-align: center;" >Thương hiệu nước hoa Christian-dior</h4>
                                    <div style="color: black;"><p>Nhà thiết kế thời trang Christian Dior sinh ra ở Pháp và vươn tầm, trở thành một trong những tên tuổi lớn trong làng thời trang thế giới với việc tạo
                                        ra những chiếc váy "New Look" làm nổi bật hình dáng nữ tính, những đường cong quyến rũ của phụ nữ. Nền tảng thời trang của Dior bao gồm làm việc cùng hoặc là đối thủ của những huyền thoại thời trang (và nước hoa) nổi tiếng của thế kỷ XX. 
                                        Ông tham gia vào công việc kinh doanh thời trang cùng với Robert Piguet, sau đó làm việc cùng Lucien Lelong cùng một nhà mốt tiếng tăm khác, Pierre Balmain.</p></div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <a href="#" class="prod-block">
                            <span class="prod-image-blocknew">
                                <span class="prod-image-box">
                                    <img class="prod-image" src="../images/dior1.jpg" alt="" />
                                </span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6" style="margin-bottom:20px">
            <div class="newsboxinmenu">
                <div class="row">
                    <div class="col-md-7" style="width: 60%; margin-left: 18px;">
                        <div class="prod-image-blocknewtit">
                            <a href="https://namperfume.net/blogs/thuong-hieu-nuoc-hoa/christian-dior?ref=gcli-CjwKCAiAvK2bBhB8EiwAZUbP1BiP3Ich4vF0hk5rT3T17QexNSPMwqlV-7LgH78GddJl6WgK3INY2hoCQ2gQAvD_BwE" class="new-block">
                                    <h4 class="color-hover" style="color: blue; text-align: center;" >Thương hiệu nước hoa Chanel</h4>
                                    <div style="color: black;"><p>Khởi đầu của thương hiệu nước hoa Chanel có nhiều ảnh hưởng nhất trên thế giới hiện nay là từ Coco Chanel - tên thật Gabrielle Bonheur Chanel (1883 - 1971) -
                                        một người đàn bà mảnh dẻ và nhỏ bé, nhân vật đã được tạp chí danh giá Time bình chọn trong top 100 người có tầm ảnh hưởng nhất thế kỷ 20.
                                        Sự nghiệp của người phụ nữ có tuổi thơ đầy cơ cực này khởi đầu với nghề ca sĩ phòng trà. Sau nhiều thăng trầm, Coco có được cửa hàng thời trang đầu tiên vào năm 1909, mang tên House of Chanel tại Paris.
                                        Đây chính là nơi nâng bước bà vào ngôi nhà của những huyền thoại.</p></div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <a href="#" class="prod-block">
                            <span class="prod-image-blocknew">
                                <span class="prod-image-box">
                                    <img class="prod-image" src="../images/chanel.jpg" alt="" />
                                </span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <?php include_once ("footer.php");?>
</body>
</html>
