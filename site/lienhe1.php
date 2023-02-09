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
echo "  <header class=\"wrapper clearfix\">
    
    <div id=\"banner\">
        <div id=\"logo\"><a href=\"\"><img src=\"../images/logo-nuochoa.png\" width=\"120px\" height=\"100px\" alt=\"logo\"></a></div>
    </div>
   
    <!-- main navigation -->
    <nav id=\"topnav\" role=\"navigation\" >
        <div class=\"menu-toggle\">Menu</div>
        <ul class=\"srt-menu\" id=\"menu-main-navigation\">
            <li class=\"current\">
            <form method=\"POST\" action=\"index.php\" >
                <input type=\"text\" name=\"noidung\" placeholder=\"  Tìm kiếm sản phẩm...\" style=\"width:200px; margin-left: 270px; border-radius: 3px ; background: beige; height:35px;\" >
                <button type=\"submit\" name=\"btn\" style=\"background: #ff8c00; border-radius: 17px; height:35px; width: 35px;\"><i class=\"fa-solid fa-magnifying-glass\"></i></button>
            </form>
            </li>
            <li class=\"khoangcach\" style=\"padding: 15px;\"></li>
            <li class=\"current\"><a href=\"index.php?index=1\" style=\"border-radius: 15px;\">Trang chủ</a></li>
            <li>
                <a href=\"#\" style=\"border-radius: 15px;\">Nước hoa</a>
                <ul>
                    <li><a href=\"../site/loc_nuoc_hoa_nam.php\">Nước hoa Nam</a> </li>
                    <li><a href=\"../site/loc_nuoc_hoa_nu.php\">Nước hoa Nữ</a> </li>
                    <li><a href=\"../site/index.php?index=2\">Selling products</a> </li>
                </ul>
            </li>
            <li><a href=\"../site/lienhe.php\" style=\"border-radius: 15px;\">Liên hệ</a></li>
            ";
if(isset($_SESSION['HoTenK']))
{
    $nameuser = $_SESSION['HoTenK'];
    echo "
            <li>
                <a href=\"#\" style=\"border-radius: 15px;\">";echo "<strong>". $nameuser."</strong>"; echo "</a>
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
                    <a href=\"#\" style=\"border-radius: 15px;\">Tài khoản</a>
                    <ul>
                        <li><a href=\"../site/TaoTaiKhoan.php\">Đăng ký</a></li>
                        <li><a href=\"../site/DangNhap.php\">Đăng nhập</a></li>
                            <li><a href=\"../site/DangXuat.php\">Đăng xuất</a></li>
                    </ul>
                </li>";
}

echo "<div id=\"banner\">
        <div id=\"cart\"><a href=\"../site/GioHang.php?idSP=1\"> <i class=\"fa-solid fa-cart-shopping\" style=\"margin: 8px;\" \"30px\" width=\"40px\" height=\"30px\" alt=\"cart\"></i>"; 
        echo "  <strong>[".$SLuong."]</strong>"; echo "</a></div>
    </div></li>
        </ul>
    </nav><!-- end main navigation -->

</header><!-- end header -->
<!-- main content area -->
<div id=\"main\" class=\"wrapper\">
<div class='row'>

</div>

    <!-- content area -->
    <section id=\"content\" class=\"wide-content\">
        <div class=\"row\">
            <div class=\"col-md-12 col-lg-12 col-lg-offset-0\">
";
