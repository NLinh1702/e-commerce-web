
    <!DOCTYPE html>
    <header>
        <?php include_once("../connection/connect_database.php");
        include_once("header1.php"); ?>
        <title>Thêm sản phẩm</title>
        <?php include_once('header2.php'); ?>
        <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
        <style> div.row {
                padding-top: 2%;
            }</style>
        <link rel="stylesheet" href="../css/fontawesome-free-6.1.2-web/css/all.css">
    </header>
    <body>
    <?php include_once('header3.php'); ?>
        <br>
    <div>
        <a href="index.php"><span style="color: #6e6e6e;">Trang chủ </span></a> 
            <span style="font-weight: 400;"> > </span>
        <a href="index_ds_sp.php"><span style="color: #6e6e6e;">Quản lý sản phẩm</span></a>
            <span style="font-weight: 400;"> > </span>
        <a href="them_sp.php"><span style="color: #b1abab;">Tạo sản phẩm mới</span></a>
    </div>
    <!-- Nội dung ở đây -->
    <center><h1>Tạo sản phẩm mới</h1></center> <br>
    <form method="post" action="" name="ThemSP" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-4"><strong>1. Tên sản phẩm:</strong></div>
            <div class="col-md-12"><input type="text" name="TenSP" id="TenSP" style="width:100%;" ></div>
        </div>
        <div class="row">
            <div class="col-md-4"><strong>2. Nhãn hiệu:</strong></div>
            <?php $sl_nhanhieu = "select * from nhanhieu";
            $rs_nhanhieu = mysqli_query($conn, $sl_nhanhieu);
            if (!$rs_nhanhieu) {
                echo "<script language='javascript'>alert('Không thể kết nối !');";
                echo "location.href='index_ds_sp.php';</script>";
            } ?>
            <div class="col-md-12">
                <select id="idNH" name="idNH" style="height: 30px; width:100%;">
                    <?php while ($r = $rs_nhanhieu->fetch_assoc()) { ?>
                        <option value="<?php echo $r["idNH"]; ?>"> <?php echo $r['TenNH']; ?> </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"><strong>3. Loại nước hoa:</strong></div>
            <div class="col-md-12">
                <?php
                $sl_l = "select * from loaisp";
                $rs_l = mysqli_query($conn, $sl_l);
                if (!$rs_l) {
                    echo "<script language='javascript'>alert('Không thể kết nối !');";
                    echo "location.href='index_ds_sp.php';</script>";
                } ?>
                <select id="idL" name="idL" style="height: 30px; width:100%;">
                    <?php while ($row_l = $rs_l->fetch_assoc()) { ?>
                        <option value="<?php echo $row_l["idL"]; ?>"> <?php echo $row_l['TenL']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"><strong>4. Giá bán: </strong></div>
            <div class="col-md-12"><input type="number" id="Gia-Ban" name="GiaBan" value="0" style="width:100%;"></div>
        </div>
        <!-- <div class="row">
            <div class="col-md-4"><strong>Giá khuyến mãi</strong></div>
            <div class="col-md-12"><input type="number" id="GiaKhuyenmai" name="GiaKhuyenmai" value="0"></div>
        </div> -->
        <div class="row">
            <div class="col-md-4"><strong>5. Tồn kho: </strong></div>
            <div class="col-md-12"><input type="number" id="SoLuongTonKho" name="SoLuongTonKho" value="0" style="width:100%;"></div>
        </div>
        <div class="row">
            <div class="col-md-4"><strong>6. Hình: </strong></div>
            <div class="col-md-12">
                <input type="hidden" name="MAX_FILE_SIZE" value="200000">
                <div><input type="file" name="file" id="file"></div>
            </div>
        </div>
       
        <div class="row">
            <div class="col-md-4"><strong>7. Chi tiết sản phẩm:</strong></div>
            <div class="col-md-12" style="width:100%;"><textarea id="MoTa" name="MoTa" cols="" rows=""></textarea></div>
            <script type="text/javascript">
                CKEDITOR.replace('MoTa');
            </script>
        </div>
       
        <div class=" row" style="margin-left: 730px;">
            <div class=" col-md-4 col-md-offset-4 ">
                <button class="btn" name="Ok" id="Ok" type="submit" style="background-color: #ff8c00; font-size: 20px; border-radius: 10px;">+ Thêm</button>
            </div>
        </div>
    </form>


    <script type="text/javascript">
        // <!--
        function getConfirmation() {
            var retVal = confirm("Bạn có muốn hủy ?");
            if (retVal == true) {
                window.history.back();
            }
        }
        //-->
    </script>


    <?php include_once('footer.php'); ?>

    </body>
    </html>
<?php
$ngaytao=date("Y-m-d");
if (isset($_POST["Ok"]) && isset($_POST['TenSP'])) {
    if ($_FILES['file']['name'] != null)
    {

            /*file hợp lệ và tiến hành upload*/
            $path = '../images/'; // file lưu vào thư mục images
            $tmp_name = $_FILES['file']['tmp_name'];
            $name = $_FILES['file']['name'];
            $type = $_FILES['file']['type'];
            $size = $_FILES['file']['size'];
            if (file_exists($path . $_FILES["file"]["name"]))// dò trùng ảnh trong folder
            {
                echo "<script language='javascript'>alert('Tên ảnh đã tồn tại!');</script>";
            }
            else {
               $sql_them = "insert into sanpham (idNH,idL,TenSP,MoTa,GiaBan,urlHinh,SoLuongTonKho)
                values(".$_POST['idNH'].",".$_POST['idL'].",'".$_POST['TenSP']."','".$_POST['MoTa']."',".$_POST['GiaBan'].",
               '".$name."',".$_POST['SoLuongTonKho'].")";
                    $rs_themsp = mysqli_query($conn, $sql_them);
                    if ($rs_themsp)
                    {
                        // upload file
                        move_uploaded_file($tmp_name, $path . $name);
                        echo "<script language='javascript'>alert('Thêm thành công!');";
                        echo "location.href='index_ds_sp.php';</script>";
                    } else {
                        echo "<script language='javascript'>alert('Thêm không thành công!');</script>";
                    }
            }

       /* } else echo "<script language='javascript'>alert('Định dạng file không hợp lệ');</script>";*/
    } else echo "<script language='javascript'>alert('Bạn chưa chọn hình');</script>";


}
?>