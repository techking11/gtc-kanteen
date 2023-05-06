<?php
include './__action/nav.php';
include './Admin/config/config.php';
if(empty($_SESSION['username'])) {
  echo "<script>window.location.href='index.php'</script>";
}
?>
<!-- about section -->

<section class="layout_padding pt-3">
    <div class="container">
      <a href="bubble.php" class="btn btn-info">&leftarrow; Back</a>
      <?php
      $stmt = $database->prepare("SELECT * FROM tblbubblekanteen WHERE id =".$_GET['id']);
      $stmt->execute();
      $result = $stmt->fetch();
      $count = $result['menu_order'];
      $rating = $result['menu_rating'];
      ?>
        <div class="row mt-4">
          <div class="col-md-12 heading_container">
            <h2><?php echo $result['menu_name']; ?> - Bubble KanTeen</h2>
            <small> - <?php echo $result['menu_series']; ?></small>
          </div>
          <div class="col-md-6">
              <div class="img-box mt-3">
                <img src="./Admin/images/<?php echo $result['menu_img']; ?>" alt="" class="img-fluid rounded" width="100%">
                <?php
                if (isset($_POST['order'])) {
                  $add = $count + 1;
                  $sql = "UPDATE tblbubblekanteen SET menu_order='$add' WHERE id =".$_GET['id'];
                  $stmt = $database->prepare($sql);
                  $stmt->execute();

                  if ($_SESSION['username']) {
                    $user = $_POST['name'];
                    $kanteen = 'Bubble KanTeen';
                    $order = $_POST['order_no'];
                    $user_phone = $_POST['phone_no'];
                    $user_addr = $_POST['order_addr'];
                    date_default_timezone_set("Asia/Yangon");
                    $order_time = date('h:i:s a');
                    $query = "INSERT INTO tbltemporder (menu_name, kanteen, order_no, order_user,phone_no,address, order_time) VALUES (?, ?, ?, ?, ?,?,?)";
                    if ($prepare = $database->prepare($query)) {
                      $prepare->bindParam(1, $result['menu_name']);
                      $prepare->bindParam(2, $kanteen);
                      $prepare->bindParam(3, $order);
                      $prepare->bindParam(4, $user);
                      $prepare->bindParam(5, $user_phone);
                      $prepare->bindParam(6, $user_addr);
                      $prepare->bindParam(7, $order_time);
                    }
                    if ($prepare->execute() == true) {
                      echo "
                      <div class='alert alert-success alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <strong>Success!</strong> Successful your Order !
                      </div>
                      ";
                    }
                  }
                }
                ?>
                <h5 class="d-flex justify-content-between align-items-center mt-3">
                  <button class="btn btn-dark" data-toggle="modal" data-target="#OrderModalCenter">Add To Cart</button>
                  <!-- Modal -->
                  <div class="modal fade" id="OrderModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-body">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <div class="container mt-5">
                            <h2><b>Order</b>App</h2>
                            <form action="" method="post">
                              <div class="input-group mb-3 mt-3">
                                <input type="text" class="form-control" placeholder="Your Name : " name="name" autocomplete="off" required>
                              </div>
                              <div class="input-group mb-3 mt-3">
                                <input type="text" class="form-control" placeholder="Order : " name="order_no" autocomplete="off" required>
                              </div>
                              <div class="input-group mb-3 mt-3">
                                <input type="text" class="form-control" placeholder="Phone no : " name="phone_no" autocomplete="off" required>
                              </div>
                              <div class="input-group mb-3 mt-3">
                                <input type="text" class="form-control" placeholder="Address : " name="order_addr" autocomplete="off" required>
                              </div>
                              <div class="input-group mb-3 mt-3">
                                <input type="submit" value="Order" class="btn btn-primary" name="order">
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <?php
                  function query($sql)
                  {
                      $pdo = new PDO('mysql:host=localhost;dbname=dbgtckanteen','root', '');
                      $res = $pdo->prepare($sql);
                      $res->execute();
                      $data = $res->fetch(PDO::FETCH_OBJ);
                      return $data;
                  }
                  $data = query('SELECT menu_rating FROM tblbubblekanteen WHERE id ='.$result['id']);
                  ?>
                  <span class="d-flex">
                      <small style="margin-top: 7px;" id="btnLike"> <?php echo $data->menu_rating; ?> </small>&ensp;
                      <button class="btn btn-warning" onclick="countLike()"><i class="text-light fa fa-light fa-star"></i></button>
                  </span>
                </h5>
              </div>
            </div>
          <div class="col-md-6">
              <div class="detail-box">
                <p class="d-flex justify-content-between align-items-center border-bottom pb-2">
                  <span class="text-danger"><?php echo $result['menu_date']; ?></span>
                  <b class="text-warning"><?php echo $result['menu_price']; ?> MMK</b>
                </p>
                <?php
                $length = strlen($result['menu_content']);
                $str = explode(".", $result['menu_content']);
                $total = count($str);
                $half = ceil(count($str) / 2);
                ?>
                  <p class="text-justify mt-2" style="text-indent: 60px;">
                    <?php
                    for($i = 0; $i < $half; $i++) {
                      echo $str[$i] . '.';
                    }
                    ?>
                  </p>
                  <p class="text-justify mt-2" style="text-indent: 60px;">
                    <?php
                    for($i = $half; $i < $total; $i++) {
                      echo $str[$i] . '.';
                    }
                    ?>
                  </p>
              </div>
          </div>
        </div>
    </div>
</section>

<script>
    function countLike() {
        fetch("http://localhost/GTC%20KanTeen/bubbleapi.php?id=<?php echo $result['id']; ?>")
        .then(function(res) {
            return res.json();
        })
        .then(function(data) {
            document.getElementById('btnLike').innerHTML = data.menu_rating;
        })
    }
</script>

<!-- end about section -->
<?php include './__action/footer.php'; ?>
