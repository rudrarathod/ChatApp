<?php
$function_url = "../assets/php/functions.php";
include('./php/admin_functions.php');
if (!isset($_SESSION['admin_auth']))
  header('Location:./pages/login.php');
$admin = getAdmin($_SESSION['admin_auth']);
?>
<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="../assets/images/icon1.png">


<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>msbtesolutionmedia | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="../assets/images/icon1.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <!-- <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li> -->

        <li class="nav-item">
          <a class=" btn btn-sm btn-danger" href="php/admin_actions.php?logout" role="button">
            Logout
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="?dashboard" class="brand-link">
        <img src="../assets/images/icon1.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light">MSM</span>
      </a>

      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

          <div class="info">
            <a href="#" class="d-block">
              <?= $admin['full_name'] ?>
            </a>
          </div>
        </div>




        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="?dashboard" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard

                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?edit_profile" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Edit Profile
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="?forms" class="nav-link">
              <!-- <svg  xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 1024 1024"><path fill="currentColor" d="M904 512h-56c-4.4 0-8 3.6-8 8v320H184V184h320c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8H144c-17.7 0-32 14.3-32 32v736c0 17.7 14.3 32 32 32h736c17.7 0 32-14.3 32-32V520c0-4.4-3.6-8-8-8"/><path fill="currentColor" d="M355.9 534.9L354 653.8c-.1 8.9 7.1 16.2 16 16.2h.4l118-2.9c2-.1 4-.9 5.4-2.3l415.9-415c3.1-3.1 3.1-8.2 0-11.3L785.4 114.3c-1.6-1.6-3.6-2.3-5.7-2.3s-4.1.8-5.7 2.3l-415.8 415a8.3 8.3 0 0 0-2.3 5.6m63.5 23.6L779.7 199l45.2 45.1l-360.5 359.7l-45.7 1.1z"/></svg>                <p> -->
              <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M14.727 6h6l-6-6zm0 .727H14V0H4.91c-.905 0-1.637.732-1.637 1.636v20.728c0 .904.732 1.636 1.636 1.636h14.182c.904 0 1.636-.732 1.636-1.636V6.727zM7.91 17.318a.819.819 0 1 1 .001-1.638a.819.819 0 0 1 0 1.638zm0-3.273a.819.819 0 1 1 .001-1.637a.819.819 0 0 1 0 1.637zm0-3.272a.819.819 0 1 1 .001-1.638a.819.819 0 0 1 0 1.638zm9 6.409h-6.818v-1.364h6.818zm0-3.273h-6.818v-1.364h6.818zm0-3.273h-6.818V9.273h6.818z"/></svg>
                  Form
                </p>
              </a>
            </li>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">
                <?php if (isset($_GET['edit_profile'])) {
                  echo "Edit Profile";
                } elseif (isset($_GET['forms'])) {
                  // echo "Form";
                } else {

                  echo "Dashboard";
                } ?>
              </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">

              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <?php if (!isset($_GET['edit_profile'])&& !isset($_GET['forms'])) {
            // } else {
            ?>
            <div class="row">
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>
                      <?= totalUsersCount() ?>
                    </h3>

                    <p>Total Users</p>
                  </div>
                  <div class="icon">
                    <!-- <i class="ion ion-bag"></i> -->
                    <i class="ion ion-person"></i>

                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>
                      <?= totalPostsCount() ?>
                    </h3>
                    <p>Total Posts</p>
                  </div>

                  <div class="icon">
                    <!-- <i class="ion ion-stats-bars"></i> -->
                    <svg class="ion" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 20 20"><path fill="currentColor" d="M9 7H6v2h3zM3 6a3 3 0 0 1 3-3h6v14H6a3 3 0 0 1-3-3zm2 1v2a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1m.5 4a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zM5 13.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4a.5.5 0 0 0-.5.5m8 3.5h1a3 3 0 0 0 3-3v-1h-4zm4-5V8h-4v4zm0-5V6a3 3 0 0 0-3-3h-1v4z"/></svg>
                  </div>

                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3>
                      <?= totalCommentsCount() ?>
                    </h3>
                    <p>Total Comments</p>
                  </div>
                  <div class="icon">
                    <!-- <i class="ion ion-person-add"></i> -->
                    <svg class="ion" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12a9.97 9.97 0 0 0 .951 4.262l-.93 4.537a1 1 0 0 0 1.18 1.18l4.537-.93c1.294.61 2.74.95 4.262.95c5.523 0 10-4.476 10-10c0-5.522-4.477-10-10-10" clip-rule="evenodd"/></svg>                  </div>

                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>
                      <?= totalLikesCount() ?>
                    </h3>
                    <p>Total Likes</p>
                  </div>
                  <div class="icon">
                    <!-- <i class="ion ion-pie-graph"></i> -->
                    <svg class="ion" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M23 10a2 2 0 0 0-2-2h-6.32l.96-4.57c.02-.1.03-.21.03-.32c0-.41-.17-.79-.44-1.06L14.17 1L7.59 7.58C7.22 7.95 7 8.45 7 9v10a2 2 0 0 0 2 2h9c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73zM1 21h4V9H1z"/></svg>
                  </div>
                </div>
              </div>
              <!-- ./col -->
            </div>
            <?php
          }

          ?>

          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <?php
            if (isset($_GET['edit_profile'])) {
              ?>
              <div class="card card-primary col-12">
                <div class="card-header">
                  <h3 class="card-title">Edit Your Profile</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <?= showError('adminprofile') ?>
                <form method="post" action="php/admin_actions.php?updateprofile">
                  <input type="hidden" name="user_id" value="<?= $admin['id'] ?>">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Full Name</label>
                      <input type="text" name="full_name" value="<?= $admin['full_name'] ?>" class="form-control"
                        id="exampleInputEmail1" placeholder="Enter Full Name" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" name="email" value="<?= $admin['email'] ?>" class="form-control"
                        id="exampleInputEmail1" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="text" name="password" value="<?= $admin['password_text'] ?>" class="form-control"
                        id="exampleInputPassword1" placeholder="Password">
                    </div>


                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                  </div>
                </form>
              </div>
              <?php
            }  
            elseif (isset($_GET['forms'])) 
            {
              ?>
                  <iframe src="form_builder/index.php" frameborder="0" class="full-iframe" style="height: 100vh;width: 100%;
    border: none;
"></iframe>

              <?php
            }
            else//if (isset($_GET['dashboard'])) 
            {
              ?>

              <div class="card w-100">
                <div class="card-header">
                  <h3 class="card-title">User Lists</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <?php
                  $userslist = getUsersList();
                  $count = 1;
                  ?>
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>#No</th>
                        <th>User</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      foreach ($userslist as $user) {
                        ?>
                        <tr>
                          <td>#
                            <?= $count ?>
                          </td>
                          <td>
                            <div class="d-flex">
                              <div>
                                <img src="../assets/images/profile/<?= $user['profile_pic'] ?>"
                                  class="rounded-circle border border-2 shadow-sm mx-2" width="55px" height="55px" />
                              </div>
                              <div>
                                <h5>
                                  <?= $user['first_name'] . ' ' . $user['last_name'] ?> - <span class="text-muted">@
                                    <?= $user['enrollment'] ?>
                                  </span>
                                </h5>
                                <h6 class="text-muted">
                                  <?= $user['email'] ?>
                                </h6>


                              </div>
                            </div>
                          </td>

                          <td>


                            <!-- <a href="./php/admin_actions.php?userlogin=<?= $user['email'] ?>" target="_blank" class="btn btn-success btn-sm m-1">Login User</a> -->
                            <a href="../?u=<?= $user['enrollment'] ?>" target="_blank"
                              class="btn btn-success btn-sm m-1">View User</a>

                            <?php if ($user['ac_status'] == 0): ?><button
                                class="m-1 btn btn-warning btn-sm verify_user_btn"
                                data-user-id="<?= $user['id'] ?>">Verify</button>
                            <?php endif; ?>


                            <button style="display:<?= $user['ac_status'] == 1 ? '' : 'none' ?>"
                              class="m-1 btn btn-danger btn-sm block_user_btn ub"
                              data-user-id="<?= $user['id'] ?>">Block</button>
                            <button style="display:<?= $user['ac_status'] == 2 ? '' : 'none' ?>"
                              class="m-1 btn btn-primary btn-sm unblock_user_btn"
                              data-user-id="<?= $user['id'] ?>">Unblock</button>



                          </td>

                        </tr>
                        <?php
                        $count++;
                      }
                      ?>


                    </tbody>
                  </table>
                  <?php
            }
            ?>
              </div>
              <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
            <br>
    <br>
    <br>

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer" style="position: fixed;
        bottom: 0;
        width: 100%;
        z-index: 1000; /* Adjust the z-index as needed */">
      <strong>Made By GPYavatmal 2023-2034 CO-6-I CPE Group 9.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 0.0.1
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>

  <!-- ChartJS -->
  <script src="plugins/chart.js/C?hart.min.js"></script>
  <!-- Sparkline -->
  <script src="plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->





  <script src="dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard.js"></script>
  <script src="js/actions.js?v=<?= time() ?>"></script>

</body>

</html>
<?php

if (isset($_SESSION['error'])) {
  unset($_SESSION['error']);
}
?>