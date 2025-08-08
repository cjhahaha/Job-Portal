<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
   
    <link rel="stylesheet" href="css/login-register.css">
    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css');
        .status-message {
            text-align: center;
            color: red;
        }
        .form-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .sign-in{
            width: 30%;
            max-width: 700px;
            height: 100%;
            max-height: 700px;
            padding: 1rem;
         
    
            overflow-y: auto;
        }
        
        .sign-in_form #f_name,
        .sign-in_form #l_name,
        .sign-in_form #uname,
        .sign-in_form #username,
        .sign-in_form #pword,
        .sign-in_form #password,
        .sign-in_form #confirm_password,
        .sign-in_form #dob,
        .sign-in_form #sex,
        .sign-in_form #email,
        .sign-in_form #location {
            border: none;
            outline: none;
            border-bottom: 1px solid black;
            caret-color: #000;
            color: #000;
            padding: .15rem 0;
            width: 70%;
            font-size: .95rem;
            display: block;
            margin: 30px auto;
            margin-bottom: 25px;
            font-weight: 300;
        }
        .input-group{
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            
        }
        .box {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            width: 48%;
            box-sizing: border-box;
        }
        .box i {
            
            margin-right: 7px;
            font-size: 18px;
        }
        .box input, .box select {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }
        .login-button{
            margin-top: 3px;
        }
        @media (max-width: 970px){
            .sign-in {
                width: 65%;
                padding: 1rem;
                height: 100%;
            max-height: 600px;
            }
        }
        @media (max-width: 768px) {
            
            .box {
                width: 100%;
            }
        }
        @media (max-width: 480px) {
            .sign-in {
                width: 100%;
                padding: 1rem;
            }
            .box input, .box select {
                max-width: 100%;
            }
            .sign-in_form #f_name,
            .sign-in_form #l_name,
            .sign-in_form #uname,
            .sign-in_form #username,
            .sign-in_form #pword,
            .sign-in_form #password,
            .sign-in_form #confirm_password,
            .sign-in_form #dob,
            .sign-in_form #sex,
            .sign-in_form #email,
            .sign-in_form #location {
                width: 100%;
            }
        }
    </style>
</head>

<body style="background-image: linear-gradient(180deg, #282b2cbd 0%, rgba(0, 0, 0, .9) 1200px), url(images/barangay-taong-tabon_1920x1080.jpg);">
    <div class="form-wrapper">
        <div class="sign-in" style="height: 700px">
            <img src="images/Bacoor-official_logo.png" alt="barangay logo" class="barangay-logo">
            <div class="sign-in_head">Registration</div>
            
            <?php
            if (isset($_SESSION['status'])) {

                echo "<h4 class='status-message'>" . $_SESSION['status'] . "</h4>";
                unset($_SESSION['status']);
            }

            ?>
            <?php if (isset($_SESSION['status'])) : ?>
                <div class="error"><?= htmlspecialchars($_SESSION['status']);
                                    unset($_SESSION['status']); ?></div>
            <?php endif; ?>

            <div class="sign-in_form">
            
                <form id="registrationForm" method="POST" action="code.php" onsubmit="return validateForm()">
                <div class="input-group">


                    <div class="box">
                     <i class="fas fa-user" aria-hidden="true"></i>
                    <input type="text" id="f_name" required name="f_name" placeholder="First Name">
                    </div>

                    <div class="box">
                    <i class="fas fa-user" aria-hidden="true"></i>
                    <input type="text" id="l_name" required name="l_name" placeholder="Last Name">
                    </div>

                </div>


                <div class="input-group">
                            <div class="box">
                           
                                <i class="fa-solid fa-cake-candles" aria-hidden="true"></i>
                                 
                                <input type="date" id="dob" required name="dob" placeholder="Enter your birthday" onchange="calculateAge()">
                            </div>
                        
                    
                        <div class="box">
                        <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                    <select name="location" id="location" required class="input">
                        <option value="Villanueva Subd.">Villanueva Subd.</option>
                        <option value="Tia Maria Subd.">Tia Maria Subd. </option>
                        <option value="Perpetual Village 5">Perpetual Village 5</option>
                    </select> 
                    </div> 
                </div>
                <div class="input-group">
                <div class="box">
                <i class="fas fa-user" aria-hidden="true"></i>
                    <select required name="age" id="age" class="input">
                            <option selected disabled value="">Age</option>
                            <?php for ($i = 15; $i <= 30; $i++): ?>
                                <option value="<?= $i; ?>"><?= $i; ?></option>
                            <?php endfor; ?>
                        </select>
                        </div>
                <div class="box">
                        <i class="fas fa-user" aria-hidden="true"></i>
                        <select name="sex" id="sex" required class="input">
                        <option selected disabled value="">Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female </option>
                    
                    </select>
                    </div>
                    </div>
                <div class="input-group">
                <div class="box">
                <i class="fas fa-user" aria-hidden="true"></i>
                    <input type="text" id="username" required name="username" placeholder="Username">
                </div>
                <div class="box">
                <i class="fas fa-envelope" aria-hidden="true"></i>
                <input type="email" id="email" required name="email" placeholder="Email Address">
                </div> 
                </div>
                <div class="input-group">
                <div class="box">
                <i class="fas fa-lock" aria-hidden="true"></i>
                    <input type="password" id="password" required name="password" maxlength="50" placeholder="Password">
                    </div>
                    <div class="box">
                    <i class="fas fa-lock" aria-hidden="true"></i>
                    <input type="password" id="confirm_password" maxlength="50" required name="confirm_password" placeholder="Confirm Password">
                    
                    </div> 
                    
                </div>
                <div class="box1">
                <input type="checkbox" id="terms_agreed" name="terms_agreed" value="1">
                <label for="terms_agreed">I agree to the <a href="terms-conditions.php" target="_blank">Terms and Conditions</a> and <a href="privacy-policy.php" target="_blank">Privacy Policy</a></label>
                <br><br>
                    <button class="login-button" value="register" name="submit">Submit</button>
                    
                    </div> 
                </form>

                <p>Already have an account? <a href="regular_login.php">Login</a></p>
            </div>
        </div>
    </div>

    <script>
        function validateForm() {
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirm_password').value;
            if (password !== confirmPassword) {
                alert('Passwords do not match. Please try again.');
                return false;
            }

            var fName = document.getElementById('f_name').value;
            var lName = document.getElementById('l_name').value;
            var namePattern = /^[A-Za-z ]+$/;

            if (!namePattern.test(fName)) {
                alert('First name should contain only letters.');
                return false;
            }

            if (!namePattern.test(lName)) {
                alert('Last name should contain only letters.');
                return false;
            }

            var termsAgreed = document.getElementById('terms_agreed');
            if (!termsAgreed.checked) {
                alert('You must agree to the terms and conditions.');
                return false;
            }

            return true;
        }

        function calculateAge() {
            var dob = document.getElementById('dob').value;
            var dobDate = new Date(dob);
            var now = new Date();
            var age = now.getFullYear() - dobDate.getFullYear();
            var monthDiff = now.getMonth() - dobDate.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && now.getDate() < dobDate.getDate())) {
                age--;
            }

            var ageSelect = document.getElementById('age');
            for (var i = 0; i < ageSelect.options.length; i++) {
                if (parseInt(ageSelect.options[i].value) === age) {
                    ageSelect.selectedIndex = i;
                    break;
                }
            }
        }
    </script>
</body>
</html>
