<?php
  error_reporting (E_ALL ^ E_NOTICE);
  include("inc/connect.php");
  $db = new database();
  $con = $db->connect();
  session_start();
  
  $product_id = $_GET['product_id'];
  $sql_product = "SELECT * FROM product WHERE product_id = '$product_id'";
  $query_product = $con->query($sql_product);
  $result_product = $query_product->fetch_object();

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
    
    <!-- Products -->
    <section class=" padding-top-100 padding-bottom-100">
      <div class="container"> 
        
        <!-- SHOP DETAIL -->
        <div class="shop-detail">
          <div class="row"> 
            
            <!-- Popular Images Slider -->
            <div class="col-md-7"> 
              
              <!-- Images Slider -->
            
              <div class="images-slider">
                <ul class="slides">
                <?php
                        $product_date = $result_product->product_date;
                        $sql_image = "SELECT * FROM image WHERE image_date = '$product_date' ORDER BY image_id ASC";
                        $query_image = $con->query($sql_image);
                        while($result_image = $query_image->fetch_object())
                        {
                        
                ?>
                  <li data-thumb="images/product/<?=$result_image->image_name;?>"> <img class="img-responsive" src="images/product/<?=$result_image->image_name;?>"  alt=""> </li>
                <?php }?>
                </ul>
              </div>
            </div>
            
            <!-- COntent -->
            <div class="col-md-5">
              <h4><?=$result_product->product_name;?></h4>              
              <span class="price"><?=number_format($result_product->product_price);?> บาท</span>
              <ul class="item-owner">
                  <?php
                    $product_cat_id = $result_product->cat_id;
                    $sql_product_cat = "SELECT * FROM categories WHERE cat_id = '$product_cat_id'";
                    $query_product_cat = $con->query($sql_product_cat);
                    $result_product_cat = $query_product_cat->fetch_object();
                  ?>
                <li>ประเภทสินค้า:<span> <?=$result_product_cat->cat_name;?></span></li>
              </ul>
              
              <!-- Item Detail -->
              <p><?=$result_product->product_full_detail;?></p>
              
              <!-- Short By -->
              <div class="some-info">
                <ul class="row margin-top-30">
                  <li class="col-md-6"> 

                  <form action="php/update_cart.php" method="GET">                   
                    <!-- Quantity -->
                    <div class="quinty">
                      <button type="button" class="quantity-left-minus"  data-type="minus" data-field=""> <span>-</span> </button>
                      <input type="number" id="quantity" name="quantity" class="form-control input-number" value="1">
                      <button type="button" class="quantity-right-plus" data-type="plus" data-field=""> <span>+</span> </button>
                    </div>
                  </li>
                  
                  <!-- ADD TO CART -->

                    <input type="hidden" name="action" value="addfrom_product_detail">
                    <input type="hidden" id="product_id" name="product_id" value="<?=$result_product->product_id;?>">
                    <li class="col-md-6"> <button id="cart_button" class="btn">เพิ่มไปยังรถเข็น</button> </li>
                  </form>
                  
                </ul>
                
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


</body>
</html>