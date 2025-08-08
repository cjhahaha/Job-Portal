<?php
include('connect.php');
include('authentication.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <!-- Main CSS File -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Overpass&display=swap" rel="stylesheet">

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
        .img_box{
            width: auto;
            height: auto;
            display: flex;
            overflow: hidden;
            padding: 1.3rem;
            justify-content: center;
        }
        .img_box img{
            width: 60%;
            height: 60%;
            border-radius: 1.5rem;
        }

        .btn, .input-btn {
            background-color: #f68211;
            color: #fff;
            border-radius: 20px;
            font-size: 1.5rem;
            padding: 10px 30px;
        }

        .btn:hover, .input-btn:hover {
            background-color: #cc690e;
            color: #fff;
        }

        .back-btn {
            background-color: #007bff;
            color: #fff;
            border-radius: 20px;
            font-size: 1.5rem;
            padding: 10px 30px;
            margin-top: 10px;
        }

        .back-btn:hover {
            background-color: #0056b3;
            color: #fff;
        }
    </style>
</head>

<body>
    <!--Header section-->
    <header id="header" class="header d-flex align-items-center fixed-top" style="background-color: #F47F10; padding: 20px;">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <a href="profile.php" class="logo d-flex align-items-center">
                <h1>Oportunidad Real</h1>
            </a>
            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="profile.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="skprojects.php">SK Projects</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <!--Header section-->

    <!-- View job section -->
    <?php
    $jobid = $_GET['jobid'];
    $sql = "SELECT * FROM `jobs` WHERE jobs.jobid='$jobid'";
    $rs = mysqli_query($con, $sql);
    $jobdata = mysqli_fetch_array($rs);
      $originalDate = $jobdata['date'];
                                            $newDate = date("F j, Y", strtotime($originalDate));
    ?>
    <section class="job-details">
        <h1 class="heading"><?= $jobdata['name'] ?> details</h1>
        <div class="details">
            <div class="job-info">
                <h3><?= $jobdata['name'] ?></h3>
                <p><i class="fas fa-map-marker-alt"> <?= $jobdata['location'] ?></i></p>
                <div class="img_box">
                    <img src="images/<?= $jobdata['images'] ?>" alt="">
                </div>
                <div class="basic-details">
                    <?php if ($jobdata['cat_id'] != 2 && $jobdata['cat_id'] != 3 && $jobdata['cat_id'] != 4 && $jobdata['cat_id'] != 5): ?>
                        <h3>salary</h3>
                        <p>₱<?= $jobdata['salary'] ?></p>
                        <h3>schedule</h3>
                        <p><?= $jobdata['schedule'] ?></p>
                    <?php endif; ?>

                    <?php if ($jobdata['cat_id'] != 1): ?>
                        <h3>schedule</h3>
                        <p><?= $newDate ?></p>
                        <?php if ($jobdata['cat_id'] != 3): ?>
                            <h3>time</h3>
                            <p><?= $jobdata['schedule'] ?></p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <ul>
                    <h3>requirements</h3>
                    <li><?= $jobdata['requirements'] ?></li>
                </ul>
                <ul>
                    <?php if ($jobdata['cat_id'] ==1) : ?>
                        <h3>skills</h3>
                        <li><?= $jobdata['skill'] ?></li>
                    <?php endif; ?>
                </ul>
                <div class="description">
                    <h3>description</h3>
                    <p><?= $jobdata['description'] ?></p>
                </div>
                <form id="applyForm" action="view_job.php?jobid=<?= $jobdata['jobid'] ?>" method="POST">
                    <input type="hidden" id="catId" value="<?= $jobdata['cat_id'] ?>">
                    <?php if($jobdata['cat_id'] == 1):?>
                    <input type="submit" value="apply now" name="apply" class="btn">
                    <?php endif; ?>
                    <?php if($jobdata['cat_id'] != 1):?>
                    <input type="submit" value="Register Now" name="apply" class="btn">
                    <?php endif; ?>
                </form>

            </div>
        </div>
    </section>

    <!-- Modal for missing CV -->
    <div class="modal fade" id="cvModal" tabindex="-1" aria-labelledby="cvModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cvModalLabel" style="font-size: 2.5rem;">CV Missing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="font-size: 1.5rem;">
                    Please upload your CV first.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="uploadCvBtn" style="border-radius: .9rem; font-size: 1.5rem;">Upload CV</button>
                </div>
            </div>
        </div>
    </div>

    <!--footer section-->
    <br><br><br><br><br><br>
    <br><br><br><br><br><br>
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

        <script>
            document.getElementById('applyForm').addEventListener('submit', function (event) {
                var catId = document.getElementById('catId').value;
                if (catId == 1) {
                    <?php
                    $user_id = $_SESSION['auth_user']['user_id'];
                    $cv_sql = "SELECT cv FROM regular_user WHERE user_id = ?";
                    $cv_stmt = mysqli_prepare($con, $cv_sql);
                    mysqli_stmt_bind_param($cv_stmt, 'i', $user_id);
                    mysqli_stmt_execute($cv_stmt);
                    mysqli_stmt_bind_result($cv_stmt, $cv);
                    mysqli_stmt_fetch($cv_stmt);
                    mysqli_stmt_close($cv_stmt);

                    if (empty($cv)) {
                        echo 'var hasCV = false;';
                    } else {
                        echo 'var hasCV = true;';
                    }
                    ?>

                    if (!hasCV) {
                        event.preventDefault(); // Prevent form from submitting
                        var cvModal = new bootstrap.Modal(document.getElementById('cvModal'), {});
                        cvModal.show();
                    }
                }
            });

            document.getElementById('uploadCvBtn').addEventListener('click', function () {
                window.location.href = 'include/editprofile.php';
            });
        </script>
    </footer>
</body>
</html>

<?php
if (isset($_POST['apply'])) {
    $jobid = $_GET['jobid'] ?? null;
    $user_id = $_SESSION['auth_user']['user_id'];
    $date = date('Y-m-d');

    // Check if the user has a CV only if cat_id is 1
    $cat_id = $jobdata['cat_id'];
    if ($cat_id == 1) {
        $cv_sql = "SELECT cv FROM regular_user WHERE user_id = ?";
        $cv_stmt = mysqli_prepare($con, $cv_sql);
        mysqli_stmt_bind_param($cv_stmt, 'i', $user_id);
        mysqli_stmt_execute($cv_stmt);
        mysqli_stmt_bind_result($cv_stmt, $cv);
        mysqli_stmt_fetch($cv_stmt);
        mysqli_stmt_close($cv_stmt);

        if (empty($cv)) {
            echo "<script>var cvModal = new bootstrap.Modal(document.getElementById('cvModal'), {}); cvModal.show();</script>";
            exit();
        }
    }

    // Check if the user has already applied for this job
    $check_sql = "SELECT COUNT(*) AS count FROM `application` WHERE `jobid` = ? AND `user_id` = ?";
    $check_stmt = mysqli_prepare($con, $check_sql);
    mysqli_stmt_bind_param($check_stmt, 'ii', $jobid, $user_id);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_bind_result($check_stmt, $count);
    mysqli_stmt_fetch($check_stmt);
    mysqli_stmt_close($check_stmt);

    if ($count > 0) {
        echo "<script>alert('You have already submitted your application.');</script>";
        exit();
    } else {
        $sql = "INSERT INTO `application` (`jobid`, `user_id`, `cv`, `date`) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'iiss', $jobid, $user_id, $cv, $date);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Application submitted successfully!');</script>";
            exit();
        } else {
            echo "Error: " . mysqli_error($con);
        }
        mysqli_stmt_close($stmt);
    }
}
?>
