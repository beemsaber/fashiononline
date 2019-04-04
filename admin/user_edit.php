<?php
include("../inc/connect.php");
include('php/checklogin.php');
$db = new database();
$con = $db->connect();

$get_user_id = $_GET['user_id'];
$sql_user = "SELECT * FROM user WHERE user_id = '$get_user_id'";
$query_user = $con->query($sql_user);
$result_user = $query_user->fetch_object();
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
            <?php $page_title = "ผู้ใช้งาน"; ?>
            <?php $page_detail = "แก้ไขข้อมูลผู้ใช้งาน" ?>
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
                                    <h3 class="card-title"><a href="user.php" class="btn waves-effect waves-light btn-secondary"><i class="fa fa-lg mdi mdi-chevron-left"></i>กลับหน้าผู้ใช้งาน</a></h3>
                                    <form id="form_user" name="form_user" method="post" action="">
                                    <!--/row-->
                                        <div class="row p-t-20">
                                            <div class="col-md-12">
                                                <div id="form_user_name" class="form-group">
                                                    <label id="label_user_name" class="control-label">ชื่อ - นามสกุล</label>
                                                    <input type="hidden" id="user_id" name="user_id" value="<?=$result_user->user_id;?>">
                                                    <input type="text" id="user_name" name="user_name" class="form-control" value="<?=$result_user->user_name;?>">
                                                </div>                                                
                                                <div id="form_user_email" class="form-group">
                                                    <label id="label_user_email" class="control-label">อีเมล</label>
                                                    <input type="text" id="user_email" name="user_email" class="form-control" value="<?=$result_user->user_email;?>">
                                                </div>                                                
                                                <div id="form_user_address" class="form-group">
                                                    <label id="label_user_address" class="control-label">ที่อยู่</label>
                                                    <textarea id="user_address" name="user_address" class="form-control" rows="5"><?=$result_user->user_address;?></textarea>                                                    
                                                </div>
                                                <div id="form_user_province" class="form-group">
                                                    <?php
                                                        $province_id = $result_user->user_province;
                                                        $sql_province = "SELECT * FROM province WHERE province_id = '$province_id'";
                                                        $q_province = $con->query($sql_province);
                                                        $r_province = $q_province->fetch_object();
                                                    ?>
                                                    <label id="label_user_province" class="control-label">จังหวัด</label>
                                                    <select id="user_province" name="user_province" class="form-control select2">
                                                        <option value="<?=$province_id;?>" selected><?=$r_province->province_name;?></option>
                                                        <option value="">------------ เลือก ------------</option>
                                                    </select>
                                                </div>
                                                <div id="form_user_zipcode" class="form-group">
                                                    <label id="label_user_zipcode" class="control-label">รหัสไปรษณีย์</label>
                                                    <input type="text" id="user_zipcode" name="user_zipcode" class="form-control" value="<?=$result_user->user_zipcode;?>">
                                                </div> 
                                                <div id="form_user_tel" class="form-group">
                                                    <label id="label_user_tel" class="control-label">เบอร์โทรศัพท์</label>
                                                    <input type="text" id="user_tel" name="user_tel" class="form-control" value="<?=$result_user->user_tel;?>">
                                                </div>
                                                <div id="form_user_username" class="form-group">
                                                    <label id="label_user_username" class="control-label">username</label>
                                                    <input type="text" id="user_username" name="user_username" class="form-control" value="<?=$result_user->user_username;?>" readonly>
                                                </div>
                                                <div id="form_user_password" class="form-group">
                                                    <label id="label_user_password" class="control-label">รหัสผ่าน</label>
                                                    <input type="password" id="user_password" name="user_password" class="form-control" value="<?=$result_user->user_password;?>">
                                                </div>
                                                <div id="form_user_cpassword" class="form-group">
                                                    <label id="label_user_cpassword" class="control-label">ยืนยันรหัสผ่าน</label>
                                                    <input type="password" id="user_cpassword" name="user_cpassword" class="form-control" value="<?=$result_user->user_password;?>">
                                                </div>
                                                <div id="form_user_status" class="form-group">
                                                    <?php
                                                        $user_status = $result_user->user_status;
                                                        if($user_status == "admin")
                                                        {
                                                            $user_status_show = "ผู้ดูแลระบบ";
                                                        }
                                                        else
                                                        {
                                                            $user_status_show = "ผู้ใช้งาน";
                                                        }
                                                    ?>
                                                    <label id="label_user_status" class="control-label">สถานะ</label>
                                                    <select id="user_status" name="user_status" class="form-control select2">
                                                        <option value="<?=$result_user->user_status;?>" selected><?=$user_status_show;?></option>
                                                        <option value="" >------------ เลือก ------------</option>
                                                        <option value="admin">ผู้ดูแลระบบ</option>
                                                        <option value="user">ผู้ใช้งาน</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                    <!--/row--> 
                                    </form>                                                                       
                                </div> <!-- form body -->
                                <div class="form-actions">
                                    <button type="button" id="edit" class="btn btn-success">บันทึก</button>
                                    <a href="user.php" class="btn btn-inverse">ยกเลิก</a>
                                </div>
                                
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
    <script src="../assets/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="../assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="../assets/plugins/multiselect/js/jquery.multi-select.js"></script>
    <!-- Sweet-Alert  -->
    <script src="../assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="../assets/plugins/sweetalert/jquery.sweet-alert.custom.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    <!-- user js -->
    <script src="js/user.js"></script>
    <script src="js/login.js"></script>
</body>

</html>