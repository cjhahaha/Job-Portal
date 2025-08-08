<?php
include('connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- Main CSS File -->
    <!-- <link rel="stylesheet" href="css/style.css"> -->

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="custom-template_carousel/css - carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="custom-template_carousel/css - carousel/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons.min.css">
    <link rel="stylesheet" href="custom-template_carousel/css - carousel/animate.css">
    <link rel="stylesheet" href="custom-template_carousel/css - carousel/style.css">

    <!-- Bootstrap CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" />
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />
    <link href="assets/vendor/aos/aos.css" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet" />

    <style>
        @media (max-width: 450px) {
            /* Adjust styles for very small screens */
            .header .container-fluid {
                padding: 10px;
            }

            .hero .gy-4 {
                flex-direction: column;
                text-align: center;
            }

            .hero-img {
                display: none;
            }

            .contact .info-item {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .featured-carousel .item .img {
                height: 200px;
                background-size: cover;
                background-position: center;
            }

            .featured-carousel .item .text {
                padding: 10px;
            }

            .hero .container {
                flex-direction: column;
                text-align: center;
            }

            .hero .gy-4 {
                flex-direction: column;
            }

            .hero h2 {
                font-size: 1.5rem;
            }

            .hero p {
                font-size: 1rem;
            }
        }

        /* Tablet styles */
        @media (min-width: 451px) and (max-width: 992px) {
            .hero {
                padding: 70px 0;
            }

            .featured-carousel .item .img {
                height: 250px;
            }
        }

        /* Desktop styles */
        @media (min-width: 993px) {
            .hero {
                padding: 100px 0;
            }

            .hero-img {
                display: block;
            }

            .featured-carousel .item .img {
                height: 300px;
            }
        }

        .hero {
            display: flex;
            align-items: center;
        }

        .hero .container {
            display: flex;
            align-items: center;
        }

        .hero .gy-4 {
            display: flex;
            justify-content: space-between;
        }

        .hero-img {
            display: block;
        }

        .contact .info-item {
            display: flex;
            align-items: center;
        }

        .featured-carousel .item .img {
            background-size: cover;
            background-position: center;
        }

        .featured-carousel .item .text {
            padding: 20px;
        }
    </style>
</head>

<body>

    <!-- Header -->

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center">
                <h1>Oportunidad Real</h1>
            </a>
            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
            <nav id="navbar" class="navbar">
                <ul>
                    
                    <li><a class="get-a-quote" href="regular_login.php" style="font-family: 'Inter', sans-serif;">Log in</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- End Header -->

    <!-- Hero Section -->
    <?php
    
    $sql = "SELECT * from `maintenance` ";
    $rs= mysqli_query($con, $sql);
    while($maint = mysqli_fetch_array($rs)){
        ?>
    <section id="hero" class="hero d-flex align-items-center">
        <div class="container">
            <div class="gy-4 d-flex justify-content-between">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h2 data-aos="fade-up"><?= $maint['head'] ?></h2>
                    <p data-aos="fade-up" data-aos-delay="100">
                    <?= $maint['dsc'] ?>
                    </p>
                </div>
                <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                    <img src="assets/img/hero-img.png" class="img-fluid mb-3 mb-lg-0" alt="" />
                </div>
            </div>
        </div>
    </section>
    <?php  } ?>

    <!-- End Hero Section -->

    <!-- About Section -->
  
    <!-- End About Section -->

    <!-- Call To Action Section  -->

    <section id="call-to-action" class="call-to-action">
        <div class="container" data-aos="zoom-out">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h3>Apply Now</h3>
                    
                    <a class="cta-btn" href="register.php">Click here</a>
                </div>
            </div>
        </div>
    </section>

    <!-- End Call To Action Section -->

   
    <section class="ftco-section" id="skproj" style="margin-bottom: 10px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="heading-section mb-3 mt-5 fw-bold">SK Projects</h1>
            </div>
            <div class="col-md-12">
                <div class="featured-carousel owl-carousel">
                    <?php
                     $sql = "SELECT jobs.*, categories.name as catname FROM jobs 
                     INNER JOIN 
                     categories ON categories.cat_id = jobs.cat_id ORDER BY jobs.jobid DESC";
                     $rs = mysqli_query($con, $sql);
                     while($jobdata = mysqli_fetch_array($rs)){
                    ?>
                        <div class="item">
                            <div class="row justify-content-center">
                                <div class="col-md-11">
                                    <div class="testimony-wrap d-md-flex">
                                        <div class="img" style="background-image: url(images/<?= $jobdata['images'] ?>);"></div>
                                        <div class="text text-center p-4 py-xl-5 px-xl-5 d-flex align-items-center">
                                            <div class="desc w-100">
                                                <p class="h3 mb-5"><?= $jobdata['name'] ?></p>
                                                <div class="pt-4">
                                                <p class="name mb-0" >&mdash; <?= strlen($jobdata['description']) > 30 ? substr($jobdata['description'], 0, 30) . '...' : $jobdata['description'] ?></p>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    } 
                    ?>
                </div>
            </div>
        </div>
    </div>
    </section>

<!-- Contact Section -->

<section id="contact" class="contact" style="margin-top: 80px;">
    <div class="container" data-aos="fade-up">
        <div class="ribbon">Contact Us</div>
        <div class="row gy-4 mt-4">
            <div class="col-lg-4 col-md-6">
            <?php
    $sql = "SELECT * FROM `contacts`";
    $rs = mysqli_query($con, $sql);
    while($contacts = mysqli_fetch_array($rs)){
?>
                <div class="info-item d-flex">
                    <i class="bi bi-geo-alt flex-shrink-0"></i>
                    <div>
                        <h4>Location:</h4>
                        <p><?= $contacts['location'] ?></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="info-item d-flex">
                    <i class="bi bi-envelope flex-shrink-0"></i>
                    <div>
                        <h4>Email:</h4>
                        <a href="mailto:<?= $contacts['gmail'] ?>"><?= $contacts['gmail'] ?></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="info-item d-flex">
                    <i class="bi bi-phone flex-shrink-0"></i>
                    <div>
                        <h4>Call:</h4>
                        <p><?= $contacts['phone'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
    }
?>




<br><br><br><br><br><br>

   
    <!-- End Contact Section -->

    <!-- Frequently Asked Questions Section -->

    

    <!-- End Frequently Asked Questions Section -->

    <!-- Footer -->
<?php include('footer.php');?>

    <!-- End Footer -->

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <script src="custom-template_carousel/js - carousel/jquery.min.js"></script>
    <script src="custom-template_carousel/js - carousel/popper.js"></script>
    <script src="custom-template_carousel/js - carousel/bootstrap.min.js"></script>
    <script src="custom-template_carousel/js - carousel/owl.carousel.min.js"></script>
    <script src="custom-template_carousel/js - carousel/main.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="js/script.js"></script>

</body>

</html>