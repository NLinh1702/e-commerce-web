<?php
?>
<!DOCTYPE html>
<html>
<header>
<?php include_once ("header1.php");?>
<title>Thêm Nhãn Hiệu </title>
<link rel="stylesheet" href="../css/fontawesome-free-6.1.2-web/css/all.css">
<?php include_once('header2.php');?>
    <style>
        div.row {padding-top: 2%;}
    </style>
</header>
<body>
<?php
include ('../connection/connect_database.php');
if(isset($_POST['TenNH']) && isset($_POST['ok']) )
{

    $sl_nhanhieu = "select * from nhanhieu";
    $rs_nhanhieu = mysqli_query($conn,$sl_nhanhieu);
    if(!$rs_nhanhieu)
    {
        echo "<script language='javascript'>alert('Thêm thành công');";
        echo "location.href = 'index_nh.php'</script>";
    }
    $check = false; // biến kiểm tra trùng tên
    while ($r = $rs_nhanhieu->fetch_assoc())
    {
        if($r['TenNH'] == $_POST['TenNH'])
        {
            $check = true;
        }
    }
    if($check == false)
    {
        $query = "INSERT INTO nhanhieu(TenNH,idL,ThuTu,AnHien) values ('".$_POST['TenNH']."',".$_POST['idL']." ,  ".$_POST['ThuTu'].",".$_POST['AnHien'].")";
        $result = mysqli_query($conn,$query);
        if($result)
        {
            echo "<script language='javascript'>alert('Thêm thành công');";
            echo "location.href = 'index_nh.php'</script>";
        }
        else
            echo "<script language='javascript'>alert('Thêm không thành công');</script>";
    }else
        echo "<script language='JavaScript'> alert('Tên loại đã tồn tại!');</script>";

}
?>
<?php include ('../connection/connect_database.php');?>
<?php include_once ('header3.php');?>
<div>
    <a href="index.php"><span style="color: #6e6e6e;">Trang chủ </span></a> <span style="font-weight: 400;"> > </span>
    <a href="index_nh.php"><span style="color: #6e6e6e;">Quản lý nhãn hiệu</span></a> <span style="font-weight: 400;"> > </span>
    <a href="them_nh.php"><span style="color: #b1abab;">Tạo nhãn hiệu mới</span></a>
</div>
<!-- Nội dung ở đây -->
<h1 style="text-align: center">Tạo nhãn hiệu mới </h1>
<form  method="post" action="" name="ThemNH" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-4"><strong>Tên nhãn hiệu</strong></div>
        <div class="col-md-12"><input type="text" name="TenNH" style="width:100%;"></div>
    </div>
    <div class="row">
            <div class="col-md-4"><strong>Loại</strong></div>
            <div class="col-md-12"><?php
                $sl_l = "select * from loaisp";
                $rs_l = mysqli_query($conn,$sl_l);
                if(!$rs_l)
                    echo "Không thể truy vấn CSDL";?>
                <select name="idL" style="width:100%; height:30px">
                    <?php while ($row_l = $rs_l->fetch_assoc()) { ?>
                        <option value="<?php echo $row_l["idL"];?>"><?php echo $row_l['TenL'];?></option>
                    <?php }?>
                </select>
            </div>
    </div>
    <div class="row">
        <div class="col-md-4"><strong>Thứ tự</strong></div>
        <div class="col-md-12"><input type="number" name="ThuTu" style="width:100%;"></div>
    </div>
    <div class="row">
        <div class="col-md-2"><strong>Trạng thái</strong></div>
        <div class="col-md-9">
            <select name="AnHien">
                <option value="1"> <strong>Hiện</strong></option>
                <option value="0"> <strong>Ẩn</strong></option>
            </select>
        </div>
    </div>
    <div class=" row">
    <div class=" col-md-4 col-md-offset-4" style="margin-left: 816px;">
            <input name="ok" class="btn" type="submit" value="+ Tạo mới" style="background-color: #ff8c00; font-size: 20px; border-radius: 10px;"/>
        </div>
    </div>
</form>
<script type="text/javascript">
    function getConfirmation(){
        var retVal = confirm("Bạn có muốn hủy ?");
        if( retVal == true ){
            location.href = 'index_ds_loaisp.php'
        }
    }
</script>
<?php include_once ('footer.php');?>
</body>
</html>