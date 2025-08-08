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
    <style>
        .full-cont {
    display: flex;
    flex-direction: column; /* Stack content vertically */
    gap: 20px; /* Add space between elements */
    padding: 20px;
}

.box-cont {
    display: flex;
    flex-direction: column;
    gap: 20px;
    background-color: #eee;
    padding: 10px;
    border-radius: 8px;
}

.box-list {
    display: flex;
    flex-direction: column;
}

 .scrollable-container {
                display:flex;
    flex-direction: row;
    overflow-x: scroll; /* Horizontal scroll if necessary */
    overflow-y: scroll; /* Hide vertical scroll initially */
    white-space: nowrap; /* Prevent wrapping of items */
    margin-bottom: 10px; /* Adjust margin as needed */
    gap: 2rem;/* Optional: add border for visibility */
    padding: 10px; /* Optional: add padding for spacing */
    width: 100%;
    background-color: #eee;
    justify-content: center;
}
            

.box {
    width: 200px; /* Adjust width of each box */
    min-width: 200px; /* Ensure minimum width is maintained */
    max-width: 100%;
    padding: 20px;
    font-size: 1.5rem;
    border-radius: 8px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    flex-direction: column;
    overflow-x:hidden;
    text-overflow: ellipsis;
     white-space: nowrap;
    /* Other styles as per your design */
}

        
        .header1{
            text-align:center;
        }

.table-container {
    justify-content: center;
    
    font-size: 2rem;
    display: flex;
    flex-direction: row; /* Align tables horizontally */
    gap: -50px; /* Space between tables */
    width: 100%;
    text-align: center;
    flex-wrap: wrap; /* Wrap tables to next line on smaller screens */
}

.container1,
.container2 {
    overflow-x: scroll;
    flex: 1;
    width: 100%;
    height: 500px;
    max-width: 1200px;
    padding:3rem;
    padding: 10px;
}


