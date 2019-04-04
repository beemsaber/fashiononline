<?php
    include("../inc/connect.php");
    include('php/checklogin.php');
    $db = new database();
    $con = $db->connect();

    $start_date = $_GET["start_date"]." 00:00:00";
    $end_date = $_GET["end_date"]." 23:59:59";

    $sql_order_main = "SELECT * FROM order_main";
    $sql_order_main .= " WHERE order_date >= '$start_date' AND order_date <= '$end_date'";
    $sql_order_main .= "  ORDER BY o_id";
    $query_order_main = $con->query($sql_order_main);
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
    <link href="../assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/switchery/dist/switchery.min.css" rel="stylesheet" />

    <!-- Date picker plugins css -->
    <link href="../assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

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
            <?php $page_title = "รายงาน"; ?>
            <?php $page_detail = "รายงานรายรับ" ?>
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
                    <div class="col-md-12">
                        <div class="card card-body printableArea">
                            <h4 class="text-center"><b>รายงานคำสั่งซื้อ</b></h4>
                            <h5 class="text-center">วันที่ <?=DateCutTime($start_date);?> ถึง <?=DateCutTime($end_date);?></h5>
                            <h5 class="text-center">วันที่พิมพ์ <?=DateTime(date("Y-m-d H:i:s"));?></h5>
                            <?php
                                while($result_order_main = $query_order_main->fetch_object())
                                {
                                    $user_id_order = $result_order_main->user_id;
                                    $sql_user = "SELECT * FROM user WHERE user_id = '$user_id_order'";
                                    $query_user = $con->query($sql_user);
                                    $result_user = $query_user->fetch_object();
                            ?>
                            <div class="row">
                                    <div class="col-md-12 pull-left">
                                        <p>
                                            <strong>รหัสสั่งซื้อ: </strong><?=$result_order_main->order_id;?>
                                            <strong>วันที่สั่งซื้อ: </strong> <?=DateTime($result_order_main->order_date);?>
                                            <strong>ผู้สั่งซื้อ: </strong> <?=$result_user->user_name;?>
                                            <strong>สถานะ: </strong> <?=$result_order_main->order_status;?>
                                        </p>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive m-t-10" style="clear: both;">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>ชื่อสินค้า</th>
                                                    <th class="text-right">จำนวน</th>
                                                    <th class="text-right">ราคา</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $order_id = $result_order_main->order_id;
                                                    $sql_order_detail = "SELECT * FROM order_detail WHERE order_id = '$order_id'";
                                                    $query_order_detail = $con->query($sql_order_detail);
                                                    $i = 1;
                                                    while($r_order_detail = $query_order_detail->fetch_object())
                                                    {
                                                        $product_id = $r_order_detail->product_id;
                                                        $sql_product = "SELECT * FROM product WHERE product_id = '$product_id'";
                                                        $query_product = $con->query($sql_product);
                                                        $r_product = $query_product->fetch_object();
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?=$i;?></td>
                                                    <td><?=$r_product->product_name;?></td>
                                                    <td class="text-right"><?=$r_order_detail->product_qty;?></td>
                                                    <td class="text-right"><?=number_format($r_order_detail->sum_price);?></td>
                                                </tr>
                                                <?php $i++; }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="pull-right text-right">
                                        <b>ค่าสินค้า : <?=$result_order_main->total_price;?> บาท</b><br>
                                        <b>ค่าจัดส่ง : <?=$result_order_main->money_delivery;?> บาท</b><br>
                                        <b>รวมทั้งหมด : <?=number_format($result_order_main->grand_total_price);?> บาท</b>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>
                                    <br>
                                </div>
                            </div>
                            <?php }?>
                            <div class="text-right">
                                <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                            </div>
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
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    <!-- user js -->
    <script src="js/report.js"></script>
    <script src="js/login.js"></script>
    <script src="js/jquery.PrintArea.js" type="text/JavaScript"></script>
    <script>
    $(document).ready(function() {
        $("#print").click(function() {
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.printableArea").printArea(options);
        });
    });
    </script>
</body>

</html>