<div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="../assets/images/users/profile.png" alt="user" />
                        <!-- this is blinking heartbit-->
                        <div class="notify setpos"> <span class="heartbit"></span> <span class="point"></span> </div>
                    </div>
                    <!-- User profile text-->
                    <div class="profile-text">
                        <h5><?=$a_name;?></h5>                        
                        <span id="logout" class="" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></span>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-small-cap">PERSONAL</li>
                        <li> <a class="waves-effect waves-dark" href="index.php" aria-expanded="false"><i class="mdi mdi-bullseye"></i><span class="hide-menu">หน้าแรก</span></a>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-bullseye"></i><span class="hide-menu">ผู้ใช้งาน</span></a>
                            <ul aria-expanded="true" class="collapse">
                                <li><a href="user.php">ข้อมูลผู้ใช้งาน </a></li>
                                <li><a href="user_add.php">เพิ่มข้อมูลผู้ใช้งาน </a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-bullseye"></i><span class="hide-menu">สินค้า</span></a>
                            <ul aria-expanded="true" class="collapse">
                                <li><a href="categories.php">ประเภทสินค้า </a></li>
                                <li><a href="product.php">ข้อมูลสินค้า </a></li>
                                <li><a href="product_add.php">เพิ่มข้อมูลสินค้า </a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-bullseye"></i><span class="hide-menu">การสั่งซื้อ</span></a>
                            <ul aria-expanded="true" class="collapse">
                                <li><a href="order.php">ข้อมูลการสั่งซ์้อ </a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-bullseye"></i><span class="hide-menu">รายงาน</span></a>
                            <ul aria-expanded="true" class="collapse">
                                <li><a href="report.php">รายงาน </a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>