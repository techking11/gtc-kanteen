<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/favicon.png" type="">

  <title>GTC - KanTeen</title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- nice select  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

</head>

<body class="sub_page">

  <div class="hero_area">
    <div class="bg-box">
      <img src="images/hero-bg.jpg" alt="">
    </div>
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.php">
            <span>
              GTC - KanTeen
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  mx-auto ">
              <li class="nav-item ">
                <a class="nav-link" href="index.php">Home </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="_shop.php">Shop</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
              </li>
            </ul>
            <div class="user_option">
              <a href="#" class="order_online" data-toggle="modal" data-target="#exampleModalCenter">
                <?php if(empty($_SESSION['username'])) {echo 'Sign in';}else {echo $_SESSION['username'];} ?>
              </a>
              <!-- Button trigger modal -->

              <!-- Modal -->
              <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-body p-5">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <div class="container" style="<?php if(!empty($_SESSION['username'])) {echo "display:none;";}else{echo "display:inline;";} ?>">
                    <ul class="nav nav-tabs">
                      <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home">Sign Up</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu1">Sign In</a>
                      </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div id="home" class="container tab-pane active"><br>
                        <form action="" method="post">
                          <div class="input-group mb-3 mt-3">
                            <input type="text" class="form-control" placeholder="Username" name="username" autocomplete="off">
                          </div>
                          <div class="input-group mb-3 mt-3">
                            <input type="email" class="form-control" placeholder="Email" name="email" autocomplete="off">
                          </div>
                          <div class="input-group mb-3 mt-3">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                          </div>
                          <div class="input-group mb-3 mt-3">
                            <input type="submit" value="Sign Up" class="btn btn-block btn-primary" name="signup">
                          </div>
                        </form>
                      </div>
                      <div id="menu1" class="container tab-pane fade"><br>
                        <form action="" method="post">
                          <div class="input-group mb-3 mt-3">
                            <input type="email" class="form-control" placeholder="Email" name="email" autocomplete="off">
                          </div>
                          <div class="input-group mb-3 mt-3">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                          </div>
                          <div class="input-group mb-3 mt-3">
                            <input type="submit" value="Sign In" class="btn btn-block btn-primary">
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <?php if (!empty($_SESSION['username'])): ?>
                    <form class="float-left" action="./logout.php" method="post">
                      <input type="submit" name="" value="Logout" class="btn btn-danger">
                    </form>
                  <?php endif; ?>
              </div>
              </div>
              </div>
            </div>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
  </div>
