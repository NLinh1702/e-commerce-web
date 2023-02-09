<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Nhipuka
 * Date: 28-Mar-17
 * Time: 13:16
 */
include_once("../connection/connect_database.php");
$sql_sanpham = "select * from sanpham WHERE idSP=" . $_GET['idSP'];
$rs_sanpham = mysqli_query($conn, $sql_sanpham);
if (!$rs_sanpham) {
    echo "<script language='javascript'>alert('Không thể kết nối !');";
    echo "location.href='index_ds_sp.php';</script>";
}
$r_sanpham = mysqli_fetch_array($rs_sanpham);
?>
<!DOCTYPE html>
<header>
    <?php include_once("header1.php"); ?>
    <title>Sửa sản phẩm</title>
    <?php include_once('header2.php'); ?>
    <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="../css/fontawesome-free-6.1.2-web/css/all.css">
    <style> 
        div.row {
            padding-top: 2%;
        }
        .input-style {
            width: 100%;
            height: 35px;
        }
    </style>
</header>
<body>
<?php include_once('header3.php'); ?>
<br>
<div>
    <a href="index.php"><span style="color: #6e6e6e;">Trang chủ </span></a> <span style="font-weight: 400;"> > </span>
    <a href="index_ds_sp.php"><span style="color: #6e6e6e;">Quản lý sản phẩm</span></a> <span style="font-weight: 400;"> > </span>
    <a href="sua_xoa_sp.php"><span style="color: #b1abab;">Sửa sản phẩm</span></a>
