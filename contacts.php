<?php
include('authentication.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contacts</title>
    <!-- <link rel="stylesheet" href="css/style.css"> -->
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
        .contact .box-container .edit {
            display: block;
            margin-left: 60rem;

        }

        .contact .box-container .edit i {
            height: 4.5rem;
            line-height: 4.2rem;
            font-size: 5rem;
            color: #2c3e50;
            border-radius: .5rem;
            margin-bottom: -20rem;


        }

        .contact {
            display: grid;
            justify-content: center;

        }

        .contact .box-container {
            display: table;
            padding: 2rem;

            background-color: #eee;
            border-radius: .5rem;

        }

        .contact .box-container .box {
            padding: 4rem;
            margin-bottom: 3rem;
            border: .1rem solid rgba(0, 0, 0, .3);
        }

        @media (max-width:768px) {
            .contact .box-container .edit {

                margin-left: 40rem;

            }




        }
    </style>

</head>

<body>
    <!--Header section-->
    <header id="header" class="header d-flex align-items-center fixed-top" style="background-color: #F47F10; padding: 20px;">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center">
                <h1>Oportunidad Real</h1>
            </a>
            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="skprojects.php">SK Projects</a></li>
                    <li><a href="contacts.php">Contact Us</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <!--Header section-->

    <!-- contacts section-->
    <?php
    include('connect.php');
    $sql = "SELECT * FROM `contacts`";
    $rs = mysqli_query($con, $sql);
    while ($contacts = mysqli_fetch_array($rs)) {
    ?>
        <section id="contact" class="contact" style="margin: 200px auto; ">
            <div class="container" data-aos="fade-up">
                <div class="ribbon">Contact Us</div>
                <div class="row gy-4">

                    <div class="col-lg-3" style="margin-right: 100px;">

                        <div class="info-item d-flex">
                            <i class="bi bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <h4>Location:</h4>
                                <p>A108 Adam Street, New York, NY 535022</p>
                            </div>
                        </div>

                        <div class="info-item d-flex">
                            <i class="bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h4>Email:</h4>
                                <p>info@example.com</p>
                            </div>
                        </div>

                        <div class="info-item d-flex">
                            <i class="bi bi-phone flex-shrink-0"></i>
                            <div>
                                <h4>Call:</h4>
                                <p>+1 5589 55488 55</p>
                            </div>
                        </div>

                    </div>
                    
        <?php
    }
        ?>

        </section>


        <!-- contacts section-->

        

        <footer id="footer" class="footer">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-5 col-md-12 footer-info">
                        <a href="index.html" class="logo d-flex align-items-center">
                            <span>Logis</span>
                        </a>
                        <p>
                            Cras fermentum odio eu feugiat lide par naso tierra. Justo eget
                            nada terra videa magna derita valies darta donna mare fermentum
                            iaculis eu non diam phasellus.
                        </p>
                        <div class="social-links d-flex mt-4">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#about">About us</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Terms of service</a></li>
                            <li><a href="#">Privacy policy</a></li>
                        </ul>
                    </div>


                   
            <div class="container mt-4">
                <div class="copyright">
                    &copy; Copyright <strong><span>Oportunidad Real</span></strong>. All Rights Reserved
                </div>
            </div>
        </footer>

        <script src="js/script.js"></script>
        <div id="preloader"></div>

        <!-- Vendor JS Files -->
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
        <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="assets/vendor/aos/aos.js"></script>
        <script src="assets/vendor/php-email-form/validate.js"></script>

        <!-- Template Main JS File -->
        <script src="assets/js/main.js"></script>
        <script src="js/script.js"></script>

</body>

</html>