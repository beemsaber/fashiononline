<?php
    error_reporting (E_ALL ^ E_NOTICE);
    session_start();
    $actionpage = "checkout";
    include("inc/connect.php");
    include("php/checkuser_login.php");
    $db = new database();
    $con = $db->connect();
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
<!--alerts CSS -->
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
              
              <!-- SUB TOTAL -->
              <div class="col-sm-12">
                <h6>คำสั่งซื้อของคุณ</h6>
                <div class="order-place">
                  <div class="order-detail">
                    <?php
                      $total=0;
                      if(!empty($_SESSION['cart']))
                      {
                        $havecart = "hidden";
                        foreach($_SESSION['cart'] as $product_id=>$qty)
                        {
                          $sql = "SELECT * FROM product WHERE product_id = '$product_id'";
                          $query = $con->query($sql);
                          $result_cart = $query->fetch_object();
                          $sum = $result_cart->product_price * $qty;
                          $total += $sum;
                    ?>
                    <p><strong><?=$result_cart->product_name;?> <span><?=number_format($result_cart->product_price);?> บาท </span><strong></p>                    
                    <?php 
                        }
                      }
                      else
                      {
                        $nocart = "hidden";
                    ?>
                    <p>ไม่มีรายการสินค้า</p>
                    <?php } ?>
                    <!-- SUB TOTAL -->
                    <p class="all-total">ราคาสินค้าทั้งหมด <span><?=number_format($total);?> บาท</span></p>
                    <p class="all-total">รูปแบบการจัดส่ง </p>
                    <div class="radio">
                      <input id="ems" type="radio" name="delivery" value="Ems" checked>
                      <label for="ems"><span>Ems 100 บาท</span></label>
                      <input id="register" type="radio" name="delivery" value="ลงทะเบียน">
                      <label for="register"><span>ลงทะเบียน 60 บาท</span></label>
                    </div>
                    <p class="all-total">ค่าจัดส่ง <strong class="floatright"><span id="money_delivery_message">ค่าจัดส่ง</span></strong></p>
								    <p class="all-total">ราคารวมค่าส่ง <strong class="floatright"><span id="grand_total">ราคารวม</span></strong></p>

                    <form id="form_order_detail" method="post">
                      <!-- ราคาสินค้าทั้งหมด ไม่รวมค่าจัดส่ง -->
                      <input type="hidden" id="total_price" name="total_price" value="<?=$total;?>">
                      <!-- ราคาสินค้าทั้งหมด รวมค่าจัดส่ง -->
                      <input type="hidden" id="grand_total_price" name="grand_total_price">
                      <!-- ค่าจัดส่ง -->
                      <input type="hidden" id="money_delivery" name="money_delivery">
                      <!-- การจัดส่ง -->
                      <input type="hidden" id="type_delivery" name="type_delivery">
                      <!-- user id -->
                      <input type="hidden" id="user_id" name="user_id" value="<?=$_COOKIE['fashionuser_id'];?>">
                    </form>
                  </div>
                  <div class="pay-meth" <?=$nocart;?>>
                    <ul>
                      <li>
                        <div class="radio">
                          <input type="radio" name="radio1" id="radio1" value="option1" checked>
                          <label for="radio1"> โอนเงินผ่านธนาคาร </label>
                          <div>&nbsp;</div>
                          <img width="5%" src="images/icon/kbank.png"> &nbsp;&nbsp;&nbsp;&nbsp;
                          <strong>ชื่อบัญชี นายวิทยาการ คอมพิวเตอร์ เลขที่บัญชี 575-1-91245-9</strong>
                          <br>
                          <div>&nbsp;</div>
                          <img width="5%" src="images/icon/scb.png"> &nbsp;&nbsp;&nbsp;&nbsp;
                          <strong>ชื่อบัญชี นายวิทยาการ คอมพิวเตอร์ เลขที่บัญชี 575-1-91245-9</strong>
                          <div>&nbsp;</div>
                        </div>
                      </li>                      
                      <li>
                    </ul>
                    <button type="button" id="save" name="save" class="btn  btn-dark pull-right margin-top-30">สั่งซื้อสินค้า</button>
                </div>
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
<!-- Sweet-Alert  -->
<script src="assets/plugins/sweetalert/sweetalert.min.js"></script>
<script src="assets/plugins/sweetalert/jquery.sweet-alert.custom.js"></script>
<!-- user custom js -->
<script src="js/checkout.js"></script>
</body>
</html>