</div>
<!-- Nội dung ở đây -->
<center><h1>Sửa sản phẩm </h1></center>
<form method="post" action="" name="ThemSP" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-4"><strong>Mã sản phẩm</strong></div>
        <div class="col-md-12 "><input class="input-style" type="text" name="idSP" readonly value="<?php echo $r_sanpham['idSP'] ?>"></div>
    </div>
    <div class="row">
        <div class="col-md-4"><strong>Tên sản phẩm</strong></div>
        <div class="col-md-12"><input class="input-style" type="text" name="TenSP" value="<?php echo $r_sanpham['TenSP'] ?>"></div>
    </div>
    <div class="row">
        <div class="col-md-4"><strong>Nhãn hiệu</strong></div>
        <?php $sl_nhanhieu = "select * from nhanhieu";
        $rs_nhanhieu = mysqli_query($conn, $sl_nhanhieu);
        if (!$rs_nhanhieu) {
            echo "<script language='javascript'>alert('Không thể kết nối !');";
            echo "location.href='index_ds_sp.php';</script>";
        } ?>
        <div class="col-md-12">
            <select name="idNH" class="input-style">
                <?php while ($r_nh = $rs_nhanhieu->fetch_assoc()) { ?>
                    <option value="<?php echo $r_nh["idNH"]; ?>" <?php if ($r_nh['idNH'] == $r_sanpham['idNH'])
                        echo "selected"; ?>> <?php echo $r_nh['TenNH']; ?> </option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4"><strong>Loại nước hoa</strong></div>
        <div class="col-md-12">
            <?php
            $sl_l = "select * from loaisp";
            $rs_l = mysqli_query($conn, $sl_l);
            if (!$rs_l)
                echo "Không thể truy vấn CSDL"; ?>
            <select name="idL" class="input-style">
                <?php while ($row_l = $rs_l->fetch_assoc()) { ?>
                    <option value="<?php echo $row_l["idL"]; ?>"<?php if ($row_l['idL'] == $r_sanpham['idL'])
                        echo "selected"; ?>> <?php echo $row_l['TenL']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4"><strong>Giá bán</strong></div>
        <div class="col-md-12"><input class="input-style" type="number" name="GiaBan" value="<?php echo $r_sanpham['GiaBan'] ?>"></div>
    </div>

    <div class="row">
        <div class="col-md-4"><strong>Tồn kho</strong></div>
        <div class="col-md-12"><input class="input-style" type="number" name="SoLuongTonKho"
                                     value="<?php echo $r_sanpham['SoLuongTonKho']; ?>"></div>
    </div>
    <div class="row">
        <div class="col-md-4"><strong>Hình:</strong></div>
        <div class="col-md-12">
            <input type="hidden" name="MAX_FILE_SIZE" value="20000000">
            <div>Hình hiện tại: <input type="text" readonly name="urlHinh" value="<?php echo $r_sanpham['urlHinh']; ?>">
            </div>
            <div><label>Thay đổi ảnh: </label><input type="file" name="file"></div>
        </div>
    </div>
 
    <div class="row">
        <div class="col-md-4"><strong>Ghi Chú</strong></div>
        <div class="col-md-12"><input type="text" class="input-style" name="GhiChu" value="<?php echo $r_sanpham['GhiChu']; ?>"></div>
    </div>
    <div class="row">
        <div class="col-md-4"><strong>Mô tả </strong></div>
        <div class="col-md-12"><textarea name="MoTa" cols="" rows=""><?php echo $r_sanpham['MoTa'] ?></textarea></div>
        <script type="text/javascript">
            CKEDITOR.replace('MoTa');
        </script>
    </div>

    <div class="row">
        <div class="col-md-4"><strong>Trạng Thái</strong></div>
        <div class="col-md-12">
            <select name="AnHien">
                <option value="0" <?php if ($r_sanpham['AnHien'] == 0) echo "selected"; ?>><strong>Ẩn</strong></option>
                <option value="1" <?php if ($r_sanpham['AnHien'] == 1) echo "selected"; ?>><strong>Hiện</strong>
                </option>
            </select>
        </div>
    </div>
    <div class=" row">
    <div class=" col-md-4 col-md-offset-4" style="margin-left: 684px;">
            <input name="update" class="btn" type="submit" style="background-color: #ff8c00; font-size: 20px; border-radius: 10px;" value="Cập nhật"/>
            <input name="delete" class="btn" type="submit" style="background-color: #ff8c00; font-size: 20px; border-radius: 10px;" value="Xóa" onclick="return confirm('Bạn có muốn xóa không?');";/>
        </div>
    </div>
    <br>
</form>

<?php
    if(isset($_POST['trove']))
    {
        echo "<script type=\"text/javascript\">
        if (confirm(\"Bạn có muốn trỏ về không ?\") == true) {
                location.href='index_ds_sp.php';
    }
</script>";
    }
?>


<?php include_once('footer.php'); ?>

</body>
</html>
<?php
$ngaycapnhat = date('Y-m-d H:m:s');
// lưu lại tên của ảnh cũ
$anhcu = $r_sanpham['urlHinh'];
        if (isset($_POST['delete']))
        {
            /// kiểm tra các ràng buộc xóa
            ///mã sp này phải k tồn tại trong hóa đơn, không thể xóa nếu nó có mã id là 1
                    $sql_ktra_dh= "select *  from donhangchitiet";
                    $rs_ktra_dh = mysqli_query($conn, $sql_ktra_dh);
                    $dem_tensp_dh = 0;// đếm số tên sản phẩm trùng trong đơn hàng
                    while ($r_count = $rs_ktra_dh->fetch_assoc()) {
                        if ($r_count['idSP'] == $r_sanpham['idSP'])
                            $dem_tensp_dh++;
                        if($dem_tensp_dh >1 ) break;
                    }

            if ($dem_tensp_dh ==0 && $r_sanpham['idSP'] != 1) {/// mã sản phẩm k tồn tại trong đơn hàng chi tiết
                $sql_delete_sp = "delete  from sanpham where idSP=" . $_GET['idSP'];
                $rs_delete_sp = mysqli_query($conn, $sql_delete_sp);
                if ($rs_delete_sp) {
                    if (file_exists('../images/'. $anhcu))// dò xem có ảnh trong folder k
                    {
                        if (is_file('../images/' . $anhcu))// xóa ảnh cũ:
                        {
                            unlink('../images/' . $anhcu);
                        }

                    }

                        // nếu sản phẩm này có bài viết thì đưa mã bài viết này thành 1

                           // $sql_up_bv ="update baiviet set idSP=1 WHERE idSP=".$_GET['idSP'];
                            $rs_up_bv = mysqli_query($conn, "update baiviet set idSP=1 WHERE idSP=".$_GET['idSP']);

                    echo "<script language='javascript'>alert('Xóa thành công');";
                    echo "location.href = 'index_ds_sp.php';</script>";
                }
                else
                    { echo "<script language='JavaScript'> alert('Xóa  không thành công!');</script>";}
            } else // mã sản phẩm có tồn tại trong đơn hàng chi tiết
                echo "<script language='javascript'>alert('Khổng thể xóa, sản phẩm này có ràng buộc');</script>";
        }


if (isset($_POST['update']) && isset($_POST['TenSP'])) // nếu nhân vào update
        {
            $dem_tensp = 0;// đếm số tên trùng trong bản sản phẩm
            if($_POST['TenSP'] != $r_sanpham['TenSP']){
                $sql_ktra = "select *  from sanpham";
                $rs_ktra = mysqli_query($conn, $sql_ktra);

                while ($r_count = $rs_ktra->fetch_assoc()) {
                    if ($r_count['TenSP'] == $r_sanpham['TenSP'])
                        $dem_tensp++;
                }
        }


            if ($dem_tensp == 0)// không trùng tên
            {
                if ($_FILES['file']['name'] != null)// người dùng  chọn ảnh mới => không thay đổi ảnh
                {
                    /*file hợp lệ và tiến hành upload*/
                    $path = "../images/"; // file lưu vào thư mục images
                    $tmp_name = $_FILES['file']['tmp_name'];
                    $name = $_FILES['file']['name'];
                    $type = $_FILES['file']['type'];
                    $size = $_FILES['file']['size'];
                    if (file_exists($path . $_FILES["file"]["name"]))// dò trùng ảnh trong folder
                    {
                        echo "<script language='javascript'>alert('Tên ảnh đã tồn tại!');</script>";
                    } else /// không trùng tên trong folder
                    {

                        $sql_up_sp = "update sanpham
                            set TenSP='" . $_POST['TenSP'] . "',idNH=" . $_POST['idNH'] . ",idL=" . $_POST['idL'] . ",GiaBan=" . $_POST['GiaBan'] . ",
                            SoLuongTonKho=" . $_POST['SoLuongTonKho'] . ",urlHinh ='" . $name .  ",GhiChu=N'" . $_POST['GhiChu'] . "',MoTa=N'" . $_POST['MoTa'] . "',AnHien= " . $_POST['AnHien'] . "
                            where idSP =" . $_GET['idSP'];
                        $rs_up_sp = mysqli_query($conn, $sql_up_sp);
                        if ($rs_up_sp) // kiểm tra thực thi
                        {
                            unlink('../images/'.$anhcu);// xóa ảnh
                            // upload file
                            move_uploaded_file($tmp_name, $path . $name);
                            // cập nhật lại tên sản phẩm trong đơn hàng chi tiết
                                    //$sql_up_dhct ="update donhangchitiet set TenSP=N'".$_POST['idSP']."' WHERE idSP=".$_GET['idSP'];
                                    $rs_up_dhct = mysqli_query($conn, "update donhangchitiet set TenSP=N'".$_POST['idSP']."' WHERE idSP=".$_GET['idSP']);

                            echo "<script language='javascript'>alert('Cập nhật thành công');";
                            echo "location.href = 'index_ds_sp.php';</script>";
                        } else
                            echo "<script language='JavaScript'> alert('Cập nhật không thành công!');</script>";

                    }
                } else// người dùng k thay đổi ảnh
                    {


                        // cập nhật thông tin ngoại trừ ảnh

                    $sql_up_sp = "update sanpham
                        set TenSP='" . $_POST['TenSP'] . "',idNH=" . $_POST['idNH'] . ",idL=" . $_POST['idL'] . ",GiaBan=" . $_POST['GiaBan'] . ",
                        SoLuongTonKho=" . $_POST['SoLuongTonKho'] . ",
                        GhiChu=N'" . $_POST['GhiChu'] . "',MoTa=N'" . $_POST['MoTa'] . "',AnHien= " . $_POST['AnHien'] . "
                        where idSP =" . $_GET['idSP'];
                    $rs_up_sp = mysqli_query($conn, $sql_up_sp);
                    
                    if ($rs_up_sp) {
                        // cập nhật lại tên sản phẩm trong đơn hàng chi tiết
                        $sql_up_dhct ="update donhangchitiet set TenSP=N'".$_POST['idSP']."' WHERE idSP=".$_GET['idSP'];
                        $rs_up_dhct = mysqli_query($conn, $sql_up_dhct);
                        echo "<script language='javascript'>alert('Cập nhật thành công');";
                        echo "location.href = 'index_ds_sp.php';</script>";
                    } else
                        echo "<script language='JavaScript'> alert('Cập nhật  không thành công!');</script>";
                }
            }
            else
                echo "<script language='JavaScript'> alert('Tên sản phẩm này đã tồn tại!');</script>";

        }


?>
