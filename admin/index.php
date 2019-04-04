<?php
include('../inc/connect.php');
include('php/checklogin.php');
$db = new database();
$con = $db->connect();
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
    <!-- morris CSS -->
    <link href="../assets/plugins/morrisjs/morris.css" rel="stylesheet">
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
                <?php
                    $sql_total_payment = "SELECT * FROM order_main WHERE order_status = 'ชำระเงินแล้ว'";
                    $q_total_payment = $con->query($sql_total_payment);
                    while($r_total_payment = $q_total_payment->fetch_object())
                    {
                        $grand_total_price = $r_total_payment->grand_total_price;
                        $sum_payment += $grand_total_price;
                    }

                    $sql_wait_payment = "SELECT * FROM order_main WHERE order_status = 'รอชำระเงิน'";
                    $q_wait_payment = $con->query($sql_wait_payment);
                    $num_wait_payment = $q_wait_payment->num_rows;

                    $sql_product = "SELECT * FROM product";
                    $q_product = $con->query($sql_product);
                    $num_product = $q_product->num_rows;
                ?>
                <!-- Row -->
                <div class="card-group">
                    <!-- Column -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="m-b-0"><i class="mdi mdi-alert-circle text-success"></i></h2>
                                    <h3 class=""><?=$sum_payment;?> บาท</h3>
                                    <h6 class="">ยอดขายทั้งหมด</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="m-b-0"><i class="mdi mdi-briefcase-check text-info"></i></h2>
                                    <h3 class=""><?=$num_wait_payment;?> ออเดอร์</h3>
                                    <h6 class="">รอชำระเงิน</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="m-b-0"><i class="mdi mdi-wallet text-purple"></i></h2>
                                    <h3 class=""><?=$num_product;?> ชิ้น</h3>
                                    <h6 class="">สินค้าทั้งหมด</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">สินค้าหมด</h4>
                            </div>
                            <div class="card-body">                                
                                <div class="form-body">
                                    <div class="col-md-12">
                                        <table id="product_table" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="1%">#</th>
                                                    <th width="7%">รูป</th>
                                                    <th width="12%">ประเภท</th>
                                                    <th width="30%">ชื่อสินค้า</th>
                                                    <th width="10">ราคา</th>
                                                    <th width="20%">จำนวน</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $sql_product_stock = "SELECT * FROM product WHERE product_qty <= '0' ORDER BY product_id";
                                                $query_product_stock = $con->query($sql_product_stock);
                                                $num_product_stock = $query_product_stock->num_rows;
                                                if($num_product_stock > 0)
                                                {
                                                $i = 1;
                                                    while($result_product_stock = $query_product_stock->fetch_object())
                                                    {
                                                        $product_date = $result_product_stock->product_date;
                                                        $sql_image = "SELECT * FROM image WHERE image_date = '$product_date' ORDER BY image_id";
                                                        $query_image = $con->query($sql_image);
                                                        $result_image = $query_image->fetch_object();

                                                        $product_cat_id = $result_product_stock->cat_id;
                                                        $sql_cat = "SELECT * FROM categories WHERE cat_id = '$product_cat_id'";
                                                        $q_cat = $con->query($sql_cat);
                                                        $result_cat = $q_cat->fetch_object();
                                                
                                            ?>
                                                <tr>
                                                    <td><?=$i;?></td>
                                                    <td><img width="60%" src="../img/product/<?=$result_image->image_name;?>"></td>
                                                    <td><?=$result_cat->cat_name;?></td>
                                                    <td><?=$result_product_stock->product_name;?></td>
                                                    <td><?=number_format($result_product_stock->product_price);?></td>
                                                    <td>สินค้าหมด</td>
                                                </tr>
                                            <?php $i++; }} else{?>
                                                <tr><td colspan="6" class="text-center">ไม่มีรายการสินค้าหมด</td></tr>
                                            <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
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
    <!--sparkline JavaScript -->
    <script src="../assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--morris JavaScript -->
    <script src="../assets/plugins/raphael/raphael-min.js"></script>
    <script src="../assets/plugins/morrisjs/morris.min.js"></script>
    <!-- Sweet-Alert  -->
    <script src="../assets/plugins/sweetalert/sweetalert.min.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <script src="../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    <!-- ============================================================== -->
    <script src="js/login.js"></script>
</body>

</html>