@media (max-width: 960px) {
    .table-container {
        flex-direction: column; /* Stack tables vertically on small screens */
    }
    .scrollable-container {
        justify-content: flex-start; /* Align boxes to the start */
        gap: 10px; /* Adjust gap between boxes */
        -webkit-overflow-scrolling: touch;
    }

    .profile {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .profile-img {
        margin-bottom: 20px;
        margin-right: 0;
    }

    .profile-info h2 {
        font-size: 1.8rem;
    }

    .profile-info p {
        font-size: 1.1rem;
    }

    .edit-btn {
        padding: 8px 16px;
        font-size: 0.9rem;
    }
}

@media (max-width: 576px) {
    .profile-info h2 {
        font-size: 2rem;
    }
    

    .profile-info p {
        font-size: 1.5rem;
    }

    .edit-btn {
        padding: 8px 16px;
        font-size: 1.2rem;
    }

    .card-header h4 {
        font-size: 2rem;
    }

    .table {
        font-size: 1.2rem;
    }
}
    </style>
</head>

<body>
    <!--Header section-->
  <?php include('header.php')?>
    <!--Header section-->
<br><br><br><br><br><br><br><br><br>

    <!-- <div class="section-title">Personal Information</div>
    <div class="container">
        <?php
            $user_id = $_SESSION['auth_user']['user_id'];
            $sql= "SELECT * from `regular_user` WHERE user_id = $user_id";
            $query= mysqli_query($con, $sql);
            $userdata = mysqli_fetch_array($query);
            $pdf_path = "user_cv/" . $userdata['cv'];
            ?>
        <div class="profile">
            <?php if (!empty($userdata['image'])): ?>
                <img src="images/user_files/profile_pictures/<?= htmlspecialchars($userdata['image']) ?>" alt="Profile Picture" class="profile-img">
            <?php else: ?>
                <i class="fas fa-user profile-img" style="font-size: 200px; line-height: 200px; text-align: center; border-radius: 1rem; border: .2rem solid black; background-color: #eee;"></i>
            <?php endif; ?>
            
            <div class="profile-info">
                <h2><?= $userdata['f_name']?> <?= $userdata['l_name']?></h2>
                <p>Age: <?= $userdata['age']?> </p>
                <p>Location: <?= $userdata['location']?> </p>
                <p>Sex: <?= $userdata['sex']?> </p>
                <br>
                
                <a href="include/editprofile.php?profileupdate=<?= $userdata ['user_id']?>" class="edit-btn">Edit</a> 
            </div>
        </div>
    </div> -->
    <div class="full-cont">
    <div class="box-cont">
         <!--Available Jobs -->
         <div class="box-list">
         
         <h1 class="header1"> Available Jobs</h1>
         <div class="scrollable-container">
         <?php
         $sql = "SELECT jobs.* ,categories.name as 'catname'
                                    from jobs
                                    INNER JOIN categories on categories.cat_id = jobs.cat_id
                                    WHERE jobs.cat_id=1
                                    order by jobs.jobid DESC";
                $rs = mysqli_query($con, $sql);
                while ($jobdata = mysqli_fetch_array($rs)) {
                    $originalDate = $jobdata['date'];
                                            $newDate = date("F j, Y", strtotime($originalDate));
    ?>

        <div class="box">
                
            <div class="company">
                <div>
                    
                    <h1 class="job-title"  style="overflow-x:hidden;  text-overflow: ellipsis;"><?= $jobdata['name'] ?></h1>
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

      
<?php              }     ?>
  </div>
  </div></div>
<!--Available Jobs -->
                                         <!-- TABLES -->
                               <div class="table-container">       
    <div class="container1">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold" style="font-size: 2.5rem;">My Applications</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                
                                <th>Title</th>
                                <th>Date Applied</th>
                                <th>Status</th>
                                <th style="text-align: center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT application.app_id,application.status, jobs.name, jobs.jobid, jobs.name AS job_name, categories.name AS cat_name, 
                                               application.date, application.cv 
                                        FROM application
                                        INNER JOIN jobs ON jobs.jobid = application.jobid
                                        INNER JOIN categories ON categories.cat_id = jobs.cat_id
                                        WHERE application.user_id = '$user_id' AND categories.cat_id=1";

                                $rs = mysqli_query($con, $sql);
                                while ($appdata = mysqli_fetch_array($rs)) {
                                    $pdf_path = "user_cv/" . $appdata['cv'];
                                    $originalDate = $appdata['date'];
                                    $newDate = date("F j, Y", strtotime($originalDate));
                            ?>
                                <tr>
                                                                   
                                    <td>
                                    <a href="view_job.php?jobid=<?= $appdata['jobid'] ?>" style="text-decoration: none; color: inherit;">
                                            <?= $appdata['job_name'] ?>
                                        </a>
                                    </td>
                                    <td><?= $newDate; ?></td>
                                    <td>
                                  
                                            <?php 
                                            if ($appdata['status'] == 1) {
                                                echo '<p style="background-color: green; color: white; border-radius: .5rem; padding: 5px; text-align: center;">Accepted</p>';
                                            } elseif ($appdata['status'] == 0) {
                                                echo '<p style="background-color: gray; color: white; border-radius: .5rem; padding: 5px; text-align: center;">Pending</p>';
                                            } elseif ($appdata['status'] == 2) {
                                                echo '<p style="background-color: darkgray; color: white; border-radius: .5rem; padding: 5px; text-align: center;">Rejected</p>';
                                            }
                                            
                                        ?>
                                    </td>
                                    <td class="text-center"><button class="icon-button" data-toggle="modal" data-target="#deleteModal" data-id="<?= $appdata['app_id'] ?>"><i class="fas fa-trash" style="font-size: 2.5rem; color: red; margin-top:1rem;"></i></button></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container2">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold" style="font-size: 2.5rem;">My Registrations</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Date registered</th>
                            <th>Schedule</th>
                            <th style="text-align: center">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT application.app_id, jobs.jobid, jobs.name AS job_name, categories.name AS cat_name, 
                                           application.date, application.cv, jobs.date AS job_date
                                    FROM application
                                    INNER JOIN jobs ON jobs.jobid = application.jobid
                                    INNER JOIN categories ON categories.cat_id = jobs.cat_id
                                    WHERE application.user_id = '$user_id' AND categories.cat_id!=1";

                            $rs = mysqli_query($con, $sql);
                            while ($appdata = mysqli_fetch_array($rs)) {
                                $pdf_path = "user_cv/" . $appdata['cv'];
                                $originalDate = $appdata['date'];
                                $newDate = date("F j, Y", strtotime($originalDate));
                        ?>
                            <tr>
                                <td><?= $appdata['cat_name'] ?></td>                                   
                                <td>
                                    <a href="view_job.php?jobid=<?= $appdata['jobid'] ?>" style="text-decoration: none; color: inherit;">
                                            <?= $appdata['job_name'] ?>
                                        </a>
                                    </td>
                                <td><?= $newDate; ?></td>
                                <td><?= date("F j, Y", strtotime($appdata['job_date'])); ?></td>
                                <td class="text-center"><button class="icon-button" data-toggle="modal" data-target="#deleteModal" data-id="<?= $appdata['app_id'] ?>"><i class="fas fa-trash" style="font-size: 2.5rem; color: red;"></i></button></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    </div> 


</div>


    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel" style="font-size: 3rem;">Delete Application</h5>
                
                    
                </button>
            </div>
            <div class="modal-body" style="font-size: 1.5rem;">
                Are you sure you want to delete this application?
            </div>
            <div class="modal-footer">
            <form id="deleteForm" method="post" action="include/applicationdelete.php">
                <button type="button" class="btn btn-primary" data-dismiss="modal" style="background-color:#337DCC; border-radius: .9rem; font-size: 1.5rem;" >Cancel</button>
                
                    <input type="hidden" name="app_id" id="app_id">
                    <button type="submit" class="btn btn-danger" style="background-color:red; border-radius: .9rem; font-size: 1.5rem;" >Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
                                </div>
<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var appId = button.data('id'); // Extract info from data-* attributes
        var modal = $(this);
        modal.find('#app_id').val(appId);
    });
</script>
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
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var appId = button.data('id'); // Extract info from data-* attributes
        var modal = $(this);
        modal.find('#app_id').val(appId);
    });
</script>
<?php include("footerlogin.php")?>
</body>

</html>
