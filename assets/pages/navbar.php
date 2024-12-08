<?php global $user; ?>
<nav class="navbar navbar-expand-lg navbar-light bg-white border" style="position: fixed; width: 100%; top: 0; z-index: 1000;">
    <div class="container col-lg-9 col-sm-12 col-md-10 d-flex flex-lg-row flex-md-row flex-sm-column justify-content-center">
        <div class="d-flex justify-content-between ">
        <a class="navbar-brand" href="?">
            <img src="assets/images/logo.png" alt="" height="28">

        </a>

        <form class="d-flex" id="searchform">
            <input class="form-control me-2" type="search" id="search" placeholder="Search" aria-label="Search" autocomplete="off">
            <span class="input-group-text m-2" id="searchIcon" onclick="focusSearch()"> <!-- Add onclick attribute -->
                <i class="bi bi-search"></i>
            </span>
            <div class="bg-white text-end rounded border shadow py-3 px-4 mt-5" style="display:none;position:absolute;z-index:+99;" id="search_result" data-bs-auto-close="true">
                <button type="button" class="btn-close" aria-label="Close" id="close_search"></button>
                <div id="sra" class="text-start">
                    <p class="text-center text-muted">enter name or enrollment</p>

                </div>
            </div>
        </form>
        <div>
            <!-- <a href="?u=<?= $user['enrollment'] ?>" style="text-decoration: none;">
                <img src="assets/images/profile/<?= $user['profile_pic'] ?>" alt="" height="40" width="40" class="rounded-circle border">
            </a> -->
            <div class="nav-item dropdown dropstart">
                <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <!-- <img src="assets/images/profile/<?= $user['profile_pic'] ?>" alt="" height="30" width="30" class="rounded-circle border"> -->
                    <i class="bi bi-list fs-3 text-black"></i>
                </a>
                <ul class="dropdown-menu position-absolute top-100 end-50" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="?u=<?= $user['enrollment'] ?>" style="text-decoration: none;">
                    <!-- <i class="bi bi-person"></i>  -->
                    <img src="assets/images/profile/<?= $user['profile_pic'] ?>" alt="" height="20" width="20" class="rounded-circle border">

                    My Profile</a></li>

                    <li><a class="dropdown-item" href="?editprofile"><i class="bi bi-pencil-square"></i> Edit Profile</a></li>
                    <li><a class="dropdown-item" href="?feedback"><svg class="bi" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M22 1h-7a2.44 2.44 0 0 0-2.41 2l-.92 5.05a2.44 2.44 0 0 0 .53 2a2.47 2.47 0 0 0 1.88.88H17l-.25.66a3.26 3.26 0 0 0 3 4.41a1 1 0 0 0 .92-.59l2.24-5.06A1 1 0 0 0 23 10V2a1 1 0 0 0-1-1m-1 8.73l-1.83 4.13a1.33 1.33 0 0 1-.45-.4a1.23 1.23 0 0 1-.14-1.16l.38-1a1.68 1.68 0 0 0-.2-1.58A1.7 1.7 0 0 0 17.35 9h-3.29a.46.46 0 0 1-.35-.16a.5.5 0 0 1-.09-.37l.92-5A.44.44 0 0 1 15 3h6ZM9.94 13.05H7.05l.25-.66A3.26 3.26 0 0 0 4.25 8a1 1 0 0 0-.92.59l-2.24 5.06a1 1 0 0 0-.09.4v8a1 1 0 0 0 1 1h7a2.44 2.44 0 0 0 2.41-2l.92-5a2.44 2.44 0 0 0-.53-2a2.47 2.47 0 0 0-1.86-1m-.48 7.58A.44.44 0 0 1 9 21H3v-6.73l1.83-4.13a1.33 1.33 0 0 1 .45.4a1.23 1.23 0 0 1 .14 1.16l-.38 1a1.68 1.68 0 0 0 .2 1.58a1.7 1.7 0 0 0 1.41.74h3.29a.46.46 0 0 1 .35.16a.5.5 0 0 1 .09.37Z"/></svg></i> Feedback Form</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="assets/php/actions.php?logout"><i class="bi bi-box-arrow-in-left"></i> Logout</a></li>
                </ul>
            </div>
            <!-- <a class="m-2" style="text-decoration: none;color:black" href="assets/php/actions.php?logout">Logout</a> -->

        </div>


        </div>





    </div>
</nav>
<br><br><br>