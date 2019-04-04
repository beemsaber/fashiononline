<?php
  error_reporting (E_ALL ^ E_NOTICE);
  session_start();
  include("inc/connect.php");
  $db = new database();
  $con = $db->connect();

  $limit = 10;  // กำหนดจำนวน ชิ้น rows ที่ต้องการแสดงต่อหน้า
  if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
  $start_from = ($page-1) * $limit;

  $product_id = array();
  $_SESSION['product_id'] = $product_id;

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
    <section class="shop-page padding-top-100 padding-bottom-100">
      <div class="container-full">
        <div class="row"> 
          
          <!-- Shop SideBar -->
          <div class="col-md-2">
            <?php include("inc/sidebar.php");?>
          </div>
          
          <!-- Item Content -->
          <div class="col-md-10">
            <div class="sidebar-layout"> 
              
              <!-- Item Filter -->
              <div class="item-fltr"> 
                <!-- List and Grid Style -->
                <div class="lst-grd"> 
                  <a href="#" id="list">
                    <i class="flaticon-interface"></i>
                  </a> 
                  <a href="#" id="grid">
                    <i class="icon-grid"></i>
                  </a>               
                </div>
              </div>
              
              <!-- Item -->
              <div id="products" class="arrival-block col-item-4 list-group">
                <div class="row">
                  <?php
                    $sql_product = "SELECT * FROM product ORDER BY product_id ASC";
                    $sql_product .= " LIMIT $start_from, $limit";
                    $query_product = $con->query($sql_product);
                    if(!$query_product)
                    {
                      echo "Error" . $query_product ."<br>" . $con->error;
                      exit();
                    }

                    $i = 1;
                    while($result_product = $query_product->fetch_object())
                    {
                      $product_date = $result_product->product_date;
                      $sql_image = "SELECT * FROM image WHERE image_date = '$product_date' ORDER BY image_id ASC";
                      $query_image = $con->query($sql_image);
                      $result_image = $query_image->fetch_object();

                      $product_date2 = $result_product->product_date;
                      $sql_image2 = "SELECT * FROM image WHERE image_date = '$product_date' ORDER BY image_id DESC";
                      $query_image2 = $con->query($sql_image2);
                      $result_image2 = $query_image2->fetch_object();

                      $product_cat_id = $result_product->cat_id;
                      $sql_cat = "SELECT * FROM categories WHERE cat_id = '$product_cat_id'";
                      $q_cat = $con->query($sql_cat);
                      $result_cat = $q_cat->fetch_object();
                    
                  ?>
                  <!-- Item -->
                  <div class="item">
                    <div class="img-ser">
                      <div class="on-sale"> Sale </div>
                      
                      <!-- Images -->
                      <div class="thumb"> <img class="img-1" src="images/product/<?=$result_image->image_name;?>" alt=""><img class="img-2" src="images/product/<?=$result_image2->image_name;?>" alt=""> 
                        <!-- Overlay  -->
                        <div class="overlay">
                          <div class="add-crt"><a href="php/update_cart.php?action=add&product_id=<?=$result_product->product_id;?>&product_qty=1"><i class="icon-basket margin-right-10"></i> เพิ่มไปยังรถเข็น</a></div>
                        </div>
                      </div>
                      
                      <!-- Item Name -->
                      <div class="item-name fr-grd"> <a href="product_detail.php?product_id=<?=$result_product->product_id;?>" class="i-tittle"><?=$result_product->product_name;?></a> 
                        <span class="price"><?=number_format($result_product->product_price);?>&nbsp;บาท</span>
                        <a class="deta animated fadeInRight" href="product_detail.php?product_id=<?=$result_product->product_id;?>">ดูรายละเอียด</a> 
                      </div>
                      <!-- Item Details -->
                      <div class="cap-text">
                        <div class="item-name"> 
                          <a href="product_detail.php?product_id=<?=$result_product->product_id;?>" class="i-tittle"><?=$result_product->product_name;?></a> 
                          <span class="price"><?=number_format($result_product->product_price);?>&nbsp;บาท</span> 
                          <!-- Details -->
                          <p><?=$result_product->product_short_detail;?></p>                          

                        </div> <!-- item-name -->
                      </div>  <!-- cap-text -->
                      <!-- Item Details -->

                    </div>  <!-- img-ser -->
                  </div>  <!-- item -->
                  <?php $i++;} ?>
                  <!-- Item -->
                
                </div> <!-- row -->
              </div> <!-- products -->
              
              <!-- View All Items -->               

                <?php  
                  $sql = "SELECT COUNT(product_id) FROM product";  
                  $rs_result = $con->query($sql);
                  $row = $rs_result->fetch_row();

                  $total_records = $row[0];  
                  $total_pages = ceil($total_records / $limit);  
                  $pagLink = "<ul class='pagination'>";  
                  for ($i=1; $i<=$total_pages; $i++) {  
                      $pagLink .= "<li><a href='index.php?page=".$i."'>".$i."</a></li>";  
                  };  
                  echo $pagLink . "</ul>";  
                ?>
                            
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