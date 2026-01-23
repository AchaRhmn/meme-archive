<?php
session_start();
include "php/config.php"; 

if(!isset($_SESSION["user_id"])){
    header("Location: login.html");
    exit;
}


$memeQuery = mysqli_query($conn, "
    SELECT meme.*, user.nama 
    FROM meme 
    LEFT JOIN user ON meme.ID_user = user.ID_user
    ORDER BY meme.judul DESC
");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Meme Archive</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">

</head>

<body>
    <!-- Search Wrapper Area Start -->
    <div class="search-wrapper section-padding-100">
        <div class="search-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="search-content">
                        <form action="#" method="get">
                            <input type="search" name="search" id="search" placeholder="Type your keyword...">
                            <button type="submit"><img src="img/core-img/search.png" alt=""></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Wrapper Area End -->

    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Mobile Nav (max width 767px)-->
        <div class="mobile-nav">
            <!-- Navbar Brand -->
            <div class="memeasoy-navbar-brand">
                <a href="index.php"><img src="img/core-img/logo.png" alt=""></a>
            </div>
            <!-- Navbar Toggler -->
            <div class="memeasoy-navbar-toggler">
                <span></span><span></span><span></span>
            </div>
        </div>

        <!-- Header Area Start -->
        <header class="header-area clearfix">
            <!-- Close Icon -->
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>

            <!-- Logo -->
            <div class="logo">
                <a href="index.php"><img src="img/core-img/logo.png" alt=""></a>
            </div>

            <!-- Nav -->
            <nav class="memeasoy-nav">
                <ul>
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="share.php">Share meme</a></li>
                    <li><a href="profile.php">Profile</a></li>
                </ul>
            </nav>

        </header>

        <!-- Product Catagories Area Start -->
        <div class="products-catagories-area clearfix">
            <div class="memeasoy-pro-catagory clearfix">

                <!-- Single Catagory -->
                <div class="single-products-catagory clearfix">

                        <img src="img/bg-img/1.jpg" alt="">
                        <!-- Hover Content -->
                        <div class="hover-content">
                            <div class="line"></div>
                            <p>2013 • Forum Internet</p>
                            <h4>Doge Meme</h4>
                        </div>
                    
                </div>

                <!-- Single Catagory -->
                <div class="single-products-catagory clearfix">
                    
                        <img src="img/bg-img/2.jpg" alt="">
                        <!-- Hover Content -->
                        <div class="hover-content">
                            <div class="line"></div>
                            <p>2017 • Twitter</p>
                            <h4>Distracted Boyfriend</h4>
                        </div>
                    
                </div>

                <!-- Single Catagory -->
                <div class="single-products-catagory clearfix">
                    
                        <img src="img/bg-img/3.jpg" alt="">
                        <!-- Hover Content -->
                        <div class="hover-content">
                            <div class="line"></div>
                            <p>2019 • TikTok</p>
                            <h4>Woman Yelling at Cat</h4>
                        </div>
                    
                </div>

                <!-- Single Catagory -->
                <div class="single-products-catagory clearfix">
                    
                        <img src="img/bg-img/4.jpg" alt="">
                        <!-- Hover Content -->
                        <div class="hover-content">
                            <div class="line"></div>
                            <p>2020 • Reddit</p>
                            <h4>Among Us Meme</h4>
                        </div>
                    
                </div>

                <!-- Single Catagory -->
                <div class="single-products-catagory clearfix">
                    
                        <img src="img/bg-img/5.jpg" alt="">
                        <!-- Hover Content -->
                        <div class="hover-content">
                            <div class="line"></div>
                            <p>2021 • Twitter</p>
                            <h4>Gigachad</h4>
                        </div>
                    
                </div>

                <!-- Single Catagory -->
                <div class="single-products-catagory clearfix">
                    
                        <img src="img/bg-img/6.jpg" alt="">
                        <!-- Hover Content -->
                        <div class="hover-content">
                            <div class="line"></div>
                            <p>2022 • TikTok</p>
                            <h4>NPC Live Meme</h4>
                        </div>
                    
                </div>

             

                  <?php while($meme = mysqli_fetch_assoc($memeQuery)) { ?>

                        <div class="single-products-catagory clearfix">
                            <img src="<?= htmlspecialchars($meme['pic']) ?>" alt="">
                            <div class="hover-content">
                                <div class="line"></div>
                                <p>Uploaded by <?= htmlspecialchars($meme['nama']) ?></p>
                                <h4><?= htmlspecialchars($meme['judul']) ?></h4>
                            </div>
                        </div>

                    <?php } ?>


                
            </div>
        </div>
        <!-- Product Catagories Area End -->
    </div>
    <!-- ##### Main Content Wrapper End ##### -->






    
    <!-- ##### Newsletter Area Start ##### -->
    <section class="newsletter-area section-padding-100-0">
        <div class="container">
            <div class="row align-items-center">
                <!-- Newsletter Text -->
                <div class="col-12 col-lg-6 col-xl-7">
                    <div class="newsletter-text mb-100">
                        <h2>Meme Archive <span> Updates</span></h2>
                        <p>Temukan asal-usul meme populer, sumber pertama kemunculannya, dan alasan mengapa meme tersebut bisa viral. Ikuti update terbaru untuk menambah wawasan sekaligus hiburan seputar dunia meme.</p>
                    </div>
                </div>
                <!-- Newsletter Form -->
                <div class="col-12 col-lg-6 col-xl-5">
                    <div class="newsletter-form mb-100">
                        <form action="#" method="post">
                            <input type="email" name="email" class="nl-email" placeholder="Your E-mail">
                            <input type="submit" value="Subscribe">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Newsletter Area End ##### -->








    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row align-items-center">
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-4">
                    <div class="single_widget_area">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <a href="index.php"><img src="img/core-img/logo.png" alt=""></a>
                        </div>


                        <!-- Copywrite Text -->
                        <p class="copywrite"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved</a>
<p>I Putu Gede Rama Prawira Yudha (2401010855)</p>
<p>Zahwa Parissa Rahman (2401010634)</p>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-8">
                    <div class="single_widget_area">
                        <!-- Footer Menu -->
                        <div class="footer_menu">
                            <nav class="navbar navbar-expand-lg justify-content-end">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#footerNavContent" aria-controls="footerNavContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                                <div class="collapse navbar-collapse" id="footerNavContent">
                                    <ul class="navbar-nav ml-auto">
                                        <li class="nav-item active">
                                            <a class="nav-link" href="index.php">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="share.php">Share Meme</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="profile.php">User Profile</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>

</body>

</html>