<?php
  error_reporting (E_ALL ^ E_NOTICE);
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
    
    <!-- MyAccount -->
    <section class="contact padding-top-100 padding-bottom-100">
      <div class="container">
        <div class="contact-form">
          
          <div class="row">
            
            <div class="col-md-2">
              <div class="shop-sidebar"> 
                
                <!-- Category -->
                <h5 class="shop-tittle margin-bottom-10">เมนู</h5>
                <ul class="shop-cate">
                  <li><a href="user_edit.php?user_id=<?=$fashionuser_id;?>" target="_blank"> ข้อมูลส่วนตัว</a></li>
                  <li><a href="php/login_process.php?logout=logout"> ออกจากระบบ</a></li>
                </ul>
                
              </div>
            </div>
            
            

            <!--======= ประวัติคำสั่งซื้อ  =========-->
            <div class="col-md-8">
              <div class="table-responsive">
              <h5 class="margin-bottom-10">คำสั่งซื้อของฉัน</h5>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="8%">#</th>
                            <th width="20%">รหัสการสั่งซื้อ</th>
                            <th width="15%">ราคา</th>
                            <th width="15%">สถานะ</th>
                            <th width="15%">รายละเอียด</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql_order = "SELECT * FROM order_main WHERE user_id = '$fashionuser_id' ORDER BY o_id DESC";
                            $query_order = $con->query($sql_order);
                            $i = 1;
                            while($result_order = $query_order->fetch_object())
                            {

                        ?>
                        <tr>
                            <td><?=$i;?></td>
                            <td><?=$result_order->order_id;?></td>
                            <td><?=$result_order->grand_total_price;?></td>
                            <td><?=$result_order->order_status;?></td>
                            <td><a href="order_detail.php?order_id=<?=$result_order->order_id;?>" target="_blank">เปิดดู</a></td>
                        </tr>
                        <?php $i++; }?>
                    </tbody>
                </table>
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
<!-- simplePagination -->
<script src="js/jquery.simplePagination.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.pagination').pagination({
      items: <?php echo $total_records;?>,
      itemsOnPage: <?php echo $limit;?>,
      //cssStyle: 'light-theme',
      currentPage : <?php echo $page;?>,
      hrefTextPrefix : 'index.php?page='
    });
  });
</script>  


</body>
</html>