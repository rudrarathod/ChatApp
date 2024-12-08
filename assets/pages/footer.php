<?php if (isset($_SESSION['Auth'])) { ?>
  <div class="modal fade" id="addpost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New Post</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeButton"></button>
        </div>
        <div class="modal-body">
          <img src="" style="display:none" id="post_img" class="w-100 rounded border">
          <form method="post" id="addPostForm" action="assets/php/actions.php?addpost" enctype="multipart/form-data">
            <div class="my-3">
              <input class="form-control" name="post_img" type="file" id="select_post_img">
            </div>
            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">Say Something</label>
              <textarea name="post_text" class="form-control" id="exampleFormControlTextarea1" rows="1" required></textarea>
            </div>

            <select name="branch" id="BRANCH" class="form-select mt-1" aria-label="Select Branch" onchange="check()" required>
              <option value="" disabled selected>Select Branch</option>
              <option value="co">Computer Engineering</option>
            </select>

            <select name="sem" id="SEM" class="form-select mt-1" aria-label="Select Semester" onchange="check()" required>
              <option value="" disabled selected>Select Semester</option>
              <option value="1">I</option>
              <option value="2">II</option>
              <option value="3">III</option>
              <option value="4">IV</option>
              <option value="5">V</option>
              <option value="6">VI</option>
            </select>

            <select name="scheme" id="SCHEME" class="form-select mt-1" aria-label="Select Scheme" onchange="check()" required>
              <option value="" disabled selected>Select Scheme</option>
              <option value="I">I</option>
              <option value="K">K</option>
            </select>

            <select name="SUBJECT" class="form-select mt-1" aria-label="Select Subject" required>
              <option value="" disabled selected>Select Subject</option>
              <!-- Computer Engineering, Semester 6, Scheme I subjects -->
              <optgroup hidden id="CO6I" label="Computer Engineering - Semester 6 - Scheme I">
                <option value="22509">Management</option>
                <option value="22616">Programming with Python</option>
                <option value="22617">Mobile Application Development</option>
                <option value="22618">Emerging Trends in Computer and Information Technology</option>
                <option value="22619">Web-Based Application Development using PHP</option>
              </optgroup>
              <optgroup hidden id="CO4I" label="Computer Engineering - Semester 4">
                <option value="22412">Java Programming</option>
                <option value="22413">Software Engineering</option>
                <option value="22414">Data Communication and Computer Network</option>
                <option value="22415">Microprocessors</option>
                <option value="22416">GUI Application Development using VB.Net</option>
              </optgroup>

              <optgroup hidden id="CO5I" label="Computer Engineering - Semester 5">
                <option value="22447">Environmental Studies</option>
                <option value="22516">Operating System</option>
                <option value="22517">Advanced Java Programming</option>
                <option value="22518">Software Testing</option>
                <option value="22519">Client-Side Scripting Language</option>
              </optgroup>

              <optgroup hidden id="CO3I" label="Computer Engineering - Semester 3">
                <option value="22316">Object-Oriented Programming with C++</option>
                <option value="22317">Data Structure using C</option>
                <option value="22319">Computer Graphics</option>
                <option value="22320">Digital Techniques</option>
              </optgroup>


            </select>

            <button type="submit" class="btn btn-primary m-2">Post</button>
          </form>

          <script <?= time() ?>>
            function check() {
              var branch = document.getElementById("BRANCH").value;
              var sem = document.getElementById("SEM").value;
              var scheme = document.getElementById("SCHEME").value;

              // Check if the conditions are met to show the optgroup
              if (branch === "co" && sem === "6" && scheme === "I") {
                document.getElementById("CO6I").removeAttribute("hidden");
              } else {
                document.getElementById("CO6I").setAttribute("hidden", "hidden");
                document.querySelector('select[name="SUBJECT"]').value = "";
              }
              if (branch === "co" && sem === "5" && scheme === "I") {
                document.getElementById("CO5I").removeAttribute("hidden");
              } else {
                document.getElementById("CO5I").setAttribute("hidden", "hidden");
                document.querySelector('select[name="SUBJECT"]').value = "";
              }
              if (branch === "co" && sem === "4" && scheme === "I") {
                document.getElementById("CO4I").removeAttribute("hidden");
              } else {
                document.getElementById("CO4I").setAttribute("hidden", "hidden");
                document.querySelector('select[name="SUBJECT"]').value = "";
              }
              if (branch === "co" && sem === "3" && scheme === "I") {
                document.getElementById("CO3I").removeAttribute("hidden");
              } else {
                document.getElementById("CO3I").setAttribute("hidden", "hidden");
                document.querySelector('select[name="SUBJECT"]').value = "";
              }
            }
            // Add an event listener to the close button
            document.getElementById("closeButton").addEventListener("click", function() {
              // Reset the form when the modal is closed
              document.getElementById("addPostForm").reset();
              //reset image
              document.getElementById("post_img").src = "";

            });
          </script>

        </div>

      </div>
    </div>
  </div>

  <div class="offcanvas offcanvas-start" tabindex="-1" id="notification_sidebar" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">Notifications</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <?php
      $notifications = getNotifications();
      foreach ($notifications as $not) {
        $time = $not['created_at'];
        $fuser = getUser($not['from_user_id']);
        $post = '';
        if ($not['post_id']) {
          $post = 'data-bs-toggle="modal" data-bs-target="#postview' . $not['post_id'] . '"';
        }
        $fbtn = '';
      ?>
        <div class="d-flex justify-content-between border-bottom">
          <div class="d-flex align-items-center p-2">
            <div><img src="assets/images/profile/<?= $fuser['profile_pic'] ?>" alt="" height="40" width="40" class="rounded-circle border">
            </div>
            <div>&nbsp;&nbsp;</div>
            

            <?php
if (isset($post) && isset($fuser) && isset($not)) {
?>
<div class="d-flex flex-column justify-content-center" <?= $post ?>>
              <a href='?u=<?= $fuser['enrollment'] ?>' class="text-decoration-none text-dark">
                <h6 style="margin: 0px;font-size: small;"><?= $fuser['first_name'] ?> <?= $fuser['last_name'] ?></h6>
              </a>
              <p style="margin:0px;font-size:small" class="<?= $not['read_status'] ? 'text-muted' : '' ?>">@<?= $fuser['enrollment'] ?> <?= $not['message'] ?></p>
              <time style="font-size:small" class="timeago <?= $not['read_status'] ? 'text-muted' : '' ?> text-small" datetime="<?= $time ?>"></time>
            </div>
<?php } else {
    // Handle the case where one or more variables are not set
    echo "Something went wrong.";
}
?>

          </div>
          <div class="d-flex align-items-center">
            <?php
            if ($not['read_status'] == 0) {
            ?>
              <div class="p-1 bg-primary rounded-circle"></div>

            <?php

            } else if ($not['read_status'] == 2) {
            ?>
              <span class="badge bg-danger">Post Deleted</span>
            <?php
            }
            ?>

          </div>
        </div>
      <?php
      }
      ?>

    </div>
  </div>







  <div class="offcanvas offcanvas-start" tabindex="-1" id="message_sidebar" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">Messages</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body" id="chatlist">




    </div>
  </div>

  <div class="modal fade" id="chatbox" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <a href="" id="cplink" class="text-decoration-none text-dark">
            <h5 class="modal-title" id="exampleModalLabel"><img src="assets/images/profile/default_profile.jpg" id="chatter_pic" height="40" width="40" class="m-1 rounded-circle border"><span id="chatter_name"></span>(@<span id="chatter_username">loading..</span>)</h5>
          </a>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body d-flex flex-column-reverse gap-2" id="user_chat">
          loading..
        </div>
        <div class="modal-footer">

          <p class="p-2 text-danger mx-auto" id="blerror" style="display:none">
            <i class="bi bi-x-octagon-fill"></i> you are not allowed to send msg to this user anymore

        </div>
        <div class="input-group p-2 " id="msgsender">
          <input type="text" class="form-control rounded-0 border-0" id="msginput" placeholder="say something.." aria-label="Recipient's enrollment" aria-describedby="button-addon2">
          <button class="btn btn-outline-primary rounded-0 border-0" id="sendmsg" data-user-id="0" type="button">Send</button>
        </div>
      </div>
    </div>
  </div>
  </div>




<?php } ?>

<script>
        // Disable right-click
        document.addEventListener('contextmenu', function (e) {
            e.preventDefault();
        });

        // Disable long-press (for touch devices)
        document.addEventListener('touchstart', function (e) {
            if (e.touches.length > 1) {
                e.preventDefault();
            }
        }, { passive: false });
    </script>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/js/jquery.timeago.js"></script>

<script src="assets/js/custom.js?v=<?= time() ?>"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.worker.min.js"></script>
</body>

</html>