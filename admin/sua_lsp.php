<?php
include_once ('../connection/connect_database.php');
$sl = "select * from loaisp where idL='".$_GET['idL']."'";
$kq = mysqli_query($conn,$sl);
if (! $kq) {
    echo "<script language='javascript'>alert('Lỗi truy vấn!');";
           echo "location.href='index_ds_loaisp.php';</script>";
}
$r_lsp=mysqli_fetch_array($kq);
if(isset($_POST['xoa']))// thao tác xóa
{
    $sql_nh = "update nhanhieu set idL=1 WHERE idL=".$_GET['idL'];//// thay đổi thể loại của nhãn hiệu này thành 1(mã loại mặc định)
    $rs_nh = mysqli_query($conn,$sql_nh);
    $sl = "delete from loaisp where idL=". $_GET['idL'];
    $kq = mysqli_query($conn, $sl);
    if($kq)
    {
        echo "<script language='javascript'>alert('Xóa thành công!');";
        echo "location.href='index_ds_loaisp.php';</script>";
    }
    else
        echo "<script language='javascript'>alert('Xóa không thành công!');";
}
if(isset($_POST['sua']))/// thao tác sửa
{
    if(isset($_POST['TenL']))
    {
        $check = false; // biến kiểm tra trùng tên
        $sql_lsp = "select TenL from loaisp WHERE idL <>".$_GET['idL'];
        $kq = mysqli_query($conn,$sql_lsp);
        while ($r = $kq->fetch_assoc())
        {
            if($r['TenL'] == $_POST['TenL'])
            {
                $check = true;// trùng tên
            }
        }
        if($check == false)
        {
            $query ="UPDATE loaisp set TenL ='". $_POST["TenL"]. "',
		ThuTu ='". $_POST["ThuTu"]. "',
		AnHien ='". $_POST["AnHien"]."' where  idL=". $_GET["idL"];
            $result_lsp = mysqli_query($conn, $query);
            if (! $result_lsp) {
                echo "<script language='javascript'>alert('Cập nhật không thành công!');";}
            else
            {
                echo "<script language='javascript'>alert('Cập nhật thành công!');";
                echo "location.href='index_ds_loaisp.php';</script>";
            }
        }
        else
        {
            echo "<script language='javascript'>alert('Trùng tên loại sản phẩm!');</script>";

        }

    }
}

?>
<!DOCTYPE html>
<html>
<header>
    <?php include_once ("header1.php");?>
    <title>Sửa Loại Sản Phẩm </title>
    <?php include_once('header2.php');?>
    <style> div.row{ padding-top: 2%;}</style>
    <link rel="stylesheet" href="../css/fontawesome-free-6.1.2-web/css/all.css">
</header>
<body>
<?php include_once ('header3.php');?>
<!-- Nội dung ở đây -->
<h1 style="text-align: center">SỬA LOẠI SẢN PHẨM </h1> <br>
<form  method="post" action="" name="SuaLSP" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-4"><strong>Loại nước hoa</strong></div>
        <div class="col-md-12"> <input type="text" style="width:100%;" name="TenL" value="<?php  echo $r_lsp['TenL']?>"></div>
    </div>
    <div class="row">
        <div class="col-md-4"><strong>Thứ tự</strong></div>
        <div class="col-md-12"><input type="number" style="width:100%;" name="ThuTu" value="<?php echo $r_lsp['ThuTu']?>"></div>
    </div>
    <div class=" row" style="margin-left: -265px;">
        <div class=" col-md-4 col-md-offset-4">
            <button type="submit" value="Quay lại" name="trove" onclick="getConfirmation()" data-original-title="" title=""><i class="fa-solid fa-hand-point-left"></i></button>
            <input name="sua" type="submit" value="Sửa" />
            <input name="xoa" type="submit" value="Xóa" />
        </div>
    </div>

    <script type="text/javascript">
        function getConfirmation()
        {
            var retVal = confirm("Bạn có muốn hủy bỏ thao tác không?");
            if( retVal == true ){
                location.href = 'index_ds_loaisp.php'
            }
        }
    </script>


    <?php include_once ('footer.php');?>
</body>
</html>

