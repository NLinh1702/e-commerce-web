
    <!DOCTYPE html>
    <header>
        <?php include_once("../connection/connect_database.php");
        include_once("header1.php"); ?>
        <title>Thêm sản phẩm hình</title>
        <?php include_once('header2.php'); ?>
        <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
        <link rel="stylesheet" href="../css/fontawesome-free-6.1.2-web/css/all.css">
        <style> div.row {
                padding-top: 2%;
            }</style>
    </header>
    <body>
    <?php include_once('header3.php'); ?>
    <!-- Nội dung ở đây -->
    <br>
    <div>
        <a href="index.php"><span style="color: #6e6e6e;">Trang chủ </span></a> 
            <span style="font-weight: 400;"> > </span>
        <a href="index_ds_sp.php"><span style="color: #6e6e6e;">Quản lý sản phẩm</span></a>
            <span style="font-weight: 400;"> > </span>
        <a href="them_sp_hinh.php"><span style="color: #b1abab;">Tạo hình ảnh mới</span></a>
    </div>
    <center><h1>Thêm hình sản phẩm mới</h1></center> <br>
    <form method="post" action="" name="ThemSP" enctype="multipart/form-data">
    
        <div class="row">
            <div class="col-md-4"><strong>Sản phẩm</strong></div>
            <?php $sl_nhanhieu = "select * from sanpham order by idSP desc";
            $rs_nhanhieu = mysqli_query($conn, $sl_nhanhieu);
            if (!$rs_nhanhieu) {
                echo "<script language='javascript'>alert('Không thể kết nối !');";
                echo "location.href='index_ds_sp.php';</script>";
            } ?>
            <div class="col-md-12">
                <select id="idSP" name="idSP" style="height: 30px; width: 100%;">
                    <?php while ($r = $rs_nhanhieu->fetch_assoc()) { ?>
                        <option value="<?php echo $r["idSP"]; ?>"> <?php echo $r['idSP']; ?>- <?php echo $r['TenSP'];?> </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        
        
        <div class="row">
            <div class="col-md-4"><strong>Hình</strong></div>
            <div class="col-md-12">
                <input type="hidden" name="MAX_FILE_SIZE" value="200000">
                <div><input type="file" name="file" id="file"></div>
            </div>
        </div>

        
        <div class="row">
            <div class="col-md-4"><strong>Trạng thái</strong></div>
            <div class="col-md-12">
                <select id="AnHien" name="AnHien">
                    <option value="0"><strong>Ẩn</strong></option>
                    <option value="1"><strong>Hiện</strong></option>
                </select>
            </div>
        </div>
        <div class=" row" style="margin-left: -520px;">
            <div class=" col-md-4 col-md-offset-4">
                <input class="btn" style="background-color: #ff8c00; font-size: 20px;" name="Ok" id="Ok" type="submit" value="+ Thêm"/>
            </div>
        </div>
    </form>


    <script type="text/javascript">
      
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
if (isset($_POST["Ok"])) {
    if ($_FILES['file']['name'] != null)
    {

        /*if (($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/jpg")
            || ($_FILES["file"]["type"] == "image/png")
            || ($_FILES["file"]["type"] == "image/bmp"))
        {*/
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
               $sql_them = "insert into sanpham_hinh (idSP,urlHinh,AnHien)
                values(".$_POST['idSP'].",
                '".$name."',
                ".$_POST['AnHien'].")";
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