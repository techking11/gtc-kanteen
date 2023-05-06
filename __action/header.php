<?php
session_start();
include '././Admin/config/config.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

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
  <link rel="shortcut icon" href="images/favicon.png" />

  <title>GTC - KanTeen</title>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

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

<body>

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
              <li class="nav-item">
                <a class="nav-link" href="index.php"> <strong>Home</strong> </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#all_shop"> <strong>Shop</strong> </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.php"> <strong>About</strong> </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.php"> <strong>Contact</strong> </a>
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

                    <?php
                    if (isset($_POST['signup'])) {

                      $username = $_POST['username'];
                      $gmail = $_POST['gmail'];
                      $passwd = $_POST['passwd'];
                      $sql = "INSERT INTO tblsignup (username, email, password) VALUES (?, ?, ?)";

                      if ($stmt = $database->prepare($sql)) {
                        $stmt->bindParam(1, $username);
                        $stmt->bindParam(2, $gmail);
                        $stmt->bindParam(3, $passwd);
                      }
                      if($stmt->execute() == true) {
                        $_SESSION['username'] = $_POST['username'];
                        echo "<script>window.location.href='index.php'</script>";
                      }
                    }
                    if(isset($_POST['signin'])) {
                      $email = $_POST['email'];
                      $password = $_POST['password'];

                      $query = "SELECT * FROM tblsignup WHERE email ='$email'";
                      $pre = $database->prepare($query);
                      $pre->execute();
                      $res = $pre->fetch();

                      if($res) {
                        if(($email == $res['email']) && ($password == $res['password'])) {
                          $_SESSION['username'] = $res['username'];
                          echo "<script>window.location.href='index.php'</script>";
                        }
                      }else {
                        echo "<script>alert('Login Unsuccessful !');</script>";
                      }
                    }
                    ?>

                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div id="home" class="container tab-pane active"><br>
                        <form action="" method="post">
                          <div class="input-group mb-3 mt-3">
                            <input type="text" class="form-control" placeholder="Username" name="username" autocomplete="off" required>
                          </div>
                          <div class="input-group mb-3 mt-3">
                            <input type="email" class="form-control" placeholder="Email" name="gmail" autocomplete="off" required>
                          </div>
                          <div class="input-group mb-3 mt-3">
                            <input type="password" class="form-control" placeholder="Password" name="passwd" required>
                          </div>
                          <div class="input-group mb-3 mt-3">
                            <input type="submit" value="Sign Up" class="btn btn-block btn-primary" name="signup">
                          </div>
                        </form>
                      </div>
                      <div id="menu1" class="container tab-pane fade"><br>
                        <form action="" method="post">
                          <div class="input-group mb-3 mt-3">
                            <input type="email" class="form-control" placeholder="Email" name="email" autocomplete="off" required>
                          </div>
                          <div class="input-group mb-3 mt-3">
                            <input type="password" class="form-control" placeholder="Password" name="password" required>
                          </div>
                          <div class="input-group mb-3 mt-3">
                            <input type="submit" value="Sign In" class="btn btn-block btn-primary" name="signin">
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
    <!-- slider section -->
    <section class="slider_section ">
      <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container ">
              <div class="row">
                <div class="col-md-7 col-lg-6 ">
                  <div class="detail-box">
                    <h1 style="font-size: 245%;">
                      Welcome From GTC - KPU KanTinn
                    </h1>
                    <p class="text-justify">
                      Doloremque, itaque aperiam facilis rerum, commodi, temporibus sapiente ad mollitia laborum quam quisquam esse error unde. Tempora ex doloremque, labore, sunt repellat dolore, iste magni quos nihil ducimus libero ipsam.
                    </p>
                    <div class="btn-box">
                      <a href="about.php" class="btn1">
                        More Details
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container ">
              <div class="row">
                <div class="col-md-7 col-lg-6 ">
                  <div class="detail-box">
                    <h1>
                      Contact To Us
                    </h1>
                    <p class="text-justify">
                      Doloremque, itaque aperiam facilis rerum, commodi, temporibus sapiente ad mollitia laborum quam quisquam esse error unde. Tempora ex doloremque, labore, sunt repellat dolore, iste magni quos nihil ducimus libero ipsam.
                    </p>
                    <div class="btn-box">
                      <a href="contact.php" class="btn1">
                        More Details
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <ol class="carousel-indicators">
            <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
            <li data-target="#customCarousel1" data-slide-to="1"></li>
          </ol>
        </div>
      </div>

    </section>
    <!-- end slider section -->
  </div>
