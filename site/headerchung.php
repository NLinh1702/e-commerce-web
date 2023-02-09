<?php
    if(!isset($_SESSION))
    {
        session_start();ob_start();
    }

$SLuong=0;
if(isset($_SESSION['cart']) && $_SESSION['cart']!=null)
{
    foreach ($_SESSION['cart'] as $list)
        $SLuong+= $list['qty'];
}
echo " 
<div class=\"container\">
    <div class=\"row\">
        <div id=\"banner\" class=\"col-md-2\">
            <div id=\"logo\"><a href=\"\"><img src=\"../images/logo-nuochoa.png\" width=\"120px\" height=\"100px\" alt=\"logo\"></a></div>
        </div>
        <div class=\"col-md-8\" style=\"margin-top: 10px;\">
            <form method=\"POST\" action=\"index.php\" >
                <input type=\"text\" name=\"noidung\" placeholder=\"  Tìm kiếm sản phẩm...\" style=\"width:80%;border-radius: 3px ; background: beige; height:35px;\" >
                <button type=\"submit\" name=\"btn\" style=\"background: #ff8c00;  height:35px; width: 50px;\">Tìm</button>
            </form>
        </div>
        <div class=\"col-md-2\">
            <h5 style=\"margin-left: 20px;font-weight: 700;\">Xin liên hệ</h5>
        <i class=\"fa-solid fa-phone\"></i>
            Hotline: 093.939.7979
        </div>
    </div>
</div>



<div class=\"container\">
    <div class=\"row navbar\">
        <!-- main navigation -->
        
        <div class=\"col-md-6\" style=\"margin-top: -31px; margin-left: 18px;\">
            <nav id=\"topnav\" role=\"navigation\" >
                <ul class=\"srt-menu\" id=\"menu-main-navigation\">
                    <li class=\"current\">
                    <i class=\"fa-solid fa-bars\" style=\"margin-left: -40px; padding-top: 10px;font-size: 20px;\"></i>

                        <li class=\"\"><a href=\"index.php?index=1\" style=\"font-weight:700; color: navy;\">Trang chủ</a></li>
                        <li>
                            <a href=\"#\" style=\"font-weight:700;\">Nước hoa</a>
                            <ul>
                                <li><a href=\"../site/loc_nuoc_hoa_nam.php\">Nước hoa Nam</a> </li>
                                <li><a href=\"../site/loc_nuoc_hoa_nu.php\">Nước hoa Nữ</a> </li>
                            </ul>
                        </li>
                        <li>
                            <a href=\"#\" style=\"font-weight:700;\">Sắp xếp</a>
                            <ul>
                                <li><a href=\"../site/giagiamdan.php\">Giá giảm dần</a> </li>
                                <li><a href=\"../site/giatangdan.php\">Giá tăng dần</a> </li>
                            </ul>
                        </li>
                        <li>
                            <a href=\"../site/tintuc.php\" style=\"font-weight:700;\">Tin tức</a>
                        </li>
                        <li>
                            <a href=\"../site/lienhe.php\" style=\"font-weight:700;\">Liên hệ</a>
                        </li>
                    </li>
                </ul>
            </nav>
        </div>
        <div  class=\"col-md-6\" style=\"margin-top: -31px; margin-left: -18px;\">
            <nav id=\"topnav\" role=\"navigation\" >
                <ul class=\"srt-menu\" id=\"menu-main-navigation\" >
                    <li class=\"current\">";
                    
                            if(isset($_SESSION['HoTenK']))
                            {
                                $nameuser = $_SESSION['HoTenK'];
                                echo "
                                        <li>
                                            <a href=\"#\"><i class=\"fa-solid fa-user\"></i> ";echo "<strong>". $nameuser."</strong>"; echo "</a>
                                            <ul>
                                                <li><a href=\"../site/DonHang.php\">Đơn hàng của bạn</a></li>
                                                <li><a href=\"../site/DangXuat.php\">Đăng xuất</a></li>
                                                <li><a href=\"../site/Sua_TaiKhoan.php\">Sửa tài khoản</a></li>";?>
                                <?php if (isset($_SESSION['IDUser']))if($_SESSION['IDUser'] ==1)
                                    echo "<li><a href=\"../admin/index.php\"> Admin</a></li>";?>
                                        <?php echo " </ul>
                                        </li>";
            
                            }else
            
                            {
                                    echo "
                                            <li>
                                                <a href=\"#\"><i class=\"fa-solid fa-user\"></i> Tài khoản</a>
                                                <ul>
                                                    <li><a href=\"../site/TaoTaiKhoan.php\">Đăng ký</a></li>
                                                    <li><a href=\"../site/DangNhap.php\">Đăng nhập</a></li>
                                                        <li><a href=\"../site/DangXuat.php\">Đăng xuất</a></li>
                                                </ul>
                                            </li>";
                            }
            
                        echo "
                        <div id=\"banner\">
                            <div id=\"cart\">
                                <a href=\"../site/GioHang.php?idSP=1\"> <i class=\"fa-solid fa-cart-shopping\" style=\"margin: 8px;\" \"30px\" width=\"40px\" height=\"30px\" alt=\"cart\"></i>"; 
                                    echo "  <strong>[".$SLuong."]</strong>"; 
                                    echo "
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
        
        ";


echo "       
    </div>
</div>                            
                <!-- Gio hang -->

<!-- main content area -->
<div id=\"main\" class=\"wrapper\">
<div class='row'>


<div>
    <img src=\"../images/freeship.PNG\" style=\"margin-left: 140px;border-radius: 34px;\">
</div>

</div>

    <!-- content area -->
    <section id=\"content\" class=\"wide-content\">
        <div class=\"row\">
            <div class=\"col-md-12 col-lg-12 col-lg-offset-0\">
";
