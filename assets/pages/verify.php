<?php
// Assuming session_start() is called before this script runs
global $db;
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("database is not connected");
$enrollment = $_SESSION['enrollment'];

$query = "SELECT email FROM `student_info` WHERE Enrollment='$enrollment'";
$result = mysqli_query($db, $query);
$return_data = mysqli_fetch_assoc($result);

?>

<div class="login">
    <div class="col-lg-4 col-md-8 col-sm-12 bg-white border rounded p-4 shadow-sm">

        <?php if (!isset($_SESSION['check']) || $_SESSION['check'] !== 0 &&  $_SESSION['enrollment_notfound'] == 0) : ?>
            <form method="POST" id="OTPbox">
                <h5 class="h5 m-3 fw-normal">Please enter OTP sent to <?php echo $return_data['email']; ?>.</h5>
                <div class="form-floating mt-1">
                    <input type="text" name="code" class="form-control rounded-0" id="floatingPassword" placeholder="" required>
                    <label for="floatingPassword">Enter OTP</label>
                </div>
                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <button class="btn btn-primary" type="submit">Verify</button>
                </div>
            </form>
        <?php elseif (isset($_SESSION['enrollment_notfound']) && $_SESSION['enrollment_notfound'] == 1) : ?>
            <p>You can't sign up for the site. Please contact the admin at <a href="mailto:rudrarathod738@gmail.com">rudrarathod738@gmail.com</a>
                for assistance.</p>
        <?php else : ?>
            <p>Verification successful. You can now proceed with signup.</p>
        <?php endif; ?>

        <?php

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['code'] == $_SESSION['enrollment_verification_code']) {
                $_SESSION['check'] = 0;

                echo '
            <script>
            // Get the element by its id
var otpBox = document.getElementById("OTPbox");

// Check if the element exists before hiding it
if (otpBox) {
    // Hide the element
    otpBox.style.display = "none";
}
</script>
            <form method="POST" action="assets/php/actions.php?signup">
                <div class="mt-3 d-flex justify-content-center align-items-center">
                    <button class="btn btn-primary" type="submit">Signup</button>
                </div>
            </form>';
            } else {
                echo "Try Again.";
            }
        }
        ?><br>
        <a href="?login" class="text-decoration-none mt-5"><i class="bi bi-arrow-left-circle-fill"></i> Go Back
            To
            Login</a>
    </div>
</div>