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
    </style>
    <link rel="stylesheet" href="../css/hoa.min.css" type="text/css">
    <link rel="stylesheet" href="../css/layout.min.css" type="text/css">
    <link rel="stylesheet" href="../css/fontawesome-free-6.1.2-web/css/all.css">
</header>
<?php include_once ("header2_mota.php");?>
        <!---- Nội dung---->
        <h1 align="center">Thông tin liên hệ</h1>

    <body>
        <!-- Contact Start -->
<div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">
                    <div id="success"></div>
                    <form name="sentMessage" id="contactForm" novalidate="novalidate">
                        <div class="control-group">
                            <input type="text" class="form-control" id="name" placeholder="Your Name"
                                required="required" data-validation-required-message="Please enter your name" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control" id="email" placeholder="Your Email"
                                required="required" data-validation-required-message="Please enter your email" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control" rows="8" id="message" placeholder="Message"
                                required="required"
                                data-validation-required-message="Please enter your message"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <div class="bg-light p-30 mb-30">
                    <iframe style="width: 100%; height: 170px;"
                    src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d4409.965060342572!2d105.7725846360741!3d10.030698186640162!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1664885420081!5m2!1svi!2s"
                    frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>   
                </div>
                <div class="bg-light p-30 mb-3">
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i> Đ. 3/2, Xuân Khánh, Ninh Kiều, Cần Thơ</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i> linhb1910092@student.ctu.edu.vn</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i> +0834 462 146</p>
                </div>
            </div>
        </div>
    </div>
    <div>
        <img src="../images/freeship.PNG" style="margin-left: 140px;border-radius: 34px;">
    </div>
    <!-- Contact End -->
        <?php include_once ("footer.php");?>
    </body>
</html>

