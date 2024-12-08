<?php
global $user;
global $posts;
global $follow_suggestions;
global $db;
$_SESSION['a']=1;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enrollment = $_POST['enrollment'];

}else{
    $enrollment= 0;
}
$query = "SELECT email FROM `student_info` WHERE Enrollment='$enrollment'";
$result = mysqli_query($db, $query);
$return_data = mysqli_fetch_assoc($result);

?>
<div class="login">
    <div class="col-lg-4 col-md-8 col-sm-12 bg-white border rounded p-4 shadow-sm">
        <form method="post" action="assets/php/actions.php?vs">
            <div class="d-flex justify-content-center">

                <img class="mb-4" src="assets/images/logo.png" alt="" height="45">
            </div>
            <h1 class="h5 mb-3 fw-normal">Create new account</h1>
            <div id="signup">
                <div class="d-flex">
                    <div class="form-floating m-1 col-6 ">
                        <input type="text" name="first_name" value="<?= showFormData('first_name') ?>" class="form-control rounded-0" placeholder="enrollment/email" required>
                        <label for="floatingInput">first name</label>
                    </div>
                    <div class="form-floating m-1 col-6">
                        <input type="text" name="last_name" value="<?= showFormData('last_name') ?>" class="form-control rounded-0" placeholder="enrollment/email" required>
                        <label for="floatingInput">last name</label>
                    </div>
                </div>
                <?= showError('first_name') ?>
                <?= showError('last_name') ?>

                <div class="d-flex gap-3 my-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="1" <?= isset($_SESSION['formdata']) ? '' : 'checked' ?><?= showFormData('gender') == 1 ? 'checked' : '' ?>>
                        <label class="form-check-label" for="exampleRadios1">
                            Male
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="exampleRadios3" value="2" <?= showFormData('gender') == 2 ? 'checked' : '' ?>>
                        <label class="form-check-label" for="exampleRadios3">
                            Female
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="exampleRadios2" value="0" <?= showFormData('gender') == 0 ? 'checked' : '' ?>>
                        <label class="form-check-label" for="exampleRadios2">
                            Other
                        </label>
                    </div>
                </div>
                <div class="form-floating mt-1">
                    <input type="email" name="email" value="<?= showFormData('email') ?>" class="form-control rounded-0" placeholder="enrollment/email" required>
                    <label for="floatingInput">email</label>
                </div>
                <?= showError('email') ?>

                <div class="form-floating mt-1">
                    <input type="text" name="enrollment" value="<?= showFormData('enrollment') ?>" class="form-control rounded-0" placeholder="enrollment/email" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                    <label for="floatingInput">enrollment</label>
                </div>
                <?= showError('enrollment') ?>

                <select name="branch" class="form-select mt-1" aria-label="Select Branch" required>
                    <option value="" disabled selected>Select Branch</option>
                    <option value="co" <?= (showFormData('branch') == 'co') ? 'selected' : '' ?>>Computer Engineering</option>
                </select>
                <?= showError('branch') ?>

                <select name="sem" class="form-select mt-1" aria-label="Select Semester" required>
                    <option value="" disabled selected>Select Semester</option>
                    <option value="1" <?= (showFormData('sem') == '1') ? 'selected' : '' ?>>I</option>
                    <option value="2" <?= (showFormData('sem') == '2') ? 'selected' : '' ?>>II</option>
                    <option value="3" <?= (showFormData('sem') == '3') ? 'selected' : '' ?>>III</option>
                    <option value="4" <?= (showFormData('sem') == '4') ? 'selected' : '' ?>>IV</option>
                    <option value="5" <?= (showFormData('sem') == '5') ? 'selected' : '' ?>>V</option>
                    <option value="6" <?= (showFormData('sem') == '6') ? 'selected' : '' ?>>VI</option>
                </select>
                <?= showError('sem') ?>

                <select name="scheme" class="form-select mt-1" aria-label="Select Scheme" required>
                    <option value="" disabled selected>Select Scheme</option>
                    <option value="I" <?= (showFormData('scheme') == 'I') ? 'selected' : '' ?>>I</option>
                    <option value="K" <?= (showFormData('scheme') == 'K') ? 'selected' : '' ?>>K</option>
                </select>
                <?= showError('scheme') ?>


                <div class="form-floating mt-1">
                    <input type="password" name="password" class="form-control rounded-0" id="floatingPassword" placeholder="Password" required>
                    <label for="floatingPassword">password</label>
                </div>
                <?= showError('password') ?>


                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <button class="btn btn-primary" type="submit">Next</button>
                    <a href="?login" class="text-decoration-none">Already have an account ?</a>
                </div>
            </div>
            <!-- <div id="verify">
                <h5 class="h5 m-3 fw-normal">Please enter OTP sent to <?php echo $return_data['email']; ?>.</h5>
                <div class="form-floating mt-1">
                    <input type="password" name="password" class="form-control rounded-0" id="floatingPassword" placeholder="" required>
                    <label for="floatingPassword">Enter OTP</label>
                </div>
                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <button class="btn btn-primary" type="button">Verify</button>
                </div>
            </div> -->

        </form>
    </div>
</div>