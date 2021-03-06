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
            <?php $page_detail = "จัดการข้อมูลผู้ใช้งาน" ?>
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
                                        <h3 class="card-title"><a href="user_add.php" class="btn waves-effect waves-light btn-primary">เพิ่มข้อมูล <i class="fa fa-lg fa-plus"></i></a></h3>
                                        <!-- <hr> -->
                                        <!--/row-->
                                        <div class="row p-t-10">
                                            <div class="col-md-12">
                                                <table id="user_table" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th width="1%">#</th>
                                                            <th width="15%">ชื่อ-สกุล</th>
                                                            <th width="5%">Username</th>
                                                            <th width="1%">แก้ไข</th>
                                                            <th width="1%">ลบ</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        $sql_user = "SELECT * FROM user ORDER BY user_id";
                                                        $query_user = $con->query($sql_user);
                                                        $i = 1;
                                                        while($result_user = $query_user->fetch_object())
                                                        {
                                                            
                                                        
                                                    ?>
                                                        <tr>
                                                            <td><?=$i;?></td>
                                                            <td><?=$result_user->user_name;?></td>
                                                            <td><?=$result_user->user_username;?></td>
                                                            <td><a href="user_edit.php?user_id=<?=$result_user->user_id;?>" class="btn waves-effect waves-light btn-warning"><i class="icon-note fa-lg"></i></a></td>
                                                            <td><button id="delete" type="button" class="btn waves-effect waves-light btn-danger" onclick="return delete_user('<?php echo $result_user->user_id;?>')"><i class="fa fa-trash-o fa-lg"></i></button></td>
                                                        </tr>
                                                    <?php $i++; }?>
                                                    </tbody>
                                                </table>
                                        </div>
                                        <!--/row-->                                        
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
    <!-- This is data table -->
    <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <!-- Sweet-Alert  -->
    <script src="../assets/plugins/sweetalert/sweetalert.min.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    <!-- user js -->
    <script src="js/user.js"></script>
    <script src="js/login.js"></script>
    <script>
        $('#user_table').DataTable({
            "language":{
                "url":"js/dataTables/Thai.json"
            }
        });
        
    </script>
</body>

</html>