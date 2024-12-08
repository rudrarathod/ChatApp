<?php global $user; ?>
<br><br><br>
<nav class="navbar navbar-expand-lg navbar-light bg-white border" style="position: fixed;
        bottom: 0;
        width: 100%;
        z-index: 1000; /* Adjust the z-index as needed */">
    <div class="container  justify-content-between">


        <ul class="navbar-nav flex-fill flex-row justify-content-evenly mb-lg-1 mb-sm-0">

            <li class="nav-item">
                <a class="nav-link text-dark" href="?"><i class="bi bi-house-door-fill"></i></a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-dark" href="?post"><i class="bi bi-book-fill"></i></a>
            </li>

            <li class="nav-item">

                <a class="nav-link text-dark" data-bs-toggle="modal" data-bs-target="#addpost" href="#"><i class="bi bi-plus-square-fill"></i></a>
            </li>
            <li class="nav-item">


                <?php
                if (getUnreadNotificationsCount() > 0) {
                ?>
                    <a class="nav-link text-dark position-relative" id="show_not" data-bs-toggle="offcanvas" href="#notification_sidebar" role="button" aria-controls="offcanvasExample">
                        <i class="bi bi-bell-fill"></i>
                        <span class="un-count position-absolute start-10 translate-middle badge p-1 rounded-pill bg-danger">
                            <small><?= getUnreadNotificationsCount() ?></small>
                        </span>
                    </a>

                <?php
                } else {
                ?>
                    <a class="nav-link text-dark" data-bs-toggle="offcanvas" href="#notification_sidebar" role="button" aria-controls="offcanvasExample"><i class="bi bi-bell-fill"></i></a>
                <?php
                }
                ?>


            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" data-bs-toggle="offcanvas" href="#message_sidebar" href="#"><i class="bi bi-chat-right-dots-fill"></i> <span class="un-count position-absolute start-10 translate-middle badge p-1 rounded-pill bg-danger" id="msgcounter">

                    </span></a>
            </li>


        </ul>


    </div>
</nav>