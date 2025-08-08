<footer id="footer" class="footer" style="background-color: #eee; " >
        <div class="container" style="color: black;">
            <div class="row gy-4" >
                <div class="col-lg-5 col-md-12 footer-info">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span style="color: black;">Links</span>
                    </a>
                    <p>
                    You can message us directly to here
                    </p>
                    <div class="social-links d-flex mt-4">
                    <a href="https://www.facebook.com/barangayrealI" class="facebook"><i class="bi bi-facebook" style="color: black;"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-6 footer-links" >
                    <h4>Useful Links</h4>
                    <ul >
                        <li ><a style="color: black;"href="profile.php">Home</a></li>
                        <li><a style="color: black;"href="about.php">About us</a></li>
                        <li><a style="color: black;"href="skprojects.php">All List</a></li>
                        <li><a href="terms-conditions.php" style="color: black;" target="_blank" >Terms of service</a></li>
                        <li><a href="privacy-policy.php" style="color: black;" target="_blank">Privacy and Policy</a></li>
                    </ul>
                </div>

                
                <?php
    include('connect.php');
    $sql = "SELECT * FROM `contacts`";
    $rs = mysqli_query($con, $sql);
    while ($contacts = mysqli_fetch_array($rs)) {
    ?>
                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start" style="color: black;" >
                    <h4>Contact Us</h4>
                    <p>
                        <?= $contacts['location']?>
                       <br>
                        <strong>Phone:</strong>  <?= $contacts['phone']?><br />
                        <strong>Email:</strong>  <?= $contacts['gmail']?><br />
                    </p>
                </div>
            </div>
        </div>
<?php } ?>
        <div class="container mt-4"style="color: black;">
            <div class="copyright">
                &copy; Copyright <strong><span>Oportunidad Real</span></strong>. All Rights Reserved
            </div>
        </div>
    </footer>