<?php
include_once ('../connection/connect_database.php');
$sl_loaisp = "select * from loaisp";
$rs_loaisp = mysqli_query($conn,$sl_loaisp);
if(!$rs_loaisp)
    echo "Không thể truy vấn CSDL";?>

<!DOCTYPE html>
<html>
<header>
    <?php include_once ("header1.php");?>
    <title>Danh sách loại sản phẩm</title>
    <?php include_once('header2.php');?>
    <link rel="stylesheet" href="../css/fontawesome-free-6.1.2-web/css/all.css">
    <style>
        .quatrai1 {
            margin-left: 832px;
        }
    </style>
</header>
<body>
<?php include_once ('header3.php');?>
<!--Content Start Here -->
        <h1 style="text-align: center">DANH SÁCH LOẠI SẢN PHẨM </h1>
        <a href="them_lsp.php" ><strong><button type="button" style="background-color: #ff8c00;" class="btn quatrai1">THÊM</button> </strong></a>
        <div style="overflow-x: scroll"><table class=" table table-bordered " border="2">
            <thead class="text-center bg-success p-2 text-white">
            <tr>
                <td width="5%"><strong> Stt</strong></td>
                <td width="20%"><strong> Sản phẩm </strong></td>
                <td width="10%"><strong> Sửa/Xóa </strong></td>
            </tr>
            </thead>
            <?php $stt = 0;?>
            <?php while ($r = $rs_loaisp->fetch_assoc()) {?>
                <tbody>
                <td width="5%" align="center"><strong> <?php echo ++$stt ;?> </strong></td>
                <td width="20%" ><strong><?php echo $r['TenL'];?> </strong></td>
                <td align="center"><a href="sua_lsp.php?idL= <?php echo $r['idL'];?>" ><strong> <i class="fa-solid fa-pen-to-square"></i> </strong></a></td>
                </tbody>
            <?php }?>
        </table></div>

<?php include_once ('footer.php');?>
</body>
</html>


