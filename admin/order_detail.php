<?php
include('../inc/connect.php');
include('php/checklogin.php');
$db = new database();
$con = $db->connect();
$order_id = $_GET['order_id'];
$sql_order_main = "SELECT * FROM order_main WHERE order_id = '$order_id'";
$query_order_main = $con->query($sql_order_main);
$r_order_main = $query_order_main->fetch_object();

$user_id = $r_order_main->user_id;
$sql_user = "SELECT * FROM user WHERE user_id = '$user_id'";
$query_user = $con->query($sql_user);
$r_user = $query_user->fetch_object();

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
            <?php $page_title = "คำสั่งซื้อ"; ?>
            <?php $page_detail = "ข้อมูลคำสั่งซื้อ" ?>
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
                            <h4><b>รหัสคำสั่งซื้อ:</b> <span class=""><?=$r_order_main->order_id;?></span></h4>
                            <h4><b>วันที่สั่งสินค้า:</b> <span class=""><?=$r_order_main->order_date;?></span></h4>
                            <h4><b>ชื่อผู้สั่ง:</b> <span class=""><?=$r_user->user_name;?></span></h4>
                            <h4><b>ที่อยู่:</b> <span class=""><?php echo $r_user->user_address." ".$r_user->user_zipcode;?></span></h4>
                            <h4><b>การจัดส่ง:</b> <span class=""><?=$r_order_main->type_delivery;?></span></h4>
                            <h4><b>การชำระเงิน:</b> <span class=""><?=$r_order_main->type_payment;?></span></h4>
                            <h4><b>สถานะ:</b> <span class=""><?=$r_order_main->order_status;?></span></h4>
                            <hr>
                            <h4><b>รายการสินค้าที่สั่ง:</b></h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive m-t-40" style="clear: both;">
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
                                    <div class="pull-right m-t-30 text-right">
                                        <h4><b>ค่าสินค้า :</b> <?=$r_order_main->total_price;?>บาท</h4>
                                        <h4><b>ค่าจัดส่ง :</b> <?=$r_order_main->money_delivery;?>บาท</h4>
                                        <hr>
                                        <h4><b>รวมทั้งหมด :</b> <?=number_format($r_order_main->grand_total_price);?>บาท</h4>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>
                                    <div class="text-right">
                                        <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->

                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                            $order_status = $r_order_main->order_status;
                            if($order_status == "รอชำระเงิน")
                            {
                                $button_hidden = "";
                        ?>
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">การชำระเงิน</h4>
                            </div>
                            <div class="card-body">                                
                                <div class="form-body">
                                    <form id="form_payment" name="form_payment" method="post">
                                    <!--/row-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table id="product_table" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th width="8%">ธนาคารที่โอน</th>
                                                            <th width="7%">วันที่ชำระ</th>
                                                            <th width="7%">เวลาที่ชำระ</th>
                                                            <th width="8%">จำนวนเงิน</th>
                                                            <th width="15">หลักฐานการโอน</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="5" class="text-center">ยังไม่ชำระเงิน</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <!--/row-->
                                    </form>
                                </div> <!-- form body -->                                
                            </div> <!-- card body -->                
                        </div> <!-- card -->
                    <?php } else{ $button_hidden = "hidden"; ?>
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">ชำระเงินแล้ว</h4>
                            </div>
                            <div class="card-body">                                
                                <div class="form-body">
                                    <form id="form_payment" name="form_payment" method="post">
                                    <!--/row-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table id="product_table" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th width="15%">ธนาคารที่โอน</th>
                                                            <th width="15%">วันที่ชำระ</th>
                                                            <th width="15%">เวลาที่ชำระ</th>
                                                            <th width="15%">จำนวนเงิน (บาท)</th>
                                                            <th width="10">หลักฐานการโอน</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        $p_datenow = $r_order_main->payment_date;
                                                        $sql_payment = "SELECT * FROM payment WHERE p_datenow = '$p_datenow'";
                                                        $query_payment = $con->query($sql_payment);
                                                        $result_payment = $query_payment->fetch_object();

                                                        $sql_image = "SELECT * FROM image WHERE image_date = '$p_datenow'";
                                                        $query_image = $con->query($sql_image);
                                                        $result_image = $query_image->fetch_object();
                                                    ?>
                                                        <tr>
                                                            <td><?=$result_payment->p_bank;?></td>
                                                            <td><?=DateConvertBase($result_payment->p_date);?></td>
                                                            <td><?=$result_payment->p_time;?></td>
                                                            <td><?=number_format($result_payment->p_price);?></td>
                                                            <td><a href="../images/payment/<?=$result_image->image_name;?>" target="_blank"><img width="5%" src="../images/payment/<?=$result_image->image_name;?>"></a></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <!--/row-->
                                    </form>
                                </div> <!-- form body -->
                                <div class="form-actions" <?=$button_hidden;?>>
                                    <button type="button" id="save" class="btn btn-success">บันทึก</button>
                                    <a href="product.php" class="btn btn-inverse">ยกเลิก</a>
                                </div>  <!-- form-actions -->                                 
                            </div> <!-- card body -->               
                        </div> <!-- card -->
                    <?php }?>      
                    </div> <!-- col-lg-12 -->
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
    <script src="js/order.js"></script>
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