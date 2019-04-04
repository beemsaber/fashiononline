<?php
    error_reporting (E_ALL ^ E_NOTICE);
    session_start();
    include("inc/connect.php");
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
    
    <!-- PAGES INNER -->
    <section class="padding-top-50 pages-in chart-page">
      <div class="container"> 
        
        <!-- Payments Steps -->
        <form action="php/update_cart.php?action=update" method="POST">
          <div class="shopping-cart text-center">          
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col" class="text-left">รายการ</th>
                  <th scope="col">ราคา</th>
                  <th scope="col">จำนวน</th>
                  <th scope="col">ราคารวม</th>
                  <th scope="col">&nbsp;</th>
                </tr>
              </thead>
              <tbody>
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

                      $product_date_cart = $result_cart->product_date;
                      $sql_image_cart = "SELECT * FROM image WHERE image_date = '$product_date_cart'";
                      $query_image_cart = $con->query($sql_image_cart);
                      $result_image_cart = $query_image_cart->fetch_object();
                ?>
                  <tr>
                    <th class="text-left"> <!-- Media Image --> 
                      <a href="product_details.php?product_id=<?=$result_cart->product_id;?>" class="item-img"> <img class="media-object" width="70%" src="images/product/<?=$result_image_cart->image_name;?>" alt=""> </a> 
                      <!-- Item Name -->
                      <div class="media-body">
                        <span><a href="product_details.php?product_id=<?=$result_cart->product_id;?>"><?=$result_cart->product_name;?></a></span>
                      </div>
                    </th>
                    <td><span class="price"><?=number_format($result_cart->product_price);?></td>
                    <td>
                      <div class="quantity">
                        <input name="amount[<?=$product_id;?>]" type="number" min="1" max="100" step="1" value="<?=$qty;?>" class="form-control qty">
                      </div>
                    </td>
                    <td><span class="price"><?=number_format($sum);?></span></td>
                    <td><a href="php/update_cart.php?product_id=<?=$product_id;?>&action=remove"><i class="icon-close"></i></a></td>
                  </tr>
                <?php 
                    }
                  }
                  else
                  {
                    $nocart = "hidden";
                    $havecart = "";
                ?>
                  <tr><td colspan="6">ไม่มีรายการสินค้า</td></tr>
                <?php } ?>
              </tbody>
            </table>          
          </div>
          <div class="coupn-btn pull-right padding-top-15 padding-bottom-15"> 
            <a href="index.php" class="btn">ช้อปปิ้งต่อ</a> 
            <button type="submit" name="button" id="button" class="btn">ปรับปรุงราคา</button>
          </div>
        </form>         
      </div>
    </section>
    
    <!-- PAGES INNER -->
    <section class="padding-top-50 padding-bottom-100 light-gray-bg shopping-cart small-cart">
      <div class="container">         
        <!-- SHOPPING INFORMATION -->
        <div class="cart-ship-info margin-top-0">
          <div class="row">             
            <div class="col-sm-7">
              &nbsp;
            </div>
            
            <!-- SUB TOTAL -->
            <div class="col-sm-5" <?=$nocart;?>>
              <h6>สรุป</h6>
              <div class="grand-total">
                <div class="order-detail">
                  <!-- SUB TOTAL -->
                  <p class="all-total">ราคารวม <span><?=number_format($total);?> บาท</span></p>
                </div>
                <a href="checkout.php" class="btn margin-top-20">ชำระเงิน</a> </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  
  <!-- FOOTER -->
  <?php include("inc/footer.php");?>
</div>
<script src="js/jquery-1.12.4.min.js"></script> 
<script src="js/popper.min.js"></script> 
<script src="js/bootstrap.min.js" ></script> 
<script src="js/own-menu.js"></script> 
<script src="js/jquery.lighter.js"></script> 
<script src="js/jquery.magnific-popup.min.js"></script> 
<script src="js/owl.carousel.min.js"></script> 
<script src="js/main.js"></script>
</body>
</html>