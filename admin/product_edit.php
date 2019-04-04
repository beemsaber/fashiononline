<?php
include('../inc/connect.php');
include('php/checklogin.php');
$db = new database();
$con = $db->connect();

$product_id = $_GET['product_id'];
$sql_product = "SELECT * FROM product WHERE product_id = '$product_id'";
$q_product = $con->query($sql_product);
$result_product = $q_product->fetch_object();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title><?php include("inc/title.php"); ?></title>
    <!-- Bootstrap Core CSS -->
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- page CSS -->
    <!-- jquery.fileuploader -->
    <link href="js/fileuploader/jquery.fileuploader.css" media="all" rel="stylesheet">   
    <link href="js/fileuploader/jquery.fileuploader-theme-dragdrop.css" media="all" rel="stylesheet">
    <link href="../assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/switchery/dist/switchery.min.css" rel="stylesheet" />
    <!--alerts CSS -->
    <link href="../assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> 
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <?php include("inc/topmenu.php") ?>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <?php include("inc/left_sidebar.php"); ?>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <?php $page_title = "สินค้า"; ?>
            <?php $page_detail = "แก้ไขข้อมูลสินค้า" ?>
            <?php $page_title_active = "breadcrumb-item";?>
            <?php $page_detail_active = "breadcrumb-item active";?>
            <?php include("inc/breadcrumb.php"); ?>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white"><?=$page_detail;?></h4>
                            </div>
                            <div class="card-body">                                
                                <div class="form-body">
                                    <h3 class="card-title"><a href="product.php" class="btn waves-effect waves-light btn-secondary"><i class="fa fa-lg mdi mdi-chevron-left"></i>กลับหน้าข้อมูลสินค้า</a></h3>
                                    <form id="form_product" name="form_product" method="post" action="">
                                    <!--/row-->
                                        <div class="row p-t-20">
                                            <div class="col-md-12">
                                                <div id="form_product_name" class="form-group">
                                                    <label id="label_product_name" class="control-label">ชื่อสินค้า</label>
                                                    <input type="hidden" id="product_id" name="product_id" value="<?=$result_product->product_id;?>">
                                                    <input type="text" id="product_name" name="product_name" class="form-control" value="<?=$result_product->product_name;?>">
                                                </div>
                                                <div id="form_cat_id" class="form-group">
                                                    <?php
                                                        $cat_id = $result_product->cat_id;
                                                        $sql_cat = "SELECT * FROM categories WHERE cat_id = '$cat_id'";
                                                        $q_cat = $con->query($sql_cat);
                                                        $result_cat = $q_cat->fetch_object();
                                                    ?>
                                                    <label id="label_cat_id" class="control-label">ประเภทสินค้า</label>
                                                    <select id="cat_id" name="cat_id" class="form-control select2">
                                                        <option value="<?=$result_cat->cat_id;?>" selected><?=$result_cat->cat_name;?></option>
                                                        <option value="" >------------ เลือก ------------</option>
                                                    </select>
                                                </div>
                                                <div id="form_product_short_detail" class="form-group">
                                                    <label id="label_product_short_detail" class="control-label">รายละเอียดสินค้าแบบย่อ</label>
                                                    <textarea id="product_short_detail" name="product_short_detail" class="form-control" rows="5"><?=$result_product->product_short_detail;?></textarea>                                                    
                                                </div>
                                                <div id="form_product_full_detail" class="form-group">
                                                    <label id="label_product_full_detail" class="control-label">รายละเอียดสินค้าแบบเต็ม</label>
                                                    <textarea id="product_full_detail" name="product_full_detail" class="form-control" rows="5"><?=$result_product->product_full_detail;?></textarea>                                                    
                                                </div>
                                                <div id="form_product_price" class="form-group">
                                                    <label id="label_product_price" class="control-label">ราคาสินค้า</label>
                                                    <input type="text" id="product_price" name="product_price" class="form-control" value="<?=$result_product->product_price;?>">
                                                </div>
                                                <div id="form_product_qty" class="form-group">
                                                    <label id="label_product_qty" class="control-label">จำนวนสินค้า</label>
                                                    <input type="text" id="product_qty" name="product_qty" class="form-control" value="<?=$result_product->product_qty;?>">
                                                </div>
                                                <div id="form_product_image_main" class="form-group">
                                                    <label id="label_product_image_main" class="control-label">ภาพสินค้า</label>
                                                    <input type="file" name="image_main" class="form-control">
                                                </div>                                                
                                                <?php
                                                    $datenow = $result_product->product_date;
                                                ?>
                                                <input type="hidden" id="datenow" name="datenow" class="form-control" value="<?=$datenow;?>">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="table color-bordered-table success-bordered-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="1%">#</th>
                                                                        <th width="5%">รูป</th>
                                                                        <th width="20%">ชื่อ</th>
                                                                        <th width="1%">ลบ</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                    $sql_image = "SELECT * FROM image WHERE image_date = '$datenow'";
                                                                    $q_image = $con->query($sql_image);
                                                                    $j = 1;
                                                                    while($result_image = $q_image->fetch_object())
                                                                    {
                                                                ?>
                                                                    <tr>
                                                                        <td><?=$j;?></td>
                                                                        <td><a target="_blank" href="../images/product/<?=$result_image->image_name;?>"><img width="40%" src="../images/product/<?=$result_image->image_name;?>"></a></td>
                                                                        <td><?=$result_image->image_name;?></td>
                                                                        <td><button id="delete_img" type="button" class="btn waves-effect waves-light btn-danger" onclick="return delete_image('<?php echo $result_image->image_id;?>')"><i class="fa fa-trash-o fa-lg"></i></button></td>
                                                                    </tr>
                                                                <?php
                                                                    $j++;}
                                                                ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                       
                                        </div>                                            
                                    </form>
                                    <!--/row-->                                        
                                </div> <!-- form body -->
                                <div class="form-actions">
                                    <button type="button" id="edit" class="btn btn-success">บันทึก</button>
                                    <a href="product.php" class="btn btn-inverse">ยกเลิก</a>
                                </div>                                
                            </div> <!-- card body -->
                        </div>
                    </div>
                </div>
                <!-- Row -->               
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <?php include("inc/right_sidebar.php"); ?>
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer"><?php include("inc/footer.php"); ?></footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <script src="../assets/plugins/switchery/dist/switchery.min.js"></script>
    <script src="../assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <!-- Sweet-Alert  -->
    <script src="../assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="../assets/plugins/sweetalert/jquery.sweet-alert.custom.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->    
    <script src="../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    <!-- ============================================================== -->
    <!-- fileuploader -->
        <script src="js/fileuploader/jquery.fileuploader.min.js" type="text/javascript"></script>
    <!-- user js -->
    <script src="js/product.js"></script>
    <script src="js/login.js"></script>
</body>

</html>