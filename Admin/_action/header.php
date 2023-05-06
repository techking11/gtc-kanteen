<?php
include './config/config.php';
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GTC - KanTeen</title>

  <link rel="shortcut icon" href="dist/img/favicon.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
      </ul>
      <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline" action="" method="post">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" name="search">
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
      </li>
      <?php
      $stmt = $database->prepare("SELECT * FROM tbltemporder ORDER BY id DESC LIMIT 1");
      $stmt->execute();
      $result = $stmt->fetchAll();
      if (empty($result)) {
        $result[0]['order_user'] = 'none';
        $result[0]['menu_name'] = '';
        $result[0]['kanteen'] = '';
        $result[0]['order_time'] = '00:00:00';
      }

      date_default_timezone_set("Asia/Yangon");
      $setDate = date("Y-m-d");

      $stmt = $database->prepare("SELECT count(*) as total FROM tbltemporder");
      $stmt->execute();
      $data = $stmt->fetchAll();

      ?>
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge" style="<?php if($data[0]['total'] == 0) {echo "display:none;";}else{echo "display:inline;";} ?>"><?php echo $data[0]['total']; ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="images/profile.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  <?php echo $result[0]['order_user']; ?>
                </h3>
                <p class="text-sm"><?php echo $result[0]['menu_name'].' - '.$result[0]['kanteen']; ?></p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i><?php echo $result[0]['order_time']; ?></p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="./temporder.php" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <?php
      $stmt = $database->prepare("SELECT * FROM tbltempcontact ORDER BY id DESC LIMIT 1");
      $stmt->execute();
      $resultNoti = $stmt->fetchAll();
      if (empty($resultNoti)) {
        $resultNoti[0]['contact_time'] = '00:00:00';
      }

      date_default_timezone_set("Asia/Yangon");
      $setDate = date("Y-m-d");

      $stmt = $database->prepare("SELECT count(*) as total FROM tbltempcontact");
      $stmt->execute();
      $dataNoti = $stmt->fetchAll();

      ?>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge " style="<?php if($dataNoti[0]['total'] == 0) {echo "display:none;";}else{echo "display:inline;";} ?>"><?php echo $dataNoti[0]['total']; ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> <?php echo $dataNoti[0]['total']; ?> new messages
            <span class="float-right text-muted text-sm"><?php echo $resultNoti[0]['contact_time']; ?></span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="./tempcontact.php" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/favicon.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href=".././././index.php" class="d-block" target="_blank">Dashboard</a>
        </div>
      </div>
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/favicon.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="index.php" class="d-block">Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                KanTeen Tables
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="././index.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Network KanTeen</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="././apyokanteen.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>APyo KanTeen</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="././drawingkanteen.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Drawing KanTeen</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="././areekanteen.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ARee KanTeen</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="././mekanteen.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ME KanTeen</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="././bubblekanteen.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bubble KanTeen</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="././team.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Team Member</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="././user.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="././logout.php" class="nav-link" onclick="return confirm('Are you sure to delete this item !'); ">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
