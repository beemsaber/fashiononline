<div class="login-info">
        <ul>
          <?php 
          if(isset($_COOKIE['fashionuser_id']))
          {
          ?>
          <li><a href="myaccount.php">บัญชีของฉัน (<?=$_COOKIE['fashionuser_name'];?>)</a></li>
          <li><a href="php/login_process.php?logout=logout">ออกจากระบบ</a></li>
          <?php }else{ ?>
          <li><a href="login_register.php">เข้าสู่ระบบ</a></li>
          <?php } ?>
          
          <!-- ตระกร้าสินค้า -->
          <?php
            if(isset($_SESSION['cart']))
            {
              foreach($_SESSION['cart'] as $product_id_cart=>$qty)
              {
                $sum_qty = $sum_qty + $qty;
                //$sum_qty +=  $qty;
              }
            }
            else
            {
              $sum_qty = 0;
            }
          ?>
          <li class="dropdown user-basket"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> (<?=$sum_qty;?>) ชิ้น <i class="icon-basket-loaded"></i> </a>
            <ul class="dropdown-menu">
              <!-- query product -->
              <?php
                $total=0;
                if(isset($_SESSION['cart']))
                {
                  foreach($_SESSION['cart'] as $product_id_cart=>$qty)
                  {
                    $sql = "select * from product where product_id = '$product_id_cart'";
                    $query = $con->query($sql);
                    $result_cart = $query->fetch_object();
                    $sum = $result_cart->product_price * $qty;
                    $total += $sum;

                    $product_date_cart = $result_cart->product_date;
                    $sql_image_cart = "SELECT * FROM image WHERE image_date = '$product_date_cart'";
                    $query_image_cart = $con->query($sql_image_cart);
                    $result_image_cart = $query_image_cart->fetch_object();
              ?>
                <li>
                  <div class="media-left">
                    <div class="cart-img"> 
                      <a href="product_detail.php?product_id=<?=$result_cart->product_id;?>">
                        <img class="media-object img-responsive" width="" src="images/product/<?=$result_image_cart->image_name;?>">
                      </a>
                    </div>
                  </div>
                  <div class="media-body">
                    <h6 class="media-heading"><?=$result_cart->product_name;?></h6>
                    <span class="price"><?=number_format($result_cart->product_price);?> บาท</span> <span class="qty">จำนวน: <?=$qty;?></span> 
                  </div>
                </li>
              <?php }?>
                <li>
                  <h5 class="text-left">รวม: <small> <?=number_format($total);?> บาท </small></h5>
                </li>
                <li class="margin-0">
                  <div class="row">
                    <div class="col-sm-6"> <a href="cart.php" class="btn">ดูตระกร้าสินค้า</a></div>
                    <div class="col-sm-6 "> <a href="checkout.php" class="btn">ชำระเงิน</a></div>
                  </div>
                </li>
              <?php
                }
                else
                {
              ?>
                <li>
                  <div class="media-left">
                    
                  </div>
                  <div class="media-body">
                    <h6 class="media-heading">ไม่มีรายการสินค้า</h6>
                  </div>
                </li>
              <?php }?>
            </ul>
          </li>
          <!-- ตระกร้าสินค้า -->
        </ul>
      </div>