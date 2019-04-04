<?php
    include("../inc/connect.php");
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
            <?php $page_detail = "ข้อมูลรายงาน" ?>
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
                                    <form id="form_payment" name="form_payment" method="post">
                                        <div class="row"><!--/row-->
                                            <div class="col-md-6">
                                                <div id="form_start_date" class="form-group">
                                                    <label id="label_start_date" class="control-label">จากวันที่</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="start_date" name="start_date" data-date-language="th-th" placeholder="วัน/เดือน/ปี">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div id="form_end_date" class="form-group">
                                                    <label id="label_end_date" class="control-label">ถึงวันที่</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="end_date" name="end_date" data-date-language="th-th" placeholder="วัน/เดือน/ปี">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div id="form_income_order" class="form-group text-center">
                                                    <button type="button" id="income" class="btn waves-effect waves-light btn-success">รายรับ</button>
                                                    <button type="button" id="order" class="btn waves-effect waves-light btn-info">คำสั่งซื้อ</button>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div id="form_cat" class="form-group">
                                                    <label id="label_cat_id" class="control-label">ประเภทสินค้า</label>
                                                    <select id="cat_id" name="cat_id" class="form-control select2">
                                                        <option value="0" selected>------------ ทังหมด ------------</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <label class="control-label">&nbsp;</label>
                                                <div id="form_product" class="form-group text-center">
                                                    <button type="button" id="product" class="btn waves-effect waves-light btn-primary">สต็อกสินค้า</button>
                                                </div>
                                            </div>
                                            
                                                <?php
                                                    $datenow = date('Y-m-d H:i:s');
                                                ?>
                                                <input type="hidden" id="datenow" name="datenow" class="form-control" value="<?=$datenow;?>">
                                        </div> <!--/row-->
                                    </form>
                                </div> <!-- form body -->
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

    <!-- Date Picker Plugin JavaScript -->
    <script src="../assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

    <!-- JS Datepicker-->
    <script src="js/bootstrap-datepicker/js/bootstrap-datepicker-thai.js"></script>
    <script src="js/bootstrap-datepicker/locales/bootstrap-datepicker.th.js"></script>

    <!-- Sweet-Alert  -->
    <script src="../assets/plugins/sweetalert/sweetalert.min.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    <!-- user js -->
    <script src="js/report.js"></script>
    <script src="js/login.js"></script>
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

        $('#start_date').datepicker({
            format: "dd/mm/yyyy",
                todayHighlight: true,
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
        }).datepicker('setDate');

        $('#end_date').datepicker({
            format: "dd/mm/yyyy",
                todayHighlight: true,
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
        }).datepicker('setDate');
    });
    </script>
</body>

</html>