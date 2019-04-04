<?php
    error_reporting (E_ALL ^ E_NOTICE);
    if(isset($_GET['actionpage']))
    {
        $actionpage = $_GET['actionpage'];
    }
    else
    {
        $actionpage = "";
    }
    $page = "login";
    include("inc/connect.php");
    include("php/checkuser_login.php");
    $db = new database();
    $con = $db->connect();
    session_start();
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<title><?php include("inc/title.php");?></title>

<!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
<link rel="stylesheet" type="text/css" href="rs-plugin/css/settings.css" media="screen" />

<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="css/ionicons.min.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<link href="font/flaticon.css" rel="stylesheet">

<!--Sweet alert CSS -->
<link href="assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">

<!-- JavaScripts -->
<script src="js/modernizr.js"></script>

<!-- Online Fonts -->
<link href="https://fonts.googleapis.com/css?family=Merriweather:300,400,700,900|Poppins:300,400,500,600,700|Montserrat:300,400,500,600,700,800" rel="stylesheet">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body>

<!-- LOADER -->
<!-- <div id="loader">
  <div class="position-center-center">
    <div class="ldr"></div>
  </div>
</div> -->

<!-- Wrap -->
<div id="wrap"> 
  
  <!-- TOP Bar -->
  <div class="top-bar">
    <div class="container-full">
      <!-- topbar_contact -->
      <?php include("inc/topbar_contact.php");?>
      
      <!-- Login Info -->
      <?php include("inc/login_info.php");?>
    </div>
  </div>
  
  <!-- header -->
  <header>
    <div class="sticky">
      <div class="container-full"> 
        <!-- Logo And Navbar -->
        <?php include("inc/logo.php");?>
        <?php include("inc/navbar.php");?>
      </div>
    </div>
    <div class="clearfix"></div>
  </header>
  
  <!--======= SUB BANNER =========-->
  <?php include("inc/subbanner.php");?>
  
  <!-- Content -->
  <div id="content"> 
    
    <!--======= PAGES INNER =========-->
    <section class="chart-page padding-top-100 padding-bottom-100">
      <div class="container"> 
        
        <!-- Payments Steps -->
        <div class="shopping-cart"> 
          
          <!-- SHOPPING INFORMATION -->
          <div class="cart-ship-info">
            <div class="row">

              <div class="col-sm-12">
                <h6>เข้าสู่ระบบ</h6>
                <form>
                  <ul class="row">                    
                    <!-- USERNAME -->
                    <li class="col-md-12">
                      <label> ชื่อเข้าใช้งาน
                        <input type="text" id="username" name="username" value="" placeholder="">
                      </label>
                    </li>
                    <!-- PASSWORD -->
                    <li class="col-md-12">
                      <label> รหัสผ่าน
                        <input type="password" id="password" name="password" value="" placeholder="">
                      </label>
                    </li>
                    <li class="col-md-12">
                      <div class="checkbox">                          
                        <input id="remember_check" name="remember_check" class="styled" type="checkbox">
                        <label for="remember_check"> จดจำการเข้าสู่ระบบ</label>
                      </div>
                    </li>  
                    <!-- SUBMIT -->
                    <li class="col-md-12">
                      <button type="button" id="login" name="login" class="btn pull-left">เข้าสู่ระบบ</button>
                    </li>
                  </ul>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
  </div>
  
  <!-- FOOTER -->
  <?php include("inc/footer.php");?>
  
  <!-- GO TO TOP  --> 
  <a href="#" class="cd-top"><i class="fa fa-angle-up"></i></a> 
  <!-- GO TO TOP End --> 
  
</div>
<script src="js/jquery-1.12.4.min.js"></script> 
<script src="js/popper.min.js"></script> 
<script src="js/bootstrap.min.js" ></script> 
<script src="js/own-menu.js"></script> 
<script src="js/jquery.lighter.js"></script> 
<script src="js/jquery.magnific-popup.min.js"></script> 
<script src="js/owl.carousel.min.js"></script> 
<script src="js/main.js"></script>

<!-- custom js -->
<script src="js/user.js"></script>
<script src="js/login.js"></script>
<!-- Sweet-Alert  -->
<script src="assets/plugins/sweetalert/sweetalert.min.js"></script>
<script src="assets/plugins/sweetalert/jquery.sweet-alert.custom.js"></script>

</body>
</html>