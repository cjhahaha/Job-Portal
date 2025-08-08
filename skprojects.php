<?php
include('connect.php');
include('authentication.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

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
</head>

<body>
    <!--Header section-->
    <?php include('header.php')?>
    <!--Header section-->

    <section class="job-filter" style="margin-top: 120px;">
        <h1 class="heading"></h1>
        <form action="" method="GET">
            <div class="flex">
                <div class="box">
                    <h3><strong>Title, Date, Location</strong></h3>
                    <input type="text" name="search" id="job-filter" placeholder="Search" required value="<?php if (isset($_GET['search'])) {
                                                                                                                echo $_GET['search'];
                                                                                                            } ?>" class="input">
                </div>
                
            </div>
            <input type="submit" value="search" class="btn">
        </form>


        </form>
    </section>
    <!-- Job filter section-->
    <!-- job section-->
    <section class="job-container">

        <h1 class="heading">All List</h1>

        
        <div class="box-container">

        <?php
            if(isset($_GET['search'])){
                $filtercat = $_GET['search'];
                $sql = "SELECT jobs.*, categories.name as catname FROM jobs 
                INNER JOIN 
                categories ON categories.cat_id = jobs.cat_id WHERE CONCAT(jobs.name, jobs.date, jobs.location) LIKE '%$filtercat%'";
                $sql_run=mysqli_query($con, $sql);
                
                if(mysqli_num_rows($sql_run) > 0){
                    while($jobdata = mysqli_fetch_array($sql_run)){    
                        $originalDate = $jobdata['date'];
                        $newDate = date("F j, Y", strtotime($originalDate));    
            ?>
            
            <div class="box">
                <div class="company">
                    <div>
                    <h1 class="job-title" style="font-size: 3rem;"><?= $jobdata['name'] ?></h1>
                    <h3 style="color: #777;"><?= $jobdata['catname'] ?></h3>
                        
                        <?php if($jobdata['cat_id'] != 1): ?>
                            
                        <?php endif; ?>
                        <?php if ($jobdata['cat_id'] != 1) : ?>
                    <br><br><br><br><br>
                <?php endif; ?>
                    </div>
                </div>
                <?php if ($jobdata['cat_id'] == 3) : ?>
                    
                    
                <?php endif; ?>
                <p class="location"><i class="fas fa-map-marker-alt"></i><span><?= $jobdata['location']?></span></p>
                <div class="tags">
                <p><i class="fas fa-calendar"></i><span><?= $newDate ?></span></p>
                    <?php if($jobdata['cat_id'] != 2 && $jobdata['cat_id'] != 3 && $jobdata['cat_id'] != 4 && $jobdata['cat_id'] != 5): ?>
                        <p><i class="fas fa-money-bill-wave"></i><span><?= $jobdata['salary']?></span></p>
                    <?php endif; ?>
                   
                    <?php if($jobdata['cat_id'] != 3):?>
                        <p><i class="fas fa-clock"></i><span><?= $jobdata['schedule']?></span></p>
                    <?php endif; ?>
                </div>
                <div class="flex-btn">
                    <a href="view_job.php?jobid=<?= $jobdata['jobid']?>" class="btn">view details</a>
                </div>  
            </div>
                    <?php } ?>
                <?php
                } else {
                ?>

                    <h3 class="job-title">NO RECORD FOUND</h3>
        </div>
        </div>

    <?php
                }
            } else {

                $sql = "SELECT jobs.* ,categories.name as 'catname'
                                    from jobs
                                    INNER JOIN categories on categories.cat_id = jobs.cat_id
                                    order by jobs.jobid DESC";
                $rs = mysqli_query($con, $sql);
                while ($jobdata = mysqli_fetch_array($rs)) {
                    $originalDate = $jobdata['date'];
                                            $newDate = date("F j, Y", strtotime($originalDate));
    ?>
        <div class="box">
            <div class="company">
                <div>
                    
                    <h1 class="job-title" style="font-size: 3rem;"><?= $jobdata['name'] ?></h1>
                    <h3 style="color: #777;"><?= $jobdata['catname'] ?></h3>
                   
                       
                    
                    <?php if ($jobdata['cat_id'] != 1) : ?>
                        <p></p>
                    <?php endif; ?>
                </div>
            </div>

            <?php if ($jobdata['cat_id'] != 1) : ?>
                    <br><br><br><br>
                <?php endif; ?>
            <p class="location"><i class="fas fa-map-marker-alt"></i>
                <span><?= $jobdata['location'] ?></span>
            </p>
            <div class="tags">
            <p><i class="fas fa-calendar"></i><span><?= $newDate ?></span></p>
                <?php if ($jobdata['cat_id'] != 2 && $jobdata['cat_id'] != 3 && $jobdata['cat_id'] != 4 && $jobdata['cat_id'] != 5) : ?>
                    <!-- Conditionally hide salary for non-seminar jobs -->
                    <p><i class="fas fa-money-bill-wave"></i><span><?= $jobdata['salary'] ?></span></p>
                <?php endif; ?>
                
               
                <?php if ($jobdata['cat_id'] != 3) : ?>

                    <p><i class="fas fa-clock"></i><span><?= $jobdata['schedule'] ?></span></p>
                <?php endif; ?>
            </div>
            <div class="flex-btn">
                <a href="view_job.php?jobid=<?= $jobdata['jobid'] ?>" class="btn">view details</a>
            </div>

        </div>

<?php
                }
            }
?>


<div style="text-align: center; margin-top: 2rem;">
</div>
    </section>


    <!-- job section-->

    <!--Home section-->
    <!-- <div class="home-container">

        <section class="home">


        </section>
    </div> -->
    <?php
    include('connect.php');
    $sql = "SELECT * from `maintenance` ";
    $rs = mysqli_query($con, $sql);
    while ($maint = mysqli_fetch_array($rs)) {
    ?>
        <!-- home2 section-->
        <!-- <div class="section-title"><?= $maint['title'] ?> </I></div>
        <section class="about">

            <div class="box">
                <h3><?= $maint['head'] ?></h3>
                <p>
                    <?= $maint['dsc'] ?></p>


                <a href="jobs.php" class="btn">All jobs</a>
            <?php }
            ?>
        </section> -->
        <br><br><br><br><br><br>
        <br><br><br><br><br><br>
       
        <!-- home2 section-->
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