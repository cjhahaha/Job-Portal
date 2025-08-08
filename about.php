<?php
include('authentication.php');
include('connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about</title>
    <link rel="stylesheet" href="css/style.css">
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
        .about-us_container img {
            max-width: 100%;
            height: auto;
            border-radius: 1rem;
        }

        .about-us_text {
            line-height: 32px !important;
            color: #000;
            font-size: 1.65rem !important;
            font-weight: 300;
            padding: 1rem;
            width: 50%;
            margin-left: 2rem;
        }

        .about-us_content {
            display: flex;
            justify-content: center;
        }

        @media (max-width: 977px) {
            .about-us_container img {
                height: auto;
                width: 50%;
            }

            .about-us_container {
                padding: 1px;
            }

            .about-us_content {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .about-us_text {
                line-height: 32px !important;
                color: #000;
                font-size: 1.65rem !important;
                font-weight: 300;
                padding: 1rem;
                width: 90%;
            }
        }

        @media (max-width: 750px) {
            .about-us_header {
                text-align: center;
                font-size: 4.5rem !important;
                font-weight: 600;
                margin-bottom: 40px !important;
                color: #000;
                position: relative;
            }

            .about-us_container img {
                height: auto;
                width: 60%;
            }

            .about-us_header::before {
                box-sizing: border-box;
                content: '';
                display: block;
                position: absolute;
                border: 2px solid #000;
                bottom: -60%;
                left: 39%;
                width: 120px;
            }
        }

        @media (max-width: 550px) {
            .about-us_container img {
                height: auto;
                width: 80%;
            }

            .about-us_header::before {
                width: 100px;
                left: 35%;
            }
        }
    </style>
    
</head>

<body>
    <!--Header section-->
    <?php include('header.php')?>
    <!--Header section-->


    <?php
    
    $sql = "SELECT * FROM `contacts`";
    $rs = mysqli_query($con, $sql);
    while ($contacts = mysqli_fetch_array($rs)) {
    ?>
        <div class="about-us_container">
            <div class="about-us_content">
                <img src="images/sk.jpg" alt="Sangguniang Kabataan">
                <div class="about-us_text">
                    <div class="about-us_header">About Us</div>
                    <p><?= $contacts['about']?>
                </div>
            </div>
        </div>
    <?php } ?>
    </section>
<?php include('footerlogin.php');?>
  
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
</body>

</html>