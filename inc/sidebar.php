<div class="shop-sidebar"> 
              
              <!-- Category -->
              <h5 class="shop-tittle margin-bottom-30">ประเภทสินค้า</h5>
              <ul class="shop-cate">
              <?php
                $sql_catlist = "SELECT * FROM categories";
                $query_catlist = $con->query($sql_catlist);
                while($result_catlist = $query_catlist->fetch_object())
                {
                  $cat_id_fornum = $result_catlist->cat_id;
                  $sql_productnumcat = "SELECT * FROM product WHERE cat_id = '$cat_id_fornum'";
                  $query_productnumcat = $con->query($sql_productnumcat);
                  $num_productnumcat = $query_productnumcat->num_rows;

              ?>
                <li><a href="#."> <?=$result_catlist->cat_name;?> <span><?=$num_productnumcat;?></span></a></li>
              <?php } ?>
              </ul>
              
              <!-- FILTER BY PRICE -->
              <h5 class="shop-tittle margin-top-60 margin-bottom-30">Filter By Price</h5>
              
              <!-- TAGS -->
              <h5 class="shop-tittle margin-top-60 margin-bottom-30">Filter By Colors</h5>
              <ul class="colors">
                <li><a href="#." style="background:#958170;"></a></li>
                <li><a href="#." style="background:#c9a688;"></a></li>
                <li><a href="#." style="background:#c9c288;"></a></li>
                <li><a href="#." style="background:#a7c988;"></a></li>
                <li><a href="#." style="background:#9ed66b;"></a></li>
                <li><a href="#." style="background:#6bd6b1;"></a></li>
                <li><a href="#." style="background:#82c2dc;"></a></li>
                <li><a href="#." style="background:#8295dc;"></a></li>
                <li><a href="#." style="background:#9b82dc;"></a></li>
                <li><a href="#." style="background:#dc82d9;"></a></li>
                <li><a href="#." style="background:#dc82a2;"></a></li>
                <li><a href="#." style="background:#e04756;"></a></li>
                <li><a href="#." style="background:#f56868;"></a></li>
                <li><a href="#." style="background:#eda339;"></a></li>
                <li><a href="#." style="background:#edd639;"></a></li>
                <li><a href="#." style="background:#daed39;"></a></li>
                <li><a href="#." style="background:#a3ed39;"></a></li>
                <li><a href="#." style="background:#f56868;"></a></li>
              </ul>
              
              <!-- TAGS -->
              <h5 class="shop-tittle margin-top-60 margin-bottom-30">Papular Tags</h5>
              <ul class="shop-tags">
                <li><a href="#.">Towels</a></li>
                <li><a href="#.">Chair</a></li>
                <li><a href="#.">Bedsheets</a></li>
                <li><a href="#.">Shoe</a></li>
                <li><a href="#.">Curtains</a></li>
                <li><a href="#.">Clocks</a></li>
                <li><a href="#.">TV Cabinets</a></li>
                <li><a href="#.">Best Seller</a></li>
                <li><a href="#.">Top Selling</a></li>
              </ul>
              
              <!-- BRAND -->
              <h5 class="shop-tittle margin-top-60 margin-bottom-30">Brands</h5>
              <ul class="shop-cate">
                <li><a href="#.">G-Furniture</a></li>
                <li><a href="#.">BigYellow</a></li>
                <li><a href="#.">WoodenBazaar</a></li>
                <li><a href="#.">GreenWoods</a></li>
                <li><a href="#.">Hot-n-Fire </a></li>
              </ul>
              
              <!-- SIDE BACR BANER -->
              <div class="side-bnr margin-top-50"> <img class="img-responsive" src="images/sidebar-bnr.jpg" alt="">
                <div class="position-center-center"> <span class="price"><small>$</small>299</span>
                  <div class="bnr-text">look hot with style</div>
                </div>
              </div>
            </div>